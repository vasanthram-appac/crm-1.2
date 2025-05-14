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

class Assetlibrary extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            $data = DB::table('assetlibrary')
                ->join('domainmaster', 'assetlibrary.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'assetlibrary.company_name', '=', 'accounts.id')
                ->select(
                    'assetlibrary.*',
                    'domainmaster.domainname',
                    'accounts.company_name as companyname',
                    'accounts.phone',
                    'accounts.emailid'
                );

            $data = $data->orderBy('assetlibrary.id', 'ASC')->get();

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
                    return '<a href="' . $row->file . '" target="blank" style="text-decoration:none;">View</a>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Assetlibrary::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'companyname', 'domainname', 'file', 'action'])
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

        return view('assetlibrary/index', compact('domainmaster'))->render();
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

        return view('assetlibrary/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'domainname' => 'required|string',
            'name' => 'required|string|max:100',
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $extension = strtolower($file->getClientOriginalExtension());

            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('assetlibrary/image');
                $path = "assetlibrary/image/";
            } else {
                $folderPath = public_path('assetlibrary/document');
                $path = "assetlibrary/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }
        }

        $empid = request()->session()->get('empid');

        $domainData = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'file' => $filesave,
            'empid' => $empid,
        ];

        // Insert data into the database
        DB::table('assetlibrary')->insert($domainData);

        session()->flash('secmessage', 'Asset Library Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Asset Library Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $assetlibrary = DB::table('assetlibrary')->select('id', 'company_name', 'domainname', 'name', 'file')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($assetlibrary->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($assetlibrary->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('assetlibrary.edit')->with(compact('assetlibrary', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $asset = DB::table('assetlibrary')->select('file')->where('id', $id)->first();

        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'empid' => request()->session()->get('empid'),
        ];

        if ($request->hasFile('file')) {

            if (!empty($asset->file)) {
                unlink(public_path($asset->file));
            }

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $extension = strtolower($file->getClientOriginalExtension());
            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('assetlibrary/image');
                $path = "assetlibrary/image/";
            } else {
                $folderPath = public_path('assetlibrary/document');
                $path = "assetlibrary/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }
        }

        $data['file'] = $filesave;

        // Update the hosting record
        $updated = DB::table('assetlibrary')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Asset Library updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Asset Library updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $asset = DB::table('assetlibrary')->select('file')->where('id', $id)->first();

        if (!empty($asset->file)) {
            unlink(public_path($asset->file));
        }

        $upd = DB::table('assetlibrary')->where('id', $id)->delete();
        session()->flash('secmessage', 'Asset Library Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Asset Library Deleted Successfully!'], 200);
    }
}
