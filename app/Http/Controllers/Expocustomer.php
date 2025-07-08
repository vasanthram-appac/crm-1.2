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

class Expocustomer extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            $data = DB::table('expocustomer')
            ->select('expocustomer.*','regis.fname')
            ->join('regis', 'expocustomer.empid', '=','regis.empid')
                ->orderBy('id', 'ASC')->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                 ->addColumn('fname', function ($row) {
                    return '
                            <button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->fname . ' </button>';
                })
                ->addColumn('url', function ($row) {
                    return '<a href="' . $row->url . '" target="blank" style="text-decoration:none;">View</a>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Expocustomer::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'fname', 'url', 'action'])
                ->make(true);
        }

        return view('expocustomer/index')->render();
    }

    public function create(Request $request)
    {
        return view('expocustomer/create')->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'date' => 'required',
            'url' => [
                'required',
                'regex:/^https:\/\/(docs\.google\.com\/(spreadsheets|document|presentation|forms)\/|drive\.google\.com\/(file\/d\/|drive(\/u\/\d+)?\/folders\/)|(www\.)?youtube\.com\/watch\?v=|youtu\.be\/)/'
            ]

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $empid = request()->session()->get('empid');

        $domainData = [
            'name' => $request->name,
            'url' => $request->url,
            'date' => $request->date,
            'empid' => $empid,
        ];

        DB::table('expocustomer')->insert($domainData);

        session()->flash('secmessage', 'Expo Customer Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Expo Customer Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $expocustomer = DB::table('expocustomer')->select('id', 'name', 'date', 'url', 'status')->find($id);

        // dd($expocustomer);
        return view('expocustomer.edit')->with(compact('expocustomer'));
    }

    public function update(Request $request, $id)
    {
     
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'date' => 'required',
            'url' => [
                'required',
                'regex:/^https:\/\/(docs\.google\.com\/(spreadsheets|document|presentation|forms)\/|drive\.google\.com\/(file\/d\/|drive(\/u\/\d+)?\/folders\/)|(www\.)?youtube\.com\/watch\?v=|youtu\.be\/)/'
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = [
            'name' => $request->name,
            'url' => $request->url,
            'date' => $request->date,
            'empid' => request()->session()->get('empid'),
        ];

        $updated = DB::table('expocustomer')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Expo Customer updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Expo Customer updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $upd = DB::table('expocustomer')->where('id', $id)->delete();
        session()->flash('secmessage', 'Expo Customer Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Expo Customer Deleted Successfully!'], 200);
    }
}


