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

class Googlesheet extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            $data = DB::table('googlesheet')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('link', function ($row) {
                    return '<a class="btn" href="' . e($row->sharedlink) . '" target="_blank" download><svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="2em" height="2em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 36 36">
                                <path class="clr-i-outline clr-i-outline-path-1" d="M30.4 17.6c-1.8-1.9-4.2-3.2-6.7-3.7c-1.1-.3-2.2-.5-3.3-.6c2.8-3.3 2.3-8.3-1-11.1s-8.3-2.3-11.1 1s-2.3 8.3 1 11.1c.6.5 1.2.9 1.8 1.1v2.2l-1.6-1.5c-1.4-1.4-3.7-1.4-5.2 0c-1.4 1.4-1.5 3.6-.1 5l4.6 5.4c.2 1.4.7 2.7 1.4 3.9c.5.9 1.2 1.8 1.9 2.5v1.9c0 .6.4 1 1 1h13.6c.5 0 1-.5 1-1v-2.6c1.9-2.3 2.9-5.2 2.9-8.1v-5.8c.1-.4 0-.6-.2-.7zm-22-9.4c0-3.3 2.7-5.9 6-5.8c3.3 0 5.9 2.7 5.8 6c0 1.8-.8 3.4-2.2 4.5v-5a3.4 3.4 0 0 0-3.4-3.2c-1.8-.1-3.4 1.4-3.4 3.2v5.2c-1.7-1-2.7-2.9-2.8-4.9zM28.7 24c.1 2.6-.8 5.1-2.5 7.1c-.2.2-.4.4-.4.7v2.1H14.2v-1.4c0-.3-.2-.6-.4-.8c-.7-.6-1.3-1.3-1.8-2.2c-.6-1-1-2.2-1.2-3.4c0-.2-.1-.4-.2-.6l-4.8-5.7c-.3-.3-.5-.7-.5-1.2c0-.4.2-.9.5-1.2c.7-.6 1.7-.6 2.4 0l2.9 2.9v3l1.9-1V7.9c.1-.7.7-1.3 1.5-1.2c.7 0 1.4.5 1.4 1.2v11.5l2 .4v-4.6c.1-.1.2-.1.3-.2c.7 0 1.4.1 2.1.2v5.1l1.6.3v-5.2l1.2.3c.5.1 1 .3 1.5.5v5l1.6.3v-4.6c.9.4 1.7 1 2.4 1.7l.1 5.4z" fill="#298ECD"></path>
                            </svg>
					<span class="tooltiptext">link</span>
					</a>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Googlesheet::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i>
					<span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'link','action'])
                ->make(true);
        }

        return view('googlesheet.index');
    }

    public function create(Request $request)
    {

        return view('googlesheet/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sharedlink' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'title' => $request->title,
            'sharedlink' => $request->sharedlink,
            'create_date' => date("d-m-Y"),
            'created_by' => request()->session()->get('empid'),
        ];

        $insert = DB::table('googlesheet')->insertGetId($val);

        session()->flash('secmessage', 'Google Sheet Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Google Sheet Created Successfully'], 200);
    }

    public function edit($id)
    {
          $googlesheet = DB::table('googlesheet')->where('id',$id)->first();
        return view('googlesheet/edit')->with(compact('googlesheet'))->render();
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'sharedlink' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'title' => $request->title,
            'sharedlink' => $request->sharedlink,
            'create_date' => date("d-m-Y"),
            'created_by' => request()->session()->get('empid'),
        ];

        $insert = DB::table('googlesheet')->where('id',$id)->update($val);

        session()->flash('secmessage', 'Google Sheet Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Google Sheet Created Successfully'], 200);
    }

    public function destroy($id)
    {
        // dd($id);

        $upd = DB::table('googlesheet')->where('id', $id)->delete();
        session()->flash('secmessage', 'Google Sheet Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Google Sheet Deleted Successfully!'], 200);
    }

}
