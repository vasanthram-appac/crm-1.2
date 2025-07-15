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

class Salary extends Controller
{
    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            $data = DB::table('emp_salary')
            ->select('emp_salary.*','regis.fname')
            ->join('regis', 'emp_salary.empid', '=','regis.empid')
            ->where('regis.status',1)
            ->orderByDesc('regis.status') ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                 ->addColumn('fname', function ($row) {
                    return '
                            <button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->fname . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Salary::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                 ';
                })
                ->rawColumns(['sno', 'fname', 'action'])
                ->make(true);
        }

        return view('salary/index')->render();
    }

    public function create(Request $request)
    {
        $regis = DB::table('regis')->pluck('fname', 'empid');
        return view('salary/create', compact('regis'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'salary' => 'required',
            'empid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

          $sal = DB::table('emp_salary')->where('empid',$request->empid)->get();

          if(count($sal)>0){
            
        session()->flash('secmessage', 'Salary Details Already added in Server.');
        return response()->json(['status' => 1, 'message' => 'Salary Details Already added in Server.'], 200);
          }

        $domainData = [
            'empid' => $request->empid,
            'salary' => $request->salary
        ];

        DB::table('emp_salary')->insert($domainData);

        session()->flash('secmessage', 'Salary Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Salary Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $salary = DB::table('emp_salary')->select('id', 'salary', 'empid')->find($id);
        $regis = DB::table('regis')->pluck('fname', 'empid');
        // dd($salary);
        return view('salary.edit')->with(compact('salary','regis'));
    }

    public function update(Request $request, $id)
    {
     
        $validator = Validator::make($request->all(), [
            'salary' => 'required',
            'empid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
        'empid' => $request->empid,
        'salary' => $request->salary
        ];

        $updated = DB::table('emp_salary')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Salary updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Salary updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $upd = DB::table('emp_salary')->where('id', $id)->delete();
        session()->flash('secmessage', 'Salary Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Salary Deleted Successfully!'], 200);
    }
}


