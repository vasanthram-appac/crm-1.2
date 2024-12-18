<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DB;

class Query extends Controller
{

    public function index(Request $request,$id)
    {
        // dd($id);
        if ($request->ajax()) {
            // Fetch the main task data
            $data1 = DB::table('task_management')
                ->where('id', $id)
                ->get();

            $empid = request()->session()->get('empid');

            $data = DB::table('task_query_details as q')
                ->join('regis as r', 'r.empid', '=', 'q.empid')
                ->select('r.empid', 'r.fname', 'q.query_date', 'q.task_id', 'q.queries', 'q.assigned_by', 'q.empid')
                ->where('q.task_id', $id)
                ->where(function ($query) use ($empid, $data1) {
                    $query->where('q.empid', $empid)
                        ->orWhere('q.assigned_by', $data1[0]->assigned_by);
                })
                ->orderBy('q.id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->rawColumns(['sno'])
                ->make(true);
        }

        return view('query.index', compact('id'));
    }


    public function queryadd($id)
    {
         $company_id=$id;
        return view('query/queryadd', compact('company_id'))->render();
    }

    public function querystore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'comments' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request->all());
        $data1 = DB::table('task_management')
        ->select('assigned_by')
        ->where('id', $request->company_id)
        ->first();

        $val = [
            'task_id' => $request->company_id,
            'empid' => request()->session()->get('empid'),
            'assigned_by' => $data1->assigned_by,
            'queries' => $request->comments,
            'query_date' => date('d-m-Y', time()),
            'status' => 0,

        ];

        $insert = DB::table('task_query_details')->insert($val);

        // Success message and response
        if(request()->session()->get('role')=='superadmin'){

        session()->flash('secmessage', 'Query Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'Query Added Successfully.'], 200);
        return redirect()->to('/task');

        }else{

        session()->flash('secmessage', 'Query Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'Query Added Successfully.'], 200);
        return redirect()->to('/taskemp');

        }
        
          
    }


   

    
}
