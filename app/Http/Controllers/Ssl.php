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

class Ssl extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {
            $data = DB::table('ssl_certificate')
                ->join('domainmaster', 'ssl_certificate.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'ssl_certificate.company_name', '=', 'accounts.id')
                ->select('ssl_certificate.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(ssl_certificate.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('ssl_certificate.status', '0')
                ->orderBy('DateFormat', 'Desc')
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

                if ($diff > 0 && $diff <= 30) {
                    $bg = '#FFF3DD'; // Yellow
                    $cc = '#D68A00';
                    $remainday1 = '<b>' . $diff . '</b> Days Remaining';
                } elseif ($diff > 30) {
                    $bg = '#F6FFF1'; // Green
                    $cc = '#38A800 ';
                    $remainday1 = '<b>' . $diff . '</b> Days Remaining';
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
                    $nextStatusLabel = $row->status == '0' ? '<i class="fi fi-ts-toggle-off"></i><span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on"><span class="tooltiptext">inactive</span></i>';

                    return '<button class="btn btn-modal  change-status" data-container=".appac_show" data-href="' . route('domainstatusupdate', [
                        'id' => $row->id,
                        'status' => $nextStatus,
                        'table' => 'ssl_certificate',
                    ]) . '">' . $nextStatusLabel . '</button>';
                })
          
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Ssl::class, 'edit'], [$row->id]) . '">
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

        return view('ssl/index')->render();
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
        return view('ssl/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {
        // Define validation rules for inputs
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'domainname' => 'required|string|max:255',
            'dateofregis' => 'required|date',
            'dateofrenewal' => 'required|date',
            'dateofexpire' => 'required|date',
            'source' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the domain already exists
        $existingDomain = DB::table('ssl_certificate')
            ->where('company_name', $request->company_name)
            ->where('domainname', $request->domainname)
            ->exists();

        if ($existingDomain) {
            session()->flash('secmessage', 'SSL Certificate already added.');
            return response()->json(['status' => 0, 'message' => 'SSL Certificate already added.'], 200);
        }
        $domainmonth = date("M-Y", strtotime($request->dateofexpire));
        // Retrieve the current user's empid
        $empid = request()->session()->get('empid');

        // Prepare data for insertion
        $data = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'dateofregis' => date("d-m-Y", strtotime($request->dateofregis)),
            'dateofrenewal' => date("d-m-Y", strtotime($request->dateofrenewal)),
            'dateofexpire' => date("d-m-Y", strtotime($request->dateofexpire)),
            'dateofexpire1' => $request->dateofexpire,
            'domainmonth' => date("M-Y", strtotime($request->dateofexpire)),
            'source' => $request->source,
            'empid' => $empid,
        ];

        // Insert data into the database
        DB::table('ssl_certificate')->insert($data);

        // Success message and response
        session()->flash('secmessage', 'SSL Certificate details successfully added.');
        return response()->json(['status' => 1, 'message' => 'SSL Certificate details successfully added.'], 200);
    }



    public function edit($id)
    {
        $ssl = DB::table('ssl_certificate')->select('id', 'company_name', 'domainname', 'dateofregis', 'dateofrenewal', 'dateofexpire', 'source')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($ssl->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($ssl->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('ssl.edit')->with(compact('ssl', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'dateofrenewal' => 'required|date',
            'dateofexpire' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Date formatting
        $dateofregis = date("d-m-Y", strtotime($request->dateofregis));
        $dateofrenewal = date("d-m-Y", strtotime($request->dateofrenewal));
        $dateofexpire = date("d-m-Y", strtotime($request->dateofexpire));
        $domainmonth = date("M-Y", strtotime($request->dateofexpire));

        // Data to be updated
        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'dateofregis' => $dateofregis,
            'dateofrenewal' => $dateofrenewal,
            'dateofexpire' => $dateofexpire,
            'dateofexpire1' => $request->dateofexpire,
            'domainmonth' => $domainmonth,
            'empid' => request()->session()->get('empid'),
        ];

        // Update the SSL certificate record
        $updated = DB::table('ssl_certificate')->where('id', $id)->update($data);

        // Fetch user details for the email notification
        $user = DB::table('regis')->where('empid', session()->get('empid'))->first();

        if ($updated) {
            // Email notification settings
            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');
            $techAdminMail = env('TECHADMINMAIL');
            $infoMailCom = env('INFOMAILCOM');
            $appName = env('APP_NAME');


            Mail::send([], [], function ($message) use (
                $appName,
                $request,
                $founderEmail,
                $managerMail,
                $techAdminMail,
                $bccEmail,
                $infoMail,
                $infoMailCom,
                $user
            ) {
                $message->to($founderEmail)
                    ->cc([$managerMail, $techAdminMail, $infoMailCom])
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject("SSL Certificate Renewal Update")
                    ->html('
                    <html><body>
                    <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                        <tr><td align="center">
                            <table width="96%" cellpadding="0" cellspacing="0">
                                <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr><td><p style="font-size:14px;color:#000;text-align:center">SSL Certificate Renewal Update Details</p></td></tr>
                                        <tr><td><p style="color:#000;font-size:13px"><strong>Hi Sir,</strong><br></p></td></tr>
                                        <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>SSL Certificate Renewal Update Details</strong></p></td></tr>
                                        <tr><td>
                                            <table style="font-size:12px;width:100%">
                                                <tr><td>Company Name:</td><td>:</td><td>' . htmlspecialchars($request->companynameval) . '</td></tr>
                                                <tr><td>Domain Name:</td><td>:</td><td>' . htmlspecialchars($request->domainnamevalue) . '</td></tr>
                                                <tr><td>Next Renewal:</td><td>:</td><td>' . htmlspecialchars(date("d-m-Y", strtotime($request->dateofexpire))) . '</td></tr>
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
        }

        session()->flash('secmessage', 'SSL Certificate details updated successfully.');
        return response()->json(['status' => 1, 'message' => 'SSL Certificate details updated successfully.'], 200);
    }





    public function destroy($id)
    {

        $ssl=DB::table('ssl_certificate')->select('company_name','domainname')->find($id);

        $domainmaster=DB::table('domainmaster')->select('domainname')->find($ssl->domainname);

        $accounts=DB::table('accounts')->select('company_name')->find($ssl->company_name);

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
                ->subject("SSL certificate Removal Details")
                ->html('
                <html><body>
                <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                    <tr><td align="center">
                        <table width="96%" cellpadding="0" cellspacing="0">
                            <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr><td><p style="font-size:14px;color:#000;text-align:center">SSL certificate Removal Details</p></td></tr>
                                    <tr><td><p style="color:#000;font-size:13px"><strong>Hi Sir,</strong><br></p></td></tr>
                                    <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>SSL certificate Removal Details</strong></p></td></tr>
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

        $upd = DB::table('ssl_certificate')->where('id', $id)->delete();
        session()->flash('secmessage', 'SSL Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'SSL Deleted Successfully!'], 200);
    }
}
