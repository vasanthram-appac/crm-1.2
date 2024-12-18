<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use DB;

class Celebration extends Controller
{

    public function index(Request $request)
    {

        if (request()->ajax()) {
            $idValue = date('m-Y');
            $currentYear = date('Y');
            $data = DB::table('calendar')
            ->where('calyear', 'like', $currentYear . '%')
            ->orderBy('id', 'asc')
            ->get();

            // $year = date('Y');

            // foreach ($data as $key => $day) {
            //     $day->smonth1 = $day->datelist_one;
            //     $day->sdate1 = date("d-m", strtotime($day->sdate)); // Format as 'd-m'
            //     $day->day = $day->sdate1 . '-' . $year; // Combine formatted date with current year

            //     // Determine active status
            //     $day->active = ($day->datelist_one == $idValue) ? 'active' : '';
            // }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->rawColumns(['sno'])
                ->make(true);
        }

        $user = DB::table('regis')->where('status', 1)->get();
        $birthdayResults = [];
        $today = date("d-m-Y");
        $thismonth = date("m", strtotime($today));
        $nextmonth = date('m', strtotime('+1 month')); // Next month number

        foreach ($user as $uaer1) {
            $birthdayData = DB::table('personalprofile')
                ->where('empid', $uaer1->empid)
                ->orderBy('dob', 'DESC')
                ->get();

            foreach ($birthdayData as $query1_data) {
                $dobm = date('m', strtotime($query1_data->dob)); // Month of birthday
                $dob = date('d-m', strtotime($query1_data->dob)); // Birthdate formatted (Day-Month)
                $today1 = date("d-m"); // Current date (Day-Month)
                $birthdayStatus = '';

                // Check if birthday is in the current month
                 if ($thismonth == $dobm && $today1 < $dob) {
                    $birthdayStatus = '<span style="font-size: 11px;padding: 2px 10px; margin-bottom: 0;border:1px solid #D68A00; border-radius: 3px; color: #D68A00; background-color: #FFF3DD;">Coming Birthday</span>';
                } elseif ($dobm == $nextmonth) {
                    $birthdayStatus = '<span style="font-size: 11px; background-color: #e91e6338;color: #E91E63; padding: 2px  10px;border:1px solid #E91E63;border-radius:3px;">Next Month</span>';
                }

                // Store data for the view
                $birthdayResults[] = [
                    'fname' => $query1_data->fname,
                    'dob' => $query1_data->dob,
                    'status' => $birthdayStatus
                ];
            }
        }

         // Get the two-digit year, e.g., "23" for 2023


        // dd($birthdayResults);

        // Pass the data to the view
        return view('celebration.index', compact('birthdayResults'));
    }
}
