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

class Reports extends Controller
{

    public function index(Request $request)
    {
       
        $dailyreport =  DB::table('dailyreport')->where('empid', request()->session()->get('empid'))->whereYear('report_date1',date('Y'))->count();

        $empreport = DB::table('dailyreport')->whereYear('report_date1',date('Y'))->count();

        $enquiry=DB::connection('mysql_second')->table('website_enquiry_data')->where('flag_identity',1)->count();

        $notes = DB::table('notes')->count();

        return view('reports/index')->with(compact('dailyreport', 'empreport', 'enquiry', 'notes'))->render();
    }
  
}