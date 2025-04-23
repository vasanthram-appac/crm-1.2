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

class Paymententry extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {
            // Fetch the main payment data
            $data = DB::table('payment_list as p')
                ->select(
                    'p.*',
                    'p.id as pid',
                    'p.paydate',
                    'a.company_name',
                    'a.id as company_id',
                    'r.fname',
                    'r.lname'
                )
                ->join('accounts as a', 'a.id', '=', 'p.company_name')
                ->join('regis as r', 'r.empid', '=', 'p.create_empid')
                ->orderByDesc('p.paydate')
                ->get();
        
            foreach ($data as $pay) {
                // Fetch related invoice data for each payment
                $invoiceData = DB::table('payment_list_invoice')->where('plist_id', $pay->pid)->get();
        
                $pay->proinv = [];
                if ($invoiceData->isNotEmpty()) {
                    foreach ($invoiceData as $invoice) {
                        $pay->proinv[] = "<b>PI:</b> " . ($invoice->pinvoice ?? 'N/A') . "<br> <b>Ino:</b> " . ($invoice->invoiceno ?? 'N/A') . "<br>";
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
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Paymententry::class, 'edit'], [$row->id]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								 <span class="tooltiptext">Edit</span>
                            </button>';
                })
                ->rawColumns(['sno', 'proinv', 'action'])
                ->make(true);
        }

        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;
        

        return view('paymententry/index', compact('accounts'))->render();
    }

    public function create(Request $request)
    {

        $accounts = DB::table('accounts')
            ->where('status', '1')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id')->toArray();
	$accounts=["0" => 'Select Client']+$accounts;	

        return view('paymententry/create', compact('accounts'))->render();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'paydate' => 'required|date',
            'paymentmode' => 'required|integer|in:1,2,3',
            'payamount' => 'required|numeric|min:0.01',
            'pinvoice' => 'nullable|string|regex:/^PI\d+(,PI\d+)*$/',
            'invoiceno' => 'nullable|string|max:255',
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

        $acc = DB::table('accounts')->where('id', $request->company_name)->first();
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
            'account_manager' => $acc->accountmanager,
            'create_empid' => request()->session()->get('empid'),
            'submitdate' => date('d-m-Y'),
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

        $insert = DB::table('payment_list')->insertGetId($val);

        $pinv = $request->pinvoice;

        $arrs = explode(",", $pinv);

        foreach ($arrs as $arr) {

            $vdata = [
                'plist_id' =>  $insert,
                'pinvoice' =>  $arr
            ];

            $invno = DB::table('payment_list_invoice')->insert($vdata);
        }

        $invno1 = $request->invoiceno;

        $arrs1 = explode(",", $invno1);

        foreach ($arrs1 as $arr1) {
            $ind = DB::table('payment_list_invoice')->where('plist_id', $insert)->update(['invoiceno' => $arr1]);
        }

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
                ) {
                    $message->to($founderEmail)
                        ->cc([$managerMail])
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
        $payment = DB::table('payment_list as p')
            ->select(
                'p.*',
                'p.company_name as cname',
                'a.company_name',
                'a.id as account_id',
                'r.fname',
                'r.lname'
            )
            ->join('accounts as a', 'a.id', '=', 'p.company_name')
            ->join('regis as r', 'r.empid', '=', 'p.account_manager')
            ->where('p.id', $id)
            ->first();

        $accounts = DB::table('accounts')
            ->where('status', '1')
            ->orderBy('company_name', 'ASC')
            ->pluck('company_name', 'id')->toArray();
		$accounts=["0" => 'Select Client']+$accounts;	
        $paymentInvoices = DB::table('payment_list_invoice')
            ->where('plist_id', $id)
            ->get();

        $pinvoices = $paymentInvoices->pluck('pinvoice')->toArray();
        $invoicenos = $paymentInvoices->pluck('invoiceno')->toArray();

        $pii = implode(',', $pinvoices);
        $invv = implode(',', $invoicenos);


        return view('paymententry.edit')->with(compact('payment', 'accounts', 'pii', 'invv'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'paydate' => 'required|date',
            'paymentmode' => 'required|integer|in:1,2,3',
            'payamount' => 'required|min:0.01',
            'pinvoice' => 'nullable|string|regex:/^PI\d+(,PI\d+)*$/',
            'invoiceno' => 'nullable|string|max:255',
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

        $acco = DB::table('accounts')->where('id', $request->company_name)->first();
        $com_name = $acco->company_name;
        $acc = $acco->accountmanager;
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
            'account_manager' => $acco->accountmanager,
            'create_empid' => request()->session()->get('empid'),
            'submitdate' => date('d-m-Y'),
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
       
        $insert = DB::table('payment_list')->where('id', $id)->update($val);

        $delete=DB::table('payment_list_invoice')->where('plist_id', $id)->delete();

        $pinv = $request->pinvoice;

        $arrs = explode(",", $pinv);
        // dd($val);
        foreach ($arrs as $arr) {

            $vdata = [
                'plist_id' =>  $id,
                'pinvoice' =>  $arr
            ];

            $invno = DB::table('payment_list_invoice')->insert($vdata);
        }

        $invno1 = $request->invoiceno;

        $arrs1 = explode(",", $invno1);

        foreach ($arrs1 as $arr1) {
            $ind = DB::table('payment_list_invoice')->where('plist_id', $id)->update(['invoiceno' => $arr1]);
        }
        // dd($val);
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

            Mail::send([], [], function ($message) use (
                $appName,
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $com_name,
                $acc,
            ) {
                $message->to($founderEmail)
                    ->cc([$managerMail])
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject("Update Payment Entry Details")
                    ->html(' <html><title></title><head></head>   <body> <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Updated Payment Entry Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hi Sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Payment Entry Details</p></td></tr><tr><td style="width:200px;padding:4px 0"> Company Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0"> Date:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->paydate . '</td></tr>
		<tr><td style="width:200px;padding:4px 0"> Amount:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->payamount . '</td></tr><tr><td style="width:200px;padding:4px 0"> Bank Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->bankname . '</td></tr>
		<tr><td style="width:200px;padding:4px 0"> Cheque Number:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->chequeno . '</td></tr><tr><td style="width:200px;padding:4px 0">NEFT/RTGS No:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->neftnumber . '</td></tr>
		<tr><td style="width:200px;padding:4px 0">Product/Service:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->productservice . '</td></tr><tr><td style="width:200px;padding:4px 0">Account Manager:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $acc . '</td></tr><tr><td style="width:200px;padding:4px 0">Comments:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->comment . '</td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>
                    ');
            });

            // Success message and response
            session()->flash('secmessage', 'Payment Details Updated Successfully');
            return response()->json(['status' => 1, 'message' => 'Payment Details Updated Successfully'], 200);
        }
    }


    public function searchpayment(Request $request){
        // dd($request->all());
        $daterange = explode(' - ', $request->daterange);
        $start_date = date('Y-m-d', strtotime($daterange[0]));
        $end_date = date('Y-m-d', strtotime($daterange[1]));
        
        $data = DB::table('payment_list')
        ->select(DB::raw("SUM(REPLACE(REPLACE(REPLACE(payamount, ',', ''), '/', ''), '-', '')) as payamount"))
        ->where('company_name', $request->companyname)
        ->whereBetween('paydate', [$start_date, $end_date])
        ->get();
    
        
        $payment = number_format((float)$data[0]->payamount, 2, '.', ',')  ?? 0; // fallback to 0 if null
        
        return response()->json(['payment' => $payment]);

    }


}
