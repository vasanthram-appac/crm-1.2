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

class Newnbd extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('newnbd as t')
                ->select(
                    'r.fname',
                    'r.empid',
                    't.name',
                    't.email',
                    't.mobile',
                    't.company_name as companyname',
                    't.source',
                    't.url',
                    't.date',
                    't.id as tid'
                )
                ->join('regis as r', 'r.empid', '=', 't.empid')
                ->orderByDesc('t.id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('url', function ($row) {
                    if (!empty($row->url)) {
                        return '<a href="' . $row->url . '" target="_blank" style="text-decoration:none;">View</a>';
                    } else {
                        return '';
                    }
                })
                 ->addColumn('date', function ($row) {
                    if (!empty($row->date)) {
                        return  date('d-m-Y', strtotime($row->date));
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Newnbd::class, 'edit'], [$row->tid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext  last">edit</span>
                            </button>';
                })
                ->rawColumns(['sno', 'url', 'action', 'date'])
                ->make(true);
        }

        return view('newnbd.index');
    }

    public function create(Request $request)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        return view('newnbd/create', compact('regis'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'url' => 'nullable|url',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'empid' => request()->session()->get('empid'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'url' => $request->url,
            'description' => $request->description,
            'date' => $request->date,
        ];

        $insert = DB::table('newnbd')->insert($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }

    public function edit($id)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        $newnbd = DB::table('newnbd')->where('id', $id)->first();

        return view('newnbd/edit', compact('regis', 'newnbd'))->render();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(),$id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'url' => 'nullable|url',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());

        $val = [
            'empid' => request()->session()->get('empid'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'url' => $request->url,
            'description' => $request->description,
            'date' => $request->date,
        ];

        $insert = DB::table('newnbd')->where('id', $id)->update($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }
}
