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

class Pettycash extends Controller
{
    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            if (isset($request->creditby) && !empty($request->creditby)) {
                request()->session()->put('cashcreditby', $request->creditby);
            }

            if (isset($request->type) && !empty($request->type)) {
                request()->session()->put('cashtype', $request->type);
            }

            if (isset($request->month) && !empty($request->month)) {
                request()->session()->put('cashmonth', $request->month);
            }

            if (empty(request()->session()->get('cashmonth'))) {
                request()->session()->put('cashmonth', date("m-Y", strtotime("-1 month")));
            }

            $data = DB::table('pettycash')
                ->when(request()->session()->has('cashcreditby') && !empty(request()->session()->get('cashcreditby')) && request()->session()->get('cashcreditby') != 'All', function ($query) {
                    $query->where('creditby', request()->session()->get('cashcreditby'));
                })
                ->when(request()->session()->has('cashtype') && !empty(request()->session()->get('cashtype')) && request()->session()->get('cashtype') != 'All', function ($query) {
                    $query->where('type', request()->session()->get('cashtype'));
                })
                ->when(request()->session()->has('cashmonth') && !empty(request()->session()->get('cashmonth')) && request()->session()->get('cashmonth') != 'All', function ($query) {
                    $cashMonth = request()->session()->get('cashmonth'); // e.g., "08-2025"
                    [$month, $year] = explode('-', $cashMonth);

                    $query->whereMonth('date', $month)->whereYear('date', $year);
                })
                ->orderByDesc('id')->get();

            if (count($data) > 0) {
                $amount = $data->sum('amount');
                $total_netsalary = number_format((float)$amount, 2, '.', ',')  ?? 0;
                request()->session()->put('totalpettycash', $total_netsalary);
            } else {
                request()->session()->put('totalpettycash', 0);
            }

            foreach ($data as $pdata) {

                $gname = DB::table('regis')->select('fname', 'lname')->where('empid', $pdata->empid)->first();

                $pdata->gname = $gname->fname . ' ' . $gname->lname;
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('gname', function ($row) {
                    return '
                            <button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->gname . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Pettycash::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>
                 ';
                })
                ->rawColumns(['sno', 'gname', 'action'])
                ->make(true);
        }

        return view('pettycash/index')->render();
    }

    public function create(Request $request)
    {
        return view('pettycash/create')->render();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paidto'      => 'required',
            'amount'      => 'required',
            'type'        => 'required',
            'date'        => 'required',
            'paymentmode' => 'required',
            'creditby'    => 'required_if:type,Credit',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $domainData = [
            'empid'         => request()->session()->get('empid'),
            'amount'        => $request->amount,
            'paidto'        => $request->paidto,
            'description'   => $request->description,
            'type'          => $request->type,
            'date'          => $request->date,
            'paymentmode'   => $request->paymentmode,
            'creditby'      => ($request->type == "Credit") ? $request->creditby : "",
        ];

        DB::table('pettycash')->insert($domainData);

        session()->flash('secmessage', 'Petty Cash Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Petty Cash Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $pettycash = DB::table('pettycash')->find($id);

        return view('pettycash.edit')->with(compact('pettycash'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'paidto'      => 'required',
            'amount'      => 'required',
            'type'        => 'required',
            'date'        => 'required',
            'paymentmode' => 'required',
            'creditby'    => 'required_if:type,Credit',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'empid'  => request()->session()->get('empid'),
            'amount' => $request->amount,
            'paidto' => $request->paidto,
            'description' => $request->description,
            'type'   => $request->type,
            'date'   => $request->date,
            'paymentmode' => $request->paymentmode,
            'creditby'    => ($request->type == "Credit") ? $request->creditby : "",
        ];

        $updated = DB::table('pettycash')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Petty Cash updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Petty Cash updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $upd = DB::table('pettycash')->where('id', $id)->delete();
        session()->flash('secmessage', 'Petty Cash Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'Petty Cash Deleted Successfully!'], 200);
    }
}
