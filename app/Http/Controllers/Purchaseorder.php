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

class Purchaseorder extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM098' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8') {

            if (request()->ajax()) {

                if (isset($request->companyname) && !empty($request->companyname)) {
                    request()->session()->put('pocompanyname', $request->companyname);
                }

                if (isset($request->companyname) && !empty($request->companyname) && $request->companyname == "All") {
                    request()->session()->put('pocompanyname', "");
                }

                if (isset($request->daterange) && !empty($request->daterange)) {
                    $daterange = explode(' - ', $request->daterange);
                    $start_date = date('Y-m-d', strtotime($daterange[0]));
                    $end_date = date('Y-m-d', strtotime($daterange[1]));
                    request()->session()->put('postart_date', $start_date);
                    request()->session()->put('poend_date', $end_date);
                }

                if (request()->session()->get('purchaseorder_status') == "") {
                    request()->session()->put('purchaseorder_status', 'open');
                }

                if (isset($request->pstatus) && !empty($request->pstatus)) {
                    request()->session()->put('purchaseorder_status', $request->pstatus);
                }

                $data = DB::table('purchaseorderdetails')
                    ->when(request()->session()->get('purchaseorder_status') != 'all', function ($query) {
                        if(request()->session()->get('purchaseorder_status') == 'withoutcancelled'){
                             $query->where('paymentstatus', '!=', 'cancelled');
                        }else{
                            $query->where('paymentstatus', request()->session()->get('purchaseorder_status'));
                        }
                    })
                    ->when(request()->session()->has('pocompanyname') && !empty(request()->session()->get('pocompanyname')) && request()->session()->get('pocompanyname') != 'All', function ($query) {
                        $query->where('company_id', request()->session()->get('pocompanyname'));
                    })
                    ->when(
                        request()->session()->has('postart_date') && !empty(request()->session()->get('postart_date')) &&
                            request()->session()->has('poend_date') && !empty(request()->session()->get('poend_date')),
                        function ($query) {
                            $start = date('Y-m-d', strtotime(request()->session()->get('postart_date')));
                            $end = date('Y-m-d', strtotime(request()->session()->get('poend_date')));

                            // Assuming invoice_date is stored in 'd-m-Y' string format in DB
                            $query->whereRaw("STR_TO_DATE(order_date, '%d-%m-%Y') BETWEEN ? AND ?", [$start, $end]);
                        }
                    )
                    // ->whereNotNull('company_id')
                    ->orderBy('order_no', 'desc')
                    ->get();

                if (count($data) > 0) {
                    $total = $data->sum(function ($item) {
                        return (float) str_replace(',', '', $item->grosspay);
                    });
                    $totalinpayment = number_format((float)$total, 2, '.', ',')  ?? 0;
                    request()->session()->put('totaloppayment', $totalinpayment);
                } else {
                    request()->session()->put('totaloppayment', 0);
                }

                foreach ($data as $pdata) {
                    $emp = DB::table('regis')->where('empid', $pdata->empid)->first();
                    $pdata->fname = $emp->fname;

                    $pdata->grosspay = number_format((float)$pdata->grosspay, 2, '.', ',');

                }

                // dd($data);
                return DataTables::of($data)
                    ->addColumn('sno', function ($row) {
                        return '';
                    })
                    ->addColumn('paymentstatus', function ($row) {
                        return
                            '<form action="' . route("paymentstatus") . '" method="POST">
                            ' . csrf_field() . '
                            <input type="hidden" name="invoice_no" value="' . $row->order_no . '">
                            <select name="paymentstatus" style="width:80px!important;">
                                <option value="closed">Close</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-modal text-lblue " role="button">Update</button>
                        </form>';
                    })
                    ->addColumn('paymentstatus', function ($row) {
                        if ($row->paymentstatus == 'open') {

                            return '
                            <div>
                                <select class="paymentstatus" style="width:80px;" data-id="' . $row->id . '" data-inid="' . $row->order_no . '">
                                    <option value="closed" ' . ($row->paymentstatus === 'closed' ? 'selected' : '') . '>Closed</option>
                                    <option value="cancelled" ' . ($row->paymentstatus === 'cancelled' ? 'selected' : '') . '>Cancelled</option>
                                    <option value="suspence" ' . ($row->paymentstatus === 'suspence' ? 'selected' : '') . '>Suspence</option>
                                </select>
                                <button class="btn btn-modal invoicestatus" data-id="' . $row->id . '" data-inid="' . $row->order_no . '">update</button>
                            </div>
                        ';
                        } else {
                            return e($row->paymentstatus);
                        }
                    })

                    ->addColumn('action', function ($row) {
                        $invoice = base64_encode($row->order_no);
                        return '<div class="d-flex justify-content-start gap-3 align-items-center">
                    <a class="btn" href="' . route('poprint', ['id' => $invoice]) . '"  target="blank"><i class="fi fi-ts-user-check"></i>
					 <span class="tooltiptext">view</span>
					</a>
                    <button class="btn btn-modal deleteclick p-0" data-container=".customer_modal" data-href="' . action([Purchaseorder::class, 'edit'], [$row->order_no]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    </div>';
                    })

                    ->rawColumns(['sno', 'action', 'paymentstatus'])
                    ->make(true);
            }

            $vendorlist = DB::table('vendorlist')->where('status', '!=', '0')->orderBy('company_name', 'ASC')->pluck('company_name', 'id')->toArray();
            $vendorlist = ['0' => 'Select Client', 'All' => 'All'] + $vendorlist;

            $proformadata = DB::table('purchaseorderdetails')
                ->select(DB::raw('COUNT(*) as total_open'), DB::raw('SUM(grosspay) as total_grosspay'))
                ->where('paymentstatus', 'open')
                ->first();

            $ninetyDaysAgo = date('d-m-Y', strtotime('-90 days'));

            $proformadata90days = DB::table('purchaseorderdetails')
                ->select(DB::raw('COUNT(*) as total_open'), DB::raw('SUM(grosspay) as total_grosspay'))
                ->where('paymentstatus', 'open')
                ->where('order_date', '>=', $ninetyDaysAgo)
                ->first();

            return view('purchaseorder/index', compact('vendorlist', 'proformadata', 'proformadata90days'))->render();
        } else {
            return redirect()->to('/workreport');
        }
    }

    public function create(Request $request)
    {
        $vendorlist = DB::table('vendorlist')->where('id', request()->session()->get('purchaseorderid'))->first();

        $gst = DB::table('global')->first();

        $innumber    = DB::table('purchaseorder')->orderBy('order_no', 'desc')->first();

        if(!empty($innumber->order_no)){
        $j = $innumber->order_no;
        $j++;
        }else{
            $j = "PO100001";
        }

        $in_number = $j;

        $statename = DB::table('statemaster')->orderBy('sorder_id', 'ASC')->get();

        return view('purchaseorder/create', compact('vendorlist', 'in_number', 'gst', 'statename'))->render();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|exists:vendorlist,id',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'paymentterms' => 'required|string',
            'order_date' => 'required|date_format:d-m-Y',
            'order_no' => 'required|string|max:255',
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
            'amount' => 'required|numeric|min:0',
            'gsttype' => 'required|in:ex,in',
            'specialdiscount' => 'nullable|numeric|min:0',
            'netpay' => 'required|numeric|min:0',
            'principle' => 'nullable|string|max:255',
            'statename' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if the domain already exists
        $existingpurchaseorder = DB::table('purchaseorder')
            ->where('order_no', $request->order_no)
            ->exists();

        if ($existingpurchaseorder) {
            session()->flash('secmessage', 'Purchase Order Number Already in our Database.');
            return response()->json(['status' => 1, 'message' => 'Purchase Order Number Already in our Database.'], 200);
        }

        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');

        if (!empty($request->quantity_one)) {
            DB::table('purchaseorder')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_one,
                'description' => $request->description_one,
                'quantity' => $request->quantity_one,
                'unit' => $request->unit_one,
                'totalamount' => $request->totalamount_one,
                'hsn' => $request->hsn_one,
            ]);
        }

        // Item 2
        if (!empty($request->quantity_two)) {
            DB::table('purchaseorder')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_two,
                'description' => $request->description_two,
                'quantity' => $request->quantity_two,
                'unit' => $request->unit_two,
                'totalamount' => $request->totalamount_two,
                'hsn' => $request->hsn_two,
            ]);
        }

        // Item 3
        if (!empty($request->quantity_three)) {
            DB::table('purchaseorder')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_three,
                'description' => $request->description_three,
                'quantity' => $request->quantity_three,
                'unit' => $request->unit_three,
                'totalamount' => $request->totalamount_three,
                'hsn' => $request->hsn_three,
            ]);
        }

        // Item 4
        if (!empty($request->quantity_four)) {
            DB::table('purchaseorder')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_four,
                'description' => $request->description_four,
                'quantity' => $request->quantity_four,
                'unit' => $request->unit_four,
                'totalamount' => $request->totalamount_four,
                'hsn' => $request->hsn_four,
            ]);
        }

        // Item 5
        if (!empty($request->quantity_five)) {
            DB::table('purchaseorder')->insert([
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_five,
                'description' => $request->description_five,
                'quantity' => $request->quantity_five,
                'unit' => $request->unit_five,
                'totalamount' => $request->totalamount_five,
                'hsn' => $request->hsn_five,
            ]);
        }

        if ($request->gsttype == 'in') {
            $taxvalue = ($request->statename == 'Tamil Nadu') ? 'sgst' : 'igst';
            $igst = $request->igst1;
            $cgst = $request->cgst1;
            $sgst = $request->sgst1;
            $grosspay = $request->grosspay1;
            $amount = $request->netpay;
        } else {
            $taxvalue = ($request->statename == 'Tamil Nadu') ? 'sgst' : 'igst';
            $igst = $request->igst;
            $cgst = $request->cgst;
            $sgst = $request->sgst;
            $grosspay = $request->grosspay;
            $amount = $request->amount;
        }

        // Insert data into the database
        $val = [
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,
            'empid' => $empid,
            'order_date' => $request->order_date,
            'order_no' => $request->order_no,
            'taxvalue' => $taxvalue,
            'cgst' => $cgst, // original expiry date format
            'sgst' => $sgst,
            'igst' => $igst,
            'gsttype' => $request->gsttype,
            'principle' => ($request->principle) ? $request->principle : 0,
            'amount' => $amount,
            'specialdiscount' => ($request->specialdiscount) ? $request->specialdiscount : 0,
            'netpay' => ($request->netpay) ? $request->netpay : 0,
            'grosspay' => $grosspay,
            'paymentterms' => $request->paymentterms,
            'paymentstatus' => "open",
            'statename' => $request->statename,
        ];

      $tt=  DB::table('purchaseorderdetails')->insert($val);

      

        session()->flash('secmessage', 'Purchase Order Generated Successfully');
        return response()->json(['status' => 1, 'message' => 'Purchase Order Generated Successfully'], 200);
    }

    public function edit($id)
    {
        $purchaseorder = DB::table('purchaseorder')->where('order_no', $id)->get();

        $purchaseorderdetails = DB::table('purchaseorderdetails')->where('order_no', $id)->first();

        $vendorlist = DB::table('vendorlist')->where('id', $purchaseorderdetails->company_id)->first();

        $gst = DB::table('global')->first();

        $statename = DB::table('statemaster')->orderBy('sorder_id', 'ASC')->get();

        // dd($vendorlist);
        return view('purchaseorder.edit')->with(compact('purchaseorder', 'purchaseorderdetails', 'vendorlist', 'gst', 'statename'));
    }

    public function update(Request $request, $id)
    {

        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|exists:vendorlist,id',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'paymentterms' => 'required|string',
            'order_date' => 'required|date_format:d-m-Y',
            'order_no' => 'required|string|max:255',
            'item_no_1' => 'required|string|max:50',
            'description_1' => 'required|string|max:255',
            'quantity_1' => 'required|numeric|min:1',
            'unit_1' => 'required|numeric|min:0',
            'totalamount_1' => 'required|numeric|min:0',
            'item_no_2' => 'nullable|string|max:50',
            'description_2' => 'nullable|string|max:255',
            'quantity_2' => 'nullable|numeric|min:0',
            'unit_2' => 'nullable|numeric|min:0',
            'totalamount_2' => 'nullable|numeric|min:0',
            'item_no_3' => 'nullable|string|max:50',
            'description_3' => 'nullable|string|max:255',
            'quantity_3' => 'nullable|numeric|min:0',
            'unit_3' => 'nullable|numeric|min:0',
            'totalamount_3' => 'nullable|numeric|min:0',
            'item_no_4' => 'nullable|string|max:50',
            'description_4' => 'nullable|string|max:255',
            'quantity_4' => 'nullable|numeric|min:0',
            'unit_4' => 'nullable|numeric|min:0',
            'totalamount_4' => 'nullable|numeric|min:0',
            'item_no_5' => 'nullable|string|max:50',
            'description_5' => 'nullable|string|max:255',
            'quantity_5' => 'nullable|numeric|min:0',
            'unit_5' => 'nullable|numeric|min:0',
            'totalamount_5' => 'nullable|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'gsttype' => 'required|in:ex,in',
            'specialdiscount' => 'nullable|numeric|min:0',
            'netpay' => 'required|numeric|min:0',
            'principle' => 'nullable|string|max:255',
            'statename' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $empid = request()->session()->get('empid');

        if (!empty($request->quantity_1)) {

            $val1 = [
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_1,
                'description' => $request->description_1,
                'quantity' => $request->quantity_1,
                'unit' => $request->unit_1,
                'totalamount' => $request->totalamount_1,
                'hsn' => $request->hsn_1,
            ];

            if (!empty($request->updateid_1)) {
                DB::table('purchaseorder')->where('id', $request->updateid_1)->update($val1);
            } else {
                DB::table('purchaseorder')->insert($val1);
            }
        }

        // Item 2
        if (!empty($request->quantity_2)) {
            // dd($request->all());
            $val2 = [
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_2,
                'description' => $request->description_2,
                'quantity' => $request->quantity_2,
                'unit' => $request->unit_2,
                'totalamount' => $request->totalamount_2,
                'hsn' => $request->hsn_2,
            ];


            if (!empty($request->updateid_2)) {
                DB::table('purchaseorder')->where('id', $request->updateid_2)->update($val2);
            } else {
                DB::table('purchaseorder')->insert($val2);
            }
        }

        // Item 3
        if (!empty($request->quantity_3)) {

            $val3 = [
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_3,
                'description' => $request->description_3,
                'quantity' => $request->quantity_3,
                'unit' => $request->unit_3,
                'totalamount' => $request->totalamount_3,
                'hsn' => $request->hsn_3,
            ];


            if (!empty($request->updateid_3)) {
                DB::table('purchaseorder')->where('id', $request->updateid_3)->update($val3);
            } else {
                DB::table('purchaseorder')->insert($val3);
            }
        }

        // Item 4
        if (!empty($request->quantity_4)) {

            $val4 = [
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_4,
                'description' => $request->description_4,
                'quantity' => $request->quantity_4,
                'unit' => $request->unit_4,
                'totalamount' => $request->totalamount_4,
                'hsn' => $request->hsn_4,
            ];

            if (!empty($request->updateid_4)) {
                DB::table('purchaseorder')->where('id', $request->updateid_4)->update($val4);
            } else {
                DB::table('purchaseorder')->insert($val4);
            }
        }

        // Item 5
        if (!empty($request->quantity_5)) {

            $val5 = [
                'company_id' => $request->company_id,
                'empid' => $empid,
                'order_date' => $request->order_date,
                'order_no' => $request->order_no,
                'item_no' => $request->item_no_5,
                'description' => $request->description_5,
                'quantity' => $request->quantity_5,
                'unit' => $request->unit_5,
                'totalamount' => $request->totalamount_5,
                'hsn' => $request->hsn_5,
            ];

            if (!empty($request->updateid_5)) {
                DB::table('purchaseorder')->where('id', $request->updateid_5)->update($val5);
            } else {
                DB::table('purchaseorder')->insert($val5);
            }
        }

        if ($request->gsttype == 'in') {
            $taxvalue = ($request->statename == 'Tamil Nadu') ? 'sgst' : 'igst';
            $igst = $request->igst1;
            $cgst = $request->cgst1;
            $sgst = $request->sgst1;
            $grosspay = $request->grosspay1;
            $amount = $request->netpay;
        } else {
            $taxvalue = ($request->statename == 'Tamil Nadu') ? 'sgst' : 'igst';
            $igst = $request->igst;
            $cgst = $request->cgst;
            $sgst = $request->sgst;
            $grosspay = $request->grosspay;
            $amount = $request->amount;
        }

        $val = [
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,
            'empid' => $empid,
            'order_date' => $request->order_date,
            'order_no' => $request->order_no,
            'taxvalue' => $taxvalue,
            'cgst' => $cgst, // original expiry date format
            'sgst' => $sgst,
            'igst' => $igst,
            'gsttype' => $request->gsttype,
            'principle' => ($request->principle) ? $request->principle : 0,
            'amount' => $amount,
            'specialdiscount' => ($request->specialdiscount) ? $request->specialdiscount : 0,
            'netpay' => ($request->netpay) ? $request->netpay : 0,
            'grosspay' => $grosspay,
            'paymentterms' => $request->paymentterms,
            'paymentstatus' => "open",
        ];

        DB::table('purchaseorderdetails')->where('id', $id)->update($val);

        session()->flash('secmessage', 'Purchase Order Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Purchase Order Updated Successfully.'], 200);
    }

    public function destroy($id)
    {

        $upd = DB::table('purchaseorder')->where('id', $id)->delete();
        session()->flash('secmessage', 'Purchase Order Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Purchase Order Deleted Successfully!'], 200);
    }


    public function purchaseorderstatus(Request $request)
    {
        // dd($request->all());

        $update = DB::table('purchaseorderdetails')->where('order_no', $request->inid)->update(['paymentstatus' => $request->status]);
        session()->flash('secmessage', 'Status Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully'], 200);
    }

    public function accountsid(Request $request)
    {
        // dd($request->all());
        request()->session()->put('purchaseorderid', $request->accountsid);
        // return $this->create($request);
    }

    public function print($id)
    {
        $id = base64_decode($id);
        $purchaseorder = DB::table('purchaseorderdetails')->where('order_no', $id)->first();
        $global = DB::table('global')->first();
        $vendorlist = DB::table('vendorlist')->where('id', $purchaseorder->company_id)->first();
        $pinfo = DB::table('purchaseorder')->where('order_no', $id)->get();

        return view('pdf.poprint')->with(compact('purchaseorder', 'global', 'vendorlist', 'pinfo'));
    }

   
}
