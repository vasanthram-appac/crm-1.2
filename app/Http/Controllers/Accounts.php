<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DB;

class Accounts extends Controller
{

    public function index(Request $request)
    {

        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {
            //   dd($request->all());

            // Set default session values if not set
            if (!request()->session()->has('active_status') || request()->session()->get('active_status') == "") {
                request()->session()->put('active_status', '1');
            }

            if (!request()->session()->has('empactive_status') || request()->session()->get('empactive_status') == "") {
                request()->session()->put('empactive_status', 'All');
            }

            // Update session values from request if provided
            if (!empty($request->status)) {
                request()->session()->put('active_status', $request->status);
            }

            if (!empty($request->empstatus)) {
                request()->session()->put('empactive_status', $request->empstatus);
            }

            $activeStatus = request()->session()->get('active_status');
            $empStatus = request()->session()->get('empactive_status');

            $query = DB::table('accounts')
                ->where('status', '!=', '0');

            // Add filters based on active_status
            switch ($activeStatus) {
                case 'All':
                    // No additional filter
                    break;

                case 'active':
                case 'inactive':
                    $query->where('active_status', $activeStatus);
                    break;

                case '1':
                    $query->where('active_status', 'active')->where('key_status', 1);
                    break;

                case 'Download':
                    $query->where('download_status', 'Download');
                    break;

                default:
                    $query->where('active_status', 'active');
                    break;
            }

            // Filter by assigned employee if not 'All'
            if ($empStatus != "All") {
                $query->where('assignedto', $empStatus);
            }

            // Choose ordering column based on status
            $orderByColumn = ($activeStatus == '1') ? 'accounts.order_id' : 'accounts.id';

            $data = $query->orderBy($orderByColumn, 'ASC')->get();

            // dd($data);

            if (count($data) > 0) {

                foreach ($data as $datas) {

                    $assname = DB::table('regis')->select('fname', 'lname')->where('empid', $datas->assignedto)->first();

                    $datas->assignedname = $assname ? $assname->fname . ' ' . $assname->lname : '';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('company_name', function ($row) {
                    return '<button class="btn  btn-modal text-lblue" data-cid="' . $row->id . '" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->id]) . '">' . $row->company_name . ' </button>';
                })
                // ->addColumn('assignedto', function ($row) {
                //     return '
                //             <button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->assignedto) . '">' . $row->assignedto . ' </button>';
                // })
                ->addColumn('active_status', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatus = $row->active_status == 'inactive' ? 'active' : 'inactive';

                    $nextStatus1 = $row->active_status == 'inactive' ? '<i class="fi fi-ts-toggle-off "></i> <span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on ms-2"></i> <span class="tooltiptext">inactive</span>';

                    // Return the current active status with the button for the next action
                    return ucfirst($row->active_status) .
                        '<button class="btn btn-modal text-lblue change-status" data-container=".appac_show" data-href="' . route('statusupdate', [
                            'id' => $row->id,
                            'active_status' => $nextStatus
                        ]) . '">' . $nextStatus1 . '</button>';
                })

                ->addColumn('key_status', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatus = $row->key_status == '0' ? '1' : '0';

                    $nextStatus1 = $row->key_status == '0' ? '<i class="fi fi-ts-toggle-off "></i> <span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on ms-2"></i> <span class="tooltiptext">inactive</span>';

                    $key = $row->key_status == '0' ? 'Not' : 'Key Account';

                    // Return the current active status with the button for the next action
                    return ucfirst($key) .
                        '<button class="btn btn-modal text-lblue change-status" data-container=".appac_show" data-href="' . route('keystatus', [
                            'id' => $row->id,
                            'key_status' => $nextStatus
                        ]) . '"> ' . $nextStatus1 . ' </button>';
                })

                ->addColumn('download_status', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatusd = $row->download_status == 'Not' ? 'Download' : 'Not';

                    $nextStatusd1 = $row->download_status == 'Not' ? '<i class="fi fi-ts-toggle-off "></i> <span class="tooltiptext">Download</span>' : '<i class="fi fi-ts-toggle-on ms-2"></i> <span class="tooltiptext">Not</span>';

                    // Return the current active status with the button for the next action
                    return ucfirst($row->download_status) .
                        '<button class="btn btn-modal text-lblue change-status" data-container=".appac_show" data-href="' . route('downloadstatus', [
                            'id' => $row->id,
                            'download_status' => $nextStatusd
                        ]) . '">' . $nextStatusd1 . '</button>';
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn  btn-modal" data-container=".customer_modal" data-href="' . action([Accounts::class, 'edit'], [$row->id]) . '">
                     <i class="fi fi-ts-file-edit"></i> 
					  <span class="tooltiptext">Edit</span>
					 </button>';
                })
                ->rawColumns(['sno', 'action', 'active_status', 'key_status', 'company_name', 'download_status'])
                ->make(true);
        }

        $allActivests = DB::table('accounts')->where('status', '!=', '0')->get();

        $key =  DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'active')->where('key_status', 1)->orderBy('accounts.id', 'ASC')->get();

        $active = DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'active')->orderBy('accounts.id', 'ASC')->get();
        $inactive = DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'inactive')->orderBy('accounts.id', 'ASC')->get();
        $download = DB::table('accounts')->where('status', '!=', '0')->where('download_status', 'Download')->orderBy('accounts.id', 'ASC')->get();

        return view('accounts/index')->with(compact('allActivests', 'key', 'active', 'inactive', 'download'))->render();
    }

    public function Viewaccounts($id)
    {
        $accounts = DB::table('accounts')->where('id', $id)->first();

        $seoclient = DB::table('seo_client')->where('id', $id)->first();

        if (!empty($seoclient)) {
            $managedby = DB::table('regis')->where('empid', $seoclient->managed_by)->where('status', 1)->first();
        } else {
            $managedby = "";
        }

        $accountmanager = DB::table('regis')->where('empid', $accounts->accountmanager)->where('status', '!=', 0)->first();

        $results = DB::table('regis')->where('status', 1)->where('fname', '!=', 'Appac')->whereNotIn('id', [2, 3])->orderBy('fname', 'asc')->get();

        $notes = DB::table('notes as n')->join('regis as r', 'n.employee', '=', 'r.empid')->select('n.*', 'r.fname', 'r.lname')->where('n.company_name', $id)->orderByDesc('n.id')->get();

        $history = DB::table('wip_history as wh')
            ->join('work_wip as w', 'wh.wip_id', '=', 'w.id')
            ->join('regis as r', 'wh.empid', '=', 'r.empid')
            ->select('wh.*', 'w.id', 'r.fname', 'r.lname')->where('w.client_id', $id)->get();

        $today = date('m-Y');

        $today1 = date('m-Y', strtotime('-1 month'));

        $reports = DB::table('dailyreport as d')
            ->join('accounts as a', 'd.client', '=', 'a.id')
            ->join('regis as r', 'd.empid', '=', 'r.empid')
            ->select(
                'd.id',
                'd.report_date',
                'd.empid',
                'd.client',
                'd.project_name',
                'd.start_time',
                'd.end_time',
                'd.status',
                'd.submit_time',
                'a.company_name',
                'r.fname',
                'r.lname'
            )
            ->where('d.client', $id)
            // ->where('d.enquiry_month', $today)
            // ->where('d.enquiry_month', $today1)
            ->orderBy('d.report_date1', 'desc')->get();

        if (count($reports) > 0) {
            foreach ($reports as $report) {

                $dateDiff = intval((strtotime($report->end_time) - strtotime($report->start_time)) / 60);
                $hours = intval($dateDiff / 60);
                $minutes = $dateDiff % 60;

                $report->total_time = $hours . " Hours and " . $minutes . " Minutes";
            }
        }

        $payments = DB::table('payment_list as p')
            ->join('regis as r', 'r.empid', '=', 'p.create_empid')
            ->leftJoin('payment_list_invoice as pli', 'pli.plist_id', '=', 'p.id')
            ->select(
                'p.id as pid',
                'p.paydate',
                'p.bankname',
                'p.chequeno',
                'p.neftnumber',
                'p.productservice',
                'p.payamount',
                'r.fname',
                'r.lname',
                'pli.pinvoice',
                'pli.invoiceno'
            )
            ->where('p.company_name', $id)
            ->orderBy('p.id', 'desc')
            ->get();

        $totalPay = $payments->sum(function ($payment) {
            $cleanedAmount = str_replace([',', '/-', ' '], '', $payment->payamount);
            return is_numeric($cleanedAmount) ? (float) $cleanedAmount : 0;
        });

        $viewquery = DB::table('social_login as s')
            ->join('accounts as a', 'a.id', '=', 's.clientid')
            ->select(
                's.id',
                's.clientid',
                's.title',
                's.url',
                's.username',
                's.password',
                's.remarks',
                's.managedby',
                's.createdby',
                'a.id as account_id',
                'a.company_name'
            )
            ->where('s.clientid', $id)
            ->get();


        // Revnue start
        $revenueData = DB::table('payment_list')
            ->where('company_name', $id)
            ->whereYear('paydate', date('Y'))
            ->select('payamount')  // Get only the payamount column
            ->get();

        $totalrev = 0;


        // Step 2: Loop through the data, clean and sum the amounts
        foreach ($revenueData as $row) {
            // Split the payamount string by '&' if present
            $amounts = preg_split('/\s*&\s*/', $row->payamount);  // Split by '&' and remove extra spaces

            // Process each part
            foreach ($amounts as $amount) {
                // Remove any non-numeric characters except for decimal points
                $cleanedAmount = preg_replace('/[^\d.]/', '', $amount);

                // Convert the cleaned-up amount to a float and add it to the total
                $totalrev += (float)$cleanedAmount;
            }
        }

        // Function to format the number in Indian numbering format
        function formatIndianNumber($number)
        {
            // Format the number with commas

            if (!$number || $number == 0) {
                return ['formatted' => 'Revenue', 'scale' => ''];
            }

            $formattedNumber = number_format($number);

            // Initialize the scale
            $scale = '';

            // Check the scale of the number
            if ($number >= 10000000) {
                $scale = 'Crore';
                $number /= 10000000; // Convert to Crores
            } elseif ($number >= 100000) {
                $scale = 'Lakh';
                $number /= 100000; // Convert to Lakhs
            } elseif ($number >= 1000) {
                $scale = 'Thousand';
                $number /= 1000; // Convert to Thousands
            }

            // Return formatted number with scale
            return ['formatted' => $formattedNumber, 'scale' => $scale];
        }

        // Get the formatted revenue with scale
        $formattedData = formatIndianNumber($totalrev);

        // Output formatted total revenue with scale

        $formattedNumber = $formattedData['formatted'];
        $scale = $formattedData['scale'];

        $domain = DB::table('domain')->where('company_name', $id)->select(
            'domain_manager as domain_manager',  // Alias for domain_manager
            'domain_source as domain_source',
            'dateofexpire'     // Alias for domain_source
        )->get();

        $email = DB::table('emailserver')->where('company_name', $id)->select('noofemailid', 'dateofexpire', 'vendorname')->first();

        $ssl = DB::table('ssl_certificate')->where('company_name', $id)->select('source as Source', 'domainmonth as D_month', 'dateofexpire')->get();

        $hosting = DB::table('hosting')->where('company_name', $id)->select('dateofexpire', 'hosting_source', 'hosting_manager')->first();

        $plans = DB::table('plans')->where('company_name', $id)->where('type', 'SEO')->select('dateofregis', 'dateofexpire', 'amount', 'plansmonth')->first();
        $plan = DB::table('plans')->where('company_name', $id)->where('type', 'AMC')->select('dateofregis', 'dateofexpire', 'amount', 'plansmonth')->first();
        $dmworks = DB::table('dmworks')->select('name', 'type', 'url')->where('company_name', $id)->get();

        $invoice = DB::table('invoicedetails')
            ->join('regis', 'invoicedetails.empid', 'regis.empid')
            ->select('regis.fname', 'invoicedetails.invoice_no', 'invoicedetails.invoice_date', 'invoicedetails.grosspay')
            ->where('company_id', $id)->orderBy('invoicedetails.id', 'desc')->get();

        $proforma = DB::table('proformadetails')
            ->join('regis', 'proformadetails.empid', 'regis.empid')
            ->select('regis.fname', 'proformadetails.invoice_no', 'proformadetails.invoice_date', 'proformadetails.grosspay')
            ->where('company_id', $id)->orderBy('proformadetails.id', 'desc')->get();

        $asset = DB::table('assetlibrary')->select('name', 'file')->where('company_name', $id)->get();

        // $requiredinput = DB::table('requiredinput')->select('name', 'file', 'description')->where('company_name', $id)->where('type','Input')->get();

        // $workprocess = DB::table('requiredinput')->select('name', 'file', 'description')->where('company_name', $id)->where('type','MOM')->get();

        $regis = DB::table('regis')
            ->where('status', '=', '1')
            ->where('id', '==', '1')
            ->where('id', '==', '6')
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid');

        $data = DB::table('dailyreport')
            ->join('accounts', 'dailyreport.client', '=', 'accounts.id')
            ->join('regis', 'dailyreport.empid', '=', 'regis.empid')
            ->select(
                'dailyreport.*',
                'accounts.company_name as company_name_account',
                DB::raw("CONCAT(regis.fname, ' ', regis.lname) as emp_fullname"),
                DB::raw("CONCAT(dailyreport.w_hours, ' Hours ', dailyreport.w_mins, ' Minutes') as total_time")
            )
            ->where('dailyreport.enquiry_month', $today1)
            ->where('dailyreport.client', $id)
            ->orWhere('dailyreport.wipid', $id)
            ->orderBy('dailyreport.id', 'asc')
            ->get();

        if ($data) {

            $totalHours = 0; // Initialize a variable to store total hours
            $hoursList = []; // Array to store all `w_hours` values

            foreach ($data as $item) {

                $wHours = (int)$item->dept_id;

                // Cast `w_hours` to integer for calculations
                $hoursList[] = $wHours; // Add to the list
                $totalHours += $wHours; // Aggregate total hours
            }

            // Debugging: Check extracted hours and total hours

            $totals = [
                'Management' => ['hours' => 0, 'minutes' => 0],
                'Design' => ['hours' => 0, 'minutes' => 0],
                'Development' => ['hours' => 0, 'minutes' => 0],
                'Promotion' => ['hours' => 0, 'minutes' => 0],
                'ContentWriter' => ['hours' => 0, 'minutes' => 0],
                'Marketing' => ['hours' => 0, 'minutes' => 0],
                'Client' => ['hours' => 0, 'minutes' => 0],

            ];

            foreach ($data as $item) {
                $totalMinutes = (int)$item->w_mins;
                $totalHours = (int)$item->w_hours;

                // Update department-specific totals
                if ($item->dept_id == '1') {
                    $totals['Management']['hours'] += $totalHours;
                    $totals['Management']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '2') {
                    $totals['Design']['hours'] += $totalHours;
                    $totals['Design']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '3') {
                    $totals['Development']['hours'] += $totalHours;
                    $totals['Development']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '4') {
                    $totals['Promotion']['hours'] += $totalHours;
                    $totals['Promotion']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '5') {
                    $totals['ContentWriter']['hours'] += $totalHours;
                    $totals['ContentWriter']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '6') {

                    $totals['Marketing']['hours'] += $totalHours;
                    $totals['Marketing']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '7') {

                    $totals['Client']['hours'] += $totalHours;
                    $totals['Client']['minutes'] += $totalMinutes;
                }
            }

            // Normalize minutes into hours for all departments
            foreach ($totals as $key => $values) {
                $extraHours = intdiv($values['minutes'], 60);
                $totals[$key]['hours'] += $extraHours;
                $totals[$key]['minutes'] = $values['minutes'] % 60;
            }
        };



        // for ($i = 0; $i < 7; $i++) {
        //     $month = date('m');
        //     $year = date('Y');

        //     $wipenq = DB::connection('mysql_second') // Specify the second database connection
        //         ->table('website_enquiry_data')
        //         ->where(DB::raw("SUBSTRING(enquiry_date, 4, 2)"), $month)
        //         ->where(DB::raw("SUBSTRING(enquiry_date, 7, 4)"), $year)
        //         ->where()
        //         ->count();

        //     $wipenqs[] = [
        //         'month' => date('M Y'),
        //         'leads' => $wipenq
        //     ];
        // }


        return view('accounts.create')->with(compact('accounts', 'managedby', 'accountmanager', 'results', 'notes', 'history', 'reports', 'payments', 'totalPay', 'viewquery', 'formattedNumber', 'scale', 'domain', 'email', 'ssl', 'hosting', 'plans', 'plan', 'dmworks', 'invoice', 'proforma', 'asset', 'regis', 'totals'));
    }

    public function store(Request $request)
    {
        // Display all input for debugging purposes

        // Collect values
        $val = [
            'datetimestamp' => $request->datetimestamp,
            'employee' => request()->session()->get('empid'),
            'subject' => $request->subject,
            'company_name' => $request->company_name,
            'submitdate' => date('Y-m-d'),
            'summary' => $request->summary,
        ];

        // Fetch company name
        $company = DB::table('accounts')->where('id', $request->company_name)->first();
        $company_name_value = $company->company_name ?? '';

        // Fetch employee details
        $employeeData = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
        $empid_value1 = $employeeData->fname ?? '';
        $empid_value2 = $employeeData->lname ?? '';
        $emailid = $employeeData->emailid ?? '';

        $accountmanager = DB::table('regis')->where('empid', $company->accountmanager)->first();
        $accountmanager_emailid = $accountmanager->emailid ?? '';

        // Insert note data
        $insert = DB::table('notes')->insert($val);

        if ($insert) {

            $htmlContent = '<html>
                    <head><title>Application</title></head>
                    <body>
                        <table style="background:#efeded; width:575px" cellpadding="0" cellspacing="0">
                            <tr>
                                <td align="center">
                                    <table width="96%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="border-top:5px solid #1e96d3; background:#fff; padding:20px;">
                                                <p style="font-size:14px; color:#000; font-weight:bold; text-align:center;">UPDATE ACCOUNT INFO</p>
                                                <p style="color:#000; font-size:13px;"> <strong>Dear Sir,</strong> <br> Account History Updated Through CRM Portal </p>
                                                <table style="font-family:Arial, sans-serif; font-size:12px; width:100%;">
                                                    <tr><td style="width:200px; padding:4px 0;">Company Name:</td><td style="font-weight:normal;">' . $company_name_value . '</td></tr>
                                                    <tr><td>Employee Name:</td><td style="font-weight:normal;">' . $empid_value1 . ' ' . $empid_value2 . '</td></tr>
                                                    <tr><td>EMP ID:</td><td style="font-weight:normal;">' . request()->session()->get('empid') . '</td></tr>
                                                    <tr><td>Date of Info Updated:</td><td style="font-weight:normal;">' . $request->datetimestamp . '</td></tr>
                                                    <tr><td>Subject:</td><td style="font-weight:normal;">' . $request->subject . '</td></tr>
                                                    <tr><td>Summary:</td><td style="font-weight:normal;">' . $request->summary . '</td></tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>';

            // Get email addresses from environment variables
            $bccEmail = env('SUPPORTMAIL');
            $bala = env('FOUNDERMAIL');
            $infomail = env('INFOMAIL');
            $managermail = env('MANAGERMAIL');
            $thesupportmail = request()->session()->get('dept_id') == 6 ? env('THESUPPORTMAIL') : null;

            // // Send email
            Mail::send([], [], function ($message) use ($request, $bala, $managermail, $bccEmail, $infomail, $emailid, $company_name_value, $htmlContent, $empid_value2, $thesupportmail, $accountmanager_emailid) {
                // Configure email properties
                $message->to($bala)
                    ->cc(array_filter([$managermail, $thesupportmail]))
                    ->bcc($bccEmail)
                    ->replyTo($emailid)
                    ->from($infomail, $company_name_value)
                    ->subject($request->subject)
                    ->html($htmlContent)
                    ->cc($accountmanager_emailid);

                // Add any CC emails from mail_cc array
                if ($request->has('mail_cc') && count($request->mail_cc) > 0) {
                    foreach ($request->mail_cc as $m_email) {
                        if (filter_var($m_email, FILTER_VALIDATE_EMAIL)) {  // Validate CC email
                            $message->cc($m_email);
                        }
                    }
                }
            });

            session()->flash('secmessage', 'Notes Created Successfully.');
            return response()->json(['status' => 1, 'message' => 'Notes Created Successfully.', 'cid' => $request->company_name], 200);
        } else {
            session()->flash('secmessage', 'Notes Not Created Successfully.');
            return response()->json(['status' => 0, 'message' => 'Notes Not Created Successfully.', 'cid' => $request->company_name], 200);
        }
    }



    public function edit($id)
    {

        $accounts = DB::table('accounts')->where('id', $id)->first();

        $assignedto =  DB::table('regis')->where('status', 1)->whereIn('dept_id', [6, 1])->orderBy('regis.fname', 'ASC')->pluck('fname', 'empid');

        $accountmanager =  DB::table('regis')->where('status', '!=', 0)->pluck('fname', 'empid');

        return view('accounts.edit')->with(compact('accounts', 'assignedto', 'accountmanager'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'comp_title' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|numeric|digits:6',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:15',
            'stdcode' => 'nullable|string|max:10',
            'phone' => 'required|string|max:15',
            'alternatephone' => 'nullable|string|max:15',
            'emailid' => 'required|email|max:255',
            'website' => 'nullable|max:255',
            'assignedto' => 'required|string|max:255',
            'accountmanager' => 'required|string|max:255',

            'shipping_firstname' => 'nullable|string|max:255',
            'shipping_title' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'shipping_phone' => 'nullable|digits:10',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_pincode' => 'nullable|string|max:10',

            'csmname' => 'nullable|string|max:70',
            'csmphone' => 'nullable|digits:10',
            'csmemail' => 'nullable|email|max:255',
            'csmname1' => 'nullable|string|max:70',
            'csmphone1' => 'nullable|digits:10',
            'csmemail1' => 'nullable|email|max:255',
            'bdmname' => 'nullable|string|max:70',
            'bdmphone' => 'nullable|digits:10',
            'bdmemail' => 'nullable|email|max:255',
            'mdname' => 'nullable|string|max:70',
            'mdphone' => 'nullable|digits:10',
            'mdemail' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Prepare the data for updating
        $data = [

            'comp_title' => $request->comp_title,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gst_number' => $request->gst_number,
            'stdcode' => $request->stdcode,
            'phone' => $request->phone,
            'alternate_phone' => $request->alternatephone,
            'emailid' => $request->emailid,
            'website' => $request->website,
            'assignedto' => $request->assignedto,
            'accountmanager' => $request->accountmanager,

            'shipping_title' => $request->shipping_title ?? $request->title,
            'shipping_firstname' => $request->shipping_firstname ?? $request->firstname,
            'shipping_lastname' => $request->shipping_lastname ?? $request->lastname,
            'shipping_phone' => $request->shipping_phone ?? $request->phone,
            'shipping_address' => $request->shipping_address ?? $request->address,
            'shipping_city' => $request->shipping_city ?? $request->city,
            'shipping_state' => $request->shipping_state ?? $request->state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->pincode,

            'csmname' => $request->csmname,
            'csmphone' => $request->csmphone,
            'csmemail' => $request->csmemail,
            'csmname1' => $request->csmname1,
            'csmphone1' => $request->csmphone1,
            'csmemail1' => $request->csmemail1,
            'bdmname' => $request->bdmname,
            'bdmphone' => $request->bdmphone,
            'bdmemail' => $request->bdmemail,
            'mdname' => $request->mdname,
            'mdphone' => $request->mdphone,
            'mdemail' => $request->mdemail,
            'download_status' => $request->download_status,
        ];

        // Update the record in the database
        DB::table('accounts')->where('id', $id)->update($data);

        // Set a success message and return JSON response
        session()->flash('secmessage', 'Company Details Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Company Details Updated Successfully.'], 200);
    }

    public function Statusupdate($id, $active_status)
    {

        $update = DB::table('accounts')->where('id', $id)->update(['active_status' => $active_status]);

        if ($update) {
            session()->flash('secmessage', 'Status updated successfully!');
            return response()->json(['status' => 1, 'message' => 'Status updated successfully!'], 200);
        } else {
            session()->flash('secmessage', 'Failed to update status.');
            return response()->json(['status' => 1, 'message' => 'Failed to update status.'], 200);
        }
    }

    public function Downloadstatus($id, $download_status)
    {

        $update = DB::table('accounts')->where('id', $id)->update(['download_status' => $download_status]);

        if ($update) {
            session()->flash('secmessage', 'Status updated successfully!');
            return response()->json(['status' => 1, 'message' => 'Status updated successfully!'], 200);
        } else {
            session()->flash('secmessage', 'Failed to update status.');
            return response()->json(['status' => 1, 'message' => 'Failed to update status.'], 200);
        }
    }

    public function Keystatus($id, $key_status)
    {
        $order = DB::table('accounts')->select('order_id')->where('active_status', 'active')->where('key_status', 1)->orderBY('order_id', 'desc')->first();

        $order_id =  ($key_status == 1) ? $order->order_id + 1 : 0;

        $update = DB::table('accounts')->where('id', $id)->update(['key_status' => $key_status, 'order_id' => $order_id]);

        if ($update) {
            session()->flash('secmessage', 'Status updated successfully!');
            return response()->json(['status' => 1, 'message' => 'Status updated successfully!'], 200);
        } else {
            session()->flash('secmessage', 'Failed to update status.');
            return response()->json(['status' => 1, 'message' => 'Failed to update status.'], 200);
        }
    }

    public function dmaccountsearch($type, $name, $id)
    {
        // Store the parameters in session (or empty string if "All")
        request()->session()->put('dmname', $name === "All" ? "" : $name);
        request()->session()->put('dmtypea', $type === "All" ? "" : $type);

        // Build the query
        $query = DB::table('dmworks')
            ->select('name', 'type', 'url');

        if (!empty(request()->session()->get('dmname'))) {
            $query->where('name', request()->session()->get('dmname'));
        }

        if (!empty(request()->session()->get('dmtypea'))) {
            $query->where('type', request()->session()->get('dmtypea'));
        }

        // Fetch results
        $dmworks = $query->where('company_name', $id)->get();

        // Return JSON response
        return response()->json($dmworks);
    }

    public function requiredinputsearch($type, $id)
    {

        // Store the parameters in session (or empty string if "All")
        request()->session()->put('requiredinput', $type === "All" ? "" : $type);

        // Build the query
        $query = DB::table('requiredinput')
            ->select('name', 'description', 'file', 'url');

        if (!empty(request()->session()->get('requiredinput'))) {
            $query->where('worktype', request()->session()->get('requiredinput'));
        }

        // Fetch results
        $dmworks = $query->where('company_name', $id)->where('worktype', '!=', 'Close')->get();

        // Return JSON response
        return response()->json($dmworks);
    }

    public function totalhourssearch(Request $request)
    {
        $id = $request->id;

        if (!empty($request->daterange)) {
            $daterange = explode(' - ', $request->daterange);
            $start_date = date('Y-m-d', strtotime($daterange[0]));
            $end_date = date('Y-m-d', strtotime($daterange[1]));
        } else {
            $daterange = "01/01/2019 - 12/23/2024";
            $start_date = "2019-01-01";
            $end_date = "2024-23-12";
        }

        $data = DB::table('dailyreport')
            ->when($daterange, function ($query) use ($start_date, $end_date) {
                return $query->whereBetween('report_date1', [$start_date, $end_date])
                    ->orderBy('report_date1', 'asc');
            }, function ($query) {
                return $query->whereYear('report_date1', date('Y'))
                    ->whereMonth('report_date1', date('m', strtotime('-1 month')))
                    ->orderBy('report_date1', 'desc');
            })
            ->where('client', $id)
            ->orWhere('wipid', $id)
            ->get();

        if ($data) {

            $totalHours = 0; // Initialize a variable to store total hours
            $hoursList = []; // Array to store all `w_hours` values

            foreach ($data as $item) {

                $wHours = (int)$item->dept_id;

                // Cast `w_hours` to integer for calculations
                $hoursList[] = $wHours; // Add to the list
                $totalHours += $wHours; // Aggregate total hours
            }

            // Debugging: Check extracted hours and total hours

            $totals = [
                'Management' => ['hours' => 0, 'minutes' => 0],
                'Design' => ['hours' => 0, 'minutes' => 0],
                'Development' => ['hours' => 0, 'minutes' => 0],
                'Promotion' => ['hours' => 0, 'minutes' => 0],
                'ContentWriter' => ['hours' => 0, 'minutes' => 0],
                'Marketing' => ['hours' => 0, 'minutes' => 0],
                'Client' => ['hours' => 0, 'minutes' => 0],

            ];

            foreach ($data as $item) {
                $totalMinutes = (int)$item->w_mins;
                $totalHours = (int)$item->w_hours;

                // Update department-specific totals
                if ($item->dept_id == '1') {
                    $totals['Management']['hours'] += $totalHours;
                    $totals['Management']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '2') {
                    $totals['Design']['hours'] += $totalHours;
                    $totals['Design']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '3') {
                    $totals['Development']['hours'] += $totalHours;
                    $totals['Development']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '4') {
                    $totals['Promotion']['hours'] += $totalHours;
                    $totals['Promotion']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '5') {
                    $totals['ContentWriter']['hours'] += $totalHours;
                    $totals['ContentWriter']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '6') {

                    $totals['Marketing']['hours'] += $totalHours;
                    $totals['Marketing']['minutes'] += $totalMinutes;
                }
                if ($item->dept_id == '7') {

                    $totals['Client']['hours'] += $totalHours;
                    $totals['Client']['minutes'] += $totalMinutes;
                }
            }

            // Normalize minutes into hours for all departments
            foreach ($totals as $key => $values) {
                $extraHours = intdiv($values['minutes'], 60);
                $totals[$key]['hours'] += $extraHours;
                $totals[$key]['minutes'] = $values['minutes'] % 60;
            }
        };

        return response()->json($totals);
    }

    public function todaydetails()
    {

        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1') {

            $hosting = DB::table('hosting')
                ->join('domainmaster', 'hosting.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'hosting.company_name', '=', 'accounts.id')
                ->select('hosting.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(hosting.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('hosting.status', '0')
                ->where('hosting.dateofexpire', date('d-m-Y'))
                ->orderBy('id', 'ASC')
                ->get();

            $seo_client = DB::table('seo_client')
                ->join('domainmaster', 'seo_client.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'seo_client.company_name', '=', 'accounts.id')
                ->select('seo_client.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(seo_client.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('seo_client.status', '0')
                ->where('seo_client.dateofexpire', date('d-m-Y'))
                ->orderBy('DateFormat', 'Desc')
                ->get();

            $domain = DB::table('domain')
                ->join('domainmaster', 'domain.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'domain.company_name', '=', 'accounts.id')
                ->select('domain.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(domain.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('domain.status', '0')
                ->where('domain.dateofexpire', date('d-m-Y'))
                ->orderBy('id', 'ASC')
                ->get();

            $emailserver = DB::table('emailserver')
                ->join('domainmaster', 'emailserver.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'emailserver.company_name', '=', 'accounts.id')
                ->select('emailserver.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(emailserver.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('emailserver.status', '0')
                ->where('emailserver.dateofexpire', date('d-m-Y'))
                ->orderBy('id', 'ASC')
                ->get();

            $ssl_certificate = DB::table('ssl_certificate')
                ->join('domainmaster', 'ssl_certificate.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'ssl_certificate.company_name', '=', 'accounts.id')
                ->select('ssl_certificate.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(ssl_certificate.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('ssl_certificate.status', '0')
                ->where('ssl_certificate.dateofexpire', date('d-m-Y'))
                ->orderBy('DateFormat', 'Desc')
                ->get();

            $task = DB::table('task_management as t')
                ->join('regis', 't.empid', '=', 'regis.empid')
                ->select('t.task_name', 't.task_duedate', 'regis.fname', 'regis.lname')
                ->whereRaw("STR_TO_DATE(t.task_duedate, '%d-%m-%Y') < ?", [date('Y-m-d')])
                ->where('t.task_duedate', '!=', '')
                ->whereNotIn('t.task_status', ['completed', 'closed'])
                ->where('regis.status', 1)
                ->orderBY('t.taskid', 'desc')
                ->get();

            $threeDaysAgo = date('Y-m-d', strtotime('-3 days'));

            $accounthistory = DB::table('notes')
                ->select('accounts.company_name', DB::raw('DATE_FORMAT(MAX(notes.submitdate), "%d-%m-%Y") as last_submit_date'))
                ->join('accounts', 'notes.company_name', '=', 'accounts.id')
                ->where('accounts.active_status', 'active')
                ->where('accounts.key_status', 1)
                ->groupBy('accounts.company_name','accounts.order_id')
                ->havingRaw('MAX(notes.submitdate) < ?', [$threeDaysAgo])
                ->orderBy('accounts.order_id', 'ASC')
                ->get();

            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d', strtotime('+3 days'));

            $dmcontract = DB::table('seo_client')
                ->join('accounts', 'seo_client.company_name', '=', 'accounts.id')
                ->select('seo_client.dateofexpire', 'seo_client.promotion_status', 'accounts.company_name as companyname')
                ->where('seo_client.status', '0')
                ->whereBetween('dateofexpire1', [$startDate, $endDate])
                ->orderBy('dateofexpire', 'Desc')
                ->get();
        } else {

            $hosting = [];
            $seo_client = [];
            $domain = [];
            $emailserver = [];
            $ssl_certificate = [];
            $accounthistory = [];
            $dmcontract = [];

            $task = DB::table('task_management as t')
                ->join('regis', 't.empid', '=', 'regis.empid')
                ->select('t.task_name', 't.task_duedate', 'regis.fname', 'regis.lname')
                ->whereRaw("STR_TO_DATE(t.task_duedate, '%d-%m-%Y') < ?", [date('Y-m-d')])
                ->where('t.task_duedate', '!=', '')
                ->where('regis.empid', request()->session()->get('empid'))
                ->whereNotIn('t.task_status', ['completed', 'closed'])
                ->where('regis.status', 1)
                ->orderBY('t.taskid', 'desc')
                ->get();
        }

        $calendar = DB::table('calendar')
            ->whereRaw("SUBSTRING(datelist_one, 1, 5) = ?", [date('d-m')])
            ->get();

        $birthdayData = DB::table('personalprofile')
            ->select('fname')
            ->whereRaw("DATE_FORMAT(dob, '%m-%d') = ?", [date('m-d')])
            ->get();

        $count = count($hosting) + count($seo_client) + count($domain) + count($emailserver) + count($ssl_certificate) + count($calendar) +
            count($birthdayData) + count($task) + count($accounthistory) + count($dmcontract);

        return response()->json([
            'hosting' => $hosting,
            'seo_client' => $seo_client,
            'domain' => $domain,
            'emailserver' => $emailserver,
            'ssl_certificate' => $ssl_certificate,
            'accounthistory' => $accounthistory,
            'dmcontract' => $dmcontract,
            'calendar' => $calendar,
            'birthdayData' => $birthdayData,
            'task' => $task,
            'count' => $count,
        ]);
    }
}
