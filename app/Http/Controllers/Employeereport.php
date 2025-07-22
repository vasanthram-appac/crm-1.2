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

class Employeereport extends Controller
{

    public function index(Request $request)
    {

        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
       
        if (request()->ajax()) {

            // dd(request()->session()->get('aireportdate'), request()->session()->get('aiempid'), request()->session()->get('aidept_id'));
            // $date=date('2024-09-06', strtotime('-1 day'));

            $lastdata = DB::table('dailyreport')
            ->select('report_date1')
            ->orderBy('id', 'desc')
            ->first();
    
            if(empty(request()->session()->get('aireportdate'))){
                request()->session()->put('aireportdate', $lastdata->report_date1);
            }

            $data = DB::table('dailyreport')
            ->when(!empty('dailyreport.client'), function ($query) {
                $query->join('accounts', 'dailyreport.client', '=', 'accounts.id');
            })
            ->when(!empty('dailyreport.empid'), function ($query) {
                $query->join('regis', 'dailyreport.empid', '=', 'regis.empid');
            })
            ->select(
                'dailyreport.*',                         // Select all columns from dailyreport
                'accounts.company_name as company_name_account',  // Alias to avoid name conflicts
                'regis.fname',                           // First name from regis
                'regis.lname'                            // Last name from regis
            )
            ->where('regis.status', '1')
            // ->where('dailyreport.report_date1', $date)

            ->when(request()->session()->has('aireportdate') && !empty(request()->session()->get('aireportdate')), function ($query) {
                $query->where('dailyreport.report_date1', request()->session()->get('aireportdate'));
            }, function ($query) {
                $query->where('dailyreport.report_date1', date('Y-m-d', strtotime('-1 day')));
            })
            ->when(request()->session()->has('aiempid') && count(request()->session()->get('aiempid'))>0 && !in_array('all', request()->session()->get('aiempid')), function ($query) {
                // dd(request()->session()->get('aiempid'));
                $query->whereIn('dailyreport.empid', request()->session()->get('aiempid'));
            })                      
            ->when(request()->session()->has('aidept_id') && !empty(request()->session()->get('aidept_id')), function ($query) {
                $query->where('dailyreport.dept_id', request()->session()->get('aidept_id'));
            })
            ->orderBy('dailyreport.id', 'desc')
            ->get();
        
            // dd($data);   
            if (count($data) > 0) {

                foreach ($data as $user) {

                    $user->empname = $user->fname . $user->lname;

                    $dateDiff = intval((strtotime($user->end_time) - strtotime($user->start_time)) / 60);
                    $hours = intval($dateDiff / 60);
                    $minutes = $dateDiff % 60;
                    $user->total_time = $hours . " Hours and " . $minutes . " Minutes";
                }
            }

            $eid=$data->pluck('empid')->toArray();
    
            $leave = DB::table('leaverecord')
            ->where('leavestatus', 'Approved')
            ->when(request()->session()->has('aireportdate') && !empty(request()->session()->get('aireportdate')), function ($query) {
                $query->whereRaw('? BETWEEN leavedate AND leavedatetill', [request()->session()->get('aireportdate')]);
            }, function ($query) {
                $query->whereRaw('? BETWEEN leavedate AND leavedatetill', [date('Y-m-d', strtotime('-1 day'))]);
            })
            ->get();
        
            $leid=$leave->pluck('empid')->toArray();

            $active=DB::table('regis')->select('fname')->whereIn('empid',$eid)->where('status','1')->get();

            $data->active = $active;

            $excludedEmpIds = array_merge($eid, $leid, ['AM001', 'AM002', 'AM099', 'admin']);

            if(empty(request()->session()->get('aiempid')) || in_array('all', request()->session()->get('aiempid')) || count($data) == 0){

            $inactive = DB::table('regis')
            ->select('fname')
            ->whereNotIn('empid', $excludedEmpIds)
            ->where('status', '1')
            ->where('dept_id', '!=', '6')
            ->get();

            $data->inactive = $inactive;
            } else{
                $data->inactive = [];
            }

            request()->session()->put('aireport', $data);
            
            // dd($data);

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('company_name_account', function ($row) {
                    return
                        '<button class="btn  btn-modal text-lblue" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->client]) . '">' . $row->company_name_account . ' </button>
                       ';
                })

                ->rawColumns(['sno','company_name_account'])
                ->make(true);
        }

 

        $user=DB::table('regis')->where('fname','!=','demo')->where('status','!=','0')->get();

        $department_master=DB::table('department_master')->pluck('department_name','id');


        return view('empreport/index', compact('user','department_master'))->render();
    }


    public function report(Request $request){
 
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'reportdate' => 'required|date',
            'empid' => 'nullable|array',  // Optional array if chosen
            'dept_id' => 'nullable|string|max:255',  // Optional string if chosen
        ])->after(function ($validator) use ($request) {
            // Custom validation to ensure only one is chosen
            $empid = $request->input('empid');
            $deptId = $request->input('dept_id');
        
            if (empty($empid) && empty($deptId)) {
                $validator->errors()->add('empid', 'Please select either Employee or Department.');
                // $validator->errors()->add('dept_id', 'Please select either Employee or Department.');
            }
        
            if (!empty($empid) && !empty($deptId)) {
                $validator->errors()->add('empid', 'Please select only one: either Employee or Department.');
                // $validator->errors()->add('dept_id', 'Please select only one: either Employee or Department.');
            }
        });
        

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        if(isset($request->reportdate) && !empty($request->reportdate)){
            request()->session()->put('aireportdate', $request->reportdate);
        }else{
            request()->session()->put('aireportdate', "");
        }
    
        if(isset($request->empid) && count($request->empid)>0){
            request()->session()->put('aiempid', $request->empid);
        }else{
            request()->session()->put('aiempid', []);
        }
    
        if(isset($request->dept_id) && !empty($request->dept_id)){
            request()->session()->put('aidept_id', $request->dept_id);
        }else{
            request()->session()->put('aidept_id', "");
        }

        return redirect()->route('employeereport.index');
    
          
        }
}
