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

class Lead extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }

        $leads = DB::table('leads')->count();

        $opportunity = DB::table('opportunity')->count();

        $leadfollowup = DB::table('leads_history')->select('leads_history.*','leads.company_name')
        ->join('leads', 'leads_history.leads_id','=','leads.id')->where('followupdate',date('Y-m-d'))->orderby('id','desc')->get();

        return view('lead/index')->with(compact('leads', 'opportunity', 'leadfollowup'))->render();
    }
  
}