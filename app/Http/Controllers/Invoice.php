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

class Invoice extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1') {

            if (request()->ajax()) {

                if (isset($request->pstatus) && !empty($request->pstatus)) {
                    request()->session()->put('invoice_status', $request->pstatus);
                }

                $data = DB::table('invoicedetails')
                    ->when(request()->session()->has('invoice_status') && request()->session()->get('invoice_status') != 'all', function ($query) {
                        $status = request()->session()->get('invoice_status');
                        if ($status == 'pending') {
                            $query->whereIn('paymentstatus', ['pending', 'open']);
                        } else {
                            $query->where('paymentstatus', $status);
                        }
                    })
                    ->when(request()->session()->has('invoice_status') && request()->session()->get('invoice_status') !== 'all', function ($query) {
                            $query->where('paymentstatus', '!=', 'closed');
                        })

                    ->orderBy('invoice_no', 'desc')
                    ->get();

                foreach ($data as $pdata) {
                    $emp = DB::table('regis')->where('empid', $pdata->empid)->first();
                    $pdata->fname = $emp->fname;

                    $pdata->grosspay = number_format((float)$pdata->grosspay, 2, '.', ',');

                    $emp = DB::table('accounts')->where('id', $pdata->company_id)->first();

                    $pdata->companyname = !empty($emp) ? $emp->company_name : '';
                }

                // dd($data);
                return DataTables::of($data)
                    ->addColumn('sno', function ($row) {
                        return '';
                    })
                    ->addColumn('companyname', function ($row) {
                        return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->company_id]) . '">' . $row->companyname . '</button>';
                    })
                    ->addColumn('paymentstatus', function ($row) {
                        if ($row->paymentstatus != 'closed') {

                            return '
                            <div>
                                <select class="paymentstatus" style="width:80px;" data-id="' . $row->id . '" data-inid="' . $row->invoice_no . '">
                                    <option value="pending" ' . ($row->paymentstatus === 'pending' ? 'selected' : '') . '>Pending</option>
                                    <option value="paid" ' . ($row->paymentstatus === 'paid' ? 'selected' : '') . '>Paid</option>
                                    <option value="closed" ' . ($row->paymentstatus === 'closed' ? 'selected' : '') . '>Closed</option>
                                    <option value="cancelled" ' . ($row->paymentstatus === 'cancelled' ? 'selected' : '') . '>Cancelled</option>
                                </select>
                                <button class="btn btn-modal invoicestatus" data-id="' . $row->id . '" data-inid="' . $row->invoice_no . '">update</button>
                            </div>
                        ';
                        } else {
                            return e($row->paymentstatus);
                        }
                    })

                    ->addColumn('action', function ($row) {
                        $invoice = base64_encode($row->invoice_no);
                        return '<a class="btn" href="' . route('iprint', ['id' => $invoice]) . '"  target="blank"><i class="fi fi-ts-user-check"></i><span class="tooltiptext">view</span></a>';
                    })
                    ->rawColumns(['sno', 'action', 'companyname', 'paymentstatus'])
                    ->make(true);
            }

            $accounts = DB::table('accounts')->where('status', '!=', '0')->orderBy('company_name', 'ASC')->pluck('company_name', 'id')->toArray();
            $accounts = ['0' => 'Select Client'] + $accounts;

            return view('invoice/index', compact('accounts'))->render();
        } else {
            return redirect()->to('/workreport');
        }
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')->where('id', request()->session()->get('invoid'))->first();
        // dd($accounts);
        $gst = DB::table('global')->first();

        $todayDate = date('Y-m-d');

        $date = date_create($todayDate);
        if (date_format($date, "m") >= 4) {
            $financialYear = date_format($date, "Y") . '-' . (date_format($date, "y") + 1);
        } else {
            $financialYear = (date_format($date, "Y") - 1) . '-' . date_format($date, "y");
        }

        $latestInvoice = DB::table('invoicedetails')->orderByDesc('id')->first();
        // dd($latestInvoice);
        $inv = $latestInvoice ? substr($latestInvoice->invoice_no, -4) : '';

        $extracted = substr($latestInvoice->invoice_no, 3, 7);

        $common = 'AMT';

        if ($inv == '' ||  (date('d-m') >= "01-04" ||  ($inv != "0001" && $extracted != $financialYear))) {
            $inv1 = '0001';
        } else {
            $inv1 = str_pad($inv + 1, 4, '0', STR_PAD_LEFT);
        }

        $c_id = $common . $financialYear . '/' . $inv1;

        $in_number = $c_id;
        // dd($in_number);
        return view('invoice/create', compact('accounts', 'in_number', 'gst'))->render();
    }

    public function store(Request $request)
    {
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|exists:accounts,id',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',

            'invoice_date' => 'required|date_format:d-m-Y',
            'invoice_no' => 'required|string|max:255',
            'item_no_one' => 'required|string|max:50',
            'description_one' => 'required|string|max:255',
            'quantity_one' => 'required|numeric|min:1',
            'unit_one' => 'required|numeric|min:0',
            'totalamount_one' => 'required|numeric|min:0',
            'item_no_two' => 'nullable|string|max:50',
            'description_two' => 'nullable|string|max:255',
            'quantity_two' => 'nullable|numeric|min:0',
            'unit_two' => 'nullable|numeric|min:0',
            'totalamount_two' => 'nullable|numeric|min:0',
            'item_no_three' => 'nullable|string|max:50',
            'description_three' => 'nullable|string|max:255',
            'quantity_three' => 'nullable|numeric|min:0',
            'unit_three' => 'nullable|numeric|min:0',
            'totalamount_three' => 'nullable|numeric|min:0',
            'item_no_four' => 'nullable|string|max:50',
            'description_four' => 'nullable|string|max:255',
            'quantity_four' => 'nullable|numeric|min:0',
            'unit_four' => 'nullable|numeric|min:0',
            'totalamount_four' => 'nullable|numeric|min:0',
            'item_no_five' => 'nullable|string|max:50',
            'description_five' => 'nullable|string|max:255',
            'quantity_five' => 'nullable|numeric|min:0',
            'unit_five' => 'nullable|numeric|min:0',
            'totalamount_five' => 'nullable|numeric|min:0',
            // 'amount' => 'required|numeric|min:0',
            'gsttype' => 'required|in:ex,in',
            'specialdiscount' => 'nullable|numeric|min:0',
            'netpay' => 'required|numeric|min:0',
            'principle' => 'nullable|string|max:255',
            'cgst1' => 'nullable|numeric|min:0',
            'sgst1' => 'nullable|numeric|min:0',
            'grosspay1' => 'nullable|numeric|min:0',
            'cgst' => 'required|numeric|min:0',
            'sgst' => 'required|numeric|min:0',
            'igst' => 'required|numeric|min:0',
            'taxvalue' => 'required|in:cgst,sgst,igst',
            'grosspay' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the domain already exists
        $existingproforma = DB::table('invoice')
            ->where('invoice_no', $request->invoice_no)
            ->exists();

        if ($existingproforma) {
            session()->flash('secmessage', 'Invoice Number Already in our Database.');
            return response()->json(['status' => 1, 'message' => 'Invoice Number Already in our Database.'], 200);
        }
        // dd($request->all());
        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');

        if (!empty($request->quantity_one)) {
            DB::table('invoice')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_one,
                'description' => $request->description_one,
                'quantity' => $request->quantity_one,
                'unit' => $request->unit_one,
                'totalamount' => $request->totalamount_one,
            ]);
        }

        // Item 2
        if (!empty($request->quantity_two)) {
            DB::table('invoice')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_two,
                'description' => $request->description_two,
                'quantity' => $request->quantity_two,
                'unit' => $request->unit_two,
                'totalamount' => $request->totalamount_two,
            ]);
        }

        // Item 3
        if (!empty($request->quantity_three)) {
            DB::table('invoice')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_three,
                'description' => $request->description_three,
                'quantity' => $request->quantity_three,
                'unit' => $request->unit_three,
                'totalamount' => $request->totalamount_three,
            ]);
        }

        // Item 4
        if (!empty($request->quantity_four)) {
            DB::table('invoice')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_four,
                'description' => $request->description_four,
                'quantity' => $request->quantity_four,
                'unit' => $request->unit_four,
                'totalamount' => $request->totalamount_four,
            ]);
        }

        // Item 5
        if (!empty($request->quantity_five)) {
            DB::table('invoice')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_five,
                'description' => $request->description_five,
                'quantity' => $request->quantity_five,
                'unit' => $request->unit_five,
                'totalamount' => $request->totalamount_five,
            ]);
        }

        if ($request->gsttype == 'in') {
            $taxvalue = $request->taxvalue1;
            $cgst = $request->cgst1;
            $sgst = $request->sgst1;
            $igst = $cgst + $sgst;
            $grosspay = $request->grosspay1;
            $amount = $request->netpay;
        } else {
            $taxvalue = $request->taxvalue;
            $igst = $request->igst;
            $cgst = $request->cgst;
            $sgst = $request->sgst;
            $grosspay = $request->grosspay;
            $amount = $request->netpay;
        }

        // Insert data into the database
        $val = [
            'company_id' => $request->company_id,
            'empid' => $empid,
            'invoice_date' => $request->invoice_date,
            'invoice_date1' => date("Y-m-d", strtotime($request->invoice_date)),
            'invoice_no' => $request->invoice_no,
            'taxvalue' => $taxvalue,
            'cgst' => $cgst, // original expiry date format
            'sgst' => $sgst,
            'igst' => $igst,
            'gsttype' => $request->gsttype,
            'principle' => ($request->principle) ? $request->principle : '',
            'amount' => $amount,
            'specialdiscount' => 0,
            'netpay' => ($request->netpay) ? $request->netpay : 0,
            'grosspay' => $grosspay,
            'paymentstatus' => "open",
        ];

        DB::table('invoicedetails')->insert($val);

        session()->flash('secmessage', 'invoice Invoice Generated Successfully');
        return response()->json(['status' => 1, 'message' => 'invoice Invoice Generated Successfully'], 200);
    }

    // public function destroy($id)
    // {

    //     $upd = DB::table('proforma')->where('id', $id)->delete();
    //     session()->flash('secmessage', 'Proforma Deleted Successfully!');

    //     return response()->json(['status' => 1, 'message' => 'Proforma Deleted Successfully!'], 200);
    // }


    public function invoicestatus(Request $request)
    {
        // dd($request->all());

        $update = DB::table('invoicedetails')->where('invoice_no', $request->inid)->update(['paymentstatus' => $request->status]);
        session()->flash('secmessage', 'Status Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully'], 200);
    }

    public function accountsid(Request $request)
    {
        // dd($request->all());
        request()->session()->put('invoid', $request->accountsid);
        // return $this->create($request);
    }

    public function print($id)
    {
        $id = base64_decode($id);

        $invoice = DB::table('invoicedetails')->where('invoice_no', $id)->first();
        $global = DB::table('global')->first();
        $accounts = DB::table('accounts')->where('id', $invoice->company_id)->first();
        $iinfo = DB::table('invoice')->where('invoice_no', $id)->get();

        return view('pdf.iprint')->with(compact('invoice', 'global', 'accounts', 'iinfo'));
    }
}
