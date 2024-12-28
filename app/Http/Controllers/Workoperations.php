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

class Workoperations extends Controller
{

    public function index(Request $request)
    {
        $currentYear = date('Y');

        $task = DB::table('task_management')->count();

        $taskview = DB::table('task_management')->where('empid', request()->session()->get('empid'))->count();

        $workorder = DB::table('work_order')->count();

        $workorderview = DB::table('work_order')->where('empid', request()->session()->get('empid'))->count();

        $wip = DB::table('work_wip')->count();

        $promotion = DB::table('promotion_wip')->count();

        $design = DB::table('design_wip')->count();

        $content = DB::table('content_wip')->count();

        return view('workoperations/index')->with(compact('task', 'taskview', 'workorder', 'workorderview', 'wip', 'promotion', 'design', 'content'))->render();
    }
  
}