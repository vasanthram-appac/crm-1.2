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

class Userdashboard extends Controller
{

    public function index(Request $request)
    {
        // user profile
        $user = DB::table('regis')->select('id', 'fname', 'lname', 'mno', 'emptype', 'role', 'status', 'emailid', 'dept_id', 'empid', 'duration')->where('empid',request()->session()->get('empid'))->first();

        $profile = DB::table('personalprofile')->where('empid', $user->empid)->first();

        //active and inactive 
        $reportactive=DB::table('dailyreport')->where('empid',request()->session()->get('empid'))
        ->where('report_date',date('d-m-Y'))
        ->count();

       // last working day hours 
        $rep=DB::table('dailyreport')->select('report_date')->where('empid',request()->session()->get('empid'))
        ->orderBy('report_date1','DESC')->first();

        if(!empty($rep)){
           $resp=$rep->report_date;
        }else{
            $resp='';
        }
        
        $report = DB::table('dailyreport')
        ->join('work_type', 'dailyreport.worktype', '=', 'work_type.id') // Join on correct columns
        ->where('dailyreport.report_date', $resp)
        ->where('dailyreport.empid', request()->session()->get('empid'))
        ->where('dept_id', request()->session()->get('dept_id'))
        ->get();
    

         if (request()->session()->get('dept_id') == 3 ) {
            $totals = [
                0 => ['hours' => 0, 'mins' => 0, 'type' => 'Others'],
                1 => ['hours' => 0, 'mins' => 0, 'type' => 'WIP'],
                2 => ['hours' => 0, 'mins' => 0, 'type' => 'AMC'],
                3 => ['hours' => 0, 'mins' => 0, 'type' => 'SEO'],
            ];
        } else if(request()->session()->get('dept_id') == 2) {
            $totals = [
                0 => ['hours' => 0, 'mins' => 0, 'type' => 'Others'],
                1 => ['hours' => 0, 'mins' => 0, 'type' => 'POST'],
                2 => ['hours' => 0, 'mins' => 0, 'type' => 'S Post'],
                3 => ['hours' => 0, 'mins' => 0, 'type' => 'SEO'],
                4 => ['hours' => 0, 'mins' => 0, 'type' => 'WIP'],
                5 => ['hours' => 0, 'mins' => 0, 'type' => 'AMC'],
            ];
        }elseif(request()->session()->get('dept_id') == 4){
            $totals = [
                0 => ['hours' => 0, 'mins' => 0, 'type' => 'Others'],
                1 => ['hours' => 0, 'mins' => 0, 'type' => 'SEO'],
            ];
        }else{
            $totals = [
                0 => ['hours' => 0, 'mins' => 0, 'type' => 'Others'],
            ]; 
        }
    
        // Loop through the report and sum up the hours and minutes for each worktype
        if(count($report)){
        foreach ($report as $item) {
        
            $worktype = (int) $item->worktype;
            $hours = (int) $item->w_hours;
            $mins = (int) $item->w_mins;
    
            if (isset($totals[$worktype])) {
                $totals[$worktype]['hours'] += $hours;
                $totals[$worktype]['mins'] += $mins;
    
                // If minutes are greater than or equal to 60, convert them into hours
                if ($totals[$worktype]['mins'] >= 60) {
                    $extra_hours = floor($totals[$worktype]['mins'] / 60);
                    $totals[$worktype]['hours'] += $extra_hours;
                    $totals[$worktype]['mins'] = $totals[$worktype]['mins'] % 60;
                }
            }
        }
        }
        // Calculate total hours and minutes across all work types
        $totalHours = 0;
        $totalMins = 0;
        foreach ($totals as $type) {
            $totalHours += $type['hours'];
            $totalMins += $type['mins'];
        }
    
        // If total minutes exceed 60, convert them into hours
        if ($totalMins >= 60) {
            $extraHours = floor($totalMins / 60);
            $totalHours += $extraHours;
            $totalMins = $totalMins % 60;
        }
    
        // Add total hours and minutes to the totals array
        $totals['total'] = [
            'hours' => $totalHours,
            'mins' => $totalMins,
            'type' => 'Total'
        ];
   
    

    

// current month working hours
    $totalhours = DB::table('dailyreport')
    ->where('empid', request()->session()->get('empid'))
    ->where('report_date', 'like', '%'.date('m-Y').'%')
    ->selectRaw('SUM(w_hours) AS total_hours, SUM(w_mins) AS total_minutes, COUNT(*) AS totalcount')
    ->get();

    // dd();
  
    $totalMinutes = ($totalhours[0]->total_hours * 60) + $totalhours[0]->total_minutes;
    $hours = floor($totalMinutes / 60);
    $remainingMinutes = $totalMinutes % 60;
    

      //total task
        $task=DB::table('task_management')->where('empid',request()->session()->get('empid'))->count();


        //leave 

      

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

            $totalLeavesTaken = DB::table('leaverecord')->where('empid', request()->session()->get('empid'))
            ->where('leavestatus', 'Approved')
            ->whereBetween('leavedate', [$academicStart, $academicEnd])
            ->sum('noofdays');
    

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


        // Casual and sick leave remaining calculations (assuming max 6 per type)

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

        return view('userdashboard.index')->with(compact('user', 'profile', 'reportactive', 'task','totals','report','totalhours','hours','remainingMinutes','totalLeavesTaken','remainingCasualLeaves','remainingSickLeaves'));
    }

   

 
}
