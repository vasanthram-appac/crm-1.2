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

class Leadhistory extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            if ($request->has('daterange')) {
                // Validation
                $validator = Validator::make($request->all(), [
                    'daterange' => 'required',
                    // 'website' => 'required|exists:accounts,id', 
                    // 'employee' => 'required|exists:regis,empid',   
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
            }

            $query = DB::table('notes')
                ->select(
                    'notes.*',
                    'regis.fname',
                    'accounts.company_name as companyname'
                )
                ->join('regis', 'notes.employee', '=', 'regis.empid')
                ->join('accounts', 'notes.company_name', '=', 'accounts.id')
                ->orderBy('notes.id', 'DESC');

            $db_date = 'notes.submitdate';

            $website = $request->input('website');
            $employee = $request->input('employee');
            $daterange = $request->input('daterange');

            $startDate = '';
            $endDate = '';

            if ($daterange) {

                $dates = explode(' - ', $daterange);
                if (count($dates) == 2) {

                    $startDate = date('Y-m-d', strtotime($dates[0]));
                    $endDate = date('Y-m-d', strtotime($dates[1]));

                    $query->whereBetween($db_date, [$startDate, $endDate]);
                }
            } else {
                // Default to current month
                $query->whereMonth($db_date, now()->month)
                    ->whereYear($db_date, now()->year);
            }

            if ($request->has('website') && !empty($request->website)) {
                $query->where('notes.company_name', $request->website);
            }

            if ($request->has('employee') && !empty($request->employee)) {
                $query->where('notes.employee', $request->employee);
            }

            // Pagination
            $perPage = $request->get('length', 10);
            $start = $request->get('start', 0);
            $currentPage = ($start / $perPage) + 1;

            $data = $query->paginate($perPage, ['*'], 'page', $currentPage);

            // Add 'sno' (Serial Number) to the data response
            $data->getCollection()->transform(function ($item, $key) use ($start) {
                $item->sno = $start + $key + 1;
                return $item;
            });

            foreach ($data->items() as $row) {
                $row->companyname = '<button class="btn btn-modal text-lblue" 
        data-cid="' . $row->company_name . '" 
        data-container=".appac_show" 
        data-href="' . route('viewaccounts', ['id' => $row->company_name]) . '">
        ' . e($row->companyname) . '
    </button>';
            }


            $totallead = [];
            $totalHistroy = [];
            $currentDate = new DateTime();

            if ($startDate && $endDate) {

                $regis = DB::table('regis')->whereNotIn('empid', ['AM001'])->whereIn('dept_id', ['6', '1', '8'])->where('status', '1')->get();

                foreach ($regis as $regi) {
                    $totalEnquiry = DB::table('notes')
                        ->where('employee', $regi->empid)
                        ->whereBetween("submitdate", [$startDate, $endDate]);

                    $totalHistroy[] = [
                        'name' => $regi->fname,
                        'count' => $totalEnquiry->count(),
                    ];
                }

                $regis1 = DB::table('regis')->whereIn('dept_id', ['6', '1', '8'])->where('status', '1')->get();

                foreach ($regis1 as $regi) {

                    $leadsHistory = DB::table('leads_history')
                        ->where('empid', $regi->empid)
                        ->whereBetween("submit_date", [$startDate, $endDate]);

                    $totallead[] = [
                        'name' => $regi->fname,
                        'count' => $leadsHistory->count(),
                    ];
                }
            } else {

                $regis = DB::table('regis')->whereNotIn('empid', ['AM001', 'AM002'])->whereIn('dept_id', ['6', '1', '8'])->where('status', '1')->get();

                foreach ($regis as $regi) {
                    $totalEnquiry = DB::table('notes')
                        ->where('employee', $regi->empid)
                        ->whereBetween("submitdate", [date('Y-m-01'), date('Y-m-t')]);

                    $totalHistroy[] = [
                        'name' => $regi->fname,
                        'count' => $totalEnquiry->count(),
                    ];
                }

                $regis1 = DB::table('regis')->whereIn('dept_id', ['6', '1', '8'])->where('status', '1')->get();

                foreach ($regis1 as $regi) {

                    $leadsHistory = DB::table('leads_history')
                        ->where('empid', $regi->empid)
                        ->whereBetween("submit_date", [date('Y-m-01'), date('Y-m-t')]);

                    $totallead[] = [
                        'name' => $regi->fname,
                        'count' => $leadsHistory->count(),
                    ];
                }
            }

            // Return the response
            return response()->json([
                'draw' => $request->get('draw'),
                'recordsTotal' => DB::table('notes')->count(),
                'recordsFiltered' => $data->total(),
                'data' => $data->items(),
                'totalHistroy' => $totalHistroy,
                'totallead' => $totallead,
            ]);
        }

        // Return default view with filter options
        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'All'] + $accounts;

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->whereIn('dept_id', ['6', '1', '8'])
            ->whereNotIn('empid', ['AM001', 'AM002'])
            ->where('status', 1) // Overwrites the earlier status condition
            ->pluck('fname', 'empid')
            ->toArray();
        $regis = ['0' => 'All'] + $regis;

        return view('leadhistory.index', compact('accounts', 'regis'));
    }
}
