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

        return view('payments/index')->with(compact('invoice', 'proforma', 'payment'))->render();
    }
  
}