<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DateTime;
use DB;

class Revenue extends Controller
{
    public function index(Request $request)
    {

        $accounts = DB::table('accounts')
        ->select('id','company_name')
            ->where('status', '!=', '0')
            ->where('active_status', 'active')
            ->where('key_status', '1')
            ->orderBy('id', 'ASC')
            ->get();

        foreach ($accounts as $account) {
            $account->total = DB::table('invoicedetails')
                ->where('company_id', $account->id)
                ->sum('grosspay');
        }

// dd($accounts);
        return view('revenue.index' ,compact('accounts'));
    }
}
