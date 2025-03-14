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

class Applyleave extends Controller
{

    public function index(Request $request)
    {

        if (request()->ajax()) {

            $currentYear = date('Y');
            $currentMonth = date('m');

            if ($currentMonth == 1 || $currentMonth == 2 || $currentMonth == 3) {
                $academicStart = ($currentYear - 1) . "-04-01"; // April 1st of the previous year
                $academicEnd = "$currentYear-03-31"; // March 31st of the current year
            } else { // For other months
                $academicStart = "$currentYear-04-01"; // April 1st of the current year
                $academicEnd = ($currentYear + 1) . "-03-31"; // March 31st of the next year
            }

            // Execute the query
            $data = DB::table('leaverecord')
                ->whereBetween('leavedate', [$academicStart, $academicEnd])
                ->where('empid', request()->session()->get('empid'))
                ->orderByDesc('id')
                ->get();

            if (count($data) > 0) {
                $leaveTypes = [
                    '0' => 'Permission',
                    '1' => 'Compensatory leave',
                    '2' => 'WFH leave',
                    '3' => 'Half day leave',
                    '4' => 'Leave',
                    '5' => 'Casual leave',
                    '6' => 'Sick leave',
                ];

                foreach ($data as $datal) {
                    $datal->leavetype = $leaveTypes[$datal->leavetype] ?? $datal->leavetype; // Default to original if not found
                }
            }
            // dd($data);

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('leavestatus', function ($row) {
                    switch ($row->leavestatus) {
                        case 'Pending':
                            return "<p style='padding: 5px 15px 6px;margin-bottom: 0;border-radius: 5px;color: #D68A00;background-color: #FFF3DD;'>{$row->leavestatus}</p>";
                        case 'Approved':
                            return "<p style='padding: 5px 15px 6px;margin-bottom: 0;border-radius: 5px;color: #38A800;background-color: #F6FFF1;'>{$row->leavestatus}</p>";
                        case 'Not Approved':
                        case 'Cancelled':
                            return "<p style='padding: 5px 15px 6px;margin-bottom: 0;border-radius: 5px;color: #F41B1B;background-color: #FFF0F0;'>{$row->leavestatus}</p>";
                        default:
                            return $row->leavestatus;
                    }
                })

                // ->addColumn('action', function ($row) {

                //         return '<button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i></button>';

                // })

                ->rawColumns(['sno', 'leavestatus', 'action'])
                ->make(true);
        }

        $employeeId = request()->session()->get('empid');

        $currentYear = date('Y');
        $currentMonth = date('m');

        if ($currentMonth == 1 || $currentMonth == 2 || $currentMonth == 3) {
            $academicStart = ($currentYear - 1) . "-04-01"; // April 1st of the previous year
            $academicEnd = "$currentYear-03-31"; // March 31st of the current year
        } else { // For other months
            $academicStart = "$currentYear-04-01"; // April 1st of the current year
            $academicEnd = ($currentYear + 1) . "-03-31"; // March 31st of the next year
        }

        // Fetch monthly leave breakdown
        $monthlyLeaves = DB::table('leaverecord')->selectRaw('MONTH(leavedate) as month, 
                SUM(CASE WHEN leavetype = 1 THEN noofdays ELSE 0 END) as compensate,
                SUM(CASE WHEN leavetype = 2 THEN noofdays ELSE 0 END) as WFH,
                SUM(CASE WHEN leavetype = 3 THEN noofdays ELSE 0 END) as halfday,
                SUM(CASE WHEN leavetype = 4 THEN noofdays ELSE 0 END) as lop,
                SUM(CASE WHEN leavetype = 5 THEN noofdays ELSE 0 END) as casual,
                SUM(CASE WHEN leavetype = 6 THEN noofdays ELSE 0 END) as sick')
            ->where('empid', $employeeId)
            ->where('leavestatus', 'Approved')
            ->whereBetween('leavedate', [$academicStart, $academicEnd])
            ->groupByRaw('MONTH(leavedate)')
            ->orderByRaw('MONTH(leavedate)')
            ->get();
        // dd($monthlyLeaves);

        // Calculate total leaves taken in the year
        $totalLeavesTaken = DB::table('leaverecord')->where('empid', $employeeId)
            ->where('leavestatus', 'Approved')
            ->whereBetween('leavedate', [$academicStart, $academicEnd])
            ->sum('noofdays');

        // Casual and sick leave remaining calculations (assuming max 6 per type)

        $userdetails = DB::table("personalprofile")
            ->select("doj")
            ->where('empid', $employeeId)
            ->first();

        if ($userdetails && !empty($userdetails->doj)) {
            $doj = $userdetails->doj;

            // Extract year and month from DOJ
            list($dojYear, $dojMonth, $dojDay) = explode('-', $doj);

            // Get current year and month manually
            $currentYear = date('Y');
            $currentMonth = date('m');
            
            // Calculate months difference manually
            $dataleave = ($currentYear - $dojYear) * 12 + ($currentMonth - $dojMonth) + 1;

            // Check if DOJ falls within the academic year
            if ($doj >= $academicStart) {
                if ($dataleave < 12) {
                    if ($dataleave % 2 == 0) {
                        // Even months
                        $maxCasual = $dataleave / 2;
                        $SickLeaves = $dataleave / 2;
                    } else {
                        // Odd months
                        $maxCasual = ceil($dataleave / 2);
                        $SickLeaves = floor($dataleave / 2);
                    }
                } else {
                    $maxCasual = 6;
                    $SickLeaves = 6;
                }
            } else {
                $maxCasual = 6;
                $SickLeaves = 6;
            }
        } else {
            $maxCasual = 6;
            $SickLeaves = 6;
        }

        $casualLeavesTaken = DB::table('leaverecord')->where('empid', $employeeId)
            ->where('leavestatus', 'Approved')
            ->where('leavetype', 5)
            ->whereBetween('leavedate', [$academicStart, $academicEnd])
            ->sum('noofdays');
        $remainingCasualLeaves = max($maxCasual - $casualLeavesTaken, 0);

        $sickLeavesTaken = DB::table('leaverecord')->where('empid', $employeeId)
            ->where('leavestatus', 'Approved')
            ->where('leavetype', 6)
            ->whereBetween('leavedate', [$academicStart, $academicEnd])
            ->sum('noofdays');
        $remainingSickLeaves = max($SickLeaves - $sickLeavesTaken, 0);

        return view('applyleave.index', compact('monthlyLeaves', 'totalLeavesTaken', 'remainingCasualLeaves', 'remainingSickLeaves', 'currentYear'));
    }

    public function create()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        if ($currentMonth == 1 || $currentMonth == 2 || $currentMonth == 3) {
            $academicStart = ($currentYear - 1) . "-04-01"; // April 1st of the previous year
            $academicEnd = "$currentYear-03-31"; // March 31st of the current year
        } else { // For other months
            $academicStart = "$currentYear-04-01"; // April 1st of the current year
            $academicEnd = ($currentYear + 1) . "-03-31"; // March 31st of the next year
        }

        $casual = DB::table('leaverecord')
            ->select(DB::raw('EXTRACT(month FROM leavedate) as Month'), DB::raw('count(*) as count1'), DB::raw('SUM(noofdays) as noday1'))
            ->where('empid', request()->session()->get('empid')) // Use Laravel's session helper to get the empid
            ->where('leavestatus', 'Approved')
            ->whereBetween('leavedate', [$academicStart, $academicEnd]) // Use whereYear for year comparison
            ->where('leavetype', 5) // Assuming '5' is Casual Leave
            ->groupBy(DB::raw('EXTRACT(month FROM leavedate)'))
            ->orderBy(DB::raw('EXTRACT(month FROM leavedate)'))
            ->get();

        $sick = DB::table('leaverecord')
            ->select(DB::raw('EXTRACT(month FROM leavedate) as Month'), DB::raw('count(*) as count1'), DB::raw('SUM(noofdays) as noday1'))
            ->where('empid', request()->session()->get('empid')) // Use Laravel's session helper to get the empid
            ->where('leavestatus', 'Approved')
            ->whereBetween('leavedate', [$academicStart, $academicEnd]) // Use whereYear for year comparison
            ->where('leavetype', 6) // Assuming '5' is Casual Leave
            ->groupBy(DB::raw('EXTRACT(month FROM leavedate)'))
            ->orderBy(DB::raw('EXTRACT(month FROM leavedate)'))
            ->get();


        $userdetails = DB::table("personalprofile")
            ->select("doj")
            ->where('empid', request()->session()->get('empid'))
            ->first();

        if ($userdetails && !empty($userdetails->doj)) {
            $doj = $userdetails->doj;
            // Extract year and month from DOJ
            list($dojYear, $dojMonth, $dojDay) = explode('-', $doj);

            // Get current year and month manually
            $currentYear = date('Y');
            $currentMonth = date('m');
            
            // Calculate months difference manually
            $dataleave = ($currentYear - $dojYear) * 12 + ($currentMonth - $dojMonth) + 1;

            if ($doj >= $academicStart) {
                
            if ($dataleave < 12) {

                if ($dataleave % 2 == 0) {
                    // Even months
                    $maxCasual = $dataleave / 2;
                    $SickLeaves = $dataleave / 2;

                    if ($maxCasual > $casual->sum('noday1')) {
                        $casual = $casual->sum('noday1');
                    } else {
                        $casual = 6;
                    }

                    if ($SickLeaves > $sick->sum('noday1')) {
                        $sick = $sick->sum('noday1');
                    } else {
                        $sick = 6;
                    }
                } else {
                    // Odd months
                    $maxCasual = ceil($dataleave / 2);
                    $SickLeaves = floor($dataleave / 2);

                    if ($maxCasual > $casual->sum('noday1')) {
                        $casual = $casual->sum('noday1');
                    } else {
                        $casual = 6;
                    }

                    if ($SickLeaves > $sick->sum('noday1')) {
                        $sick = $sick->sum('noday1');
                    } else {
                        $sick = 6;
                    }
                }
            } else {
                $casual = $casual->sum('noday1');
                $sick = $sick->sum('noday1');
            }
        } else {
            $casual = $casual->sum('noday1');
            $sick = $sick->sum('noday1');
        }


        } else {
            $casual = $casual->sum('noday1');
            $sick = $sick->sum('noday1');
        }



        return view('applyleave/create', compact('casual', 'sick'))->render();
    }

    public function store(Request $request)
    {

        $rules = [
            'leavetype' => 'required',
        ];

        switch ($request->leavetype) {
            case '1': // Compensate
                $rules = array_merge($rules, [
                    'cleavedate' => 'required|date',
                    'cleavedatetill' => 'required|date|after_or_equal:cleavedate',
                ]);
                break;
            case '0': // Permission
                $rules = array_merge($rules, [
                    'pleavedate' => 'required|date',
                    'fromtime' => 'required|date_format:H:i',
                    'totime' => 'required|date_format:H:i|after:fromtime',
                ]);
                break;
            case '2': // WFH
            case '4': // Unpaid
            case '5': // Casual
            case '6': // Sick
                $rules = array_merge($rules, [
                    'leavedate' => 'required|date',
                    'leavedatetill' => 'required|date|after_or_equal:leavedate',
                ]);
                break;
            case '3': // Half Day
                $rules = array_merge($rules, [
                    'hleavedate' => 'required|date',
                    'half' => 'required|in:1,2',
                ]);
                break;
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());
        $employee = request()->session()->get('fname');
        $empid = request()->session()->get('empid');
        $dateofapplication = now()->format('F j, Y, g:i a T');
        $leavetype = $request->leavetype;
        $reason = $request->reason;


        $leavedate = null;
        $leavedatetill = null;
        $noofdays = null;
        $fromtime = null;
        $totime = null;
        $half = null;


        switch ($leavetype) {
            case '1': // Compensate
                $leavedate = $request->cleavedate;
                $leavedatetill = $request->cleavedatetill;
                $noofdays = 1;
                break;
            case '0': // Permission
                $leavedate = $request->pleavedate;
                $leavedatetill = $request->pleavedate;
                $fromtime = $request->fromtime;
                $totime = $request->totime;
                $noofdays = 0;
                break;
            case '2': // WFH
            case '4': // Unpaid
            case '5': // Casual
            case '6': // Sick
                $leavedate = $request->leavedate;
                $leavedatetill = $request->leavedatetill;
                $diff = abs(strtotime($leavedatetill) - strtotime($leavedate));
                $noofdays = round($diff / (60 * 60 * 24) + 1);
                break;
            case '3': // Half Day
                $leavedate = $request->hleavedate;
                $leavedatetill = $request->hleavedate;
                $noofdays = 0.5;
                $half = $request->half;
                break;
        }

        $converteddate1 = date("d-m-Y", strtotime($leavedate));
        $converteddate2 = date("d-m-Y", strtotime($leavedatetill));

        $emp_email = DB::table('regis')->select('dept_head', 'emailid')->where('empid', $empid)->first();
        $empemail = $emp_email->emailid;

        $bccEmail = env('SUPPORTMAIL');

        $head_mail = DB::table('regis')->select('emailid')->where('empid', $emp_email->dept_head)->first();
        if (!empty($head_mail)) {
            $heademail = $head_mail->emailid;
        } else {
            $heademail = $bccEmail;
        }
        $existingLeave = DB::table('leaverecord')
            ->where('empid', $empid)
            ->where('leavedate', $leavedate)
            ->where('leavedatetill', $leavedatetill)
            ->where('leavestatus', '!=', 'Approved')
            ->exists();

        if ($existingLeave) {
            session()->flash('secmessage', 'You have already applied for leave on these dates.');
            return response()->json(['status' => 0, 'message' => 'You have already applied for leave on these dates.'], 200);
        }

        $uleave = [
            'employee' => $employee,
            'empid' => $empid,
            'dateofapplication' => $dateofapplication,
            'leavedate' => $leavedate,
            'leavedatetill' => $leavedatetill,
            'noofdays' => $noofdays,
            'reason' => $reason,
            'leavestatus' => 'Pending', // Assuming 'Pending' is the default status
            'approvedby' => null, // You can update this field later after approval
            'approvaldate' => null, // You can update this field after approval
            'leavetype' => $leavetype,
            'fromtime' => $fromtime,
            'totime' => $totime,
        ];

        $insert = DB::table('leaverecord')->insert($uleave);

        if ($insert) {

            switch ($request->leavetype) {
                case '1':
                    $leavetypee = 'Compensatory leave';
                    $noofdays = '1';
                    break;
                case '2':
                    $leavetypee = 'Work from Home';
                    break;
                case '3':
                    $leavetypee = 'Half Day Leave';
                    break;
                case '4':
                    $leavetypee = 'Others Leave';
                    break;
                case '5':
                    $leavetypee = 'Casual Leave';
                    break;
                case '6':
                    $leavetypee = 'Sick Leave';
                    break;
                case '0':
                    $leavetypee = 'Permission';
                    break;
                default:
                    $leavetypee = 'Unknown Leave Type'; // Optional: handle any unexpected values
                    break;
            }

            $subject_details = "Reg: " . $leavetypee . " Request";

            $bccEmail = env('SUPPORTMAIL');
            $founderEmail = env('FOUNDERMAIL');
            $infoMail = env('INFOMAIL');
            $managerMail = env('MANAGERMAIL');
            $techAdminMail = env('TECHADMINMAIL');
            $infoMailCom = env('INFOMAILCOM');
            $appName = env('APP_NAME');

            Mail::send([], [], function ($message) use ($appName, $subject_details, $empemail, $infoMail, $employee, $leavetypee, $converteddate1, $converteddate2, $reason) {
                $message->to($empemail)

                    ->from($infoMail, $appName)
                    ->subject($subject_details)
                    ->html(
                        '<span style="margin-top:50px;"></span>' .
                            'Dear <b>' . $employee . '</b>,<br><br>' .
                            'Your ' . $leavetypee . ' Application is submitted successfully. You had applied leave from ' . $converteddate1 .
                            ' to ' . $converteddate2 . ' due to ' . $reason . '<br>'
                    );
            });

            $htmlContent = '<html><title>Application</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">' . $leavetypee . ' Request</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Applied through CRM Portal </p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody>
                                                    <tr>
                                                    <td style="width:200px;padding:4px 0">Employee Name:</td>
                                                    <td style="padding-right:10px"> : </td>
                                                    <td style="font-weight:normal"> ' . $employee . ' </td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">EMP ID</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $empid . ' </td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">Date of Apply	</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $dateofapplication . ' </td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">Leave Type	</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $leavetypee . '</td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">No of days Leave	</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $noofdays . '  Days</td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">Leave From</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $converteddate1 . ' </td>
                                                     </tr>';

            if ($leavetype == '0') {

                $htmlContent .= '<tr>
                                                     <td style="width:200px;padding:4px 0">Leave Time</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $fromtime . '-' . $totime . ' </td>
                                                     </tr>';
            }

            $htmlContent .=  '<tr>
                                                     <td style="width:200px;padding:4px 0">Leave Till</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $converteddate2 . ' </td>
                                                     </tr>
                                                     <tr>
                                                     <td style="width:200px;padding:4px 0">Reason for Leave	</td>
                                                     <td style="padding-right:10px"> : </td>
                                                     <td style="font-weight:normal"> ' . $reason . ' </td>
                                                     </tr>
                                                      <tr>
                                                     <td style="width:200px;padding:4px 0"></td>
                                                     <td style="padding-right:10px"></td>
                                                     <td style="font-weight:normal"></td>
                                                     </tr>
                                                      <tr>
                                                     <td style="width:200px;padding:4px 0"></td>
                                                     <td style="padding-right:10px">  </td>
                                                     <td style="font-weight:normal"> <a href="http://www.appacmediatech.com/leaveapproval" style="color: white;font-weight: bold;padding: 5px;text-decoration: none;background-color: #22c0cb;" >Status Update</a> </td>
                                                     </tr>
                                                     </tbody>
                                                     </table>
                                                     </td>
                                                     </tr>
                                                     </tbody>
                                                     </table>
                                                     </td>
                                                     </tr>
                                                     <tr>
                                                     <td style="margin:0;padding:15px 0">Note: Leave Approval will be done using CRM Access</td>
                                                     </tr>
                                                     </tbody>
                                                     </table>
                                                     </td>
                                                     </tr>
                                                     </tbody>
                                                     </table>
                                                     </body>
                                                     </html>';

            Mail::send([], [], function ($message) use ($appName, $bccEmail, $subject_details, $infoMail, $heademail, $founderEmail, $managerMail, $htmlContent) {
                $message->to($heademail)
                    ->cc([$managerMail, $founderEmail])
                    ->bcc($bccEmail)
                    ->from($infoMail, $appName)
                    ->subject($subject_details)
                    ->html($htmlContent);
            });
        }

        session()->flash('secmessage', 'Leave Applied Successfully!');
        return response()->json(['status' => 1, 'message' => 'Leave Applied Successfully!'], 200);
    }


    public function destroy($id)
    {
        DB::table('leaverecord')->where('id', $id)->delete();
        session()->flash('secmessage', 'Leave Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'Leave Deleted Successfully!'], 200);
    }
}
