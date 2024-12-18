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

class Documentupload extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            $data = DB::table('appac_document')
            ->where('empid',request()->session()->get('empid'))
                ->orderBy('id', 'DESC')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('link', function ($row) {
                    return '<a class="btn" href=" uploaddoc/' . e($row->documents) . '" target="_blank" download><i class="fi fi-ts-print"></i></a>';
                })
                ->rawColumns(['sno', 'link'])
                ->make(true);
        }

        return view('documentupload.index');
    }

    public function create(Request $request)
    {

        return view('documentupload/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'documentlink' => 'required|file|mimes:xlsx,xls,doc,docx|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $folder = "uploaddoc/";
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
        
        // Get the uploaded file details
        if ($request->hasFile('documentlink')) {
            $file = $request->file('documentlink'); // Get the uploaded file
            $extp = $file->getClientOriginalExtension(); // Get the file extension
            $filep = $request->filename . "-document." . $extp; // Generate new filename
            $filePath = $folder . $filep; // Full file path
        
            // Move the file to the specified folder
            $file->move($folder, $filep);
        } else {
            $filep = null; // No file uploaded
        }

        $val = [
            'title' => $request->title,
            'documents' => $filep,
            'submitdate' => date("d-m-Y"),
            'empid' => request()->session()->get('empid'),
        ];

        $insert = DB::table('appac_document')->insertGetId($val);

        session()->flash('secmessage', 'Document Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Document Created Successfully'], 200);
    }
}
