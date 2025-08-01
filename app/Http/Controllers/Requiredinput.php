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

class Requiredinput extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            $data = DB::table('requiredinput')
                ->join('domainmaster', 'requiredinput.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'requiredinput.company_name', '=', 'accounts.id')
                ->select(
                    'requiredinput.*',
                    'domainmaster.domainname',
                    'accounts.company_name as companyname',
                    'accounts.phone',
                    'accounts.emailid'
                );

            $data = $data->orderBy('requiredinput.id', 'ASC')->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('companyname', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('viewaccounts', ['id' => $row->company_name]) . '">' . $row->companyname . '</button>';
                })
                ->addColumn('domainname', function ($row) {
                    return '<a href="http://' . $row->domainname . '" target="_blank" style="text-decoration:none;">' . $row->domainname . '</a>';
                })
                ->addColumn('file', function ($row) {
                if($row->file){
                    return '<a href="' . $row->file . '" target="blank" style="text-decoration:none;">View</a>';
                }else{
                    return '';
                }
                })
                ->addColumn('url', function ($row) {
                if($row->url){
                    return '<a href="' . $row->url . '" target="blank" style="text-decoration:none;">View</a>';
                      }else{
                    return '';
                }
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Requiredinput::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'companyname', 'domainname', 'file', 'url', 'action'])
                ->make(true);
        }

        $domainmaster = DB::table('domainmaster')
            ->join('accounts', 'domainmaster.company_name', '=', 'accounts.id')
            ->where('domainmaster.domainname', '!=', '')
            ->groupBy('domainmaster.company_name')
            ->groupBy('accounts.company_name')
            ->groupBy('accounts.id')
            ->orderBy('accounts.company_name', 'ASC')
            ->select('domainmaster.company_name', 'accounts.company_name as company_name_full', 'accounts.id')
            ->get();

        return view('requiredinput/index', compact('domainmaster'))->render();
    }

    public function create(Request $request)
    {
        $domainmaster = DB::table('domainmaster')
            ->join('accounts', 'domainmaster.company_name', '=', 'accounts.id')
            ->where('domainmaster.domainname', '!=', '')
            ->groupBy('domainmaster.company_name')
            ->groupBy('accounts.company_name')
            ->groupBy('accounts.id')
            ->orderBy('accounts.company_name', 'ASC')
            ->select('domainmaster.company_name', 'accounts.company_name as company_name_full', 'accounts.id')
            ->get();

        return view('requiredinput/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'domainname' => 'required|string',
            'name' => 'required|string|max:100',
            'worktype' => 'required',
            'file' => 'nullable|file|max:1024',
              'url' => [
                'nullable',
                'regex:/^https:\/\/(docs\.google\.com\/(spreadsheets|document|presentation|forms)\/|drive\.google\.com\/(file\/d\/|drive(\/u\/\d+)?\/folders\/)|(www\.)?youtube\.com\/watch\?v=|youtu\.be\/)/'
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = preg_replace('/\s+/', '', $originalName); 

            $extension = strtolower($file->getClientOriginalExtension());

            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('requiredinput/image');
                $path = "requiredinput/image/";
            } else {
                $folderPath = public_path('requiredinput/document');
                $path = "requiredinput/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }

        } else{
                $filesave = "";
            }

        $empid = request()->session()->get('empid');

        $domainData = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'file' => $filesave,
            'empid' => $empid,
            'worktype' => $request->worktype,
            'description' => $request->description,
            'url' => $request->url,
        ];

        // Insert data into the database
        DB::table('requiredinput')->insert($domainData);

        session()->flash('secmessage', 'Required Input Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Required Input Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $requiredinput = DB::table('requiredinput')->select('id', 'company_name', 'domainname', 'name', 'file', 'worktype', 'description', 'url')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($requiredinput->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($requiredinput->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('requiredinput.edit')->with(compact('requiredinput', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $rules = [
            'name' => 'required|string|max:100',
            'worktype'   => 'required',
            'url' => [
                'nullable',
                'regex:/^https:\/\/(docs\.google\.com\/(spreadsheets|document|presentation|forms)\/|drive\.google\.com\/(file\/d\/|drive(\/u\/\d+)?\/folders\/)|(www\.)?youtube\.com\/watch\?v=|youtu\.be\/)/'
            ]
        ];

        if ($request->hasFile('file')) {
            $rules['file'] = 'required|file|max:1024'; // 1MB = 1024KB
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = DB::table('requiredinput')->select('file')->where('id', $id)->first();

        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'empid' => request()->session()->get('empid'),
            'worktype' => $request->worktype,
            'description' => $request->description,
            'url' => $request->url,
        ];

        if ($request->hasFile('file')) {

            if (!empty($input->file)) {
                unlink(public_path($input->file));
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = preg_replace('/\s+/', '', $originalName); 

            $extension = strtolower($file->getClientOriginalExtension());
            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('requiredinput/image');
                $path = "requiredinput/image/";
            } else {
                $folderPath = public_path('requiredinput/document');
                $path = "requiredinput/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }
            $data['file'] = $filesave;
        }

        // Update the hosting record
        $updated = DB::table('requiredinput')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Required Input updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Required Input updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $input = DB::table('requiredinput')->select('file')->where('id', $id)->first();

        if (!empty($input->file)) {
            unlink(public_path($input->file));
        }

        $upd = DB::table('requiredinput')->where('id', $id)->delete();
        session()->flash('secmessage', 'Required Input Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Required Input Deleted Successfully!'], 200);
    }
}
