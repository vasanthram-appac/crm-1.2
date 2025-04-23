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

class Wip extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if ($request->ajax()) {

// dd($request->all());

               if(empty(request()->session()->get('wip_status'))){
                request()->session()->put('wip_status','new');
               }

               if(isset($request->status) && !empty($request->status)){
                request()->session()->put('wip_status',$request->status);
               }
               
               $data = DB::table('work_wip as w')
               ->select(
                   'w.*',
                   'w.id as wid',
                   'a.company_name',
                   'a.id as aid'
               )
               ->join('accounts as a', 'a.id', '=', 'w.client_id');
           
           // Apply conditional logic based on the session value
           if (request()->session()->get('wip_status') == 'new') {
               $data->where('w.status', '=', '0')
                    ->where('w.wiptype', '=', '1');
           } elseif (request()->session()->get('wip_status') == 'existing') {
               $data->where('w.status', '=', '0')
                    ->where('w.wiptype', '=', '2');
           } else {
               $data->where('w.status', '=', '1');
           }
           
           // Complete the query
           $data = $data->orderBy('w.id', 'DESC')->get();

            foreach ($data as $wip) {

                 // $reports = DB::table('dailyreport')
                // ->where('client', $wip->aid)
                // ->orWhere('leadid', $wip->aid)
                // ->get();

                // $timeByDepartment = [
                //     '1' => ['hours' => 0, 'minutes' => 0], // Management
                //     '2' => ['hours' => 0, 'minutes' => 0], // Design
                //     '3' => ['hours' => 0, 'minutes' => 0], // Development
                //     '4' => ['hours' => 0, 'minutes' => 0], // Promotion
                //     '5' => ['hours' => 0, 'minutes' => 0], // Content
                //     '6' => ['hours' => 0, 'minutes' => 0], // Marketing
                // ];

                // foreach ($reports as $report) {
                //     $deptId = $report->dept_id;
                //     $startTime = strtotime($report->start_time);
                //     $endTime = strtotime($report->end_time);

                //     if ($startTime && $endTime && isset($timeByDepartment[$deptId])) {
                //         $dateDiff = intval(($endTime - $startTime) / 60); // Convert to minutes
                //         $hours = intval($dateDiff / 60);
                //         $minutes = $dateDiff % 60;

                //         // Add hours and minutes to the respective department
                //         $timeByDepartment[$deptId]['hours'] += $hours;
                //         $timeByDepartment[$deptId]['minutes'] += $minutes;
                //     }
                // }

                // // Convert minutes to hours for each department and format the result
                // foreach ($timeByDepartment as $deptId => $time) {
                //     $totalMinutes = $time['hours'] * 60 + $time['minutes'];
                //     $hours = intval($totalMinutes / 60);
                //     $minutes = $totalMinutes % 60;

                //     $timeByDepartment[$deptId]['formatted_time'] = sprintf('%d Hours %02d Minutes', $hours, $minutes);
                //     $timeByDepartment[$deptId]['decimal_time'] = sprintf('%d.%02d', $hours, $minutes);
                // }

                // // Access the formatted times for each department
                // $managementTime = $timeByDepartment['1']['formatted_time'];
                // $designTime = $timeByDepartment['2']['formatted_time'];
                // $developmentTime = $timeByDepartment['3']['formatted_time'];
                // $promotionTime = $timeByDepartment['4']['formatted_time'];
                // $contentTime = $timeByDepartment['5']['formatted_time'];
                // $marketingTime = $timeByDepartment['6']['formatted_time'];

                $reports = DB::table('dailyreport')
                ->where('worktype', 1)
                ->where('report_date1','>=', $wip->startdate)
                ->where('client', $wip->aid)
                ->orWhere('leadid', $wip->aid)
                ->get();

                $timeByDepartment = [
                    '3' => ['hours' => 0, 'minutes' => 0], // Management
                    '2' => ['hours' => 0, 'minutes' => 0], // Design
                ];

                foreach ($reports as $report) {
                    $deptId = $report->dept_id;
                    $startTime = strtotime($report->start_time);
                    $endTime = strtotime($report->end_time);

                    if ($startTime && $endTime && isset($timeByDepartment[$deptId])) {
                        $dateDiff = intval(($endTime - $startTime) / 60); // Convert to minutes
                        $hours = intval($dateDiff / 60);
                        $minutes = $dateDiff % 60;

                        // Add hours and minutes to the respective department
                        $timeByDepartment[$deptId]['hours'] += $hours;
                        $timeByDepartment[$deptId]['minutes'] += $minutes;
                    }
                }

                // Convert minutes to hours for each department and format the result
                foreach ($timeByDepartment as $deptId => $time) {
                    $totalMinutes = $time['hours'] * 60 + $time['minutes'];
                    $hours = intval($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                    $timeByDepartment[$deptId]['formatted_time'] = sprintf('%d Hours %02d Minutes', $hours, $minutes);
                    $timeByDepartment[$deptId]['decimal_time'] = sprintf('%d.%02d', $hours, $minutes);
                }

                // Access the formatted times for each department
                $wip->developmentTime = $timeByDepartment['3']['formatted_time'];
                $wip->designTime = $timeByDepartment['2']['formatted_time'];

                $developmentDecimal = floatval($timeByDepartment['3']['hours']) + ($timeByDepartment['3']['minutes'] / 60);
                $designDecimal = floatval($timeByDepartment['2']['hours']) + ($timeByDepartment['2']['minutes'] / 60);

                $totalDecimal = $developmentDecimal + $designDecimal;

                // Convert total decimal back to hours and minutes
                $totalMinutes = intval($totalDecimal * 60);
                $totalHours = intval($totalMinutes / 60);
                $totalRemainingMinutes = $totalMinutes % 60;
                
                $wip->totalTime = sprintf('%d Hours %02d Minutes', $totalHours, $totalRemainingMinutes);

                $datetime1 = date_create(date('d-m-Y', time()));
                $datetime2 = date_create($wip->startdate);
                // Calculates the difference between DateTime objects
                $interval = date_diff($datetime1, $datetime2);

                // Display the result
                $diff = $interval->format('%R%a');
                $diff1 = $interval->format('%a');
                //echo $diff;  
                if ($diff1 == 1) {
                    $dname = "Day";
                } else {
                    $dname = "Days";
                }
                if ($diff > 0) {
                    $wip->remainday1 = $diff1 . " " . $dname . " Remaining";
                } elseif ($diff == 0) {
                    $wip->remainday1 = 'Today is the day to Entry';
                } elseif ($diff < 0) {
                    $wip->remainday1 = "<p style='color:#000'><b>" . $diff1 . "</b> " . $dname . "</p>";
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->aid]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('remainday1', function ($row) {
                    return $row->remainday1;
                })
                ->addColumn('totalhours', function ($row) {
                    return '<die style="cursor: pointer;" onclick="viewalldetail(this)">' . $row->totalTime . '</div>' .
                           '<input type="hidden" name="development" value="' . $row->developmentTime . '">' .
                           '<input type="hidden" name="design" value="' . $row->designTime . '">';
                })                
                ->addColumn('url', function ($row) {
                    if (!empty($row->temp_url)) {
                        return '<a class="btn" href="' . htmlspecialchars($row->temp_url, ENT_QUOTES, 'UTF-8') . '" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                                <path class="clr-i-outline clr-i-outline-path-1" d="M30.4 17.6c-1.8-1.9-4.2-3.2-6.7-3.7c-1.1-.3-2.2-.5-3.3-.6c2.8-3.3 2.3-8.3-1-11.1s-8.3-2.3-11.1 1s-2.3 8.3 1 11.1c.6.5 1.2.9 1.8 1.1v2.2l-1.6-1.5c-1.4-1.4-3.7-1.4-5.2 0c-1.4 1.4-1.5 3.6-.1 5l4.6 5.4c.2 1.4.7 2.7 1.4 3.9c.5.9 1.2 1.8 1.9 2.5v1.9c0 .6.4 1 1 1h13.6c.5 0 1-.5 1-1v-2.6c1.9-2.3 2.9-5.2 2.9-8.1v-5.8c.1-.4 0-.6-.2-.7zm-22-9.4c0-3.3 2.7-5.9 6-5.8c3.3 0 5.9 2.7 5.8 6c0 1.8-.8 3.4-2.2 4.5v-5a3.4 3.4 0 0 0-3.4-3.2c-1.8-.1-3.4 1.4-3.4 3.2v5.2c-1.7-1-2.7-2.9-2.8-4.9zM28.7 24c.1 2.6-.8 5.1-2.5 7.1c-.2.2-.4.4-.4.7v2.1H14.2v-1.4c0-.3-.2-.6-.4-.8c-.7-.6-1.3-1.3-1.8-2.2c-.6-1-1-2.2-1.2-3.4c0-.2-.1-.4-.2-.6l-4.8-5.7c-.3-.3-.5-.7-.5-1.2c0-.4.2-.9.5-1.2c.7-.6 1.7-.6 2.4 0l2.9 2.9v3l1.9-1V7.9c.1-.7.7-1.3 1.5-1.2c.7 0 1.4.5 1.4 1.2v11.5l2 .4v-4.6c.1-.1.2-.1.3-.2c.7 0 1.4.1 2.1.2v5.1l1.6.3v-5.2l1.2.3c.5.1 1 .3 1.5.5v5l1.6.3v-4.6c.9.4 1.7 1 2.4 1.7l.1 5.4z" fill="#298ECD"></path>
                            </svg>
							<span class="tooltiptext">URL</span>
                        </a>';
                    }
                    return '';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Wip::class, 'edit'], [$row->wid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext">Edit</span>
                            </button> ';
                })
                ->rawColumns(['sno', 'remainday1', 'companyname', 'action', 'url', 'totalhours'])
                ->make(true);
        }

        return view('wip.index');
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

        $Client = DB::table('regis')
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

        return view('wip/create', compact('accounts', 'marketing', 'promotion', 'Client', 'mail'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'wiptype' => 'required|in:1,2',
            'company_name' => 'required|exists:accounts,id',
            'projectname' => 'required|string|max:255',
            'marketing_person' => 'required|exists:regis,empid',
            'promotion_person' => 'required|exists:regis,empid',
            'client_coordinate' => 'required|exists:regis,empid',
            'project_status' => 'nullable|in:On Board,Discovery,Design,Development,Content,Hosted,Others,Not yet started',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'eta' => 'required|numeric|min:0',
            'temp_url' => 'nullable',
            'project_description' => 'nullable|string',
            'mail_cc' => 'required|array|min:1',
            'mail_cc.*' => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());
        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'client_id' => $request->company_name,
            'projectname' => $request->projectname,
            'marketing_person' => $request->marketing_person,
            'promotion_person' => $request->promotion_person,
            'client_coordinate' => $request->client_coordinate,
            'startdate' => $request->start_date,
            'enddate' => $request->end_date,
            'description' => $request->project_description,
            'project_status' => $request->project_status,
            'eta' => $request->eta,
            'created_by' => request()->session()->get('empid'),
            'created_date' => date('d-m-Y h:i:s a', time()),
            'enquiry_month' => date("m-Y"),
            'temp_url' =>  $request->temp_url,
            'status' => '0',
            'wiptype' => $request->wiptype,
            'mail_cc' => json_encode($request->mail_cc)
        ];

        $insert = DB::table('work_wip')->insert($val);

        if ($insert) {
            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

            $fname = $fquery->fname;
            $lname = $fquery->lname;

            $mperson1 = DB::table('regis')->where('empid', $request->marketing_person)->first();
            $mmailid = $mperson1->emailid;
            $mfname = $mperson1->fname;
            $mlname = $mperson1->lname;

            $pperson1 = DB::table('regis')->where('empid', $request->promotion_person)->first();
            $pmailid = $pperson1->emailid;
            $pfname = $pperson1->fname;
            $plname = $pperson1->lname;

            $cperson1 = DB::table('regis')->where('empid', $request->client_coordinate)->first();
            $cmailid = $cperson1->emailid;
            $cfname = $cperson1->fname;
            $clname = $cperson1->lname;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $htmlContent = '<html>   <title>Work Order Details</title>   <head></head>   <body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">WIP Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> WIP details Updated Through CRM Portal</p> </td></tr> <tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"> <table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">WIP Start Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Project Status</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->project_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Marketing Person:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $mfname . " " . $mlname . '</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $pfname . " " . $plname . '</td></tr><tr><td style="width:200px;padding:4px 0">Client Co ordinate:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $cfname . " " . $clname . '</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Created By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname . " " . $lname . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

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
                $mmailid,
                $pmailid,
                $cmailid,

            ) {
                // Set recipients
                $ccEmails = is_array($request->mail_cc) ? $request->mail_cc : [];
                $message->to($founderEmail, $managerMail)
                    ->cc(array_merge([$mmailid, $pmailid, $cmailid], $ccEmails))
                    ->bcc($bccEmail)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject($com_name . " - WIP Status - "  . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'WIP Details Created');
            return response()->json(['status' => 1, 'message' => 'WIP Details Created'], 200);
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

        $Client = DB::table('regis')
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

        $workWip = DB::table('work_wip as w')
            ->join('accounts as a', 'a.id', '=', 'w.client_id')
            ->select('w.*', 'w.id as wid', 'a.company_name', 'a.id')
            ->where('w.id', '=', $id)
            ->first();
        if(!empty($workWip->mail_cc)){
        $reg = DB::table('regis')->whereIn('emailid', json_decode($workWip->mail_cc))->pluck('fname');
        }else{
            $reg = [];
        }
//    dd(count($reg));
        return view('wip/edit', compact('accounts', 'marketing', 'promotion', 'Client', 'mail', 'workWip', 'reg'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [

            'company_name' => 'required|exists:accounts,id',
            'projectname' => 'required|string|max:255',
            'marketing_person' => 'required|exists:regis,empid',
            'promotion_person' => 'required|exists:regis,empid',
            'client_coordinate' => 'required|exists:regis,empid',
            'project_status' => 'nullable|in:On Board,Discovery,Design,Development,Content,Hosted,Others,Not yet started',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'eta' => 'required|numeric|min:0',
            'temp_url' => 'nullable',
            'project_description' => 'nullable|string',
            // 'mail_cc' => 'required|array|min:1',
            // 'mail_cc.*' => 'email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());
        $project_description = str_replace(array("\r\n", "\r", "\n", "\\r", "\\n", "\\r\\n"), "<br/>", $request->project_description);

        $val = [
            'projectname' => $request->projectname,
            'marketing_person' => $request->marketing_person,
            'promotion_person' => $request->promotion_person,
            'client_coordinate' => $request->client_coordinate,
            'startdate' => $request->start_date,
            'enddate' => $request->end_date,
            'description' => $request->project_description,
            'project_status' => $request->project_status,
            'eta' => $request->eta,
            'updated_by' => request()->session()->get('empid'),
            'update_date' => date('d-m-Y h:i:s a', time()),
            'enquiry_month' => date("m-Y"),
            'temp_url' =>  $request->temp_url,
        ];

        if(!empty($request->mail_cc)){
            $val['mail_cc']=json_encode($request->mail_cc);
        }

        if($request->project_status=='Hosted' || $request->project_status=='Closed'){
            $val['status']=1;
        }
        // dd($id);
        $insert = DB::table('work_wip')->where('id',$id)->update($val);


        if ($insert) {
            $fquery = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

            $fname = $fquery->fname;
            $lname = $fquery->lname;

            $mperson1 = DB::table('regis')->where('empid', $request->marketing_person)->first();
            $mmailid = $mperson1->emailid;
            $mfname = $mperson1->fname;
            $mlname = $mperson1->lname;

            $pperson1 = DB::table('regis')->where('empid', $request->promotion_person)->first();
            $pmailid = $pperson1->emailid;
            $pfname = $pperson1->fname;
            $plname = $pperson1->lname;

            $cperson1 = DB::table('regis')->where('empid', $request->client_coordinate)->first();
            $cmailid = $cperson1->emailid;
            $cfname = $cperson1->fname;
            $clname = $cperson1->lname;

            $mcompany1 = DB::table('accounts')->where('id', $request->company_name)->first();
            $com_name = $mcompany1->company_name;

            $data=DB::table('work_wip')->where('id',$id)->first();
             
            if(!empty($data) && !empty($data->mail_cc)){
               $mail=json_decode($data->mail_cc);
            }else{
                $mail=array();
            }

             $htmlContent = '<html>   <title></title>   <head></head>   <body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Update WIP Status</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Team, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> WIP details Updated Through CRM Portal</p> </td></tr> <tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"> <table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Client Name:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $com_name . '</td></tr><tr><td style="width:200px;padding:4px 0">WIP Start Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->start_date . '</td></tr><tr><td style="width:200px;padding:4px 0">Project Status</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->project_status . '</td></tr><tr><td style="width:200px;padding:4px 0">Marketing Person:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $mfname ." ".$mlname .'</td></tr><tr><td style="width:200px;padding:4px 0">Promotion Person:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $pfname ." ".$plname .'</td></tr><tr><td style="width:200px;padding:4px 0">Client Co ordinate:</td> <td style="padding-right:10px"> :</td> <td style="font-weight:normal"> ' . $cfname ." ".$clname .'</td></tr><tr><td style="width:200px;padding:4px 0">Description</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $project_description . '</td></tr><tr><td style="width:200px;padding:4px 0">Updated By</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $fname ." ".$lname .'</td></tr><tr><td style="width:200px;padding:4px 0">Temp URL</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"><a href=" ' . $request->temp_url .'" target="blank">Click Here</a></td></tr>
							  </tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';		

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
                $mmailid,
                $pmailid,
                $cmailid,
                $mail,

            ) {
                // Set recipients
                $ccEmails = is_array($mail) ? $mail : [];
                $message->to($founderEmail, $managerMail)
                    ->cc(array_merge([$mmailid, $pmailid, $cmailid], $ccEmails))
                    ->bcc($bccEmail)
                    ->from($infoMail, $fquery->fname . ' ' . $fquery->lname)
                    ->subject($com_name . " - Updated WIP Details - "  . now()->format('d-m-Y'))
                    ->html($htmlContent);
            });

            // Success message and response
            session()->flash('secmessage', 'WIP Details Updated');
            return response()->json(['status' => 1, 'message' => 'WIP Details Updated'], 200);
        }else{
            session()->flash('secmessage', 'WIP Details Updated');
            return response()->json(['status' => 1, 'message' => 'WIP Details Updated'], 200);
        }
    }
}
