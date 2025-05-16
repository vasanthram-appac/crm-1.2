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

class Serverdetails extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }


        $email = DB::table('emailserver')->count();

        $hosting = DB::table('hosting')->count();

        $ssl = DB::table('ssl_certificate')->count();

        $domain = DB::table('domain')->count();

        $seo = DB::table('seo_client')->count();

        $plans = DB::table('plans')->count();

        return view('serverdetails/index')->with(compact('email', 'hosting', 'ssl', 'domain', 'seo', 'plans'))->render();
    }
  
}