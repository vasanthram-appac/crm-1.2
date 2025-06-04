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


class Monthlyreport extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        $gdata = '';
        if (request()->ajax()) {

            $mdata = request()->session()->get('client');
         
            $emp = isset($mdata['emp']) 
            ? (is_array($mdata['emp']) ? $mdata['emp'] : [$mdata['emp']]) 
            : [];

            $client = (isset($mdata['client']) && !empty($mdata['client']))? $mdata['client'] : null;
            $emp = isset($mdata['emp']) ? (is_array($mdata['emp']) ? $mdata['emp'] : [$mdata['emp']]) : [];
            $daterange = (isset($mdata['daterange']) && !empty($mdata['daterange']))? $mdata['daterange'] : null;
            
            if ($daterange) {
                $daterange = explode(' - ', $daterange);
                $start_date = date('Y-m-d', strtotime($daterange[0]));
                $end_date = date('Y-m-d', strtotime($daterange[1]));
            }else{
                $start_date = date('Y-m-01');
                $end_date = date('Y-m-d');
            }
            
            $data = DB::table('dailyreport')
                ->join('accounts', 'dailyreport.client', '=', 'accounts.id')
                ->join('regis', 'dailyreport.empid', '=', 'regis.empid')
                ->select(
                    'dailyreport.*',
                    'accounts.company_name as company_name_account',
                    DB::raw("CONCAT(regis.fname, ' ', regis.lname) as emp_fullname"),
                    DB::raw("CONCAT(dailyreport.w_hours, ' Hours ', dailyreport.w_mins, ' Minutes') as total_time")
                )
                ->when(!empty($client) && $client != 'all', function ($query) use ($client) {
                    return $query->where(function ($q) use ($client) {
                        $q->where('dailyreport.client', $client)
                          ->orWhere('dailyreport.wipid', $client);
                    });
                })
                ->when(!empty($emp) && !in_array('all', $emp), function ($query) use ($emp) {
                    return $query->whereIn('dailyreport.empid', $emp);
                })
                ->when($daterange, function ($query) use ($start_date, $end_date) {
                    return $query->whereBetween('report_date1', [$start_date, $end_date])
                                 ->orderBy('report_date1', 'asc');
                }, function ($query) {
                    return $query->whereYear('report_date1', date('Y'))
                    ->whereMonth('report_date1', date('m'))
                    ->orderBy('report_date1', 'desc');
                })
                ->orderBy('dailyreport.id', 'asc')
                ->get();

            $graph_data1 = $data;

            if ($data) {
               
                $totalHours = 0; 
                $hoursList = []; 

                foreach ($data as $item) {
                    $wHours = (int)$item->dept_id;
                    $hoursList[] = $wHours; 
                    $totalHours += $wHours; 
                }

                $totals = [
                    'Management' => ['hours' => 0, 'minutes' => 0],
                    'Design' => ['hours' => 0, 'minutes' => 0],
                    'Development' => ['hours' => 0, 'minutes' => 0],
                    'Promotion' => ['hours' => 0, 'minutes' => 0],
                    'ContentWriter' => ['hours' => 0, 'minutes' => 0],
                    'Marketing' => ['hours' => 0, 'minutes' => 0],
                    'Client' => ['hours' => 0, 'minutes' => 0],
                    'All' => ['hours' => 0, 'minutes' => 0], // To hold total across all departments
                ];

                foreach ($data as $item) {
                    $totalMinutes = (int)$item->w_mins;
                    $totalHours = (int)$item->w_hours;

                    // Update department-specific totals
                    if ($item->dept_id == '1') {
                        $totals['Management']['hours'] += $totalHours;
                        $totals['Management']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '2') {
                        $totals['Design']['hours'] += $totalHours;
                        $totals['Design']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '3') {
                        $totals['Development']['hours'] += $totalHours;
                        $totals['Development']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '4') {
                        $totals['Promotion']['hours'] += $totalHours;
                        $totals['Promotion']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '5') {
                        $totals['ContentWriter']['hours'] += $totalHours;
                        $totals['ContentWriter']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '6') {

                        $totals['Marketing']['hours'] += $totalHours;
                        $totals['Marketing']['minutes'] += $totalMinutes;
                    }
                    if ($item->dept_id == '7') {

                        $totals['Client']['hours'] += $totalHours;
                        $totals['Client']['minutes'] += $totalMinutes;
                    }

                    $totals['All']['hours'] += $totalHours;
                    $totals['All']['minutes'] += $totalMinutes;
                }

                foreach ($totals as $key => $values) {
                    $extraHours = intdiv($values['minutes'], 60);
                    $totals[$key]['hours'] += $extraHours;
                    $totals[$key]['minutes'] = $values['minutes'] % 60;
                }

                session()->put('gdata', json_encode($totals));

                // dd(session('gdata'));

            };

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->rawColumns(['sno'])
                ->make(true);
        }

        $clients = DB::table('accounts')->where('status', '1')->where('active_status', 'active')->orderBy('company_name', 'asc')->pluck('company_name', 'id');
        $clients = ['all' => 'All'] + $clients->toArray();
        $prom_clients = DB::table('accounts')->where('status', '1')->where('active_status', 'active')->where('promotion', '1')->orderBy('company_name', 'asc')->pluck('company_name', 'id');

        $mdata = request()->session()->get('client');

        $clientn = DB::table('accounts')
            ->where('status', '1')
            ->where('active_status', 'active')
            ->when(!empty($mdata) && $mdata != 'all', function ($query) use ($mdata) {
                return $query->where('id', $mdata['client']);
            })
            ->get(['company_name']);

        // dd($clientn);

        if (!empty($mdata) && count($clientn) > 0) {
            $clientname = "of {$clientn[0]->company_name}";
        } else {
            $clientname = "of ALL Clients";
        }

        if (!empty($mdata['daterange'])) {

            $dates = explode(' - ', $mdata['daterange']);
            $daterange = "From {$dates[0]} to {$dates[1]}";
        } else {
            $daterange = now()->format('d M Y');
        }

        $employe = request()->session()->get('emp');

        $empl = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->get(['fname', 'lname', 'id', 'empid', 'dept_id']);

        $empl = $empl->mapWithKeys(function ($item) {
            $fullName = $item->fname . ' ' . $item->lname;
            return [$item->empid => $item->empid . ' - ' . $fullName];
        });

        // Convert the collection to an array and prepend the "All" option
        $empl = ['all' => 'All'] + $empl->toArray();

        $user = DB::table('regis')->where('fname', '!=', 'demo')->where('status', '!=', '0')->get();

        $department_master = DB::table('department_master')->pluck('department_name', 'id');

        return view('monthlyreport/index', compact('user', 'department_master', 'clients', 'prom_clients', 'empl', 'gdata', 'clientname', 'employe', 'daterange'))->render();
    }

    public function store(Request $request)
    {

        // if($request->type=='client'){
        $validator = Validator::make($request->all(), [
            'client' => 'required|string',  // Optional array if chosen
            'daterange' => 'required',
            'emp' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        request()->session()->put('client', $request->all());
        // request()->session()->put('promotion','');
        // }
        // else{
        //     $validator = Validator::make($request->all(), [
        //         'pclient' => 'required|string',  // Optional array if chosen
        //         'pdaterange' => 'required',
        //         'pemp'=> 'required' // Optional string if chosen
        //     ]);
        //     if ($validator->fails()) {
        //         return response()->json(['errors' => $validator->errors()], 422);
        //     }
        //     request()->session()->put('promotion',$request->all());
        //     request()->session()->put('client','');
        // }

        // Return data as JSON or pass it to a view
        return redirect()->route('monthlyreport.index');

    }
}
