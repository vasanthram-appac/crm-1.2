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

class Domain extends Controller
{

    public function index(Request $request)
    {
   
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {
            $data = DB::table('domain')
                ->join('domainmaster', 'domain.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'domain.company_name', '=', 'accounts.id')
                ->select('domain.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(domain.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('domain.status', '0')
                ->orderBy('id','ASC')
                ->get();

            foreach ($data as $domain) {
                $currentDate = date('d-m-Y');  // Get the current date in d-m-Y format
                $expiryDate = $domain->dateofexpire;  // Assuming it's in d-m-Y format

                // Convert both dates to timestamp (seconds since epoch)
                $currentTimestamp = strtotime($currentDate);
                $expiryTimestamp = strtotime($expiryDate);

                // Calculate the difference in days
                $diff = ($expiryTimestamp - $currentTimestamp) / (60 * 60 * 24); // Difference in days

                $diff = (int) $diff;  // Cast to integer for exact day count

                if ($diff > 0 && $diff <= 30) {
                    $bg = '#FFF3DD'; // Yellow
                    $cc = '#D68A00';
                    $remainday1 = '<b>' . $diff . '</b> Days Remaining';
                } elseif ($diff > 30) {
                    $bg = '#F6FFF1'; // Green
                    $cc = '#38A800 ';
                    $remainday1 ='<b>' . $diff . '</b> Days Remaining';
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
                    $nextStatusLabel = $row->status == '0' ? '<i class="fi fi-ts-toggle-off"></i><span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on"></i><span class="tooltiptext">inactive</span>';

                    return '<button class="btn btn-modal  change-status" data-container=".appac_show" data-href="' . route('domainstatusupdate', [
                        'id' => $row->id,
                        'status' => $nextStatus,
                        'table' => 'domain',
                    ]) . '">' . $nextStatusLabel . '</button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Domain::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					<span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })

                ->rawColumns(['sno', 'companyname', 'domainname', 'remainday1', '', 'action'])
                ->make(true);
        }

        return view('domain/index')->render();
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
        return view('domain/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
{
    // Validate the request inputs
    $validator = Validator::make($request->all(), [
        'company_name' => 'required|string',
        'domainname' => 'required|string',
        'dateofregis' => 'required|date',
        'dateofrenewal' => 'required|date',
        'dateofexpire' => 'required|date',
        'domain_source' => 'required|string',
        'domain_manager' => 'required|string',
        'domain_privacy' => 'required|string'
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Check if the domain already exists
    $existingDomain = DB::table('domain')
        ->where('company_name', $request->company_name)
        ->where('domainname', $request->domainname)
        ->exists();

    if ($existingDomain) {
        session()->flash('secmessage', 'Domain Already added in Server');
        return response()->json(['status' => 1, 'message' => 'Domain Already added in Server'], 200);
    }

    // Format dates
    $dateOfRegis = date("d-m-Y", strtotime($request->dateofregis));
    $dateOfRenewal = date("d-m-Y", strtotime($request->dateofrenewal));
    $dateOfExpire = date("d-m-Y", strtotime($request->dateofexpire));
    $domainMonth = date("M-Y", strtotime($dateOfExpire));

    // Retrieve the current user's email ID and current date/time
    $empid = request()->session()->get('empid');
    $datetime = date("F j, Y, g:i A");

    // Insert data into the database
    $domainData = [
        'company_name' => $request->company_name,
        'domainname' => $request->domainname,
        'dateofregis' => $dateOfRegis,
        'dateofrenewal' => $dateOfRenewal,
        'dateofexpire' => $dateOfExpire,
        'dateofexpire1' => $request->dateofexpire, // original expiry date format
        'domainmonth' => $domainMonth,
        'domain_source' => $request->domain_source,
        'domain_manager' => $request->domain_manager,
        'domain_privacy' => $request->domain_privacy,
        'empid' => $empid,
        'datetime' => $datetime,
        'status' => 0
    ];

    DB::table('domain')->insert($domainData);

    session()->flash('secmessage', 'Domain Details Successfully Added.');
    return response()->json(['status' => 1, 'message' => 'Domain Details Successfully Added.'], 200);
}


    public function edit($id)
    {
        $domain = DB::table('domain')->select('id','company_name','domainname','dateofregis','dateofrenewal','dateofexpire','domain_source','domain_manager','domain_privacy')->find($id);

        $accounts = DB::table('accounts')->select('id','company_name')->find($domain->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($domain->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('domain.edit')->with(compact('domain','accounts','domainmaster'));

            // $domain = DB::table('domain')
            // ->join('accounts', 'domain.company_name', '=', 'accounts.id')
            // ->join('domainmaster', 'domain.domainname', '=', 'domainmaster.domainname')
            // ->select(
            //     'domain.id',
            //     'domain.company_name',
            //     'domain.domainname',
            //     'domain.dateofregis',
            //     'domain.dateofrenewal',
            //     'domain.dateofexpire',
            //     'domain.domain_source',
            //     'domain.domain_manager',
            //     'domain.domain_privacy',
            //     'accounts.id as company_id',
            //     'accounts.company_name as companyname',
            //     'domainmaster.domainname as domain_name'
            // )
            // ->where('domain.id', $id)
            // ->first();

            // dd($domain);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'companynameval'  => 'required|string',
            'domainnamevalue' => 'required|string',
           
            'dateofrenewal'   => 'required|date',
            'dateofexpire'    => 'required|date',
            'domain_source'   => 'required|string',
            'domain_manager'  => 'required|string',
            'domain_privacy'  => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Date formatting
        $registerdate = date("d-m-Y", strtotime($request->dateofregis));
        $renewaldate = date("d-m-Y", strtotime($request->dateofrenewal));
        $expiredate = date("d-m-Y", strtotime($request->dateofexpire));
    
        // Extracting data from the request
        $val = [
            'company_name'    => $request->companyid,
            'domainname'      => $request->domainname,
          
            'dateofregis'     => $registerdate,
           
            'dateofrenewal'   => $renewaldate,
          
            'dateofexpire'    => $expiredate,
            'domain_source'   => $request->domain_source,
            'domain_manager'  => $request->domain_manager,
            'domain_privacy'  => $request->domain_privacy,
            'empid'            => request()->session()->get('empid'),
            'datetime'         => now(),
         
            'domainmonth'      => date("M-Y", strtotime($expiredate)),
        ];
    // dd($val);
        // Update the domain record
        $updated = DB::table('domain')->where('id', $id)->update($val);
    
        // Fetch user details (assuming this is the current logged-in user)
        $mquery1 = DB::table('regis')->where('empid', session()->get('empid'))->first();
    
        if ($updated) {
            // Sending email to notify domain renewal update
            $bccEmail = env('SUPPORTMAIL');
            $bala = env('FOUNDERMAIL');
            $infomail = env('INFOMAIL');
            $managermail = env('MANAGERMAIL');
            $techadminmail = env('TECHADMINMAIL');
            $infomailcom = env('INFOMAILCOM');
            $appname = env('APP_NAME');
    
            Mail::send([], [], function ($message) use ($appname, $request, $bala, $managermail, $bccEmail, $infomail, $techadminmail, $infomailcom, $mquery1) {
                // Configure email properties
                $message->to($bala)
                    ->cc($managermail)
                    ->cc($techadminmail)
                    ->cc($infomailcom)
                    ->bcc($bccEmail)
                    ->from($infomail, $appname)
                    ->subject("Domain Renewal Update");
    
                // HTML content for the email
                $message->html(
                    '<html><body>
                    <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                    <tr><td align="center">
                    <table width="96%" cellpadding="0" cellspacing="0">
                    <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                    <tr><td><p style="font-size:14px;color:rgb(0,0,0);text-align:center">Domain Renewal Update Details</p></td></tr>
                    <tr><td><p style="color:#000;font-size:13px"> <strong> Hi Sir, </strong><br></p></td></tr>
                    <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>Domain Renewal Update Details</strong></p></td></tr>
                    <tr>
                    <td>
                    <table style="font-size:12px;width:100%">
                    <tr><td>Company Name:</td><td> : </td><td>' . $request->companynameval . '</td></tr>
                    <tr><td>Domain Name:</td><td> : </td><td>' . $request->domainnamevalue . '</td></tr>
                    <tr><td>Next Renewal:</td><td> : </td><td>' . date("d-m-Y", strtotime($request->dateofexpire)) . '</td></tr>
                    <tr><td>Updated By:</td><td> : </td><td>' . $mquery1->fname . ' ' . $mquery1->lname . '</td></tr>
                    </table></td></tr></table></td></tr></table></td></tr></table></body></html>'
                );
            });
        }
    
        session()->flash('secmessage', 'Domain details updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Domain details updated successfully.'], 200);
    }
    



    public function destroy($id)
    {
        // dd($id);

        $domain=DB::table('domain')->select('company_name','domainname')->find($id);

        $domainmaster=DB::table('domainmaster')->select('domainname')->find($domain->domainname);

        $accounts=DB::table('accounts')->select('company_name')->find($domain->company_name);

        $user=DB::table('regis')->select('fname','lname')->where('empid',request()->session()->get('empid'))->first();

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
                ->subject("Domain Removal Details")
                ->html('
                <html><body>
                <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                    <tr><td align="center">
                        <table width="96%" cellpadding="0" cellspacing="0">
                            <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr><td><p style="font-size:14px;color:#000;text-align:center">Domain Removal Details</p></td></tr>
                                    <tr><td><p style="color:#000;font-size:13px"><strong>Hi Sir,</strong><br></p></td></tr>
                                    <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>Domain Removal Details</strong></p></td></tr>
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

        	
        $upd = DB::table('domain')->where('id', $id)->delete();
        session()->flash('secmessage', 'Domain Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Domain Deleted Successfully!'], 200);
    }

    public function domainStatusUpdate($id, $status, $table)
    {
 
        $statusValue = ($status == '1') ? '1' : '0';
        
        $update=DB::table($table)->where('id', $id)->update(['status' => $statusValue]);

        if ($update) {
            session()->flash('secmessage', 'Status updated successfully!');
            return response()->json(['status' => 1, 'message' => 'Status updated successfully!'], 200);
        } else {
            session()->flash('secmessage', 'Failed to update status.');
            return response()->json(['status' => 1, 'message' => 'Failed to update status.'], 200);
        }

    }

    public function Websitelistload(Request $request)
    {
        $categoryId = $request->input('avalue');
        $categoryTypeName = $request->input('names');
    
        // Retrieve domains by company name
        $domains = DB::table('domainmaster')
            ->where('company_name', $categoryId)
            ->orderBy('company_name', 'DESC')
            ->get();
    
        // Return HTML options as response
        $options = '';
        foreach ($domains as $domain) {
            $options .= "<option name='domainname' value='{$domain->id}'>{$domain->domainname}</option>";
        }
    
        return response($options);
    }
    
}
