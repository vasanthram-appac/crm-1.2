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

class Hosting extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {
            $data = DB::table('hosting')
                ->join('domainmaster', 'hosting.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'hosting.company_name', '=', 'accounts.id')
                ->select('hosting.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(hosting.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('hosting.status', '0')
                ->orderBy('id', 'ASC')
                ->get();
            // dd($data);
            foreach ($data as $domain) {
                $currentDate = date('d-m-Y');  // Get the current date in d-m-Y format
                $expiryDate = $domain->dateofexpire;  // Assuming it's in d-m-Y format

                // Convert both dates to timestamp (seconds since epoch)
                $currentTimestamp = strtotime($currentDate);
                $expiryTimestamp = strtotime($expiryDate);

                // Calculate the difference in days
                $diff = ($expiryTimestamp - $currentTimestamp) / (60 * 60 * 24); // Difference in days

                $diff = (int) $diff;  // Cast to integer for exact day count

    
          
                
                // Determine status based on the difference in days
                if ($diff > 0 && $diff <= 30) {
                    $bg = '#FFF3DD'; // Yellow
                    $cc = '#D68A00';
                    $remainday1 ='<b>'.$diff .'</b>'. ' Days Remaining';
                } elseif ($diff > 30) {
                    $bg = '#F6FFF1'; // Green
                    $cc = '#38A800 ';
                    $remainday1 = '<b>'.$diff .'</b>'. ' Days Remaining';
                } elseif ($diff == 0) {
                    $bg = '#F6FFF1'; // Green
                    $cc = '#38A800 ';
                    $remainday1 = 'Today is the day to Renew';
                } else {
                    $bg = '#FFF0F0'; // Red
                    $cc = '#F41B1B';
                    $remainday1 = $diff;
                }
                $domain->cc = $cc;
                $domain->bg = $bg;
                $domain->remainday1 = $remainday1;
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->company_name]) . '">' . $row->companyname . '</button>';
                })
                ->addColumn('domainname', function ($row) {
                    return '<a href="http://' . $row->domainname . '" target="_blank" style="text-decoration:none;">' . $row->domainname . '</a>';
                })
                ->addColumn('remainday1', function ($row) {

                    $nextStatus = $row->bg == '#FFF0F0' ? 'Overdue for <b>' . abs($row->remainday1) . '</b> Days' : $row->remainday1;

                    return '<p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: ' . $row->cc . '; background-color: ' . $row->bg . ';">' . $nextStatus . '</p>';
    
                })
                ->addColumn('', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatus = $row->status == '0' ? '1' : '0';
                    $nextStatusLabel = $row->status == '0' ? '<i class="fi fi-ts-toggle-off"></i> <span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on"></i> <span class="tooltiptext">inactive</span>';

                    return '<button class="btn btn-modal  change-status" data-container=".appac_show" data-href="' . route('domainstatusupdate', [
                        'id' => $row->id,
                        'status' => $nextStatus,
                        'table' => 'hosting',
                    ]) . '">' . $nextStatusLabel . '</button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Hosting::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })

                ->rawColumns(['sno', 'companyname', 'domainname', 'remainday1', '', 'action'])
                ->make(true);
        }

        return view('hosting/index')->render();
    }

    public function create(Request $request)
    {
        $domainmaster = DB::table('domainmaster')
            ->join('accounts', 'domainmaster.company_name', '=', 'accounts.id')
            ->where('domainmaster.domainname', '!=', '')
            ->groupBy('domainmaster.company_name')
            ->groupBy('accounts.company_name')
            ->groupBy('accounts.id')
            ->orderBy('accounts.company_name', 'ASC')
            ->select('domainmaster.company_name', 'accounts.company_name as company_name_full', 'accounts.id')
            ->get();
        // dd(  $domainmaster);
        // return view('domain/create')->render();
        return view('hosting/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Define validation rules for inputs
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'domainname' => 'required|string',
            'dateofregis' => 'required|date',
            'hostingperiod' => 'required|integer',
            'hosting_source' => 'required|string',
            'hosting_manager' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the domain already exists
        $existingDomain = DB::table('hosting')
            ->where('company_name', $request->company_name)
            ->where('domainname', $request->domainname)
            ->exists();

        if ($existingDomain) {
            session()->flash('secmessage', 'Hosting Already added in Server');
            return response()->json(['status' => 1, 'message' => 'Hosting Already added in Server'], 200);
        }

        // Format dates
        $registerDate = date("d-m-Y", strtotime($request->dateofregis));
        $hostingPeriod = $request->hostingperiod;
        $effectiveDate = date('Y-m-d', strtotime("+$hostingPeriod months", strtotime($request->dateofregis)));
        $dateOfExpire = date("d-m-Y", strtotime($effectiveDate));
        $domainMonth = date("M-Y", strtotime($effectiveDate));

        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');
        $datetime = date("F j, Y, g:i A");

        // Prepare data for insertion
        $domainData = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'dateofregis' => $registerDate,
            'hostingperiod' => $hostingPeriod,
            'dateofexpire' => $dateOfExpire,
            'dateofexpire1' => $effectiveDate,
            'hostingmonth' => $domainMonth,
            'empid' => $empid,
            'datetime' => $datetime,
            'hosting_source' => $request->hosting_source,
            'hosting_manager' => $request->hosting_manager,
            'status' => 0
        ];

        // Insert data into the database
        DB::table('hosting')->insert($domainData);

        session()->flash('secmessage', 'Server details Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Server details Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $hosting = DB::table('hosting')->select('id', 'company_name', 'domainname', 'dateofregis', 'dateofexpire', 'hostingperiod', 'empid', 'datetime', 'hosting_source', 'hosting_manager')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($hosting->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($hosting->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('hosting.edit')->with(compact('hosting', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'renewaldate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Date formatting
        $renewaldate = date("d-m-Y", strtotime($request->renewaldate));

        // Extracting data from the request
        $hostingPeriod = $request->hostingperiod;
        $effectiveDate = date('Y-m-d', strtotime("+$hostingPeriod months", strtotime($renewaldate)));
        $expireDateFormatted = date("d-m-Y", strtotime($effectiveDate));
        $thisMonth = date("M", strtotime($effectiveDate));
        $thisYear = date("Y", strtotime($effectiveDate));
        $hostingMonth = "$thisMonth-$thisYear";

        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'dateofregis' => $renewaldate,
            'hostingperiod' => $hostingPeriod,
            'dateofexpire' => $expireDateFormatted,
            'dateofexpire1' => $effectiveDate,
            'hostingmonth' => $hostingMonth,
            'hosting_source' => $request->hosting_source,
            'hosting_manager' => $request->hosting_manager,
            'empid' => request()->session()->get('empid'),
            'datetime' => date("F j, Y, g:i A"),
        ];

        // Update the hosting record
        $updated = DB::table('hosting')->where('id', $id)->update($data);

        // Fetch user details
        $user = DB::table('regis')->where('empid', session()->get('empid'))->first();

        if ($updated) {
            // Sending email to notify domain renewal update
            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');
            $techAdminMail = env('TECHADMINMAIL');
            $infoMailCom = env('INFOMAILCOM');
            $appName = env('APP_NAME');

            Mail::send([], [], function ($message) use ($appName, $request, $founderEmail, $managerMail, $techAdminMail, $bccEmail, $infoMail, $infoMailCom, $user,$expireDateFormatted) {
                $message->to($founderEmail)
                    ->cc([$managerMail, $techAdminMail, $infoMailCom])
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject("Hosting Renewal Update");
                    $message->html('
                        <html><body>
                        <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                        <tr><td align="center">
                        <table width="96%" cellpadding="0" cellspacing="0">
                        <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                        <tr><td><p style="font-size:14px;color:rgb(0,0,0);text-align:center">Hosting Renewal Update Details</p></td></tr>
                        <tr><td><p style="color:#000;font-size:13px"> <strong> Hi Sir, </strong><br></p></td></tr>
                        <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>Hosting Renewal Update Details</strong></p></td></tr>
                        <tr>
                        <td>
                        <table style="font-size:12px;width:100%">
                        <tr><td>Company Name:</td><td> : </td><td>' . $request->companynameval . '</td></tr>
                        <tr><td>Domain Name:</td><td> : </td><td>' . $request->domainnamevalue . '</td></tr>
                        <tr><td>Next Renewal:</td><td> : </td><td>' . $expireDateFormatted . '</td></tr>
                        <tr><td>Updated By:</td><td> : </td><td>' . $user->fname . ' ' . $user->lname . '</td></tr>
                        </table></td></tr></table></td></tr></table></td></tr></table></body></html>
                    ');
            });
        }

        session()->flash('secmessage', 'Server details updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Server details updated successfully.'], 200);
    }

    public function destroy($id)
    {

        $hosting = DB::table('hosting')->select('company_name', 'domainname')->find($id);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($hosting->domainname);

        $accounts = DB::table('accounts')->select('company_name')->find($hosting->company_name);

        $user = DB::table('regis')->select('fname', 'lname')->where('empid', request()->session()->get('empid'))->first();

        $bccEmail = env('SUPPORTMAIL');
        $founderEmail = env('FOUNDERMAIL');
        $infoMail = env('INFOMAIL');
        $managerMail = env('MANAGERMAIL');
        $techAdminMail = env('TECHADMINMAIL');
        $appName = env('APP_NAME');
        $emailid = request()->session()->get('emailid');

        Mail::send([], [], function ($message) use (
            $appName,
            $domainmaster,
            $accounts,
            $founderEmail,
            $managerMail,
            $techAdminMail,
            $bccEmail,
            $infoMail,
            $emailid,
            $user
        ) {
            $message->to($founderEmail)
                ->cc([$managerMail, $techAdminMail, $emailid])
                ->bcc($bccEmail)
                ->from($infoMail, $appName)
                ->subject("Hosting Removal Details")
                ->html('
                <html><body>
                <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                    <tr><td align="center">
                        <table width="96%" cellpadding="0" cellspacing="0">
                            <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr><td><p style="font-size:14px;color:#000;text-align:center">Hosting Removal Details</p></td></tr>
                                    <tr><td><p style="color:#000;font-size:13px"><strong>Hi Sir,</strong><br></p></td></tr>
                                    <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>Hosting Removal Details</strong></p></td></tr>
                                    <tr><td>
                                        <table style="font-size:12px;width:100%">
                                            <tr><td>Company Name:</td><td>:</td><td>' . htmlspecialchars($accounts->companynameval) . '</td></tr>
                                            <tr><td>Domain Name:</td><td>:</td><td>' . htmlspecialchars($domainmaster->domainnamevalue) . '</td></tr>
                                            <tr><td>Updated By:</td><td>:</td><td>' . htmlspecialchars($user->fname . ' ' . $user->lname) . '</td></tr>
                                        </table>
                                    </td></tr>
                                </table>
                            </td></tr>
                        </table>
                    </td></tr>
                </table>
                </body></html>
            ');
        });

        $upd = DB::table('hosting')->where('id', $id)->delete();
        session()->flash('secmessage', 'Hosting Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Hosting Deleted Successfully!'], 200);
    }

    public function adddomain()
    {

        $domainmaster = DB::table('domainmaster')
            ->join('accounts', 'domainmaster.company_name', '=', 'accounts.id')
            ->where('domainmaster.domainname', '!=', '')
            ->groupBy('domainmaster.company_name')
            ->groupBy('accounts.company_name')
            ->groupBy('accounts.id')
            ->orderBy('accounts.company_name', 'ASC')
            ->select('domainmaster.company_name', 'accounts.company_name as company_name_full', 'accounts.id')
            ->get();
        // dd(  $domainmaster);
        // return view('domain/create')->render();
        return view('hosting/adddomain', compact('domainmaster'))->render();
    }

    public function updatedomain(Request $request)
    {
        // dd($request->all());

        $Selectmobile = DB::table('domainmaster')->where('company_name', $request->company_name)->where('domainname', $request->domainname)->get();

        if (count($Selectmobile) > 0) {
            session()->flash('secmessage', 'Domain Already added in List');
            return response()->json(['status' => 1, 'message' => 'Domain Already added in List'], 200);
        } else {

            $val = [
                'domainname' => $request->domainname,
                'company_name' => $request->company_name
            ];

            $insert=DB::table('domainmaster')->insert($val);

            session()->flash('secmessage', 'Domain name Successfully Added.');
            return response()->json(['status' => 1, 'message' => 'Domain name Successfully Added.'], 200);
        }
    }
}
