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

class Content extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            if (request()->session()->get('content_status') == "") {
                request()->session()->put('content_status', 'Open');
            }

            if (isset($request->status) && !empty($request->status)) {
                request()->session()->put('content_status', $request->status);
            }


            $data = DB::table('content_wip as p')
                ->join('accounts as a', 'a.id', '=', 'p.client_id')
                ->select(
                    'p.*',
                    'p.id as pid',
                    'p.assignedto as assigned_to',
                    'a.company_name',
                    'a.id as aid'
                )
                ->when(request()->session()->get('content_status') != 'Closed', function ($query) {
                    return $query->where('p.task_status', '!=', 'Closed');
                }, function ($query) {
                    return $query->where('p.task_status', 'Closed');
                })
                ->orderBy('p.id', 'desc')
                ->get();



            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->aid]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('date', function ($row) {
                    return $row->start_date . '/' . $row->enddate;
                })
                ->addColumn('status', function ($row) {
                    $taskStatus = $row->task_status; // Access design_status from the $row object

                    if (in_array($taskStatus, ['Started', 'Not yet started', 'Completed'])) {
                        return '
                           <div>
                             <select name="design_status" class="paymentstatus" data-id="' . $row->pid . '">
                                    <option value="">Select From List</option>
                                    <option value="Not yet started" ' . ($taskStatus == 'Not yet started' ? 'selected' : '') . '>Not yet Started</option>
                                    <option value="Started" ' . ($taskStatus == 'Started' ? 'selected' : '') . '>Started</option>
                                    <option value="Completed" ' . ($taskStatus == 'Completed' ? 'selected' : '') . '>Completed</option>
                                    <option value="Closed" ' . ($taskStatus == 'Closed' ? 'selected' : '') . '>Closed</option>
                                </select>
                                <button class="btn btn-modal taskestatus" data-id="' . $row->pid . '">update</button>
                            </div>';
                    } elseif ($taskStatus == 'Completed') {
                        return '<p style="font-size:10px;color: #2fade7;font-weight: 800;text-align: center;">Date: ' . e($row->completed_date) . '</p>';
                    } else {
                        return '<p style="font-size:10px;color: #2fade7;font-weight: 800;text-align: center;">' . ucfirst($taskStatus) . ' Date: ' . e($row->closed_date) . '</p>';
                    }
                })

                ->rawColumns(['sno', 'status', 'companyname', 'date'])
                ->make(true);
        }

        return view('content.index');
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

        $regis = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->pluck('fname', 'empid');

        $mail = DB::table('regis')
            ->where('status', '=', '1')
            ->where('fname', '!=', 'Appac')
            ->where('id', '!=', '2')
            ->where('id', '!=', '3')
            ->orderBy('fname', 'ASC')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'emailid');

        $marketing = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->where('dept_id', '=', '6')
            ->pluck('fname', 'empid');

        $promotion = DB::table('regis')
            ->where('status', '!=', '0')
            ->where('fname', '!=', 'demo')
            ->where('dept_id', '=', '4')
            ->pluck('fname', 'empid');

        return view('content/create', compact('accounts', 'regis', 'mail', 'marketing', 'promotion'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id', 
            'marketing_person' => 'required|exists:regis,empid', 
            'promotion_person' => 'required|exists:regis,empid', 
            'assignedto' => 'required|exists:regis,empid', 
            'task_status' => 'required|in:Not yet started,Started,Completed', 
            'start_date' => 'nullable|date', 
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'files.*' => 'nullable|file|mimes:xlsx,xls,doc,docx|max:5120', 
            'project_description' => 'nullable|string|max:1000', 
            'mail_cc' => 'nullable|array', 
            'mail_cc.*' => 'email', 
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'client_id' => $request->company_name,
            'promotion_person' => $request->promotion_person,
            'marketing_person' => $request->marketing_person,
            'assignedto' => $request->assignedto,
            'task_status' => $request->task_status,
            'start_date' => date('d-m-Y', strtotime($request->start_date)),
            'enddate' => date('d-m-Y', strtotime($request->enddate)),
            'project_description' => $request->project_description,
            'created_by' => request()->session()->get('empid'),
            'create_date' => date('d-m-Y h:i:s a', time()),
            'mail_cc' => json_encode($request->mail_cc),
        ];

        $insert = DB::table('content_wip')->insertGetId($val);

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
                $uploadDir = 'uploaddoc' . DIRECTORY_SEPARATOR;
                $filePath = $uploadDir . $fileName;
                if (file_exists(public_path($filePath))) {
                    $fileName = time() . '_' . $fileName;
                    $filePath = $uploadDir . $fileName;
                }

                // Move the file to the upload directory
                if ($file->move(public_path($uploadDir), $fileName)) {
                    // Insert into the database
                    DB::table('pro_doc')->insert([
                        'cid' => $insert, // Assuming $insert contains the related promotion_wip ID
                        'document' => $fileName
                    ]);
                } else {
                    echo "Error uploading {$fileName}.<br />";
                }
            }
        }

        if ($insert) {

            $fquery1 = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();
            $fname = $fquery1->fname;
            $lname = $fquery1->lname;

            $afquery1 = DB::table('regis')->where('empid', $request->assignedto)->first();
            $afname = $afquery1->fname;
            $alname = $afquery1->lname;
            $cmailid = $afquery1->emailid;

            $mperson1 = DB::table('regis')->where('empid', $request->marketing_person)->first();
            $mmailid = $mperson1->emailid;
            $mfname = $mperson1->fname;
            $mlname = $mperson1->lname;

            $pperson1 = DB::table('regis')->where('empid', $request->promotion_person)->first();
            $pmailid = $pperson1->emailid;
            $pfname = $pperson1->fname;
            $plname = $pperson1->lname;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $htmlContent = '<html><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Content Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear ' . $afname . ' ' . $alname . ', </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left">Updated Through CRM Portal</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">Start Date - End Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . ' / ' . $request->end_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Task Status</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->task_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $pfname . " " . $plname . '</td></tr><tr><td style="width:200px;padding:4px 0">Marketing Person:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $mfname . " " . $mlname . '</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');

            // Mail::send([], [], function ($message) use (
            //     $request,
            //     $founderEmail,
            //     $managerMail,
            //     $bccEmail,
            //     $infoMail,
            //     $fquery1,
            //     $com_name,
            //     $htmlContent,
            //     $cmailid,
            // ) {
            //     $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
            //     $message->to($founderEmail, $managerMail)
            //         ->cc(array_merge([$cmailid], $ccEmails))
            //         ->bcc($bccEmail)
            //         ->from($infoMail, $fquery1->fname . ' ' . $fquery1->lname)
            //         ->subject($com_name . " Content Status "  . now()->format('d-m-Y'))
            //         ->html($htmlContent);
            // });

            session()->flash('secmessage', 'Design Details Created Successfully');
            return response()->json(['status' => 1, 'message' => 'Design Details Created Successfully'], 200);
        }
    }

    public function contentstatus(Request $request)
    {

        $data = [
            'task_status' => $request->status,
        ];

        // Add additional fields based on the status
        if ($request->status == 'Started') {
            $data['start_date'] = now()->format('d-m-Y');
        } elseif ($request->status == 'Completed') {
            $data['completed_date'] = now()->format('d-m-Y');
            $data['completed_by'] = request()->session()->get('empid');
        } elseif ($request->status == 'Closed') {
            $data['closed_date'] = now()->format('d-m-Y');
            $data['closed_by'] = request()->session()->get('empid');
        }

        // Update the record in the database
        DB::table('content_wip')
            ->where('id', $request->id)
            ->update($data);

        session()->flash('secmessage', 'Status Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Status Updated Successfully'], 200);
    }
}
