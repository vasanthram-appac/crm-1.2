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

class Design extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            if(request()->session()->get('design_status') == ""){
                request()->session()->put('design_status', 'Open');
            }

            if(isset($request->status) && !empty($request->status)){
                request()->session()->put('design_status', $request->status);
            }
       
           
            $data = DB::table('design_wip as d')
                ->join('accounts as a', 'a.id', '=', 'd.company_name')
                ->select(
                    'd.*',
                    'd.id as d_id',
                    'd.assignedto as assigned_to',
                    'a.company_name',
                    'a.id'
                )
                ->when(request()->session()->get('design_status') != 'Closed', function ($query) {
                    return $query->where('d.design_status', '!=', 'Closed');
                }, function ($query) {
                    return $query->where('d.design_status', 'Closed');
                })
                ->orderBy('d.id', 'DESC')
                ->get();


            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->id]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('date', function ($row) {
                    return $row->start_date . '/' . $row->enddate;
                })
                ->addColumn('status', function ($row) {
                    $designStatus = $row->design_status; // Access design_status from the $row object

                    if (in_array($designStatus, ['Started', 'Not yet started', 'Completed'])) {
                        return '
                           <div>
                             <select name="design_status" class="paymentstatus" data-id="' . $row->d_id . '">
                                    <option value="">Select From List</option>
                                    <option value="Not yet started" ' . ($designStatus == 'Not yet started' ? 'selected' : '') . '>Not yet Started</option>
                                    <option value="Started" ' . ($designStatus == 'Started' ? 'selected' : '') . '>Started</option>
                                    <option value="Completed" ' . ($designStatus == 'Completed' ? 'selected' : '') . '>Completed</option>
                                    <option value="Closed" ' . ($designStatus == 'Closed' ? 'selected' : '') . '>Closed</option>
                                </select>
                                <button class="btn btn-modal taskestatus" data-id="' . $row->d_id . '">update</button>
                            </div>';
                    } elseif ($designStatus == 'Completed') {
                        return '<p style="font-size:10px;color: #2fade7;font-weight: 800;text-align: center;">Date: ' . e($row->completed_date) . '</p>';
                    } else {
                        return '<p style="font-size:10px;color: #2fade7;font-weight: 800;text-align: center;">' . ucfirst($designStatus) . ' Date: ' . e($row->closed_date) . '</p>';
                    }
                })

                ->rawColumns(['sno', 'status', 'companyname', 'date'])
                ->make(true);
        }

        return view('design.index');
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        $regis = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->pluck('fname', 'empid');

        $mail = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->where('id', '!=', '2')
            ->where('id', '!=', '3')
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        return view('design/create', compact('accounts', 'regis', 'mail'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'assignedto' => 'required|exists:regis,empid',
            'design_type' => 'required|in:graphic,ui',
            'design_status' => 'required|in:Not yet started,Started,Completed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'project_description' => 'nullable|string|max:1000',
            'mail_cc' => 'required|array',
            'mail_cc.*' => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'company_name' => $request->company_name,
            'assignedto' => $request->assignedto,
            'design_type' => $request->design_type,
            'design_status' => $request->design_status,
            'start_date' => date('d-m-Y', strtotime($request->start_date)),
            'enddate' => date('d-m-Y', strtotime($request->enddate)),
            'project_description' => $request->project_description,
            'status' => '',
            'created_date' => date('d-m-Y h:i:s a', time()),
            'mail_cc' => json_encode($request->mail_cc),
        ];

        $insert = DB::table('design_wip')->insertGetId($val);

        if ($insert) {
            $fquery1 = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
            $fname = $fquery1->fname;
            $lname = $fquery1->lname;

            $afquery1 = DB::table('regis')->where('empid', $request->assignedto)->first();
            $afname = $afquery1->fname;
            $alname = $afquery1->lname;
            $cmailid = $afquery1->emailid;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $htmlContent = '<html><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">design WIP Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear ' . $afname . ' ' . $alname . ', </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Start Date - End Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . ' / ' . $request->end_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Status</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->design_status . '</td></tr>
                                  <tr><td style="width:200px;padding:4px 0">Design Type</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->design_type . '</td></tr>
                                  <tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use (
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $fquery1,
                $com_name,
                $htmlContent,
                $cmailid,
            ) {
                $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
                $message->to($founderEmail, $managerMail)
                    ->cc(array_merge([$cmailid], $ccEmails))
                    ->bcc($bccEmail)
                    ->from($infoMail, $fquery1->fname . ' ' . $fquery1->lname)
                    ->subject($com_name . " Design WIP Status "  . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            session()->flash('secmessage', 'Design Details Created Successfully');
            return response()->json(['status' => 1, 'message' => 'Design Details Created Successfully'], 200);
        }
    }

    public function designstatus(Request $request)
    {

        $data = [
            'design_status' => $request->status,
        ];

        // Add additional fields based on the status
        if ($request->status == 'Started') {
            $data['start_date'] = now()->format('d-m-Y');
        } elseif ($request->status == 'Completed') {
            $data['completed_date'] = now()->format('d-m-Y');
            $data['completed_by'] = request()->session()->get('empid');
        } elseif ($request->status == 'Closed') {
            $data['closed_date'] = now()->format('d-m-Y');
            $data['closed_by'] = request()->session()->get('empid');
        }

        // Update the record in the database
        DB::table('design_wip')
            ->where('id', $request->id)
            ->update($data);

        session()->flash('secmessage', 'Status Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully'], 200);
    }

}
