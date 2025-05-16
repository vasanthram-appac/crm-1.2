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

class Payments extends Controller
{

    public function index(Request $request)
    {

        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }

        $invoice = DB::table('invoicedetails')->count();

        $proforma = DB::table('proformadetails')->count();

        $payment = DB::table('payment_list')->count();

        $leads = DB::table('leads')->count();

        $opportunity = DB::table('opportunity')->count();

        $active = DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'active')->orderBy('accounts.id', 'ASC')->count();

        $inactive = DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'inactive')->orderBy('accounts.id', 'ASC')->count();

        $download = DB::table('accounts')->where('status', '!=', '0')->where('download_status', 'Download')->orderBy('accounts.id', 'ASC')->count();

        $keyaccount = DB::table('accounts')->where('status', '!=', '0')->where('active_status', 'active')->where('key_status', 1)->orderBy('accounts.id', 'ASC')->count();

        $dmworks = DB::table('dmworks')->count();

        $newnbd = DB::table('newnbd')->count();

        $assetlibrary = DB::table('assetlibrary')->count();

        $requiredinput = DB::table('requiredinput')->count();

        return view('payments/index')->with(compact('invoice', 'proforma', 'payment', 'leads', 'opportunity', 'active', 'inactive', 'keyaccount', 'download','dmworks','newnbd','assetlibrary', 'requiredinput'))->render();
    }
}
