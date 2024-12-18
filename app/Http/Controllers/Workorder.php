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

class Workorder extends Controller
{

    public function index(Request $request)
    {
      
        if ($request->ajax()) {

            $empid = request()->session()->get('empid'); // Retrieve empid from session


            // Use whereIn to match empid values in the array
            $data = DB::table('work_order as w')
                ->select(
                    'a.id as aid',
                    'a.company_name',
                    'w.issue_date',
                    'w.dead_line',
                    'w.id as wid',
                    'w.complete_date',
                    'w.close_date',
                    'w.empid',
                    'w.project_description',
                    'w.work_status',
                    'w.assigned_by',
                    'w.working_day',
                    'd.id as dept_id',
                    'd.department_name'
                )
                ->join('accounts as a', 'a.id', '=', 'w.company_id')
                ->join('department_master as d', 'd.id', '=', 'w.dept_id')
                ->where('w.empid', 'LIKE', '%' . $empid . '%')
                ->orderBy('w.id', 'DESC')
                ->get();

            // dd($data); 

            $emp = request()->session()->get('empid');
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
                    ->where(function ($query) use ($emp, $work) {
                        $query->where('q.empid', $emp)
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
                } elseif ($diff == 0) {
                    $work->remainday1 = 'Today is the day to finish';
                } else {
                    $work->remainday1 = "Work Over Due for <b>" . $diff1 . "</b> " . $dname;
                }

                // Status labels
                if ($work->work_status == 'closed') {
                    $work->status_label = "<p style='font-size:10px;color: #2fade7;font-weight: 800;text-align: center;'>"
                        . ucfirst($work->work_status) . " Date: " . htmlspecialchars($work->close_date) . "</p>";
                } elseif ($work->work_status == 'live') {
                    $work->status_label = '
                    <div>
                        <select class="status" style="width:80px;" data-id="' . htmlspecialchars($work->wid) . '">
                            <option value="' . htmlspecialchars($work->work_status) . '" '
                        . ($work->work_status == $work->work_status ? 'selected' : '') . '>'
                        . ucfirst($work->work_status) . '</option>
                            <option value="completed" '
                        . ($work->work_status == 'completed' ? 'selected' : '') . '>Completed</option>
                        </select>
                        <button class="btn btn-modal livestatus" data-id="' . htmlspecialchars($work->wid) . '">Update</button>
                    </div>';
                } else {
                    $work->status_label = "<p style='color: #4CAF50;font-weight: 800;text-align: center;'>"
                        . ucfirst($work->work_status) . "<br>Date: " . htmlspecialchars($work->complete_date) . "</p>";
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
                    if ($row->work_status == 'completed' || $row->work_status == 'closed') {
                        return "Completed";
                    } else {
                        return $row->remainday1;
                    }
                })
                ->addColumn('status', function ($row) {
                    return $row->status_label;
                })
                ->addColumn('action', function ($row) {
                    return ' <a class="btn" href="workqueryindex/' . $row->wid . '" style="text-decoration:none;"><i class="icon-pencil"></i> Query - <b>' . $row->query_count . '</a>';
                })
                ->rawColumns(['sno', 'project_description', 'company_name', 'days', 'status', 'action'])
                ->make(true);
        }

        return view('workorder.index');
    }

    public function workorderstatus(Request $request)
    {
// dd($request->all());
        if ($request->status == 'completed') {

            $val=[
                'work_status'=>$request->status,
                'complete_date'=> date('d-m-Y', time()),
                'complete_by'=> request()->session()->get('empid'),
                'status'=>'1',
            ];

            $result = DB::table('work_order')->where('id',$request->id)->update($val);

            $work_order = DB::table('work_order')
                ->select('work_order.*', 'accounts.company_name')
                ->join('accounts', 'work_order.company_id', '=', 'accounts.id')
                ->where('work_order.id', $request->id) // Specify the table for the id
                ->first();

            if ($result) {

                $fquery = DB::table('regis')->where('empid',$work_order->assigned_by)->first();
                $fname = $fquery->fname;
                $lname = $fquery->lname;

                $aquery = DB::table('regis')->where('empid',request()->session()->get('empid'))->first();
                $afname = $aquery->fname;
                $alname = $aquery->lname;
          
                $htmlContent = '<html><title>Work Completed Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Work completed Update</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hi sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Work order details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $work_order->company_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Project Description:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $work_order->project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Work Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $work_order->issue_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Assigned By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr><tr><td style="width:200px;padding:4px 0">Completed By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $afname . " " . $alname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

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
                    $aquery,
                    $htmlContent,
                ) {
                    // Set recipients
                        $message->to($fquery->emailid)
                        ->cc(array_merge([$founderEmail, $managerMail]))
                        ->bcc($bccEmail)
                        ->from($infoMail, $aquery->fname)
                        ->subject('Work Complete Details - ' . date('d-m-Y', time()))
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
