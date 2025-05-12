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

class Newnbd extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('newnbd as t')
                ->select(
                    'r.fname',
                    'r.empid',
                    't.name',
                    't.email',
                    't.mobile',
                    't.company_name as companyname',
                    't.source',
                    't.status',
                    't.id as tid'
                )
                ->join('regis as r', 'r.empid', '=', 't.empid')
                ->where('t.status', '!=', 'closed')
                ->when($request->session()->get('role') == 'user', function ($query) use ($request) {
                    $query->where('t.empid', $request->session()->get('empid'));
                })
                ->orderByDesc('t.id')
                ->get();

            foreach ($data as $task) {

                // Add task status information
                if (in_array($task->status, ['assigned', 'reopen'])) {
                    $task->status_label = ucfirst($task->status);
                } elseif ($task->status == 'Closed') {
                    $task->status_label = '<p style="font-size: 11px; color: #2fade7; font-weight: 800; text-align: center;">'
                        . ucfirst($task->status) .  '</p>';
                } else {
                    $task->status_label = '<p style="font-size: 11px; color: #4CAF50; font-weight: 800; text-align: center;">'
                        . ucfirst($task->status) .'</p>'
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
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('status', function ($row) {
                    return $row->status_label;
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Newnbd::class, 'edit'], [$row->tid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext  last">edit</span>
                            </button>';
                })
                ->rawColumns(['sno', 'status', 'action'])
                ->make(true);
        }

        return view('newnbd.index');
    }

    public function create(Request $request)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        return view('newnbd/create', compact( 'regis'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'empid' => 'required|exists:regis,empid',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        $val = [
            'empid' => $request->empid,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'status' => $request->status,
        ];

        $insert = DB::table('newnbd')->insert($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }

    public function edit($id)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        $newnbd = DB::table('newnbd')->where('id', $id)->first();

        return view('newnbd/edit', compact('regis', 'newnbd'))->render();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(),$id);

        $validator = Validator::make($request->all(), [
            'empid' => 'required|exists:regis,empid',
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());

        $val = [
            'empid' => $request->empid,
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'status' => $request->status,
        ];

        $insert = DB::table('newnbd')->where('id', $id)->update($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }

    public function taskstatus($id, $status)
    {
dd($id, $status);
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
          
        }
        session()->flash('secmessage', 'Status Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully.'], 200);
    }

}
