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

class Taskview extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Fetch the main task data
            $fnf = request()->session()->get('empid');
            $data = DB::table('task_management as t')
                ->join('accounts as a', 'a.id', '=', 't.company_id')
                ->select(
                    'a.id as account_id',
                    'a.company_name',
                    't.id as tid',
                    't.company_id',
                    't.empid',
                    't.task_name',
                    't.task_startdate',
                    't.start_time',
                    't.end_time',
                    't.task_duedate',
                    't.taskclose_date',
                    't.task_description',
                    't.assigned_by',
                    't.task_enddate',
                    't.priority',
                    't.task_status'
                )
                ->where('t.empid', $fnf)
                ->orderBy('t.id', 'DESC')
                ->get();
            // dd($data);
            foreach ($data as $task) {
                $tid = $task->tid;
                $assigned_by = $task->assigned_by;

                $task->query_count = DB::table('task_query_details as q')
                    ->where('q.task_id', $tid)
                    ->where(function ($query) use ($fnf, $assigned_by) {
                        $query->where('q.empid', $fnf)
                            ->orWhere('q.assigned_by', $assigned_by);
                    })
                    ->count();

                $assignedEmployee = DB::table('regis')
                    ->where('empid', $assigned_by)
                    ->first();

                $task->assig_fname = $assignedEmployee->fname;

                $priorityLabels = [
                    'High' => '<span style="font-size: 11px; background-color: #E91E63; color: #fff; padding: 4px;">High</span>',
                    'Medium' => '<span style="font-size: 11px; background-color: #673ab7; color: #fff; padding: 4px;">Medium</span>',
                    'Low' => '<span style="font-size: 11px; background-color: #00bcd4; color: #fff; padding: 4px;">Low</span>',
                ];

                // Add task status information
                if (in_array($task->task_status, ['assigned', 'reopen'])) {
                    $task->status_label =
                        '<div>
                           <select class="paymentstatus" style="width:80px;" data-id="' . $task->tid . '" >
                                    <option value="assigned" ' . ($task->task_status === 'assigned' ? 'selected' : '') . '>Assigned</option>
                                    <option value="completed" ' . ($task->task_status === 'completed' ? 'selected' : '') . '>Completed</option>
                            </select>
                                <button class="btn btn-modal taskestatus" data-id="' . $task->tid . '">update</button>
                            </div>';

                    $task->priority_label = $priorityLabels[$task->priority] ?? '';
                } elseif ($task->task_status == 'Closed') {
                    $task->status_label = '<p style="font-size: 11px; color: #2fade7; font-weight: 800; text-align: center;">'
                        . ucfirst($task->task_status) . ' Date: <br>' . $task->taskclose_date . '</p>';
                    $task->priority_label = '';
                } else {
                    $task->status_label = '<p style="font-size: 11px; color: #4CAF50; font-weight: 800; text-align: center;">'
                        . ucfirst($task->task_status) . ' Date: <br>' . $task->task_enddate . '</p>';
                    $task->priority_label = '';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('status', function ($row) {
                    return $row->status_label . ' ' . $row->priority_label;
                })
                ->addColumn('action', function ($row) {
                    return '<a class="btn" href="queryindex/' . $row->tid . '" style="text-decoration:none;"><i class="icon-pencil"></i> Query - <b>' . $row->query_count . '</a>';
                })
                ->rawColumns(['sno', 'status', 'action'])
                ->make(true);
        }

        return view('taskview.index');
    }

    public function taskcompletestatus(Request $request)
    {
    
        if ($request->status == 'completed') {
            $val = [
                'task_enddate' => date('d-m-Y'),
                'task_status' => $request->status,
                'status' => "1",

            ];
            // dd($request->all());
            $result = DB::table('task_management')->where('id', $request->id)->update($val);

            $task_enddate = DB::table('task_management')
            ->select('task_management.*', 'accounts.company_name')
            ->join('accounts', 'task_management.company_id', '=', 'accounts.id')
            ->where('task_management.id', $request->id) // Specify the table for the id
            ->first();

            $fquery = DB::table('regis')->where('empid', $task_enddate->assigned_by)->first();

            $equery1 = DB::table('regis')->where('empid', request()->session()->get('empid',))->first();

            if ($result) {
                $htmlContent = '<html><title>Task Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Task complete Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Task Completed details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_enddate->company_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_enddate->task_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_enddate->task_startdate . '</td></tr><tr><td style="width:200px;padding:4px 0">Complete Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . date('d-m-Y', time()) . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

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
                    $equery1,
                    $htmlContent,
                ) {
                    $projectmail = in_array($equery1->dept_id, [2, 3]) ? 'project@appacmedia.com' : null;
                    // Set recipients
                    $message->to($fquery->emailid)
                        ->cc(array_merge([$founderEmail, $managerMail, $projectmail]))
                        ->bcc($bccEmail)
                        ->from($infoMail, $equery1->fname)
                        ->subject('Task Completed ' . date('d-m-Y', time()))
                        ->html($htmlContent);
                });

                session()->flash('secmessage', 'Status Updated Successfully.');
                return response()->json(['status' => 1, 'message' => 'Status Updated Successfully.'], 200);
            } else {
                session()->flash('secmessage', 'Status Updated Successfully.');
                return response()->json(['status' => 1, 'message' => 'Status Updated Successfully.'], 200);
            }
        } else {

               session()->flash('secmessage', 'Status Updated Successfully.');
                return response()->json(['status' => 1, 'message' => 'Status Updated Successfully.'], 200);
        }

    }
}
