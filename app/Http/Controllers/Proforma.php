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

class Proforma extends Controller
{

  public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {

            if(request()->session()->get('proforma_status') == ""){
                request()->session()->put('proforma_status', 'open');
            }

            if(isset($request->pstatus) && !empty($request->pstatus)){
                request()->session()->put('proforma_status', $request->pstatus);
            }

            $data = DB::table('proformadetails')
            ->when(request()->session()->get('proforma_status') !== 'all', function ($query) {
                $query->where('paymentstatus', request()->session()->get('proforma_status'));
            })
			// ->whereNotNull('company_id')
            ->orderBy('invoice_no', 'desc')
            ->get();

            foreach ($data as $pdata) {
                $emp = DB::table('regis')->where('empid', $pdata->empid)->first();
                $pdata->fname = $emp->fname;

                $pdata->grosspay = number_format((float)$pdata->grosspay, 2, '.', '');

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
                    return
                        '<form action="' . route("paymentstatus") . '" method="POST">
                            ' . csrf_field() . '
                            <input type="hidden" name="invoice_no" value="' . $row->invoice_no . '">
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
                                <select class="paymentstatus" style="width:80px;" data-id="' . $row->id . '" data-inid="' . $row->invoice_no . '">
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
                    $invoice=base64_encode($row->invoice_no);
                    return '<div class="d-flex justify-content-start gap-3 align-items-center">
                    <a class="btn" href="' . route('pprint', ['id' => $invoice]) . '"  target="_blank"><i class="fi fi-ts-print"></i>
					 <span class="tooltiptext">print</span>
					</a>
                    <button class="btn btn-modal deleteclick p-0" data-container=".customer_modal" data-href="' . action([Proforma::class, 'edit'], [$row->invoice_no]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
               
                    <button class="btn conformconvert p-0" data-id="' . $row->invoice_no . '"><i class="fi fi-ts-paste"></i>
					 <span class="tooltiptext">convert</span>
					</button>
                    </div>';
                })

                ->rawColumns(['sno', 'action', 'companyname', 'paymentstatus'])
                ->make(true);
        }

        $accounts = DB::table('accounts')->where('status', '!=', '0')->orderBy('company_name', 'ASC')->pluck('company_name', 'id')->toArray();
          $accounts = ['0' => 'Select Client'] + $accounts;
        return view('proforma/index', compact('accounts'))->render();
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')->where('id', request()->session()->get('proformaid'))->first();
        // dd($accounts);
        $gst = DB::table('global')->first();

        $innumber    = DB::table('proforma')->orderBy('invoice_no', 'desc')->first();

        $j = $innumber->invoice_no;
        $j++;

        $in_number = $j;
        return view('proforma/create', compact('accounts', 'in_number', 'gst'))->render();
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
            'paymentterms' => 'required|string',
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
            'amount' => 'required|numeric|min:0',
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
        $existingproforma = DB::table('proforma')
            ->where('invoice_no', $request->invoice_no)
            ->exists();

        if ($existingproforma) {
            session()->flash('secmessage', 'Proforma Invoice Number Already in our Database.');
            return response()->json(['status' => 1, 'message' => 'Proforma Invoice Number Already in our Database.'], 200);
        }

        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');

        if (!empty($request->quantity_one)) {
            DB::table('proforma')->insert([
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
            DB::table('proforma')->insert([
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
            DB::table('proforma')->insert([
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
            DB::table('proforma')->insert([
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
            DB::table('proforma')->insert([
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
            $igst = $request->igst1;
            $cgst = $request->cgst1;
            $sgst = $request->sgst1;
            $grosspay = $request->grosspay1;
            $amount = $request->netpay;
        } else {
            $taxvalue = $request->taxvalue;
            $igst = $request->igst;
            $cgst = $request->cgst;
            $sgst = $request->sgst;
            $grosspay = $request->grosspay;
            $amount = $request->amount;
        }

        // Insert data into the database
        $val = [
            'company_id' => $request->company_id,
            'empid' => $empid,
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
            'taxvalue' => $taxvalue,
            'cgst' => $cgst, // original expiry date format
            'sgst' => $sgst,
            'igst' => $igst,
            'gsttype' => $request->gsttype,
            'principle' => ($request->principle) ? $request->principle : '',
            'amount' => $amount,
            'specialdiscount' => ($request->specialdiscount) ? $request->specialdiscount : 0,
            'netpay' => ($request->netpay) ? $request->netpay : 0,
            'grosspay' => $grosspay,
            'paymentterms' => $request->paymentterms,
            'url' => '',
            'paymentstatus' => "open",
        ];

        DB::table('proformadetails')->insert($val);

        session()->flash('secmessage', 'Proforma Invoice Generated Successfully');
        return response()->json(['status' => 1, 'message' => 'Proforma Invoice Generated Successfully'], 200);
    }

    public function edit($id)
    {
        $proforma= DB::table('proforma')->where('invoice_no',$id)->get();

        $proformadetails = DB::table('proformadetails')->where('invoice_no',$id)->first();

        $accounts=DB::table('accounts')->where('id',$proformadetails->company_id)->first();

        $gst = DB::table('global')->first();
// dd($accounts);
        return view('proforma.edit')->with(compact('proforma', 'proformadetails', 'accounts', 'gst'));
    }

    public function update(Request $request, $id)
    {
        
        // Validate the request inputs
        $validator = Validator::make($request->all(), [
            'company_id' => 'required|integer|exists:accounts,id',
            'company_name' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'paymentterms' => 'required|string',
            'invoice_date' => 'required|date_format:d-m-Y',
            'invoice_no' => 'required|string|max:255',
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
        // $existingproforma = DB::table('proforma')
        //     ->where('invoice_no', $request->invoice_no)
        //     ->exists();

        // if ($existingproforma) {
        //     session()->flash('secmessage', 'Proforma Invoice Number Already in our Database.');
        //     return response()->json(['status' => 1, 'message' => 'Proforma Invoice Number Already in our Database.'], 200);
        // }

        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');

        if (!empty($request->quantity_1)) {

            $val1=[
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_1,
                'description' => $request->description_1,
                'quantity' => $request->quantity_1,
                'unit' => $request->unit_1,
                'totalamount' => $request->totalamount_1,
            ];

            if(!empty($request->updateid_1)){
                DB::table('proforma')->where('id',$request->updateid_1)->update($val1);
            }else{
            DB::table('proforma')->insert($val1);
            }
        }

        // Item 2
        if (!empty($request->quantity_2)) {
            // dd($request->all());
            $val2=[
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_2,
                'description' => $request->description_2,
                'quantity' => $request->quantity_2,
                'unit' => $request->unit_2,
                'totalamount' => $request->totalamount_2,
            ];

            
            if(!empty($request->updateid_2)){
                DB::table('proforma')->where('id',$request->updateid_2)->update($val2);
            }else{
                DB::table('proforma')->insert($val2);
            }

        }

        // Item 3
        if (!empty($request->quantity_3)) {

            $val3=[
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_3,
                'description' => $request->description_3,
                'quantity' => $request->quantity_3,
                'unit' => $request->unit_3,
                'totalamount' => $request->totalamount_3,
            ];

            
            if(!empty($request->updateid_3)){
                DB::table('proforma')->where('id',$request->updateid_3)->update($val3);
            }else{
                DB::table('proforma')->insert($val3);
            }

        }

        // Item 4
        if (!empty($request->quantity_4)) {

            $val4=[
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_4,
                'description' => $request->description_4,
                'quantity' => $request->quantity_4,
                'unit' => $request->unit_4,
                'totalamount' => $request->totalamount_4,
            ];
            
            if(!empty($request->updateid_4)){
                DB::table('proforma')->where('id',$request->updateid_4)->update($val4);
            }else{
                DB::table('proforma')->insert($val4);
            }

        }

        // Item 5
        if (!empty($request->quantity_5)) {

            $val5=[
                'company_id' => $request->company_id,
                'empid' => $empid,
                'invoice_date' => $request->invoice_date,
                'invoice_no' => $request->invoice_no,
                'item_no' => $request->item_no_5,
                'description' => $request->description_5,
                'quantity' => $request->quantity_5,
                'unit' => $request->unit_5,
                'totalamount' => $request->totalamount_5,
            ];
            
            if(!empty($request->updateid_5)){
                DB::table('proforma')->where('id',$request->updateid_5)->update($val5);
            }else{
                DB::table('proforma')->insert($val5);
            }

        }

        if ($request->gsttype == 'in') {
            $taxvalue = $request->taxvalue1;
            $igst = $request->igst1;
            $cgst = $request->cgst1;
            $sgst = $request->sgst1;
            $grosspay = $request->grosspay1;
            $amount = $request->netpay;
        } else {
            $taxvalue = $request->taxvalue;
            $igst = $request->igst;
            $cgst = $request->cgst;
            $sgst = $request->sgst;
            $grosspay = $request->grosspay;
            $amount = $request->amount;
        }

        // Insert data into the database
        $val = [
            'company_id' => $request->company_id,
            'empid' => $empid,
            'invoice_date' => $request->invoice_date,
            'invoice_no' => $request->invoice_no,
            'taxvalue' => $taxvalue,
            'cgst' => $cgst, // original expiry date format
            'sgst' => $sgst,
            'igst' => $igst,
            'gsttype' => $request->gsttype,
            'principle' => ($request->principle) ? $request->principle : '',
            'amount' => $amount,
            'specialdiscount' => ($request->specialdiscount) ? $request->specialdiscount : 0,
            'netpay' => ($request->netpay) ? $request->netpay : 0,
            'grosspay' => $grosspay,
            'paymentterms' => $request->paymentterms,
            'url' => '',
            'paymentstatus' => "open",
        ];

        DB::table('proformadetails')->where('id',$id)->update($val);

        session()->flash('secmessage', 'Proforma Invoice Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Proforma Invoice Updated Successfully.'], 200);
    }

    public function destroy($id)
    {
        
        $upd = DB::table('proforma')->where('id', $id)->delete();
        session()->flash('secmessage', 'Proforma Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Proforma Deleted Successfully!'], 200);
    }


    public function paymentstatus(Request $request)
    {
        // dd($request->all());

        $update = DB::table('proformadetails')->where('invoice_no', $request->inid)->update(['paymentstatus' => $request->status]);
        session()->flash('secmessage', 'Status Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully'], 200);
    }

    public function accountsid(Request $request)
    {
        // dd($request->all());
        request()->session()->put('proformaid', $request->accountsid);
        // return $this->create($request);
    }

    public function print($id){
        $id=base64_decode($id);
        $proforma = DB::table('proformadetails')->where('invoice_no', $id)->first();
        $global = DB::table('global')->first();
        $accounts= DB::table('accounts')->where('id', $proforma->company_id)->first();
        $pinfo = DB::table('proforma')->where('invoice_no', $id)->get();

        return view('pdf.pprint')->with(compact('proforma', 'global', 'accounts','pinfo'));
    }

    public function convertinvoice($id){
// dd($id);
        $invoi = DB::table('invoicedetails')->select('invoice_no')->orderBy('id','desc')->first(); 

        $j = $invoi->invoice_no;
        $j++;
        $in_number = $j;

        $invoice = DB::table('invoicedetails')->where('invoice_no',$in_number)->count(); 
   
        if ($invoice > 0) {
            session()->flash('secmessage', 'Invoice Already Issued');
            return response()->json(['status' => 1, 'message' => 'Invoice Already Issued'], 200);
        } else {
        
            $proformaupdate = DB::table('proformadetails')->where('invoice_no',$id)->update(['paymentstatus' => "closed"]);
        
            $proforma=DB::table('proforma')->where('invoice_no',$id)->get();

            if(count($proforma)>0){
                foreach($proforma as $key=> $proforma1){

                    $val1=[
                         'company_id' => $proforma1->company_id,
                         'empid'      => request()->session()->get('empid'),
                         'invoice_date' => date('d-m-Y'),
                         'invoice_no'  => $in_number,
                         'item_no'     => $proforma1->item_no,
                         'description' => $proforma1->description,
                         'quantity'    => $proforma1->quantity,
                         'unit'        => $proforma1->unit,
                         'totalamount' => $proforma1->totalamount,
                    ];
                         $insert=DB::table('invoice')->insert($val1);

                }
            }

            $proformadetails=DB::table('proformadetails')->where('invoice_no',$id)->first();

             $val2=[
                  'company_id' => $proformadetails->company_id,
                  'empid'      => request()->session()->get('empid'),
                  'invoice_date' => date('d-m-Y'),
                  'invoice_date1' => date('Y-m-d'),
                  'invoice_no'  => $in_number,
                  'taxvalue'     => $proformadetails->taxvalue,
                  'cgst'     => $proformadetails->cgst,
                  'sgst'     => $proformadetails->sgst,
                  'igst'     => $proformadetails->igst,
                  'gsttype'     => $proformadetails->gsttype,
                  'principle'     => $proformadetails->principle,
                  'amount'     => $proformadetails->amount,
                  'specialdiscount'     => $proformadetails->specialdiscount,
                  'netpay'     => $proformadetails->netpay,
                  'grosspay'     => $proformadetails->grosspay,
                  'paymentstatus'     => "open",
                  'url'     => "",
                  'paymentdate'     => "",
                  'transactiontype'     => "",

             ];

             $invoicedetails=DB::table('invoicedetails')->insert($val2);

             $pay=DB::table('payment_list_invoice')->where('pinvoice',$id)->update(['invoiceno' => $in_number]);

             session()->flash('secmessage', 'Invoice Converted Successfully');
             return response()->json(['status' => 1, 'message' => 'Invoice Converted Successfully'], 200);
        }

    }
}
