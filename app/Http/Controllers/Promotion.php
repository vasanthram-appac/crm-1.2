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

class Promotion extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('promotion_wip as p')
                ->join('accounts as a', 'a.id', '=', 'p.client_id')
                ->join('regis as r', 'r.empid', '=', 'p.promotion_person')
                ->select('p.*', 'p.id as pid', 'a.company_name', 'a.id as aid', 'r.fname', 'r.lname')
                ->orderByDesc('p.id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->aid]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('contract', function ($row) {
                    if ($row->contract == '') {
                        return "";  // Return "-" if contract is "-"
                    } else {
                        return '<b>' . $row->contract . ' Months</b> (' . $row->start_date . ' / ' . $row->enddate . ')'; // Return formatted contract details
                    }
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Promotion::class, 'edit'], [$row->pid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								 <span class="tooltiptext">Edit</span>
                            </button> ';
                })
                ->rawColumns(['sno', 'contract', 'companyname', 'action'])
                ->make(true);
        }

        return view('promotion.index');
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        $promotion = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->where('dept_id', '=', '4')
            ->pluck('fname', 'empid');

        $mail = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->where('id', '!=', '2')
            ->where('id', '!=', '3')
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        return view('promotion/create', compact('accounts', 'promotion', 'mail'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'promotion_person' => 'required|exists:regis,empid',
            'promotion_status' => 'required|in:Organic,Paid,Organic/Paid,Social Media,Retainer',
            'start_date' => 'required|date',
            'contract' => 'required|in:1,3,6,9,12',
            'files.*' => 'nullable|mimes:xlsx,xls,doc,docx|max:3072',
            'project_description' => 'nullable|string|max:1000',
            'mail_cc' => 'required|array',
            'mail_cc.*' => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());
        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'client_id' => $request->company_name,
            'promotion_person' => $request->promotion_person,
            'promotion_status' => $request->promotion_status,
            'contract' => $request->contract,
            'start_date' => date('d-m-Y', strtotime($request->start_date)),
            'enddate' => date('d-m-Y', strtotime("+" . $request->contract . " months", strtotime($request->start_date))),
            'project_description' => $request->project_description,
            'created_by' => request()->session()->get('empid'),
            'create_date' => date('d-m-Y h:i:s a', time()),
            'mail_cc' => json_encode($request->mail_cc),
        ];

        // dd($val);
        $insert = DB::table('promotion_wip')->insertGetId($val);


        if ($request->hasFile('files') && count($request->file('files')) > 0) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $allowedTypes = ['xlsx', 'xls', 'doc', 'docx'];
                $maxSize = 2 * 1024 * 1024; // 2MB in bytes

                // Validate file type
                if (!in_array(strtolower($fileExtension), $allowedTypes)) {
                    return response()->json([
                        'errors' => ["{$fileName} ({$fileExtension}) file type is not allowed."]
                    ], 422);
                }

                // Validate file size
                if ($fileSize > $maxSize) {
                    return response()->json([
                        'errors' => ["{$fileName} exceeds the maximum size limit of 2MB."]
                    ], 422);
                }

                // Generate a unique file name if a file with the same name exists
                $uploadDir = 'uploads/';
                $filePath = $uploadDir . $fileName;
                if (file_exists(public_path($filePath))) {
                    $fileName = time() . '_' . $fileName;
                    $filePath = $uploadDir . $fileName;
                }

                // Move the file to the upload directory
                if ($file->move(public_path($uploadDir), $fileName)) {
                    // Insert into the database
                    DB::table('pro_doc')->insert([
                        'pid' => $insert, // Assuming $insert contains the related promotion_wip ID
                        'document' => $fileName
                    ]);
                } else {
                    echo "Error uploading {$fileName}.<br />";
                }
            }
        }

        // dd($val);
        if ($insert) {
            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

            $fname = $fquery->fname;
            $lname = $fquery->lname;

            $pperson1 = DB::table('regis')->where('empid', $request->promotion_person)->first();
            $pmailid = $pperson1->emailid;
            $pfname = $pperson1->fname;
            $plname = $pperson1->lname;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $htmlContent = '<html><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Promotion Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Contract Period</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->contract . ' Months</td></tr><tr><td style="width:200px;padding:4px 0">Start Date - End Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . ' / ' . date('d-m-Y', strtotime("+" . $request->contract . " months", strtotime($request->start_date))) . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Type</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->promotion_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $pfname . " " . $plname . '</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';
            $htmlContent = '<html><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Promotion Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Contract Period</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->contract . ' Months</td></tr><tr><td style="width:200px;padding:4px 0">Start Date - End Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . ' / ' . date('d-m-Y', strtotime("+" . $request->contract . " months", strtotime($request->start_date))) . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Type</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->promotion_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $pfname . " " . $plname . '</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use (
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $fquery,
                $com_name,
                $htmlContent,
                $pmailid,

            ) {
                // Set recipients
                $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
                $message->to($founderEmail, $managerMail)
                    ->cc(array_merge([$pmailid], $ccEmails))
                    ->bcc($bccEmail)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject($com_name . " Promotion Status "  . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'Promotion Details Created Successfully');
            return response()->json(['status' => 1, 'message' => 'Promotion Details Created Successfully'], 200);
        }
    }

    public function edit($id)
    {

        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        $promotion = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->where('dept_id', '=', '4')
            ->pluck('fname', 'empid');

        $mail = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->where('id', '!=', '2')
            ->where('id', '!=', '3')
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        $promotionWip = DB::table('promotion_wip as p')
            ->join('accounts as a', 'a.id', '=', 'p.client_id')
            ->select('p.*', 'p.id as pid', 'a.company_name', 'a.id as account_id')
            ->where('p.id', $id)
            ->first();

        if(!empty($promotionWip->mail_cc)){
            $reg = DB::table('regis')->whereIn('emailid', json_decode($promotionWip->mail_cc))->pluck('fname');
            }else{
                $reg = [];
            }
// dd(count($reg));
        return view('promotion/edit', compact('accounts', 'promotion', 'mail','promotionWip'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'promotion_person' => 'required|exists:regis,empid',
            'promotion_status' => 'required|in:Organic,Paid,Organic/Paid,Social Media,Retainer',
            'start_date' => 'required|date',
            'contract' => 'required|in:1,3,6,9,12',
            'files.*' => 'nullable|mimes:xlsx,xls,doc,docx|max:3072',
            'project_description' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());
        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'client_id' => $request->company_name,
            'promotion_person' => $request->promotion_person,
            'promotion_status' => $request->promotion_status,
            'contract' => $request->contract,
            'start_date' => date('d-m-Y', strtotime($request->start_date)),
            'enddate' => date('d-m-Y', strtotime("+" . $request->contract . " months", strtotime($request->start_date))),
            'project_description' => $request->project_description,
            'created_by' => request()->session()->get('empid'),
            'update_date' => date('d-m-Y h:i:s a', time()),
        ];

        if(!empty($request->mail_cc)){
            $val['mail_cc']=json_encode($request->mail_cc);
        }

        // dd($val);
        $insert = DB::table('promotion_wip')->where('id', $id)->update($val);

        if ($request->hasFile('files') && count($request->file('files')) > 0) {
            foreach ($request->file('files') as $file) {
                $fileName = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                $fileSize = $file->getSize();
                $allowedTypes = ['xlsx', 'xls', 'doc', 'docx'];
                $maxSize = 2 * 1024 * 1024; // 2MB in bytes

                // Validate file type
                if (!in_array(strtolower($fileExtension), $allowedTypes)) {
                    return response()->json([
                        'errors' => ["{$fileName} ({$fileExtension}) file type is not allowed."]
                    ], 422);
                }

                // Validate file size
                if ($fileSize > $maxSize) {
                    return response()->json([
                        'errors' => ["{$fileName} exceeds the maximum size limit of 2MB."]
                    ], 422);
                }

                // Generate a unique file name if a file with the same name exists
                $uploadDir = 'uploads/';
                $filePath = $uploadDir . $fileName;
                if (file_exists(public_path($filePath))) {
                    $fileName = time() . '_' . $fileName;
                    $filePath = $uploadDir . $fileName;
                }

                // Move the file to the upload directory
                if ($file->move(public_path($uploadDir), $fileName)) {
                    // Insert into the database
                    DB::table('pro_doc')->insert([
                        'pid' => $id, // Assuming $insert contains the related promotion_wip ID
                        'document' => $fileName
                    ]);
                } else {
                    echo "Error uploading {$fileName}.<br />";
                }
            }
        }

        // dd($val);
        if ($insert) {
            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

            $fname = $fquery->fname;
            $lname = $fquery->lname;

            $pperson1 = DB::table('regis')->where('empid', $request->promotion_person)->first();
            $pmailid = $pperson1->emailid;
            $pfname = $pperson1->fname;
            $plname = $pperson1->lname;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $email = DB::table('promotion_wip')->select('mail_cc')->where('id', $id)->first();
            $mail=json_decode($email->mail_cc);
             $htmlContent = '<html><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Promotion Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Contract Period</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->contract . ' Months</td></tr><tr><td style="width:200px;padding:4px 0">Start Date - End Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . ' / '.date('d-m-Y', strtotime("+" . $request->contract . " months", strtotime($request->start_date))).'</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Type</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->promotion_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $pfname ." ".$plname .'</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname ." ".$lname .'</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use (
                $request,
                $founderEmail,
                $managerMail,
                $bccEmail,
                $infoMail,
                $fquery,
                $com_name,
                $htmlContent,
                $pmailid,
                $mail,
            ) {             
                // Set recipients
                $ccEmails = is_array($mail) ? $mail : [];
                $message->to($founderEmail, $managerMail)
                    ->cc(array_merge([$pmailid], $ccEmails))
                    ->bcc($bccEmail)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject($com_name . " Promotion Status "  . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'Promotion Details Updated Successfully');
            return response()->json(['status' => 1, 'message' => 'Promotion Details Updated Successfully'], 200);
        } else {
            session()->flash('secmessage', 'Promotion Details Updated Successfully');
            return response()->json(['status' => 1, 'message' => 'Promotion Details Updated Successfully'], 200);
        }
    }
}
