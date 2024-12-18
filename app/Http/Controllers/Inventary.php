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

class Inventary extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            $data = DB::table('appac_inventory')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->rawColumns(['sno','description'])
                ->make(true);
        }

        return view('inventary.index');
    }

    public function create(Request $request)
    {

        return view('inventary/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'title' => $request->title,
            'description' => $request->description,
            'submitdate' => date("d-m-Y"),
            'empid' => request()->session()->get('empid'),
        ];

        $insert = DB::table('appac_inventory')->insertGetId($val);

        session()->flash('secmessage', 'Questionnaire Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Questionnaire Created Successfully'], 200);
    }
}
