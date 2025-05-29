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

class Dmcontract extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {
            $data = DB::table('seo_client')
                ->join('domainmaster', 'seo_client.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'seo_client.company_name', '=', 'accounts.id')
                ->select('seo_client.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(seo_client.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('seo_client.status', '0')
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

                $user = DB::table('regis')->where('empid', $domain->managed_by)->where('status', '1')->first();
                if (!empty($user)) {

                    $domain->fname = $user->fname;
                    $domain->lname = $user->fname;
                } else {
                    $domain->fname = "";
                    $domain->lname = "";
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->company_name]) . '">' . $row->companyname . '</button>';
                })
                ->addColumn('domainname', function ($row) {
                    return '<a href="https://' . $row->domainname . '" target="_blank" style="text-decoration:none;">' . $row->domainname . '</a>';
                })
                ->addColumn('remainday1', function ($row) {

                    $nextStatus = $row->bg == '#FFF0F0' ? 'Overdue for <b>' . abs($row->remainday1) . '</b> Days' : $row->remainday1;

                    return '<p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: ' . $row->cc . '; background-color: ' . $row->bg . ';">' . $nextStatus . '</p>';
    
                })
                ->addColumn('', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatus = $row->status == '0' ? '1' : '0';
                    $nextStatusLabel = $row->status == '0' ? '<i class="fi fi-ts-toggle-off"></i><span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on"></i><span class="tooltiptext">inactive</span>';

                    return '<button class="btn btn-modal change-status" data-container=".appac_show" data-href="' . route('domainstatusupdate', [
                        'id' => $row->id,
                        'status' => $nextStatus,
                        'table' => 'seo_client',
                    ]) . '">' . $nextStatusLabel . '</button>';
                })
            
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Dmcontract::class, 'edit'], [$row->id]) . '">
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

        return view('dmcontract/index')->render();
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

        $names = DB::table('regis')
            ->where('status', '1')
            ->where('fname', '!=', 'Appac')
            ->whereNotIn('id', [2, 3])
            ->where('dept_id', '4')
            ->orderBy('fname', 'ASC')
            ->pluck('fname', 'empid');

        // dd(  $names);
        // return view('domain/create')->render();
        return view('dmcontract/create', compact('domainmaster', 'names'))->render();
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
            'numberofmonth' => 'required',
            'managed_by' => 'required',
            'promotion_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the domain already exists
        $existingDomain = DB::table('seo_client')
            ->where('company_name', $request->company_name)
            ->where('domainname', $request->domainname)
            ->where('promotion_status', $request->promotion_status)
            ->exists();

        if ($existingDomain) {
            session()->flash('secmessage', 'SEO Already added');
            return response()->json(['status' => 0, 'message' => 'SEO Already added'], 200);
        }

        // Retrieve the current user's empid
        $empid = request()->session()->get('empid');

        // Prepare data for insertion
        $data = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'promotion_status' => $request->promotion_status,
            'dateofregis' => date("d-m-Y", strtotime($request->dateofregis)),
            'dateofrenewal' => date("d-m-Y", strtotime($request->dateofrenewal)),
            'dateofexpire' => date("d-m-Y", strtotime($request->dateofexpire)),
            'dateofexpire1' => $request->dateofexpire,
            'domainmonth' => date("M-Y", strtotime($request->dateofexpire)),
            'numberofmonth' => $request->numberofmonth,
            'managed_by' => $request->managed_by,
            'empid' => $empid,
        ];

        // Insert data into the database
        DB::table('seo_client')->insert($data);

        // Success message and response
        session()->flash('secmessage', 'SEO Details Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'SEO Details Successfully Added.'], 200);
    }



    public function edit($id)
    {
        $dmcontract = DB::table('seo_client')->select('id', 'company_name', 'managed_by', 'domainname', 'dateofregis', 'dateofrenewal', 'dateofexpire', 'promotion_status', 'numberofmonth')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($dmcontract->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($dmcontract->domainname);

        $names = DB::table('regis')
            ->where('status', '1')
            ->where('fname', '!=', 'Appac')
            ->whereNotIn('id', [2, 3])
            ->where('dept_id', '4')
            ->orderBy('fname', 'ASC')
            ->pluck('fname', 'empid');

        // dd($domain,$accounts,$domainmaster);
        return view('dmcontract.edit')->with(compact('dmcontract', 'accounts', 'domainmaster', 'names'));
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
            'promotion_status' => $request->promotion_status,
            'numberofmonth' => $request->numberofmonth,
            'dateofregis' => date("d-m-Y", strtotime($request->dateofregis)),
            'dateofrenewal' => date("d-m-Y", strtotime($request->dateofrenewal)),
            'dateofexpire' => date("d-m-Y", strtotime($request->dateofexpire)),
            'dateofexpire1' => $request->dateofexpire,
            'domainmonth' => date("M-Y", strtotime($request->dateofexpire)),
            'empid' => request()->session()->get('empid'),
        ];

        // Update the SSL certificate record
        $updated = DB::table('seo_client')->where('id', $id)->update($data);

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
                    ->subject("SEO Renewal Update")
                    ->html('
                    <html><body>
                    <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                        <tr><td align="center">
                            <table width="96%" cellpadding="0" cellspacing="0">
                                <tr><td style="border-top:5px solid #1e96d3;background:#fff;padding:20px;">
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr><td><p style="font-size:14px;color:#000;text-align:center">SEO Update Detailss</p></td></tr>
                                        <tr><td><p style="color:#000;font-size:13px"><strong>Hi Sir,</strong><br></p></td></tr>
                                        <tr><td style="background-color:rgb(234,234,234);"><p style="font-size:13px;text-align:left"><strong>SEO Update Detailss</strong></p></td></tr>
                                        <tr><td>
                                            <table style="font-size:12px;width:100%">
                                                <tr><td>Company Name:</td><td>:</td><td>' . htmlspecialchars($request->companynameval) . '</td></tr>
                                                <tr><td>Domain Name:</td><td>:</td><td>' . htmlspecialchars($request->domainnamevalue) . '</td></tr>
                                                <tr><td>Promotion Type:</td><td>:</td><td>' . htmlspecialchars($request->promotion_status) . '</td></tr>
                                                <tr><td>Number of Month:</td><td>:</td><td>' . htmlspecialchars($request->numberofmonth) . '</td></tr>
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

        session()->flash('secmessage', 'Renewal details Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Renewal details Updated Successfully.'], 200);
   
    }

    public function destroy($id)
    {

        $upd = DB::table('seo_client')->where('id', $id)->delete();
        session()->flash('secmessage', 'DM contract Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'DM contract Deleted Successfully!'], 200);

    }
}
