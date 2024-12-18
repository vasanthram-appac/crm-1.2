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

class Sociallogin extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('social_login as s')
                ->join('accounts as a', 'a.id', '=', 's.clientid')
                ->select(
                    's.id',
                    's.clientid',
                    's.title',
                    's.username',
                    's.password',
                    's.managedby',
                    's.createdby',
                    'a.id as aid',
                    'a.company_name'
                )
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Sociallogin::class, 'edit'], [$row->id]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								   <span class="tooltiptext">edit</span>
                            </button> ';
                })
                ->rawColumns(['sno', 'action'])
                ->make(true);
        }

        return view('sociallogin.index');
    }

    public function create(Request $request)
    {
        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        return view('sociallogin/create', compact('accounts'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'managedby' => 'nullable|string|max:255',
            'createdby' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'clientid' => $request->company_name,
            'title' => $request->title,
            'url' => $request->url,
            'username' => $request->username,
            'password' => $request->password,
            'managedby' => $request->managedby,
            'createdby' => $request->createdby,
            'generatedate' => date('d-m-Y h:i:s A', time()),
            'submited_by' => request()->session()->get('empid'),
        ];

        $insert = DB::table('social_login')->insertGetId($val);

        session()->flash('secmessage', 'Social Login Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Social Login Created Successfully'], 200);
    }

    public function edit($id)
    {

        $accounts = DB::table('accounts')
            ->where('status', 1)
            ->where('active_status', 'active')
            ->orderBy('company_name', 'asc')
            ->pluck('company_name', 'id')
            ->toArray();
        $accounts = ['0' => 'Select Option'] + $accounts;

        $sociallogin = DB::table('social_login')->where('id', $id)->first();


        return view('sociallogin/edit', compact('accounts', 'sociallogin'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|exists:accounts,id',
            'title' => 'required|string|max:255',
            'url' => 'required|url',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'managedby' => 'nullable|string|max:255',
            'createdby' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'clientid' => $request->company_name,
            'title' => $request->title,
            'url' => $request->url,
            'username' => $request->username,
            'password' => $request->password,
            'managedby' => $request->managedby,
            'createdby' => $request->createdby,
            'generatedate' => date('d-m-Y h:i:s A', time()),
            'submited_by' => request()->session()->get('empid'),
        ];

        $insert = DB::table('social_login')->where('id',$id)->update($val);

        session()->flash('secmessage', 'Social Login Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Social Login Updated Successfully'], 200);
    }
}
