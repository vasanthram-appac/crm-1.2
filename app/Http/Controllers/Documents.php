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

class Documents extends Controller
{

    public function index(Request $request)
    {
       
        $offer =  DB::table('offer_letter_pdf')->count();

        $web = DB::table('proposal_pdf')->count();

        $digital = DB::table('digital_proposal_pdf')->count();

        $rate = DB::table('ratecard')
        ->whereNotNull('empid')
        ->where('empid', '!=', '')
        ->count();

        return view('documents/index')->with(compact('offer', 'web', 'digital', 'rate'))->render();
    }
  
}