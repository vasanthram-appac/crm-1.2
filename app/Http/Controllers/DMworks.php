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

class DMworks extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            if (isset($request->dmaccount) && !empty($request->dmaccount) && isset($request->dmtype) && !empty($request->dmtype)) {
                request()->session()->put('dmaccount', $request->dmaccount);
                request()->session()->put('dmtype', $request->dmtype);

                if ($request->dmaccount == "All") {
                    request()->session()->put('dmaccount', "");
                }

                if ($request->dmtype == "All") {
                    request()->session()->put('dmtype', "");
                }
            }

            $data = DB::table('dmworks')
                ->join('domainmaster', 'dmworks.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'dmworks.company_name', '=', 'accounts.id')
                ->select(
                    'dmworks.*',
                    'domainmaster.domainname',
                    'accounts.company_name as companyname',
                    'accounts.phone',
                    'accounts.emailid'
                );

            if (!empty(request()->session()->get('dmaccount'))) {
                $data->where('dmworks.company_name', request()->session()->get('dmaccount'));
            }

            if (!empty(request()->session()->get('dmtype'))) {
                $data->where('dmworks.type', request()->session()->get('dmtype'));
            }

            $data = $data->orderBy('dmworks.id', 'ASC')->get();

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
                ->addColumn('url', function ($row) {
                    return '<a href="' . $row->url . '" target="blank" style="text-decoration:none;">View</a>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([DMworks::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'companyname', 'domainname', 'url', 'action'])
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

        return view('dmworks/index', compact('domainmaster'))->render();
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

        return view('dmworks/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'domainname' => 'required|string',
            'name' => 'required|string|max:100',
            'type' => 'required|not_in:0',
            'url' => [
                'required',
                'regex:/^(https:\/\/)?((docs|drive)\.google\.com\/(spreadsheets|document|presentation|forms|file|folders)|(www\.)?youtube\.com\/watch\?v=|youtu\.be\/)/'
            ],
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $empid = request()->session()->get('empid');

        $domainData = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'url' => $request->url,
            'type' => $request->type,
            'empid' => $empid,
        ];

        // Insert data into the database
        DB::table('dmworks')->insert($domainData);

        session()->flash('secmessage', 'DM Works Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'DM Works Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $dmworks = DB::table('dmworks')->select('id', 'company_name', 'domainname', 'type', 'name', 'url', 'status')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($dmworks->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($dmworks->domainname);
        // dd($domain,$accounts,$domainmaster);
        return view('dmworks.edit')->with(compact('dmworks', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'type' => 'required|not_in:0',
            'url' => [
                'required',
                'regex:/^(https:\/\/)?(docs|drive)\.google\.com\/(spreadsheets|document|presentation|forms|file|folders)/'
            ],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'name' => $request->name,
            'url' => $request->url,
            'type' => $request->type,
            'empid' => request()->session()->get('empid'),
        ];

        // Update the hosting record
        $updated = DB::table('dmworks')->where('id', $id)->update($data);

        session()->flash('secmessage', 'DM Works updated successfully.');
        return response()->json(['status' => 1, 'message' => 'DM Works updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $upd = DB::table('dmworks')->where('id', $id)->delete();
        session()->flash('secmessage', 'DM Works Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'DM Works Deleted Successfully!'], 200);
    }
}
