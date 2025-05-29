<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DateTime;
use DB;

class Usermodule extends Controller
{

    public function index(Request $request)
    {
        $currentYear = date('Y-04-01');

        $employee = DB::table('regis')->where('status',1)->count();

        $leaveapproved = DB::table('leaverecord')->whereRaw("STR_TO_DATE(leavedate, '%Y-%m-%d') >= ?", [$currentYear])->where('leavestatus','Approved')->count();

        $payslip = DB::table('emp_payslip')->count();

        $leave = DB::table('leaverecord')->whereRaw("STR_TO_DATE(leavedate, '%Y-%m-%d') >= ?", [$currentYear])->where('empid', request()->session()->get('empid'))->where('leavestatus','Approved')->count();

        $user = DB::table('regis')->select('fname','empid')->where('empid', request()->session()->get('empid'))->where('status',1)->first();

        $calendar = DB::table('calendar')->where('calyear', date('Y'))->count();

        return view('usermodule/index')->with(compact('employee','leaveapproved','payslip','leave','user' ,'calendar'))->render();
    }

}