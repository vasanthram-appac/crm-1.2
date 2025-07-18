<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

use Validator;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use DB;

class Payslip extends Controller
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

                if (empty(request()->session()->get('payslipmonth'))) {
                    request()->session()->put('payslipmonth', date("m-Y", strtotime("-1 month")));
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
                    ->orderBy('id', 'desc')
                    ->get();

                if (count($data) > 0) {
                    $salary = $data->sum('netsalary');
                    $total_netsalary = number_format((float)$salary, 2, '.', ',')  ?? 0;
                    request()->session()->put('totalsalary', $total_netsalary);
                } else {
                    request()->session()->put('totalsalary', 0);
                }

                foreach ($data as $pdata) {

                    $gname = DB::table('regis')->select('fname', 'lname')->where('empid', $pdata->empid)->first();

                    $pdata->gname = $gname->fname . ' ' . $gname->lname;
                }

                return DataTables::of($data)
                    ->addColumn('sno', function ($row) {
                        return '';
                    })
                    // ->addColumn('action', function ($row) {
                    //     return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Payslip::class, 'edit'], [$row->id]) . '">
                    //     <i class="fi fi-ts-file-edit"></i></button>
                    //     <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i></button>
                    //     <a href="' . $row->payslip_path . '" target="_blank" style="text-decoration:none;"><i class="fi fi-ts-user-check"></i></a>';
                    // })
                    ->addColumn('action', function ($row) {
                        $id = base64_encode($row->id);
                        return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Payslip::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i> 
					  <span class="tooltiptext ">edit</span>
					</button>
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

            return view('payslip.index', compact('regis'))->render();
        } else {
            return redirect()->to('/workreport');
        }
    }

    public function create(Request $request)
    {

        $emp = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->select('empid', 'fname', 'lname')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->empid => $item->fname . ' ' . $item->lname];
            })
            ->toArray();

        $emp = ['0' => 'Select Employee'] + $emp;


        return view('payslip/create', compact('emp'))->render();
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'empid' => 'required|exists:personalprofile,empid',
            'monthyear' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $empid = $request->empid;

        $generatedate = date('Y-m-d H:i:s');
        $generateby = request()->session()->get('empid');

        $check = DB::table('emp_payslip')->where('empid', $request->empid)->where('month_year', $request->monthyear)->count();

        if ($check > 0) {
            session()->flash('secmessage', 'Payslip Already Generated.');
            return response()->json(['status' => 1, 'message' => 'Payslip Already Generated.'], 200);
        } else {

            $eid = DB::table('emp_salary')->select('salary')->where('empid', $request->empid)->first();

            if (empty($eid)) {
                session()->flash('secmessage', 'Please add salary details.');
                return response()->json(['status' => 1, 'message' => 'Please add salary details'], 200);
            } else {

                $salary = $eid->salary;
                $other = $request->other;
                $incentive1 = $request->incentive;
                $lop = $request->lop;
                $basic = $salary * (40 / 100);
                $hra = $salary * (30 / 100);
                $conveyance = $salary * (8 / 100);
                $special = $salary * (22 / 100);
                $pt = $request->pt;
                if ($empid == 'AM003') {
                    $tds = '4000';
                } else if ($empid == 'AM063') {
                    $tds = '4750';
                } else {
                    if ($request->tds == '1') {
                        $tds = $salary * (10 / 100);
                    } else {
                        $tds = '0';
                    }
                }

                $mm = "01-" . $request->monthyear;
                $new_date = date('Y-m-d', strtotime($mm));

                $days = (date('t', strtotime($new_date)));
                $tot_lop = $days - $request->totalleave;
                $total = $basic + $hra + $conveyance + $special + $incentive1;
                $totaldect = $pt + $tds + $other + $lop + $request->esi + $request->pf;
                $netsalary = $total - $totaldect;

                $pdata = [
                    'empid' => $empid,
                    'month_year' => $request->monthyear,
                    'specl_amt' => $request->incentive,
                    'lop' => $request->lop,
                    'totalleave' => $request->totalleave,
                    'other' => $request->other,
                    'generate_date' => $generatedate,
                    'generated_by' => $generateby,
                    'pf' => $request->pf,
                    'pt' => $request->pt,
                    'tds' => $tds,
                    'esi' => $request->esi,
                    'summary' => $request->summary,
                    'salary' => $salary + $request->incentive,
                    'netsalary' => $netsalary,
                    'basic_salary' => $basic,
                    'conveyance_allowance' => $conveyance,
                    'hra' => $hra,
                    'special_allowance' => $special,
                    'status' => 1,
                ];

                $last_id = DB::table('emp_payslip')->insertGetID($pdata);

                session()->flash('secmessage', 'Payslip Added Successfully.');
                return response()->json(['status' => 1, 'message' => 'Payslip Added Successfully.'], 200);
            }
        }
    }

    public function edit($id)
    {
        $emp = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->select('empid', 'fname', 'lname')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->empid => $item->fname . ' ' . $item->lname];
            })
            ->toArray();

        $emp = ['0' => 'Select Employee'] + $emp;


        $payslip = DB::table('emp_payslip')->where('id', $id)->first();

        return view('payslip/edit', compact('emp', 'payslip'))->render();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'empid' => 'required|exists:personalprofile,empid',
            'monthyear' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $generateby = request()->session()->get('empid');

        $eid = DB::table('emp_salary')->select('salary')->where('empid', $request->empid)->first();

        if (empty($eid)) {
            session()->flash('secmessage', 'Please add salary details.');
            return response()->json(['status' => 1, 'message' => 'Please add salary details'], 200);
        } else {

            $empid = $request->empid;
            $salary = $eid->salary;
            $other = $request->other;
            $incentive1 = $request->incentive;
            $lop = $request->lop;
            $basic = $salary * (40 / 100);
            $hra = $salary * (30 / 100);
            $conveyance = $salary * (8 / 100);
            $special = $salary * (22 / 100);
            $pt = $request->pt;
            if ($empid == 'AM003') {
                $tds = '4000';
            } else if ($empid == 'AM063') {
                $tds = '4750';
            } else {
                if ($request->tds == '1') {
                    $tds = $salary * (10 / 100);
                } else {
                    $tds = '0';
                }
            }

            $mm = "01-" . $request->monthyear;
            $new_date = date('Y-m-d', strtotime($mm));

            $days = (date('t', strtotime($new_date)));
            $tot_lop = $days - $request->totalleave;
            $total = $basic + $hra + $conveyance + $special + $incentive1;
            $totaldect = $pt + $tds + $other + $lop + $request->esi + $request->pf;
            $netsalary = $total - $totaldect;

            $pdata = [
                'specl_amt' => $request->incentive,
                'lop' => $request->lop,
                'totalleave' => $request->totalleave,
                'other' => $request->other,
                'generated_by' => $generateby,
                'pf' => $request->pf ?? 0,
                'pt' => $request->pt,
                'tds' => $tds,
                'esi' => $request->esi ?? 0,
                'salary' => $salary + $request->incentive,
                'netsalary' => $netsalary,
                'basic_salary' => $basic,
                'conveyance_allowance' => $conveyance,
                'hra' => $hra,
                'special_allowance' => $special,
                'summary' => $request->summary,
            ];

            $last_id = DB::table('emp_payslip')->where('id', $id)->update($pdata);

            session()->flash('secmessage', 'Payslip Updated Successfully.');
            return response()->json(['status' => 1, 'message' => 'Payslip Updated Successfully.'], 200);
        }
    }

    public function destroy($id)
    {

        $upd = DB::table('emp_payslip')->where('id', $id)->delete();
        session()->flash('secmessage', 'Payslip Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Payslip Deleted Successfully!'], 200);
    }

    public function print($id)
    {
        $id = base64_decode($id);

        $payslip = DB::table('emp_payslip')->where('id', $id)->first();

        $empid = $payslip->empid;

        $my = explode('-', $payslip->month_year);
        $mm = $my[0];
        $yy = $my[1];

        $monthYear = $payslip->month_year; // Example: "2024-11"
        $month = (int) date('m', strtotime($monthYear . "-01")); // Extract the month as an integer
        $monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
        $monthName1 = $yy;

        $edata = DB::table('personalprofile as p')
            ->leftJoin('documentsupload as d', 'd.empid', '=', 'p.empid')
            ->leftJoin('bankinfo as b', 'b.empid', '=', 'p.empid')
            ->select(
                'b.id as bank_id',
                'b.acholder',
                'b.bankname',
                'b.branch',
                'b.acno',
                'b.ifsccode',
                'b.actype',
                'b.panno',
                'd.photo',
                'd.identityproof',
                'd.addressproof',
                'd.resume',
                'p.*'
            )
            ->where('p.empid', $payslip->empid)
            ->first();

        $fname = $edata->fname;
        $lname = $edata->lname;
        $doj = $edata->doj;
        $personalemailid = $edata->personalemailid;
        $empid1 = $edata->empid;
        $designation = $edata->designation;
        $department = $edata->department;
        $bankname = $edata->bankname;
        $acno = $edata->acno;
        $panno = $edata->panno;

        $check = DB::table('emp_payslip')
            ->where('month_year', $payslip->month_year)
            ->where('empid', $payslip->empid)
            ->first();
        // dd($check,$request->monthyear);
        $salary = $check->salary - $check->specl_amt;
        $other = $check->other;
        $incentive1 = $check->specl_amt;
        $lop = $check->lop;
        $basic = $check->basic_salary;
        $hra = $check->hra;
        $conveyance = $check->conveyance_allowance;
        $special = $check->special_allowance;
        $pt = $check->pt;
        $tds = $check->tds;

        $mm = "01-" . $payslip->month_year;
        $new_date = date('Y-m-d', strtotime($mm));

        $days = (date('t', strtotime($new_date)));
        $tot_lop = $days - $payslip->totalleave;
        $total = $basic + $hra + $conveyance + $special + $incentive1;
        $totaldect = $pt + $tds + $other + $lop + $check->esi + $check->pf;
        $netsalary = $total - $totaldect;

        $pf = $check->pf;
        $esi = $check->esi;
        $specl_amt = $check->specl_amt;



        return view('pdf.payslip')->with(compact('monthName', 'monthName1', 'fname', 'lname', 'empid', 'doj', 'bankname', 'department', 'acno', 'designation', 'panno', 'days', 'tot_lop', 'basic', 'pf', 'esi', 'conveyance', 'pt', 'hra', 'tds', 'special', 'other', 'specl_amt', 'lop', 'total', 'totaldect', 'netsalary'));
    }

    public function sendpayslip(Request $request)
    {
        // dd($request->all());
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'empid' => 'required|exists:personalprofile,empid',
            'monthyear' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $generatedate = date('Y-m-d H:i:s');
        $generateby = request()->session()->get('empid');

        $check = DB::table('emp_payslip')->where('empid', $request->empid)->where('month_year', $request->monthyear)->count();

        if ($check > 0) {
            session()->flash('secmessage', 'Payslip Already Generated.');
            return response()->json(['status' => 1, 'message' => 'Payslip Already Generated.'], 200);
        } else {

            $pdata = [
                'empid' => $request->empid,
                'month_year' => $request->monthyear,
                'specl_amt' => $request->incentive,
                'lop' => $request->lop,
                'totalleave' => $request->totalleave,
                'other' => $request->other,
                'generate_date' => $generatedate,
                'generated_by' => $generateby,
                'status' => 1,

            ];

            $last_id = DB::table('emp_payslip')->insertGetID($pdata);

            if ($last_id) {

                $my = explode('-', $request->monthyear);
                $mm = $my[0];
                $yy = $my[1];

                $monthYear = $request->monthyear; // Example: "2024-11"
                $month = (int) date('m', strtotime($monthYear . "-01")); // Extract the month as an integer
                $monthName = date('F', mktime(0, 0, 0, $month, 10)); // March
                $monthName1 = $yy;

                $edata = DB::table('personalprofile as p')
                    ->leftJoin('documentsupload as d', 'd.empid', '=', 'p.empid')
                    ->leftJoin('bankinfo as b', 'b.empid', '=', 'p.empid')
                    ->select(
                        'b.id as bank_id',
                        'b.acholder',
                        'b.bankname',
                        'b.branch',
                        'b.acno',
                        'b.ifsccode',
                        'b.actype',
                        'b.panno',
                        'd.photo',
                        'd.identityproof',
                        'd.addressproof',
                        'd.resume',
                        'p.*'
                    )
                    ->where('p.empid', $request->empid)
                    ->first();

                $fname = $edata->fname;
                $lname = $edata->lname;
                $doj = $edata->doj;
                $personalemailid = $edata->personalemailid;
                $empid1 = $edata->empid;
                $designation = $edata->designation;
                $department = $edata->department;
                $bankname = $edata->bankname;
                $acno = $edata->acno;
                $panno = $edata->panno;

                $check = DB::table('emp_payslip as ep')
                    ->join('emp_salary as es', 'ep.empid', '=', 'es.empid')
                    ->select(
                        'ep.empid as payid',
                        'ep.month_year',
                        'ep.specl_amt',
                        'ep.other',
                        'ep.lop',
                        'ep.status',
                        'es.empid',
                        'es.salary',
                        'es.pf',
                        'es.esi',
                        'es.pt',
                        'es.tds'
                    )
                    ->where('ep.month_year', $request->monthyear)
                    ->where('ep.empid', $request->empid)
                    ->first();
                // dd($check,$request->monthyear);
                $salary = $check->salary;
                $other = $check->other;
                $incentive1 = $check->specl_amt;
                $lop = $check->lop;
                $basic = $salary * (40 / 100);
                $hra = $salary * (30 / 100);
                $conveyance = $salary * (8 / 100);
                $special = $salary * (22 / 100);
                $pt = $check->pt;
                if ($empid1 == 'AM003') {
                    $tds = '4000';
                } else if ($empid1 == 'AM063') {
                    $tds = '4750';
                } else {
                    if ($check->tds == '1') {
                        $tds = $salary * (10 / 100);
                    } else {
                        $tds = '0';
                    }
                }

                $mm = "01-" . $request->monthyear;
                $new_date = date('Y-m-d', strtotime($mm));

                $days = (date('t', strtotime($new_date)));
                $tot_lop = $days - $request->totalleave;
                $total = $basic + $hra + $conveyance + $special + $incentive1;
                $totaldect = $pt + $tds + $other + $lop;
                $netsalary = $total - $totaldect;

                $html = '<table border="1" width="100%" cellspacing="0" cellpadding="0" style="border-collapse: collapse;font-family: Noto Sans TC, sans-serif;"><tbody>
        
<tr style="border-right: 1px solid #000;">
<td colspan="4" align="left" style="border-right: 0px solid #fff;"> <img src="img/head-logo.png" style="width:175px;float: left;padding-top: 50px;">
<h3 style="    text-align: center;">APPAC MEDIATECH PRIVATE LIMITED</h3><p style="font-family: Noto Sans TC, sans-serif;font-size:13px;text-align: center;">No : 204, 2nd Floor, Aathisree towers, D.B Road,<br> R.S.Puram, Coimbatore, Tamil
Nadu,India - 641002.<br><span style="font-style:normal;font-size:13px;">Ph: + 91 422-4354854 | +91 636 928 6774</span>
<br>
<span style="font-style:normal;font-size:13px;">Mail: info@appacmedia.com | www.appacmedia.com</span>
<br>
<span style="font-style:normal;font-size:13px;">PAN : AAQCA4617E / TAN : CMBA09095C</span>
</p>
</td>
</tr>

<tr style="background-color: #18a7c7;"><td colspan="4" align="center"><b>Payslip for the month of ' . $monthName . '-' . $monthName1 . '</b></td></tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Employee Name</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $fname . ' ' . $lname . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Emp Id</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $request->empid . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Date of Joining</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $doj . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Bank Name</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $bankname . '</td></tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Department</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $department . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Account Number</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $acno . '</td>
</tr>

<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Designation</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $designation . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">PAN No</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $panno . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Total Working Days</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $days . '</td> 
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">PF No</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Worked Days </td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $tot_lop . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">ESI No</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
</tr>

<tr>
<td colspan="4" align="center" style="height:20px"> </td>
</tr>
<tr>
<td colspan="2" align="center" style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Earnings</b></td>
<td colspan="2" align="center" style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Deductions</b></td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Particulars</b></td>
<td style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Amount</b></td>
<td style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Particulars</b></td>
<td style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Amount</b></td>
</tr>

<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Basic Salary</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $basic . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">PF</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $check->pf . '</td>
</tr>

<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Conveyance allowance</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $conveyance . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Professional Tax</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $pt . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">HRA</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $hra . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">TDS</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $tds . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Special allowance</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $special . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Others</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $other . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Performance Incentive</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $check->specl_amt . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">LOP</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $lop . '</td>
</tr>
<tr>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Total Rs.</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $total . '</td>
<td style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">Total Rs.</td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 12px;font-weight:400;color: #000;">' . $totaldect . '</td>
</tr>
<tr>
<td colspan="4" style="height:20px"> </td>
</tr>
<tr>
<td colspan="2" ></td>
<td style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Net Salary Rs.</b></td>
<td align="right" style="padding: 3px 5px 3px 8px; font-size: 14px;font-weight:500;color: #000;">' . $netsalary . '</td>
</tr>
<tr>
<td colspan="4" style="height:40px"> </td>
</tr>
<tr>
<td colspan="4" align="center" style="border-top: 1px solid #fff;font-size:12px;height:20px"><p>This is a computer generated payslip and does not require a signature</p></td>
</td>
</tr>
</tbody>
</table>';
                //echo $html;

                $pdf = Pdf::loadHTML($html)->setPaper('A4', 'portrait');
                // dd($pdf);
                // Add watermark
                $canvas = $pdf->getDomPDF()->getCanvas();

                $w = $canvas->get_width();
                $h = $canvas->get_height();


                $imagePath = public_path('asset/image/appac-logo.png');

                $imgWidth = 200;
                $imgHeight = 104;
                $canvas->set_opacity(0.2);


                $x = ($w - $imgWidth) / 2;
                $y = ($h - $imgHeight) / 3;

                // Add the image to the canvas
                $canvas->image($imagePath, $x, $y, $imgWidth, $imgHeight, 'normal');

                // Save PDF
                $payslipname = "{$request->empid}-payslip-for-{$request->monthyear}.pdf";
                $directory = public_path('pdf/payslip');
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }
                $path = "{$directory}/{$payslipname}";

                file_put_contents($path, $pdf->output());

                $pathn = "pdf/payslip/" . $payslipname;
                // Update database
                DB::table('emp_payslip')->where('id', $last_id)->update(['payslip_path' => $pathn]);

                // Send email
                $bccEmail = env('SUPPORTMAIL');
                $infoMail = env('INFOMAIL');
                $subject = 'Payslip for the month of ' . $monthName . '-' . $monthName1;
                $html1 = 'Dear ' . $fname . ' ' . $lname . ',<br><br>Your payslip has been generated for ' . $request->monthyear . '.<br>Please find the attachment.<br><br>';

                Mail::send([], [], function ($message) use ($bccEmail, $infoMail, $subject, $html1, $payslipname, $personalemailid) {
                    $message->to($personalemailid)
                        ->bcc($bccEmail)
                        ->replyTo(env('TECHADMINMAIL'))
                        ->from($infoMail, env('APP_NAME'))
                        ->subject($subject)
                        ->html($html1)
                        ->attach(public_path('pdf/payslip/' . $payslipname), ['as' => $payslipname]);
                });



                session()->flash('secmessage', 'Payslip Generated Successfully.');
                return response()->json(['status' => 1, 'message' => 'Payslip Generated Successfully.'], 200);
            }
        }
    }
}
