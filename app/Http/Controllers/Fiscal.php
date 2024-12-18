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

class Fiscal extends Controller
{
    public function index(Request $request)
    {

        // dd($request->all());

        if (isset($request->date) && !empty($request->date)) {
        $yearrange = $request->date;
        $yr = explode("-", $yearrange);
        $fyear = $yr[0];
        $syear = $yr[1];

        $fromdate = "$fyear-04-01";
        $todate = "$syear-03-31";
        }

        $invoices = DB::table('invoicedetails as inv')
            ->join('accounts as a', 'inv.company_id', '=', 'a.id')
            ->select(
                'inv.company_id',
                'a.company_name',
                'a.id',
                DB::raw('SUM(inv.netpay) AS total_score'),
                DB::raw('MIN(inv.invoice_date1) AS earliest_invoice_date') // Example aggregation
            );

        if (isset($fromdate) && !empty($fromdate) && isset($todate) && !empty($todate)) {
           
            $invoices = $invoices->whereBetween('inv.invoice_date1', [$fromdate, $todate]);
        } else {
            $invoices = $invoices->whereBetween('inv.invoice_date1', [date('Y-01-01'), date('Y-m-d')]);
        }

        $invoices = $invoices
            ->where('inv.paymentstatus', '!=', 'cancelled')
            ->groupBy('inv.company_id', 'a.company_name', 'a.id')
            ->orderBy(DB::raw('SUM(inv.netpay)'), 'DESC')
            ->get();
            // dd($invoices);
        $total = 0;
        $Rtotal = [];
        foreach ($invoices as $invoice) {
            $total_score = $invoice->total_score;
            $company_name = $invoice->company_name;
            $total += $total_score;

            $Rtotal[] = [
                'total_score' => $total_score,
                'company_name' => $company_name
            ];
        }
        if (isset($request->date) && !empty($request->date)) {
        return response()->json([
            'total' => $total,
            'Rtotal' => $Rtotal,
        ]);
    }else{
        return view('fiscal.index', compact('total', 'Rtotal'));
    }

      
    }
}
