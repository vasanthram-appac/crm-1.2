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

class Workreport extends Controller
{

    public function index(Request $request)
    {

        if (request()->ajax()) {
            $data = DB::table('dailyreport')
                ->where('empid', request()->session()->get('empid'))
                ->orderBy('id', 'DESC')
                ->limit(200)
                ->get();

            if (count($data) > 0) {
                foreach ($data as $record) {
                    $client = $record->client;
                    $leadid = $record->leadid;
                    $start_time = $record->start_time;
                    $end_time = $record->end_time;
                    $record->time = $start_time . ' - ' . $end_time;

                    $dateDiff = intval((strtotime($end_time) - strtotime($start_time)) / 60);
                    $hours = intval($dateDiff / 60);
                    $minutes = $dateDiff % 60;

                    $record->total_time = $hours . " Hours and " . $minutes . " Minutes";

                    $mcompany = DB::table('accounts')->select('company_name')->find($client);

                    $record->com_name = (!empty($mcompany)) ? $mcompany->company_name : '';

                    $lmcompany = DB::table('leads')->select('company_name')->find($leadid);
                    // dd($lmcompany);
                    $record->lcom_name = (!empty($lmcompany)) ? $lmcompany->company_name : '';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('company', function ($row) {
                    return $row->com_name . "<br>" . $row->lcom_name;
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Workreport::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					<span class="tooltiptext">update</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i> 
						<span class="tooltiptext">delete</span>
					</button>';
                })

                ->rawColumns(['sno', 'action', 'company'])
                ->make(true);
        }

         $totalhours = DB::table('dailyreport')
        ->where('empid', request()->session()->get('empid'))
        ->where('report_date', date('d-m-Y'))
        ->selectRaw('SUM(w_hours) AS total_hours, SUM(w_mins) AS total_minutes, COUNT(*) AS totalcount')
        ->get();

        $totalMinutes = ($totalhours[0]->total_hours * 60) + $totalhours[0]->total_minutes;
        $hours = floor($totalMinutes / 60);
        $remainingMinutes = $totalMinutes % 60;


        return view('workreport/index', compact('hours', 'remainingMinutes'))->render();
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')->where('status', '1')->where('active_status', 'active')->orderBy('company_name', 'ASC')->pluck('company_name', 'id');

        $accounts[147] = 'Others';

        $dept_id = request()->session()->get('dept_id');

        if ($dept_id == 2) {
            $work_types = DB::table('work_type')->whereIn('dept', [2, 3])->get();
        } else {
            
            if($dept_id != 1 && $dept_id != 5 && $dept_id != 6 && $dept_id != 7){
                $dept_id1=$dept_id;
            }else{
                $dept_id1="0";
            }

            $work_types = DB::table('work_type')->where('dept', $dept_id1)->get();
        }

        $wip_list = DB::table('work_wip')
            ->join('accounts', 'work_wip.client_id', '=', 'accounts.id')
            ->whereIn('project_status', ['Development', 'Design'])
            ->where('work_wip.status', '0')
            ->pluck('accounts.company_name', 'work_wip.id');

        $leads_list = DB::table('leads')
            ->where('oppourtunity_status', 'inactive')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id');

  $lasttime = DB::table('dailyreport')
            ->select('end')
            ->where('report_date1', date('Y-m-d'))
            ->orderBy('id', 'DESC')
            ->first();

            if(!empty($lasttime)){
              
                $lasttime=date('H:i', strtotime($lasttime->end . ' +1 minute'));   
            }else{
                $lasttime='08:45';
            }


        return view('workreport/create', compact('accounts', 'work_types', 'wip_list', 'leads_list', 'lasttime'))->render();
    }

    public function store(Request $request)
    {

        // Define validation rules for inputs
        $validator = Validator::make($request->all(), [
            'report_date' => 'required|date',
            'client' => 'required|exists:accounts,id', // Assuming 'accounts' is your table and 'id' is the column
            'worktype' => 'required|integer',
            'wipid' => 'nullable|exists:work_wip,id', // Assuming 'wip_list' is your table and 'id' is the column
            'leadid' => 'nullable|exists:leads,id', // Assuming 'leads_list' is your table and 'id' is the column
            'start_time' => 'required|date_format:H:i',
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                function ($attribute, $value, $fail) use ($request) {
                    // Parse start_time and end_time as timestamps
                    $startTime = strtotime($request->start_time);
                    $endTime = strtotime($value);
            
                    // Ensure both timestamps are valid
                    if ($startTime === false || $endTime === false) {
                        $fail("Invalid time format provided for start or end time.");
                        return;
                    }
            
                    // Calculate the difference in minutes
                    $diffInMinutes = ($endTime - $startTime) / 60;
            
                    // Allow if the difference is 5 hours or less
                    if ($diffInMinutes > 300) {
                        $fail("The difference between start time and end time must be 5 hours or less.");
                    }
                },
                
            ],

            'project_name' => 'nullable|string|max:255',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        $dateDiff = intval((strtotime(date("H:i", strtotime($request->end_time))) - strtotime(date("H:i", strtotime($request->start_time)))) / 60);
        $hours = intval($dateDiff / 60);
        $minutes = $dateDiff % 60;
        $total_time = $hours . " Hours and " . $minutes . " Minutes";

        // Prepare data for insertion
        $reportData = [
            'report_date' => date("d-m-Y", strtotime($request->report_date)),
            'report_date1' => $request->report_date,
            'empid' => request()->session()->get('empid'),
            'dept_id' => request()->session()->get('dept_id'),
            'client' => $request->client,
            'leadid' => $request->leadid,
            'project_name' => $request->project_name,
            'start_time' => date("g:i a", strtotime($request->start_time)),
            'end_time' => date("g:i a", strtotime($request->end_time)),
            'start' => $request->start_time,
            'end' => $request->end_time,
            'enquiry_month' => date("m-Y", strtotime($request->report_date)),
            'status' => $request->status,
            'submit_time' => date('d-m-Y h:i:s A', time()),
            'w_hours' => $hours,
            'w_mins' => $minutes,
            'taskid' => "",
            'wipid' => $request->wipid,
            'worktype' => $request->worktype,
        ];

        // Insert data into the database
        DB::table('dailyreport')->insert($reportData);

        session()->flash('secmessage', 'your Daily Report Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'your Daily Report Successfully Added.'], 200);
    }



    public function edit($id)
    {
        $workreport = DB::table('dailyreport')->where('id', $id)->first();

        $accounts = DB::table('accounts')->where('status', '1')->where('active_status', 'active')->orderBy('company_name', 'ASC')->pluck('company_name', 'id');

        $accounts[147] = 'Others';

        $dept_id = request()->session()->get('dept_id');

        if ($dept_id == 2) {
            $work_types = DB::table('work_type')->whereIn('dept', [2, 3])->get();
        } else {
            $work_types = DB::table('work_type')->where('dept', $dept_id)->get();
        }

        $wip_list = DB::table('work_wip')
            ->join('accounts', 'work_wip.client_id', '=', 'accounts.id')
            ->whereIn('project_status', ['Development', 'Design'])
            ->where('work_wip.status', '0')
            ->pluck('accounts.company_name', 'work_wip.id');

        $leads_list = DB::table('leads')
            ->where('oppourtunity_status', 'inactive')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id');



        return view('workreport/edit', compact('accounts', 'work_types', 'wip_list', 'leads_list','workreport'))->render();
    }

    public function update(Request $request, $id)
    {
        
        // Define validation rules for inputs
        $validator = Validator::make($request->all(), [
            'report_date' => 'required|date',
            'client' => 'required|exists:accounts,id', // Assuming 'accounts' is your table and 'id' is the column
            'worktype' => 'required|integer',
            'wipid' => 'nullable|exists:work_wip,id', // Assuming 'wip_list' is your table and 'id' is the column
            'leadid' => 'nullable|exists:leads,id', // Assuming 'leads_list' is your table and 'id' is the column
            'start_time' => 'required|date_format:H:i',
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                function ($attribute, $value, $fail) use ($request) {
                    // Parse start_time and end_time as timestamps
                    $startTime = strtotime($request->start_time);
                    $endTime = strtotime($value);
            
                    // Ensure both timestamps are valid
                    if ($startTime === false || $endTime === false) {
                        $fail("Invalid time format provided for start or end time.");
                        return;
                    }
            
                    // Calculate the difference in minutes
                    $diffInMinutes = ($endTime - $startTime) / 60;
            
                    // Allow if the difference is 5 hours or less
                    if ($diffInMinutes > 300) {
                        $fail("The difference between start time and end time must be 5 hours or less.");
                    }
                },
                
            ],

            'project_name' => 'nullable|string|max:255',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        $dateDiff = intval((strtotime(date("H:i", strtotime($request->end_time))) - strtotime(date("H:i", strtotime($request->start_time)))) / 60);
        $hours = intval($dateDiff / 60);
        $minutes = $dateDiff % 60;
        $total_time = $hours . " Hours and " . $minutes . " Minutes";

        // Prepare data for insertion
        $reportData = [
            'report_date' => date("d-m-Y", strtotime($request->report_date)),
            'report_date1' => $request->report_date,
            'empid' => request()->session()->get('empid'),
            'dept_id' => request()->session()->get('dept_id'),
            'client' => $request->client,
            'leadid' => $request->leadid,
            'project_name' => $request->project_name,
            'start_time' => date("g:i a", strtotime($request->start_time)),
            'end_time' => date("g:i a", strtotime($request->end_time)),
            'start' => $request->start_time,
            'end' => $request->end_time,
            'enquiry_month' => date("m-Y", strtotime($request->report_date)),
            'status' => $request->status,
            'submit_time' => date('d-m-Y h:i:s A', time()),
            'w_hours' => $hours,
            'w_mins' => $minutes,
            'taskid' => "",
            'wipid' => $request->wipid,
            'worktype' => $request->worktype,
        ];

        // Insert data into the database
        DB::table('dailyreport')->where('id',$id)->update($reportData);

        session()->flash('secmessage', 'your Daily Report updated successfully.');
        return response()->json(['status' => 1, 'message' => 'your Daily Report updated successfully.'], 200);
    }

    public function destroy($id)
    {

        $upd = DB::table('dailyreport')->where('id', $id)->delete();
        session()->flash('secmessage', 'Daily report Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Daily report Deleted Successfully!'], 200);
    }
}
