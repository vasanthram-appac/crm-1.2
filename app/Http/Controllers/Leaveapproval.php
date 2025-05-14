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

class Leaveapproval extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1') {

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
                                return "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #D68A00; background-color: #FFF3DD;'>{$row->leavestatus}</p>";
                            case 'Approved':
                                return "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #38A800 ; background-color: #F6FFF1;'>{$row->leavestatus}</p>";
                            case 'Not Approved':
                            case 'Cancelled':
                                return "<p style='padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: #F41B1B; background-color: #FFF0F0;'>{$row->leavestatus}</p>";
                            default:
                                return $row->leavestatus;
                        }
                    })

                    ->addColumn('action', function ($row) {
                        if ($row->leavestatus == 'Pending') {
                            return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Leaveapproval::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					<span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i> 
					<span class="tooltiptext">delete</span>
					</button>';
                        } else {
                            return '
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i> <span class="tooltiptext">remove</span></button>';
                        }
                    })

                    ->rawColumns(['sno', 'leavestatus', 'action'])
                    ->make(true);
            }

            $currentYear = date('Y');
            $currentMonth = date('m');

            if ($currentMonth == 1 || $currentMonth == 2 || $currentMonth == 3) {
                $academicStart = ($currentYear - 1) . "-04-01"; // April 1st of the previous year
                $academicEnd = "$currentYear-03-31"; // March 31st of the current year
            } else { // For other months
                $academicStart = "$currentYear-04-01"; // April 1st of the current year
                $academicEnd = ($currentYear + 1) . "-03-31"; // March 31st of the next year
            }

            $employees = DB::table('regis')
                ->join('personalprofile', 'regis.empid', '=', 'personalprofile.empid')
                ->whereNotIn('regis.empid', ['AM001', 'AM002', 'admin'])
                ->where('regis.status', '1')
                ->select('regis.empid', 'personalprofile.fname', 'personalprofile.lname', 'personalprofile.doj')
                ->get();

            $leaveData = [];

            foreach ($employees as $employee) {
                $dojYear = date('Y', strtotime($employee->doj));
                $currentYear = date('Y');
                $currentMonth = ($dojYear == $currentYear)
                    ? date('m') - date('m', strtotime($employee->doj))
                    : date('m');

                $leaves = DB::table('leaverecord')
                    ->selectRaw("
                    SUM(CASE WHEN leavetype = '1' THEN noofdays END) as noday1,
                    SUM(CASE WHEN leavetype = '2' THEN noofdays END) as noday2,
                    SUM(CASE WHEN leavetype = '3' THEN noofdays END) as noday3,
                    SUM(CASE WHEN leavetype = '4' THEN noofdays END) as noday4,
                    SUM(CASE WHEN leavetype = '5' THEN noofdays END) as noday5,
                    SUM(CASE WHEN leavetype = '6' THEN noofdays END) as noday6
                ")
                    ->where('empid', $employee->empid)
                    ->where('leavestatus', 'Approved')
                    ->whereBetween('leavedate', [$academicStart, $academicEnd])
                    ->first();

                $totalLeaves = ($leaves->noday3 ?? 0) + ($leaves->noday4 ?? 0) + ($leaves->noday5 ?? 0) + ($leaves->noday6 ?? 0);
                $casualAvailable = 12 - ($leaves->noday5 ?? 0) - ($leaves->noday6 ?? 0) - ($leaves->noday3 ?? 0);

                $leaveData[] = [
                    'id' => $employee->empid,
                    'name' => $employee->fname,
                    'total' => $totalLeaves,
                    'casual' => $leaves->noday5 ?? 0,
                    'sick' => $leaves->noday6 ?? 0,
                    'half_day' => $leaves->noday3 ?? 0,
                    'available' => $casualAvailable
                ];
            }

            $year = $currentYear;
            return view('leaveapproval.index', compact('year', 'leaveData'));
        } else {
            return redirect()->to('/workreport');
        }
    }

    public function edit($id)
    {
        $leavemaster = DB::table('leavemaster')->pluck('leavestatus', 'leavestatus');

        $record = DB::table('leaverecord')->select('id', 'leavestatus')->find($id);

        return view('leaveapproval/edit', compact('leavemaster', 'record'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'leavestatus' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $selectrecord = DB::table('leaverecord')->find($id);
        $approvedby = request()->session()->get('fname');
        // dd(request()->session()->get('empid'));
        $val = [
            'leavestatus' => $request->leavestatus,
            'approvedby' => $approvedby,
            'approvaldate' => date("F j, Y, g:i a T"),
            'comments' => $request->comments
        ];

        $update = DB::table('leaverecord')->where('id', $id)->update($val);

        $emprecord = DB::table('regis')->where('empid', $selectrecord->empid)->first();

        $leaveTypes = [
            '0' => 'Permission',
            '1' => 'Compensatory leave',
            '2' => 'WFH leave',
            '3' => 'Half day leave',
            '4' => 'leave',
            '5' => 'Casual leave',
        ];

        $lt = isset($leaveTypes[$request->leavetype]) ? $leaveTypes[$request->leavetype] : '';

        $bccEmail = env('SUPPORTMAIL');
        $bccEmail = env('SUPPORTMAIL');
        $founderEmail = env('FOUNDERMAIL');
        $infoMail = env('INFOMAIL');
        $managerMail = env('MANAGERMAIL');
        $appName = env('APP_NAME');

        Mail::send([], [], function ($message) use ($appName, $infoMail, $managerMail, $founderEmail, $bccEmail, $lt, $request, $approvedby, $selectrecord, $emprecord) {
            $message->to($emprecord->emailid)
                ->cc([$managerMail, $founderEmail])
                ->bcc($bccEmail)
                ->from($infoMail, $appName)
                ->subject('Reg: Leave')
                ->html(
                    '<html><title>Application</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;border-bottom:5px solid #EAEAEA;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">LEAVE APPROVAL STATUS</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear ' . $selectrecord->employee . ', </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Approval through CRM Portal </p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="font-size:15px;width:200px;padding:4px 0;text-align:center;color:#1e96d3;" colspan="3">Your ' . $lt . ' has been ' . $request->leavestatus . ' for the date <br> from <span style="color:#000000;">' . $selectrecord->leavedate . '</span> till <span style="color:#000000;">' . $selectrecord->leavedatetill . '</span></td> </tr><tr><td style="font-size:15px;width:200px;padding:4px 0;text-align:center;color:#1e96d3;" colspan="3">Your leave is ' . $request->leavestatus . ' by <span style="color:#000000;">' . $approvedby . '</span></td></tr><tr><td style="font-size:15px;width:200px;padding:4px 0;text-align:center;color:#1e96d3;" colspan="3">Comments: ' . $request->comments . '</td></tr>
                    </tbody></table></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table></body></html>'
                );
        });

        session()->flash('secmessage', 'Leave Status Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Leave Status Updated Successfully.'], 200);
    }


    public function destroy($id)
    {

        DB::table('leaverecord')->where('id', $id)->delete();
        session()->flash('secmessage', 'Leave Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'Leave Deleted Successfully!'], 200);
    }
}
