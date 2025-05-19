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

class Workorderview extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('work_order as w')
                ->select(
                    'a.id as aid',
                    'a.company_name',
                    'w.issue_date',
                    'w.wid as workid',
                    'w.id as wid',
                    'w.complete_date',
                    'w.dead_line',
                    'w.empid',
                    'w.project_description',
                    'w.work_status',
                    'w.assigned_by',
                    'd.id as dept_id',
                    'd.department_name'
                )
                ->join('accounts as a', 'a.id', '=', 'w.company_id')
                ->join('department_master as d', 'd.id', '=', 'w.dept_id')
                ->where('w.work_status', '!=', 'closed')
                ->orderBy('w.wid', 'DESC')
                ->get();

            foreach ($data as $work) {
                // Fetch query details
                $reg = DB::table('query_details as q')
                    ->select(
                        'r.empid',
                        'r.fname',
                        'q.work_id',
                        'q.queries',
                        'q.assigned_by',
                        'q.empid'
                    )
                    ->join('regis as r', 'r.empid', '=', 'q.empid')
                    ->where('q.work_id', $work->wid)
                    ->where(function ($query) use ($work) {
                        $query->where('q.empid', $work->empid)
                            ->orWhere('q.assigned_by', $work->assigned_by);
                    })
                    ->count();

                $work->query_count = $reg;

                // Assigned employees
                $workArray = explode(',', rtrim($work->empid, ','));
                $assignedEmp = DB::table('regis')
                    ->whereIn('empid', $workArray)
                    ->pluck('fname');
                $work->emp = $assignedEmp;

                // Assigned user
                $assignedUser = DB::table('regis')
                    ->select('fname')
                    ->where('empid', $work->assigned_by)
                    ->first();
                $work->assig_fname = $assignedUser->fname ?? 'N/A';

                // Date calculations
                $datetime1 = date_create(date("d-m-Y"));
                $datetime2 = date_create($work->dead_line);
                $interval = date_diff($datetime1, $datetime2);
                $diff = $interval->format('%R%a');
                $diff1 = $interval->format('%a');
                $dname = $diff1 == 1 ? "Day" : "Days";

                if ($diff > 0) {
                    $work->remainday1 = $diff1 . " " . $dname . " Remaining";
                    //       $work->remainday1 = '<p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: black; background-color: lightgray;">' 
                    // . $diff1 . " " . $dname . " Remaining" 
                    // . '</p>';

                } elseif ($diff == 0) {
                    $work->remainday1 = 'Today is the day to finish';
                } else {
                    // $work->remainday1 = "Work Over Due for <b>" . $diff1 . "</b> " . $dname;
                    $work->remainday1 = '<p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #D68A00; background-color: #FFF3DD;">'
                        . '<b>' . $diff1 . '</b>' . " " . $dname . " Remaining"
                        . '</p>';;
                }

                // Status labels
                if ($work->work_status == 'Closed') {
                    $work->status_label = "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #F41B1B; background-color: #FFF0F0;'>"
                        . ucfirst($work->work_status) . " Date: " . $work->close_date . "</p>";
                } elseif ($work->work_status == 'live') {
                    $work->status_label = "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #38A800 ; background-color: #F6FFF1;'>Live</p>";
                } elseif ($work->work_status == 'Pending') {
                    $work->status_label = "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #D68A00; background-color: #FFF3DD;'>Waiting for Approval</p>";
                } else {
                    $work->status_label = "<p style='font-size:11px;color: #4CAF50;font-weight: 800;text-align: center;'>"
                        . ucfirst($work->work_status) . " Date: " . $work->complete_date . "</p>"
                        . '<button class="btn btn-modal text-lblue change-status" data-container=".appac_show" data-href="' . route('workstatus', [
                            'id' => $work->wid,
                            'status' => 'closed'
                        ]) . '"><i class="icon-eye-open"></i> Close </button>';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('project_description', function ($row) {
                    return $row->project_description;
                })
                ->addColumn('company_name', function ($row) {
                    return '<button class="btn btn-modal" data-container=".appac_show" data-href="'
                        . route('viewaccounts', ['id' => $row->aid]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('days', function ($row) {
                    if ($row->work_status == 'live') {
                        return $row->remainday1;
                    } elseif ($row->work_status == 'Pending') {
                    } else {
                        return "Completed";
                    }
                })

                ->addColumn('updatestatus', function ($row) {
                    $designStatus = $row->design_status; // Access design_status from the $row object
                    return '
                           <div>
                             <select name="design_status" class="paymentstatus" data-id="' . $row->d_id . '">
                                    <option value="">Select From List</option>
                                    <option value="Not yet started" ' . ($designStatus == 'Not yet started' ? 'selected' : '') . '>Not yet Started</option>
                                    <option value="Started" ' . ($designStatus == 'Started' ? 'selected' : '') . '>Started</option>
                                </select>
                                <button class="btn btn-modal taskestatus" data-id="' . $row->d_id . '">update</button>
                            </div>';
                })

                ->addColumn('status', function ($row) {
                    return $row->status_label;
                })
                ->addColumn('action', function ($row) {
                    return '<div class="d-flex  justify-ccontent-center gap-1 align-items-start"><button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Workorderview::class, 'edit'], [$row->wid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext">Edit</span>
                            </button> <a class="d-flex align-items-center gap-1 flex-wrap btn " href="workqueryindex/' . $row->wid . '" style="text-decoration:none;"><i class="fi fi-ts-book-arrow-right"></i>' . $row->query_count . '
							<span class="tooltiptext ">Query</span>
							</a></div>';
                })
                ->rawColumns(['sno', 'project_description', 'company_name', 'days', 'status', 'action'])
                ->make(true);
        }

        return view('workorderview.index');
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

        $department = DB::table('department_master')->pluck('department_name', 'id')->toArray();
        $department = ['0' => 'Select Option'] + $department;


        return view('workorderview/create', compact('accounts', 'department'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:accounts,id',
            'department' => 'required|exists:department_master,id',
            'working_hours' => 'nullable|string',
            'startdate' => 'required|date|before_or_equal:dead_line',
            'dead_line' => 'required|date|after_or_equal:startdate',
            'project_description' => 'nullable|string',
            'comments' => 'nullable|string',
            'empid' => 'required|array',
            'empid.*' => 'exists:regis,empid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);
        $sempid = implode(",", $request->empid);
        $wsql = DB::table('work_order')->orderBy('id', 'DESC')->first();

        $wid = substr($wsql->wid, -4);
        $common = 'WO';
        if ($wid == '') {
            $wid1 = '0001';
        } else {
            $wid1 = str_pad($wid + 1, 4, 0, STR_PAD_LEFT);
        }
        $w_id = $common . $wid1;

        $val = [
            'wid' => $w_id,
            'company_id' => $request->id,
            'dept_id' => $request->department,
            'empid' => $sempid,
            'startdate' => $request->startdate,
            'issue_date' => date('d-m-Y', time()),
            'dead_line' => date("d-m-Y", strtotime($request->dead_line)),
            'project_description' => $request->project_description,
            'working_hours' => $request->working_hours,
            'comments' => $request->comments,
            'assigned_by' => request()->session()->get('empid'),
            'work_status' => 'Pending',
            'status' => '-1',
        ];

        $query = DB::table('work_order')->insert($val);

        if ($query) {

            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
            $fname = $fquery->fname;
            $lname = $fquery->lname;
            $aemailid = $fquery->emailid;

            $mcompany1 = DB::table('accounts')->where('id', $request->id)->first();
            $com_name = $mcompany1->company_name;

            $htmlContent = '<html><title>Work Order Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Today Work Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Work order details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Project Description:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Work Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . date('d-m-Y', time()) . '</td></tr><tr><td style="width:200px;padding:4px 0">Comments</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comments . '</td></tr><tr><td style="width:200px;padding:4px 0">Assigned By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr> <tr>
            <td style="width:200px;padding:4px 0">Approval</td>
            <td style="padding-right:10px"> :</td>
            <td style="font-weight:normal"> <a href="https://www.appacmedia.in" style="color: white;font-weight: bold;padding: 5px;text-decoration: none;background-color: #22c0cb;" >Status Update</a></td>
            </tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';


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
                $fquery,
                $com_name,
                $htmlContent,
            ) {
                // Set recipients
                $message->to($founderEmail, $managerMail)
                    ->bcc($bccEmail)
                    ->replyTo($fquery->emailid, $fquery->fname . ' ' . $fquery->lname)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject('Work Order Approval Request for ' . $com_name . ' : ' . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'Work Order Details Successfully Added.');
            return response()->json(['status' => 1, 'message' => 'Work Order Details Successfully Added.'], 200);
        }
    }

    public function edit($id)
    {

        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        $department = DB::table('department_master')->pluck('department_name', 'id')->toArray();
        $department = ['0' => 'Select Option'] + $department;

        $work_order = DB::table('work_order')->where('id', $id)->first();
        $result = explode(",", $work_order->empid);

        $reg = DB::table('regis')->whereIn('empid', $result)->pluck('fname');

        return view('workorderview/edit', compact('accounts', 'department', 'work_order', 'reg'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:accounts,id',
            'department' => 'required|exists:department_master,id',
            'working_hours' => 'nullable|string',
            'dead_line' => 'required|date',
            'project_description' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all(), $id);

        if ($request->status == '0') {
            $work_status = 'live';
            $workstatus = 'Approved';
        } else if ($request->status == '2') {
            $work_status = 'Rejected';
            $workstatus = 'Rejected';
        } else {
            $work_status = '';
            $workstatus = '';
        }

        $val = [
            'project_description' => $request->project_description,
            'comments' => $request->comments,
        ];

        if (!empty($work_status)) {
            $val['work_status'] = $work_status;
        }

        if (!empty($request->status)) {
            $val['status'] = $request->status;
        }

        $query = DB::table('work_order')->where('id', $id)->update($val);

        if ($query) {

            $workOrder = DB::table('work_order as w')
                ->join('accounts as a', 'a.id', '=', 'w.company_id')
                ->join('department_master as d', 'd.id', '=', 'w.dept_id')
                ->select(
                    'a.id',
                    'a.company_name',
                    'w.issue_date',
                    'w.wid as workid',
                    'w.id as wid',
                    'w.complete_date',
                    'w.dead_line',
                    'w.empid',
                    'w.project_description',
                    'w.work_status',
                    'w.assigned_by',
                    'd.id as dept_id',
                    'd.department_name'
                )
                ->where('w.id', $id)
                ->orderByDesc('w.wid')
                ->first();

            $checkbox1 = explode(',', $workOrder->empid);

            $com_name = $workOrder->company_name;

            $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $workOrder->project_description1);

            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
            $fname = $fquery->fname;
            $lname = $fquery->lname;
            $aemailid = $fquery->emailid;

            $htmlContent = '<html><title>Work Order Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Today Work Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Work order details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $workOrder->company_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Project Description:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Work Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $workOrder->issue_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Assigned By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr> ';
            if ($request->status != '') {
                $htmlContent .= ' <tr><td style="width:200px;padding:4px 0">' . $workstatus . ' by</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> Balakrishnan </td></tr><tr><td style="width:200px;padding:4px 0">Comments</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comments . '</td></tr>';
            } else {
                $htmlContent .= '<tr><td style="width:200px;padding:4px 0">Comments</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comments . '</td></tr>';
            }
            $htmlContent .= '</tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use (
                $request,
                $founderEmail,
                $workstatus,
                $bccEmail,
                $infoMail,
                $fquery,
                $com_name,
                $htmlContent,
                $checkbox1,
            ) {

                if ($request->status != '') {
                    $appname = 'Balakrishnan S';
                } else {
                    $appname = $fquery->fname . ' ' . $fquery->lname;
                }

                if ($request->status != '') {
                    $subject_details = "Work Order " . $workstatus . " For ";
                    $Subject = $subject_details . " " . $com_name . " : " . date("d-m-Y");
                } else {
                    $subject_details = "Work Order For ";
                    $Subject = $subject_details . " " . $com_name . " : " . date("d-m-Y");
                }

                $message->to($checkbox1)
                    ->bcc($bccEmail)
                    ->replyTo($fquery->emailid, $fquery->fname . ' ' . $fquery->lname)
                    ->from($infoMail, $appname)
                    ->subject($Subject)
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'Work Order Details Updated Successfully.');
            return response()->json(['status' => 1, 'message' => 'Work Order Details Updated Successfully.'], 200);
        } else {
            session()->flash('secmessage', 'Work Order Details Updated Successfully.');
            return response()->json(['status' => 1, 'message' => 'Work Order Details Updated Successfully.'], 200);
        }
    }

    public function query($id)
    {
        // dd($id);
        return view('task/query', compact('id'))->render();
    }

    public function workstatus($id, $status)
    {
        // dd($id, $status);
        if ($status == 'closed') {
            $val = [
                'work_status' => 'closed',
                'close_date' => date('d-m-Y', time()),
            ];
            $query1 = DB::table('work_order')->where('id', $id)->update($val);
        } else {

            $wsql1 = DB::table('task_management')->where('id', $id)->first();

            $empid = $wsql1->empid;
            $task_name = $wsql1->task_name;

            $task_startdate = date("d-m-Y", strtotime($wsql1->task_startdate));
            $task_duedate1 = $wsql1->task_duedate;
            if ($task_duedate1 == '') {
                $task_duedate = $task_duedate1;
            } else {
                $task_duedate = date("d-m-Y", strtotime($task_duedate1));
            }

            $shrs = $wsql1->shrs;
            $ssecs = $wsql1->ssecs;
            $s_ampm = $wsql1->s_ampm;
            $start_time = $shrs . ":" . $ssecs . " " . $s_ampm;
            $thrs = $wsql1->thrs;
            $tsecs = $wsql1->tsecs;
            $e_ampm = $wsql1->e_ampm;
            $end_time = $thrs . ":" . $tsecs . " " . $e_ampm;
            $task_description = $wsql1->task_description;

            $taskid = $wsql1->taskid;

            $query1 = DB::table('task_management')->where('id', $id)->update(['task_status' => 'closed', 'taskclose_date' => date('d-m-Y', time())]);

            $val = [
                'taskid' => $taskid,
                'company_id' => $wsql1->company_id,
                'empid' => $empid,
                'task_name' => $task_name,
                'task_description' => $task_description,
                'task_startdate' => date('d-m-Y', time()),
                'task_duedate' => $task_duedate,
                'assigned_by' => request()->session()->get('empid'),
                'task_status' => 'reopen',
                'start_time' => $start_time,
                'end_time' => $end_time,
                'priority' => 'High',
                'status' => 0,
            ];

            $query = DB::table('task_management')->insert($val);

            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
            $assig_fname = $fquery->fname;
            $assig_lname = $fquery->lname;

            $mcompany1 = DB::table('accounts')->where('id', $wsql1->company_id)->first();
            $com_name = $mcompany1->company_name;

            $mquery1 = DB::table('regis')->where('empid', $empid)->first();
            $fname = $mquery1->fname;
            $lname = $mquery1->lname;

            $htmlContent = '<html><title>Task Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center"> Task Reopen Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear ' . $fname . " " . $lname . ', </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Task details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Priority:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> High </td></tr><tr><td style="width:200px;padding:4px 0">Task Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_startdate . '</td></tr><tr><td style="width:200px;padding:4px 0">Assigned By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $assig_fname . " " . $assig_lname . '</td></tr><tr><td colspan="3" style="width:200px;padding:4px 0">Task Description</td></tr>
                                  <tr><td colspan="3" ><p>' . $task_description . '</p></td></tr>
                                  </tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';


            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use (

                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $fquery,
                $com_name,
                $mquery1,
                $htmlContent,
            ) {

                // Set recipients
                $message->to($mquery1->emailid)
                    ->cc(array_merge([$founderEmail, $managerMail]))
                    ->bcc($bccEmail)
                    ->replyTo($fquery->emailid, $fquery->fname . ' ' . $fquery->lname)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject('Task For ' . $com_name . ' : ' . date('d-m-Y'))
                    ->html($htmlContent);
            });
        }
        session()->flash('secmessage', 'Status Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully.'], 200);
    }

    public function getempid(Request $request)
    {
        $category_Id = $request->avalue;

        // Fetch employees from the 'regis' table
        $employees = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('dept_id', $category_Id)
            ->where('fname', '!=', 'Appac')
            ->get();

        // Generate checkbox options
        $options = '';
        foreach ($employees as $employee) {
            $options .= '<input type="checkbox" name="empid[]" value="' . $employee->id . '" /> '
                . htmlspecialchars($employee->fname . " " . $employee->lname) . '<br>';
        }

        return response($options);
    }
}
