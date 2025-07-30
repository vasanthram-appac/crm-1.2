<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use DB;

class Esi extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8') {

            if (request()->ajax()) {

                if (isset($request->empid) && !empty($request->empid)) {
                    request()->session()->put('payslipempid', $request->empid);
                }

                if (isset($request->month) && !empty($request->month)) {
                    request()->session()->put('payslipmonth', $request->month);
                }

                if (empty(request()->session()->get('payslipmonth')) && date('d') < 26) {
                    request()->session()->put('payslipmonth', date("m-Y", strtotime("-1 month")));
                }else{
                     request()->session()->put('payslipmonth', date("m-Y"));
                }

                $data = DB::table('emp_payslip')
                    ->join('regis', 'emp_payslip.empid', '=', 'regis.empid')
                    ->select('emp_payslip.*', 'regis.fname')
                    ->when(request()->session()->has('payslipempid') && !empty(request()->session()->get('payslipempid')) && request()->session()->get('payslipempid') != 'All', function ($query) {
                        $query->where('emp_payslip.empid', request()->session()->get('payslipempid'));
                    })
                    ->when(request()->session()->has('payslipmonth') && !empty(request()->session()->get('payslipmonth')) && request()->session()->get('payslipmonth') != 'All', function ($query) {
                        $query->where('emp_payslip.month_year', request()->session()->get('payslipmonth'));
                    })
                    ->where('employee_contribution','!=','')
                    ->orderBy('id', 'desc')
                    ->get();

                if (count($data) > 0) {
                    $salary = $data->sum('netsalary');
                    $total_netsalary = number_format((float)$salary, 2, '.', ',')  ?? 0;
                    request()->session()->put('esitotalsalary', $total_netsalary);
                } else {
                    request()->session()->put('esitotalsalary', 0);
                }

                foreach ($data as $pdata) {

                    $gname = DB::table('regis')->select('fname', 'lname')->where('empid', $pdata->empid)->first();
                    $pdata->gname = $gname->fname . ' ' . $gname->lname;
                }

                return DataTables::of($data)
                    ->addColumn('sno', function ($row) {
                        return '';
                    })
                    ->addColumn('action', function ($row) {
                        $id = base64_encode($row->id);
                        return '
                    <a class="btn" href="' . route('emppayslip', ['id' => $id]) . '"  target="blank"><i class="fi fi-ts-user-check"></i><span class="tooltiptext">view</span></a>
                    ';
                    })
                    ->rawColumns(['sno', 'action'])
                    ->make(true);
            }

            $regis = DB::table('regis')
                ->where('status', '!=', '0')
                ->where('fname', '!=', 'demo')
                ->pluck('fname', 'empid')->toArray();
            $regis = ['0' => 'Select Employee', 'All' => 'All'] + $regis;

            return view('esi.index', compact('regis'))->render();
        } else {
            return redirect()->to('/workreport');
        }
    }
}