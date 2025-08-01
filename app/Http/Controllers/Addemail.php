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

class Addemail extends Controller
{
    public function index(Request $request, $id)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {

            $data = DB::table('emailid_list')->where('eid', $id)->orderByDesc('id')->get();

            foreach ($data as $pdata) {

                $gname = DB::table('regis')->select('fname', 'lname')->where('empid', $pdata->empid)->first();

                $pdata->gname = $gname->fname . ' ' . $gname->lname;
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('gname', function ($row) {
                    return '<button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->gname . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '
                    <button class="btn btn-modal" data-container=".customer_modal" data-href="' . route('addemail.edit', $row->id) . '"> <i class="fi fi-ts-file-edit"></i>
                    <span class="tooltiptext">edit</span> 
                    </button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>
                 ';
                })
                ->rawColumns(['sno', 'gname', 'action'])
                ->make(true);
        }

        return view('addemail/index', compact('id'))->render();
    }

    public function create(Request $request)
    {

        $id = $request->id;
        return view('addemail/create', compact('id'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mailid' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $email = DB::table('emailid_list')
            ->where('eid', $request->eid)
            ->where('mailid', $request->mailid)
            ->exists();

        if ($email) {
            session()->flash('secmessage', 'Email Already added in Server');
            return response()->json(['status' => 1, 'message' => 'Email Already added in Server'], 200);
        }

        $domainData = [
            'empid' => request()->session()->get('empid'),
            'mailid' => $request->mailid,
            'eid' => $request->eid,
        ];

        DB::table('emailid_list')->insert($domainData);

        session()->flash('secmessage', 'Email Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Email Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $email = DB::table('emailid_list')->find($id);

        return view('addemail.edit')->with(compact('email'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'mailid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $emailExists = DB::table('emailid_list')
            ->where('eid', $request->eid)
            ->where('mailid', $request->mailid)
            ->where('id', '!=', $request->id)
            ->exists();

        if ($emailExists) {
            session()->flash('secmessage', 'Email already exists for this Server.');
            return response()->json(['status' => 1, 'message' => 'Email already exists for this Server.'], 200);
        }

        $data = [
            'empid' => request()->session()->get('empid'),
            'mailid' => $request->mailid,
        ];

        $updated = DB::table('emailid_list')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Email updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Email updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $upd = DB::table('emailid_list')->where('id', $id)->delete();
        session()->flash('secmessage', 'Email Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'Email Deleted Successfully!'], 200);
    }
}
