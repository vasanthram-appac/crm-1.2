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

class Workquery extends Controller
{

    public function index(Request $request, $id)
    {
        // dd($id);
        if ($request->ajax()) {
            // Fetch the main task data
            $work=DB::table('work_order')->where('id',$id)->first();

            $aid=request()->session()->get('empid');

            $data = DB::table('query_details as q')
                ->join('regis as r', 'r.empid', '=', 'q.empid')
                ->select('r.empid', 'r.fname', 'q.query_date', 'q.work_id', 'q.queries', 'q.assigned_by', 'q.empid as q_empid')
                ->where('q.work_id', $id)
                ->where(function ($query) use ($aid, $work) {
                    $query->where('q.empid', $aid)
                        ->orWhere('q.assigned_by', $work->assigned_by);
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

        return view('workquery.index', compact('id'));
    }


    public function queryadd($id)
    {
        $company_id = $id;
        return view('workquery/queryadd', compact('company_id'))->render();
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
        $data1 = DB::table('work_order')->where('id',$request->company_id)->first();

        $val = [
            'work_id' => $request->company_id,
            'empid' => request()->session()->get('empid'),
            'assigned_by' => $data1->assigned_by,
            'queries' => $request->comments,
            'query_date' => date('d-m-Y', time()),
            'status' => 0,

        ];

        $insert = DB::table('query_details')->insert($val);

        // Success message and response
        if (request()->session()->get('role') == 'superadmin') {
            session()->flash('secmessage', 'Query Added Successfully.');
            return response()->json(['status' => 1, 'message' => 'Query Added Successfully.'], 200);
            return redirect()->to('/workorderview');
        } else {
            session()->flash('secmessage', 'Query Added Successfully.');
            return response()->json(['status' => 1, 'message' => 'Query Added Successfully.'], 200);
            return redirect()->to('/taskemp');
        }
    }
}
