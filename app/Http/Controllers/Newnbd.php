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

class Newnbd extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {
            // Fetch the main task data
            $data = DB::table('newnbd as t')
                ->select(
                    'r.fname',
                    'r.empid',
                    't.name',
                    't.email',
                    't.mobile',
                    't.company_name as companyname',
                    't.source',
                    't.url',
                    't.date',
                    't.id as tid'
                )
                ->join('regis as r', 'r.empid', '=', 't.empid')
                ->orderByDesc('t.id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('url', function ($row) {
                    if (!empty($row->url)) {
                        return '<a href="' . $row->url . '" target="_blank" style="text-decoration:none;">View</a>';
                    } else {
                        return '';
                    }
                })
                 ->addColumn('date', function ($row) {
                    if (!empty($row->date)) {
                        return  date('d-m-Y', strtotime($row->date));
                    } else {
                        return '';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Newnbd::class, 'edit'], [$row->tid]) . '">
                                <i class="fi fi-ts-file-edit"></i>
								<span class="tooltiptext  last">edit</span>
                            </button>
                            <button class="btn btn-modal" data-container=".customer_modal" data-href="' . route('convertlead', ['id' => $row->tid]) . '"><i class="fi fi-ts-user-check"></i>
							  <span class="tooltiptext last quer">Convert to Lead</span>
							</button>
                            ';
                })
                ->rawColumns(['sno', 'url', 'action', 'date'])
                ->make(true);
        }

        return view('newnbd.index');
    }

    public function create(Request $request)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        return view('newnbd/create', compact('regis'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'url' => 'nullable|url',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'empid' => request()->session()->get('empid'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'url' => $request->url,
            'description' => $request->description,
            'date' => $request->date,
        ];

        $insert = DB::table('newnbd')->insert($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }

    public function edit($id)
    {

        $regis = DB::table('regis')
            ->where('status', '!=', 0)
            ->where('fname', '!=', 'demo')
            ->pluck(DB::raw("CONCAT(fname, ' ', lname)"), 'empid')
            ->toArray();
        $regis = ['0' => 'Select Option'] + $regis;

        $newnbd = DB::table('newnbd')->where('id', $id)->first();

        return view('newnbd/edit', compact('regis', 'newnbd'))->render();
    }

    public function update(Request $request, $id)
    {
        // dd($request->all(),$id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'mobile' => 'nullable|digits:10',
            'email' => 'required|email|max:50',
            'company_name' => 'required',
            'source' => 'required',
            'url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());

        $val = [
            'empid' => request()->session()->get('empid'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'company_name' => $request->company_name,
            'source' => $request->source,
            'url' => $request->url,
            'description' => $request->description,
            'date' => $request->date,
        ];

        $insert = DB::table('newnbd')->where('id', $id)->update($val);

        // Success message and response
        session()->flash('secmessage', 'New NBD Details Added Successfully.');
        return response()->json(['status' => 1, 'message' => 'New NBD Details Added Successfully.'], 200);
    }

    public function Convertlead($id){

        $newnbd = DB::table('newnbd')->where('id', $id)->first();
        $city = DB::table('citymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $state = DB::table('statemaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $country = DB::table('countrymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $source = DB::table('leadmaster')->where('source', '!=', '0')->orderBy('id', 'ASC')->pluck('source', 'source');
        $status = DB::table('leadmaster')->where('status', '!=', '0')->orderBy('status', 'ASC')->pluck('status', 'status');
        $regis = DB::table('regis')->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })->where('id', '!=', '1')->orderBy('fname', 'ASC')->pluck('fname', 'empid');

        return view('newnbd.convertlead')->with(compact('newnbd','city', 'state', 'country', 'source', 'status', 'regis'));
    }

   public function Savelead(Request $request){

            $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:15',

            'phone' => 'required|digits:10',
            'assignedto' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'summary' => 'required|string',
            'designation' => 'required|string|max:255',
            'emailid' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'leadsource' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',

            'shipping_firstname' => 'nullable|string|max:255',
            'shipping_title' => 'nullable|string|max:255',
            'shipping_address' => 'nullable|string|max:255',
            'shipping_phone' => 'nullable|digits:10',
            'shipping_city' => 'nullable|string|max:255',
            'shipping_state' => 'nullable|string|max:255',
            'shipping_pincode' => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'leaddate' => date('d-m-Y'),
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'company_name' => $request->company_name,
            'gst_number' => $request->gst_number,
            'stdcode' => '+91',
            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'assignedto' => $request->assignedto,
            'status' => $request->status,
            'summary' => $request->summary,
            'designation' => $request->designation,
            'department' => $request->department,
            'emailid' => $request->emailid,
            'alternateemail' => $request->alternateemail,
            'website' => $request->website,
            'leadsource' => $request->leadsource,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'country' => $request->country,
            'oppourtunity_status' => 'inactive',

            'shipping_title' => $request->shipping_title ?? $request->title,
            'shipping_firstname' => $request->shipping_firstname ?? $request->firstname,
            'shipping_lastname' => $request->shipping_lastname ?? $request->lastname,
            'shipping_phone' => $request->shipping_phone ?? $request->phone,
            'shipping_address' => $request->shipping_address ?? $request->address,
            'shipping_city' => $request->shipping_city ?? $request->city,
            'shipping_state' => $request->shipping_state ?? $request->state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->pincode,
        ];
       
        $Selectmobile = DB::table('leads')->where('phone', $request->phone)->where('gst_number', $request->gst_number)->where('company_name', $request->company_name)->get();

        if (count($Selectmobile) > 0) {
            session()->flash('secmessage', 'Lead Already Exists in our Database.');
            return response()->json(['status' => 0, 'message' => 'Lead Already Exists in our Database.'], 200);
        } else {

            $Lead = DB::table('newnbd')->where('id', $request->id)->update(['status' => 'Active']);
            $lead_id = DB::table('leads')->insertGetId($val);

            session()->flash('secmessage', 'Lead Successfully Created.');
            return response()->json(['status' => 1, 'message' => 'Lead Successfully Created.'], 200);
        }

    }


}
