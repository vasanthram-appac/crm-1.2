<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;

class Ratecards extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1') {
       
        if (request()->ajax()) {

            $data = DB::table('ratecard')
            ->whereNotNull('empid')
            ->where('empid', '!=', '')
            ->orderBy('id', 'ASC')
            ->get();
        

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('view', function ($row) { 
                    return '<a href="pdf/ratecard/download/'.$row->download_package.'" target="_blank" style="text-decoration:none;">View</a>';
                })
              
                ->rawColumns(['sno', 'view'])
                ->make(true);
        }
        
        return view('ratecards/index')->render();
        
    }else{
        return redirect()->to('/workreport');
    }
    }

}
