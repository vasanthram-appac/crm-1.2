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
        // dd($request->all());
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            if (request()->session()->get('active_status') == "") {
                request()->session()->put('active_status', '1');
            }

            if (isset($request->status) && !empty($request->status)) {
                request()->session()->put('active_status', $request->status);
            }

            if (request()->session()->get('active_status') == 'All') {

                $data = DB::table('accounts')
                    ->where('status', '!=', '0')
                    ->orderBy('accounts.id', 'ASC')
                    ->get();
            } elseif (request()->session()->get('active_status') == 'active' || request()->session()->get('active_status') == 'inactive') {

                $data = DB::table('accounts')
                    ->where('status', '!=', '0')
                    ->where('active_status', request()->session()->get('active_status'))
                    ->orderBy('accounts.id', 'ASC')
                    ->get();
            } elseif (request()->session()->get('active_status') == '1') {

                $data = DB::table('accounts')
                    ->where('status', '!=', '0')
                    ->where('active_status', 'active')
                    ->where('key_status', 1)
                    ->orderBy('accounts.id', 'ASC')
                    ->get();
            } else {

                $data = DB::table('accounts')
                    ->where('status', '!=', '0')
                    ->where('active_status', 'active')
                    ->where('assignedto', request()->session()->get('active_status'))
                    ->orderBy('accounts.id', 'ASC')
                    ->get();
            }
            // dd($data);



            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('company_name', function ($row) {
                    return '
                            <button class="btn  btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->id]) . '">' . $row->company_name . ' </button>';
                })
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

                ->addColumn('action', function ($row) {
                    return '<button class="btn  btn-modal" data-container=".customer_modal" data-href="' . action([Accounts::class, 'edit'], [$row->id]) . '">
                     <i class="fi fi-ts-file-edit"></i> 
					  <span class="tooltiptext">Edit</span>
					 </button>';
                })
                ->rawColumns(['sno', 'action', 'active_status', 'key_status', 'company_name'])
                ->make(true);
        }

        return view('accounts/index')->render();
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
            ->where('d.client', $id)->where('d.enquiry_month', $today)->orderBy('d.id', 'desc')->get();
            
        if (count($reports)>0) {
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
function formatIndianNumber($number) {
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
    

$domain=DB::table('domain')->where('company_name', $id)->select(
    'domain_manager as domain_manager',  // Alias for domain_manager
    'domain_source as domain_source'     // Alias for domain_source
)->get();

$email =DB::table('emailserver')->where('company_name',$id)->select(
    'vendorname as vendorname',  // Alias for domain_manager
    'emailserver as emailserver'     // Alias for domain_source
)->count();

$ssl=DB::table('ssl_certificate')->where('company_name',$id)->select('source as Source','domainmonth as D_month')->get();


        return view('accounts.create')->with(compact('accounts', 'managedby', 'accountmanager', 'results', 'notes', 'history', 'reports', 'payments', 'totalPay', 'viewquery','formattedNumber','scale','domain','email','ssl'));
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

            // // Send email
            // Mail::send([], [], function ($message) use ($request, $bala, $managermail, $bccEmail, $infomail, $emailid, $company_name_value, $htmlContent, $empid_value2) {
            //     // Configure email properties
            //     $message->to($bala)
            //            ->cc($managermail)
            //             ->bcc($bccEmail)
            //             ->replyTo($emailid)
            //             ->from($infomail, $company_name_value)
            //             ->subject($request->subject)
            //             ->html($htmlContent);
            
            //     // Add any CC emails from mail_cc array
            //     if ($request->has('mail_cc') && count($request->mail_cc) > 0) {
            //         foreach ($request->mail_cc as $m_email) {
            //             if (filter_var($m_email, FILTER_VALIDATE_EMAIL)) {  // Validate CC email
            //                 $message->cc($m_email);
            //             }
            //         }
            //     }
            // });
       
            session()->flash('secmessage', 'Notes Created Successfully.');
            return response()->json(['status' => 1, 'message' => 'Notes Created Successfully.'], 200);
        } else {
            session()->flash('secmessage', 'Notes Not Created Successfully.');
            return response()->json(['status' => 0, 'message' => 'Notes Not Created Successfully.'], 200);
        }
    }



    public function edit($id)
    {

        $accounts = DB::table('accounts')->where('id', $id)->first();

        $assignedto =  DB::table('regis')->where('status', 1)->orderBy('regis.fname', 'ASC')->pluck('fname', 'empid');

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

    public function Keystatus($id, $key_status)
    {

        $update = DB::table('accounts')->where('id', $id)->update(['key_status' => $key_status]);

        if ($update) {
            session()->flash('secmessage', 'Status updated successfully!');
            return response()->json(['status' => 1, 'message' => 'Status updated successfully!'], 200);
        } else {
            session()->flash('secmessage', 'Failed to update status.');
            return response()->json(['status' => 1, 'message' => 'Failed to update status.'], 200);
        }
    }
}
