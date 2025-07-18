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

class Vendorpaymententry extends Controller
{

    public function index(Request $request)
    {

        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8') {

            if (request()->ajax()) {
                // Fetch the main payment data

                if (isset($request->companyname) && !empty($request->companyname)) {
                    request()->session()->put('pcompanyname', $request->companyname);
                }

                if (isset($request->companyname) && !empty($request->companyname) && $request->companyname == "All") {
                    request()->session()->put('pcompanyname', "");
                }

                if (isset($request->daterange) && !empty($request->daterange)) {
                    $daterange = explode(' - ', $request->daterange);
                    $start_date = date('Y-m-d', strtotime($daterange[0]));
                    $end_date = date('Y-m-d', strtotime($daterange[1]));
                    request()->session()->put('pstart_date', $start_date);
                    request()->session()->put('pend_date', $end_date);
                }

                $data = DB::table('vendorpayment_list as p')
                    ->select(
                        'p.*',
                        'p.id as pid',
                        'p.paydate',
                        'a.company_name',
                        'a.id as company_id',
                        'r.fname',
                        'r.lname',
                        DB::raw("SUM(CAST(REPLACE(REPLACE(REPLACE(p.payamount, ',', ''), '/', ''), '-', '') AS UNSIGNED)) OVER () as totalpayamount")
                    )
                    ->join('vendorlist as a', 'a.id', '=', 'p.company_name')
                    ->join('regis as r', 'r.empid', '=', 'p.create_empid')
                    ->when(request()->session()->has('pcompanyname') && !empty(request()->session()->get('pcompanyname')) && request()->session()->get('pcompanyname') != 'All', function ($query) {

                        $query->where('p.company_name', request()->session()->get('pcompanyname'));
                    })
                    ->when(request()->session()->has('pstart_date') && !empty(request()->session()->get('pstart_date')) && request()->session()->has('pend_date') && !empty(request()->session()->get('pend_date')), function ($query) {

                        $query->whereBetween('paydate', [request()->session()->get('pstart_date'), request()->session()->get('pend_date')]);
                    })
                    ->orderByDesc('p.paydate')
                    ->get();

                if (count($data) > 0) {
                    $totalpayamount = number_format((float)$data[0]->totalpayamount, 2, '.', ',')  ?? 0;
                    request()->session()->put('totalvendorpaymententry', $totalpayamount);
                } else {
                    request()->session()->put('totalvendorpaymententry', 0);
                }

                foreach ($data as $pay) {

                    $pay->proinv = [];

                    if (!empty($pay->porder)) {

                        $ponumber = json_decode($pay->porder);

                        foreach ($ponumber as $invoiceRow) {
                            // dd($invoiceRow);
                            $pinvoice = $invoiceRow;

                            if ($pinvoice) {
                                $pinvoice_encoded = base64_encode($pinvoice);
                                $pay->proinv[] = "<b>PO:</b> <a class='btn text-lblue' href='" . route('poprint', ['id' => $pinvoice_encoded]) . "' target='_blank'>" . e($pinvoice) . "</a><br>";
                            }

                            if (empty($invoiceno) && empty($pinvoice)) {
                                $pay->proinv[] = "<b>PO:</b> N/A<br>";
                            }
                        }
                    }

                    // Map payment mode to human-readable values
                    $paymentModes = [
                        '1' => 'NEFT',
                        '2' => 'Cheque',
                        '3' => 'Others',
                    ];
                    $pay->paymentmode = $paymentModes[$pay->paymentmode] ?? 'Unknown';

                    // Combine first and last name for account manager
                    $pay->account_manager = $pay->fname . ' ' . $pay->lname;

                    $paypayamount = str_replace([',', '/-'], '', $pay->payamount);

                    $pay->payamount = number_format((float)$paypayamount, 2, '.', ',');
                }

                return DataTables::of($data)
                    ->addColumn('sno', function ($row) {
                        return '';
                    })
                    ->addColumn('proinv', function ($row) {
                        return is_array($row->proinv) ? implode('', $row->proinv) : '';
                    })
                    ->addColumn('action', function ($row) {
                        return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Vendorpaymententry::class, 'edit'], [$row->id]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								 <span class="tooltiptext">Edit</span>
                            </button>';
                    })
                    ->rawColumns(['sno', 'proinv', 'action'])
                    ->make(true);
            }

            $vendorlist = DB::table('vendorlist')
                ->where('status', 'Active')
                ->where('active_status', 'active')
                ->orderBy('company_name', 'asc')
                ->pluck('company_name', 'id')
                ->toArray();
            $vendorlist = ['0' => 'Select Option', 'All' => 'All'] + $vendorlist;

            return view('vendorpaymententry/index', compact('vendorlist'))->render();
        } else {
            return redirect()->to('/workreport');
        }
    }

    public function create(Request $request)
    {
        $vendor = DB::table('vendorlist')
            ->where('status', 'Active')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id')->toArray();
        $vendor = ["0" => 'Select Client'] + $vendor;

        $purchase = DB::table('purchaseorderdetails')
            ->where('paymentstatus', 'open')
            ->orderByDesc('order_no')
            ->get()
            ->pluck('grosspay', 'order_no')
            ->map(function ($grosspay, $order_no) {
                return $order_no . ' - ₹' . number_format($grosspay, 2);
            });

        return view('vendorpaymententry/create', compact('vendor', 'purchase'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'paydate' => 'required|date',
            'paymentmode' => 'required|integer|in:1,2,3',
            'payamount' => 'required|numeric|min:0.01',
            'porder' => 'required',
            'bankname' => 'nullable|string|max:255',
            'chequeno' => 'nullable|string|max:255',
            'document_upload' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024', // 1MB file limit
            'neftnumber' => 'nullable|string|max:255',
            'productservice' => 'required|string|max:1000',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        if ($request->paymentmode == '1') {
            $pm = 'NEFT/RTGS No';
        } else if ($request->paymentmode == '2') {
            $pm = 'Cheque';
        } else if ($request->paymentmode == '3') {
            $pm = 'Others';
        }

        $acc = DB::table('vendorlist')->where('id', $request->company_name)->first();
        $com_name = $acc->company_name;

        $val = [
            'company_name' => $request->company_name,
            'paydate' => $request->paydate,
            'payamount' => $request->payamount,
            'paymentmode' => $request->paymentmode,
            'bankname' => $request->bankname,
            'chequeno' => $request->chequeno,
            'neftnumber' => $request->neftnumber,
            'productservice' => $request->productservice,
            'comment' => $request->comment,
            'create_empid' => request()->session()->get('empid'),
            'submitdate' => date('d-m-Y'),
            'porder'     => json_encode($request->porder),
        ];

        if (!empty($request->document_upload)) {

            $resumesource = $_FILES['document_upload']['name'];
            $resumesource1 = str_replace(' ', '-', $resumesource);
            $target12 = basename(strtolower($resumesource1));
            $resumelocation = "uploaddoc/";
            $file_loc = $_FILES['document_upload']['tmp_name'];

            // Ensure the directory exists
            if (!is_dir($resumelocation)) {
                mkdir($resumelocation, 0755, true); // Create directory with proper permissions
            }

            // Construct the full path
            $fullpath = $resumelocation . $target12;

            // Move the uploaded file
            if (move_uploaded_file($file_loc, $fullpath)) {
                $val['document_upload'] = $target12;
            }
        }

        $insert = DB::table('vendorpayment_list')->insertGetId($val);

        if ($insert) {
            if (isset($target12) && !empty($target12)) {
                $targ = '<a target="blank" href=' . "https://appacmedia.in/uploaddoc/" . $target12 . '>Click here</a>';
            } else {
                $targ = "";
            }

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');
            $appName = env('APP_NAME');
            $thesupportmail = request()->session()->get('dept_id') == 6 ? env('THESUPPORTMAIL') : null;
dd('hh');
            Mail::send([], [], function ($message) use (
                $appName,
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $pm,
                $com_name,
                $targ,
                $thesupportmail,
            ) {
                $message->to($founderEmail)
                    ->cc(array_filter([$managerMail, $thesupportmail]))
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject("Payment Entry Details")
                    ->html('
                        <html><title></title><head></head>   <body> <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Payment Entry Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hi Sir/Mam, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0" colspan="4"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Please find the Payment Entry Details</p></td></tr><tr><td style="width:200px;padding:4px 0"> Company Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0"> Date:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->paydate . '</td></tr>
            <tr><td style="width:200px;padding:4px 0"> Amount:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->payamount . '</td></tr><tr><td style="width:200px;padding:4px 0">Payment Mode:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $pm . '</td></tr><tr><td style="width:200px;padding:4px 0">Product/Service:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->productservice . '</td></tr><tr><td style="width:200px;padding:4px 0">Comments:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comment . '</td></tr><tr><td style="width:200px;padding:4px 0">Document Path</td><td style="padding-right:10px"> : </td><td style="font-weight:normal"> ' . $targ . ' </td></tr> </tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>
                    ');
            });

            // Success message and response
            session()->flash('secmessage', 'Payment Details Added Successfully.');
            return response()->json(['status' => 1, 'message' => 'Payment Details Added Successfully.'], 200);
        }
    }

    public function edit($id)
    {
        $payment = DB::table('vendorpayment_list as p')
            ->select(
                'p.*',
                'p.company_name as cname',
                'a.company_name',
                'a.id as account_id',
                'r.fname',
                'r.lname'
            )
            ->join('vendorlist as a', 'a.id', '=', 'p.company_name')
            ->join('regis as r', 'r.empid', '=', 'p.create_empid')
            ->where('p.id', $id)
            ->first();

        $vendorlist = DB::table('vendorlist')
            ->where('status', 'Active')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id')->toArray();
        $vendorlist = ["0" => 'Select Vendor'] + $vendorlist;

        $pii = json_decode($payment->porder);

        $purchase = DB::table('purchaseorderdetails')
            ->where('paymentstatus', 'open')
            ->where('company_id', $payment->cname)
            ->orderByDesc('order_no')
            ->get()
            ->pluck('grosspay', 'order_no')
            ->map(function ($grosspay, $order_no) {
                return $order_no . ' - ₹' . number_format($grosspay, 2);
            });

        return view('vendorpaymententry.edit')->with(compact('payment', 'vendorlist', 'pii', 'purchase'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'paydate' => 'required|date',
            'paymentmode' => 'required|integer|in:1,2,3',
            'payamount' => 'required|min:0.01',
            'porder' => 'required',
            'bankname' => 'nullable|string|max:255',
            'chequeno' => 'nullable|string|max:255',
            'document_upload' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:1024', // 1MB file limit
            'neftnumber' => 'nullable|string|max:255',
            'productservice' => 'required|string|max:1000',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());

        if ($request->paymentmode == '1') {
            $pm = 'NEFT/RTGS No';
        } else if ($request->paymentmode == '2') {
            $pm = 'Cheque';
        } else if ($request->paymentmode == '3') {
            $pm = 'Others';
        }

        $acco = DB::table('vendorlist')->where('id', $request->company_name)->first();
        $com_name = $acco->company_name;

        $val = [
            'company_name' => $request->company_name,
            'paydate' => $request->paydate,
            'payamount' => $request->payamount,
            'paymentmode' => $request->paymentmode,
            'bankname' => $request->bankname,
            'chequeno' => $request->chequeno,
            'neftnumber' => $request->neftnumber,
            'productservice' => $request->productservice,
            'comment' => $request->comment,
            'create_empid' => request()->session()->get('empid'),
            'submitdate' => date('d-m-Y'),
            'porder'     => json_encode($request->porder),
        ];

        if (!empty($request->document_upload)) {

            $resumesource = $_FILES['document_upload']['name'];
            $resumesource1 = str_replace(' ', '-', $resumesource);
            $target12 = basename(strtolower($resumesource1));
            $resumelocation = "uploaddoc/";
            $file_loc = $_FILES['document_upload']['tmp_name'];

            // Ensure the directory exists
            if (!is_dir($resumelocation)) {
                mkdir($resumelocation, 0755, true); // Create directory with proper permissions
            }

            // Construct the full path
            $fullpath = $resumelocation . $target12;

            // Move the uploaded file
            if (move_uploaded_file($file_loc, $fullpath)) {
                $val['document_upload'] = $target12;
            }
        }

        $insert = DB::table('vendorpayment_list')->where('id', $id)->update($val);

        dd('ll');
        if ($insert) {
            if (isset($target12) && !empty($target12)) {
                $targ = '<a target="blank" href=' . "https://appacmedia.in/uploaddoc/" . $target12 . '>Click here</a>';
            } else {
                $targ = "";
            }

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');
            $appName = env('APP_NAME');
            $thesupportmail = request()->session()->get('dept_id') == 6 ? env('THESUPPORTMAIL') : null;

            Mail::send([], [], function ($message) use (
                $appName,
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $com_name,
                $thesupportmail,
            ) {
                $message->to($founderEmail)
                    ->cc(array_filter([$managerMail, $thesupportmail]))
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject("Update Payment Entry Details")
                    ->html(' <html><title></title><head></head>   <body> <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Updated Payment Entry Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hi Sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Payment Entry Details</p></td></tr><tr><td style="width:200px;padding:4px 0"> Company Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0"> Date:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->paydate . '</td></tr>
		<tr><td style="width:200px;padding:4px 0"> Amount:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->payamount . '</td></tr><tr><td style="width:200px;padding:4px 0"> Bank Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->bankname . '</td></tr>
		<tr><td style="width:200px;padding:4px 0"> Cheque Number:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->chequeno . '</td></tr><tr><td style="width:200px;padding:4px 0">NEFT/RTGS No:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->neftnumber . '</td></tr>
		<tr><td style="width:200px;padding:4px 0">Product/Service:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->productservice . '</td></tr><tr><td style="width:200px;padding:4px 0">Comments:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comment . '</td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>
                    ');
            });

            // Success message and response
            session()->flash('secmessage', 'Payment Details Updated Successfully');
            return response()->json(['status' => 1, 'message' => 'Payment Details Updated Successfully'], 200);
        }
    }

    public function paymentproduct(Request $request)
    {
        $pid = $request->pid;

        $porder = $pid ? DB::table('purchaseorder')
            ->select('description')
            ->whereIn('order_no', $pid)
            ->orderByDesc('order_no')
            ->get() : collect();

        $paymentterms = $porder->pluck('description');
        $numberedTerms = "\n" . $paymentterms
            ->filter(function ($term) {
                return !is_null($term) && trim($term) !== '';
            })
            ->values()
            ->map(function ($term, $index) {
                return ($index + 1) . '. ' . trim($term);
            })
            ->implode("\n");


        return response()->json(['paymentterms' => $numberedTerms]);
    }

    public function fetchClientInvoices(Request $request)
    {
        $clientId = $request->input('company_id');

        $porder = DB::table('purchaseorderdetails')
            ->where('paymentstatus', 'open')
            ->where('company_id', $clientId)
            ->orderByDesc('order_no')
            ->select('order_no', 'grosspay')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->order_no => $item->order_no . ' - ₹' . number_format($item->grosspay)];
            })
            ->toArray();

        return response()->json([
            'porder' => $porder,
        ]);
    }
}
