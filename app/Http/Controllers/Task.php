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

class Task extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('task_management as t')
                ->select(
                    'a.id as aid',
                    'a.company_name',
                    'r.fname',
                    'r.empid',
                    't.taskid',
                    't.task_name',
                    't.assigned_by',
                    't.task_enddate',
                    't.taskclose_date',
                    't.task_startdate',
                    't.task_duedate',
                    't.task_status',
                    't.priority',
                    't.id as tid'
                )
                ->join('accounts as a', 'a.id', '=', 't.company_id')
                ->join('regis as r', 'r.empid', '=', 't.empid')
                ->where('t.task_status', '!=', 'closed')
                ->when($request->session()->get('role') == 'user', function ($query) use ($request) {
                    $query->where('t.assigned_by', $request->session()->get('empid'));
                })
                ->orderByDesc('t.id')
                ->get();

            foreach ($data as $task) {
                // Count task queries
                $task->query_count = DB::table('task_query_details as q')
                    ->where('q.task_id', $task->tid)
                    ->where(function ($query) use ($task, $request) {
                        $query->where('q.empid', $request->session()->get('empid'))
                            ->orWhere('q.assigned_by', $task->assigned_by);
                    })
                    ->count();



                // Get assigned user's first name
                $assignedUser = DB::table('regis')
                    ->select('fname')
                    ->where('empid', $task->assigned_by)
                    ->first();

                $task->assig_fname = $assignedUser->fname ?? 'N/A';

                // Add priority labels
                $priorityLabels = [
                    'High' => '<span style="font-size: 11px;padding:5px 10px;margin-bottom:0;border-radius:3px;color:#F41B1B;background-color:#FFF0F0;border:1px solid  #F41B1B">High</span>',
                    'Medium' => '<span style="font-size:11px;padding:5px 10px;margin-bottom:0;border-radius:3px;color:#D68A00;background-color:#FFF3DD;border:1px solid  #D68A00">Medium</span>',
                    'Low' => '<span style="font-size: 11px; padding:5px 10px;margin-bottom:0; border-radius: 3px;color: #38A800;background-color:#F6FFF1;border:1px solid  #38A800">Low</span>',
                ];

                // Add task status information
                if (in_array($task->task_status, ['assigned', 'reopen'])) {
                    $task->status_label = ucfirst($task->task_status);
                    $task->priority_label = $priorityLabels[$task->priority] ?? '';
                } elseif ($task->task_status == 'Closed') {
                    $task->status_label = '<p style="font-size: 11px; color: #2fade7; font-weight: 800; text-align: center;">'
                        . ucfirst($task->task_status) . ' on: <br>' . $task->taskclose_date . '</p>';
                    $task->priority_label = $priorityLabels[$task->priority] ?? '';
                } else {
                    $task->status_label = '<p style="font-size: 11px; color: #4CAF50; font-weight: 800; text-align: center;">'
                        . ucfirst($task->task_status) . ' on: <br>' . $task->task_enddate . '</p>'
                        . '<button class="btn btn-modal  change-status p-0 ms-1" data-container=".appac_show" data-href="' . route('taskstatus', [
                            'id' => $task->tid,
                            'status' => 'reopen'
                        ]) . '"><i class="fi fi-ts-arrows-repeat"></i>
						<span class="tooltiptext">reopen</span>
						</button>'
                        . '<button class="btn btn-modal  change-status p-0 ms-2" data-container=".appac_show" data-href="' . route('taskstatus', [
                            'id' => $task->tid,
                            'status' => 'closed'
                        ]) . '"><i class="fi fi-ts-rectangle-xmark"></i>
						<span class="tooltiptext  last">Close</span>
						</button>';
                    $task->priority_label = '';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('company_name', function ($row) {
                    return '<button class="btn btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->aid]) . '">' . $row->company_name . '</button>';
                })

                ->addColumn('status', function ($row) {
                    return $row->status_label . ' ' . $row->priority_label;
                })

                ->addColumn('approved', function ($row) {
                    return ' <button class="btn btn-modal text-lblue" data-container=".customer_modal" data-href="' . action([Taskview::class, 'edit'], [$row->tid]) . '">
                                Click
                            </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Task::class, 'edit'], [$row->tid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext  last">edit</span>
                            </button>
                            <button class="btn btn-modal text-lblue" data-container=".customer_modal" data-href="' . route('taskapprovalview', ['id' => $row->tid]) . '">
                                View
                            </button>
                            <a class="d-flex align-items-center gap-1 flex-wrap btn" href="queryindex/' . $row->tid . '" style="text-decoration:none;"><i class="fi fi-ts-book-arrow-right"></i><b>' . $row->query_count . '
							<span class="tooltiptext  last">Query</span>
							</a>';
                })
                ->rawColumns(['sno', 'company_name', 'status', 'action', 'approved'])
                ->make(true);
        }

        return view('task.index');
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
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        $assign = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->whereNotIn('id', [2, 3])
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        return view('task/create', compact('accounts', 'regis', 'assign'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'empid' => 'required|exists:regis,empid',
            'task_name' => 'required|string|max:255',
            'priority' => 'required|in:High,Medium,Low',
            'task_startdate' => 'required|date',
            'task_duedate' => 'required|date',
            'task_description' => 'nullable|string|max:500',
            // 'mail_cc' => 'required|array',
            // 'mail_cc.*' => 'exists:regis,emailid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        $task_new = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->task_description);

        $wsql1 = DB::table('task_management')->orderBy('id', 'DESC')->first();
        $wid = substr($wsql1->taskid, -4);
        $common = 'TO';
        if ($wid == '') {
            $wid1 = '0001';
        } else {
            $wid1 = str_pad($wid + 1, 4, 0, STR_PAD_LEFT);
        }
        $t_id = $common . $wid1;

        $val = [
            'taskid' => $t_id,
            'company_id' => $request->company_name,
            'empid' => $request->empid,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'task_startdate' => date("d-m-Y", strtotime($request->task_startdate)),
            'task_duedate' => ($request->task_duedate) ? date("d-m-Y", strtotime($request->task_duedate)) : '',
            'assigned_by' => request()->session()->get('empid'),
            'task_status' => 'assigned',
            'start_time' => "",
            'end_time' => "",
            'priority' => $request->priority,
            'status' => 0,
            'mail_cc' => json_encode($request->mail_cc)
        ];

        $insert = DB::table('task_management')->insert($val);

        $mcompany = DB::table('accounts')->where('id', $request->company_name)->first();
        $com_name = $mcompany->company_name;

        $mquery1 = DB::table('regis')->where('empid', $request->empid)->first();
        $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
        if (request()->session()->get('dept_id') != 6) {
            $replay1 = DB::table('regis')->select('emailid')->where('empid', request()->session()->get('empid'))->first();
            $reply = $replay1->emailid ?? null;
        } else {
            $reply = null;
        }

        $business = DB::table('regis')->where('dept_id', 6)->where('status', 1)->pluck('emailid');
        $thesupportmail = request()->session()->get('dept_id') == 6 ? $business->toArray() : [];

        //tl mail start
        $empidsByDept = [
            3 => ['AM063', 'AM073', 'AM098'],
            2 => ['AM043', 'AM049'],
            4 => ['AM045', 'AM046'],
            5 => ['AM045', 'AM046'],
            6 => ['AM081'],
        ];
        $empids = $empidsByDept[$mquery1->dept_id] ?? [];

        $tmail = DB::table('regis')
            ->whereIn('empid', $empids)
            ->where('status', 1)
            ->pluck('emailid');
        $tlmail = $business ? $tmail->toArray() : [];
        //tl mail end

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
            $mquery1,
            $task_new,
            $thesupportmail,
            $reply,
            $tlmail,
        ) {
            // Validate that $request->mail_cc is an array or provide a fallback
            $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
            // $ccList = array_filter([$founderEmail, $managerMail, $thesupportmail, ...$ccEmails]);

            $ccList = array_filter(array_merge(array_filter([$founderEmail, $managerMail]), $thesupportmail, $ccEmails, $tlmail));

            // Set recipients
            $message->to($mquery1->emailid)
                ->cc($ccList)
                ->bcc($bccEmail);
            if (!empty($reply)) {
                $message->bcc($reply);
            }
            $message->replyTo($fquery->emailid, $fquery->fname . ' ' . $fquery->lname)
                ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                ->subject('Task For ' . $request->task_name . ' - ' . $com_name . ' : ' . date('d-m-Y', strtotime($request->task_startdate)))
                ->html(' <html>
                        <head>
                            <title>Task Details</title>
                        </head>
                        <body>
                            <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">
                                <tbody>
                                    <tr>
                                        <td align="center">
                                            <table width="96%" cellpadding="0" cellspacing="0" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px">
                                                            <table width="100%" cellpadding="0" cellspacing="0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px">
                                                                            <p style="font-size:14px;color:#000;font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">
                                                                                Today Task Details
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px">
                                                                            <p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif">
                                                                                <strong>Dear ' . htmlspecialchars($mquery1->fname . ' ' . $mquery1->lname) . ',</strong>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="margin:0;padding:0 0 5px 0">
                                                                            <p style="font-size:13px;background-color:#eaeaea;color:#000;font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">
                                                                                Task details Updated Through CRM Portal
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px">
                                                                            <table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td style="width:200px;padding:4px 0">Client Name:</td>
                                                                                        <td style="padding-right:10px">:</td>
                                                                                        <td style="font-weight:normal">' . htmlspecialchars($com_name) . '</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="width:200px;padding:4px 0">Task Name:</td>
                                                                                        <td style="padding-right:10px">:</td>
                                                                                        <td style="font-weight:normal">' . htmlspecialchars($request->task_name) . '</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="width:200px;padding:4px 0">Task Priority:</td>
                                                                                        <td style="padding-right:10px">:</td>
                                                                                        <td style="font-weight:normal">' . htmlspecialchars($request->priority) . '</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="width:200px;padding:4px 0">Task Due Date:</td>
                                                                                        <td style="padding-right:10px">:</td>
                                                                                        <td style="font-weight:normal">' . htmlspecialchars(date('d-m-Y', strtotime($request->task_duedate))) . '</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td style="width:200px;padding:4px 0">Assigned By:</td>
                                                                                        <td style="padding-right:10px">:</td>
                                                                                        <td style="font-weight:normal">' . htmlspecialchars($fquery->fname . ' ' . $fquery->lname) . '</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3" style="width:200px;padding:4px 0">Task Description:</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3">
                                                                                            <p>' . $task_new . '</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </body>
                    </html>
                        ');
        });


        // Success message and response
        session()->flash('secmessage', 'Task Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'Task Details Added Successfully.'], 200);
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

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        $assign = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->whereNotIn('id', [2, 3])
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        $task = DB::table('task_management')->where('id', $id)->first();

        return view('task/edit', compact('accounts', 'regis', 'assign', 'task'))->render();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(),$id);

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'empid' => 'required|exists:regis,empid',
            'task_name' => 'required|string|max:255',
            'task_startdate' => 'required|date',
            'task_description' => 'nullable|string|max:500',
            'task_subject' => 'nullable|string|max:500',
            // 'mail_cc' => 'required|array',
            // 'mail_cc.*' => 'exists:regis,emailid',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        $task_new = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->task_description);

        $val = [

            'company_id' => $request->company_name,
            'empid' => $request->empid,
            'task_name' => $request->task_name,
            'task_description' => $request->task_description,
            'task_subject' => $request->task_subject,
            'task_startdate' => date("d-m-Y", strtotime($request->task_startdate)),

        ];

        if (count($request->mail_cc) > 0) {
            $val['mail_cc'] = json_encode($request->mail_cc);
        }

        $insert = DB::table('task_management')->where('id', $id)->update($val);

        $mcompany = DB::table('accounts')->where('id', $request->company_name)->first();
        $com_name = $mcompany->company_name;

        $mquery1 = DB::table('regis')->where('empid', $request->empid)->first();

        $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

        if (request()->session()->get('dept_id') != 6) {
            $replay1 = DB::table('regis')->select('emailid')->where('empid', request()->session()->get('empid'))->first();
            $reply = $replay1->emailid ?? null;
        } else {
            $reply = null;
        }

        $business = DB::table('regis')->where('dept_id', 6)->where('status', 1)->pluck('emailid');
        $thesupportmail = request()->session()->get('dept_id') == 6 ? $business->toArray() : [];

        //tl mail start
        $empidsByDept = [
            3 => ['AM063', 'AM073', 'AM098'],
            2 => ['AM043', 'AM049'],
            4 => ['AM045', 'AM046'],
            5 => ['AM045', 'AM046'],
            6 => ['AM081'],
        ];
        
        $empids = $empidsByDept[$mquery1->dept_id] ?? [];

        $tmail = DB::table('regis')
            ->whereIn('empid', $empids)
            ->where('status', 1)
            ->pluck('emailid');
        $tlmail = $business ? $tmail->toArray() : [];
        //tl mail end

        $bccEmail = env('SUPPORTMAIL');
        $founderEmail = env('FOUNDERMAIL');
        $infoMail = env('INFOMAIL');
        $managerMail = env('MANAGERMAIL');

        Mail::send([], [], function ($message) use (
            $request,
            $founderEmail,
            $bccEmail,
            $infoMail,
            $fquery,
            $com_name,
            $mquery1,
            $task_new,
            $thesupportmail,
            $reply,
            $managerMail,
            $tlmail,
        ) {
            // Validate that $request->mail_cc is an array or provide a fallback
            $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
            // $ccList = array_filter([$founderEmail, $thesupportmail, ...$ccEmails]);

            $ccList = array_filter(array_merge(array_filter([$founderEmail, $managerMail]), $thesupportmail, $ccEmails, $tlmail));

            $message->to($mquery1->emailid)
                ->cc($ccList)
                ->bcc($bccEmail);
            if (!empty($reply)) {
                $message->bcc($reply);
            }
            $message->replyTo($fquery->emailid, $fquery->fname . ' ' . $fquery->lname)
                ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                ->subject('Task For ' . $request->task_name . ' - ' . $com_name . ' : ' . date('d-m-Y', strtotime($request->task_startdate)))
                ->html('<html><title>Task Update Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size: 18px;color: rgb(239, 12, 12);    font-family: Arial,Helvetica,sans-serif;font-weight: 800;line-height: 1.5em;    margin: 0px;padding: 0.4em;text-align: center;">Task Update Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear ' . htmlspecialchars($mquery1->fname . ' ' . $mquery1->lname) . ', </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Task details Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . htmlspecialchars($com_name) . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . htmlspecialchars($request->task_name) . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Assign Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . htmlspecialchars(date('d-m-Y', strtotime($request->task_startdate))) . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $task_new . '</td></tr><tr><td style="width:200px;padding:4px 0">Assigned By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . htmlspecialchars($fquery->fname . ' ' . $fquery->lname) . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>
                        ');
        });

        // Success message and response
        session()->flash('secmessage', 'Task Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'Task Details Added Successfully.'], 200);
    }

    public function query($id)
    {
        // dd($id);
        return view('task/query', compact('id'))->render();
    }

    public function taskstatus($id, $status)
    {
        // dd($id, $status);
        if ($status == 'closed') {
            $val = [
                'task_status' => 'closed',
                'taskclose_date' => date('d-m-Y', time()),
                'closedatef' => date('Y-m-d', time()),

            ];
            $query1 = DB::table('task_management')->where('id', $id)->update($val);
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

            // $shrs = $wsql1->shrs;
            // $ssecs = $wsql1->ssecs;
            // $s_ampm = $wsql1->s_ampm;
            // $start_time = $shrs . ":" . $ssecs . " " . $s_ampm;

            // $thrs = $wsql1->thrs;
            // $tsecs = $wsql1->tsecs;
            // $e_ampm = $wsql1->e_ampm;
            // $end_time = $thrs . ":" . $tsecs . " " . $e_ampm;

            $start_time = "";
            $end_time = "";

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

    public function taskapprovalview($id)
    {

        $task = DB::table('taskqc')->select('taskqc.*', 'regis.fname')->where('taskqc.task_id', $id)
            ->join('regis', 'taskqc.empid', 'regis.empid')->get();

        return view('task/taskapprovalview', compact('task'))->render();
    }
}
