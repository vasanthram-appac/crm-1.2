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

class Backup extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            $data =  DB::table('db_backup_logs')
            ->where('download_status', '1')
            ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
              
                ->rawColumns(['sno'])
                ->make(true);
        }

        return view('backup.index');
    }

    public function create(Request $request)
    {

        return view('backup/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'filename' => 'required|string|max:255',
            'documentlink' => 'required|file|mimes:xlsx,xls,doc,docx|max:10240',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $folder = "pdf/";
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
            'documentlink' => $filep,
            'create_date' => date("d-m-Y"),
            'create_by' => request()->session()->get('empid'),
        ];

        $insert = DB::table('questionnaire')->insertGetId($val);

        session()->flash('secmessage', 'Questionnaire Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Questionnaire Created Successfully'], 200);
    }
}
