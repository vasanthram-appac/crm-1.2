<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;

class Vendorlist extends Controller
{

    public function index(Request $request)
    {
         if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM098' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8') {

        if (request()->ajax()) {

                $data = DB::table('vendorlist')
                    ->orderBy('id', 'desc')
                    ->get();
            
            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('phone', function ($row) {
                    return '<a href="tel:' . $row->phone . '" style="text-decoration:none;">' . $row->phone . '</a>';
                })
                ->addColumn('emailid', function ($row) {
                    return '<a href="mailto:' . $row->emailid . '" style="text-decoration:none;">' . $row->emailid . '</a>';
                })
                ->addColumn('empid', function ($row) {
                    return '<button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->empid . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Vendorlist::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i> 
					  <span class="tooltiptext ">edit</span>
					</button>
                            ';
                })
                ->rawColumns(['sno', 'action', 'phone', 'emailid', 'empid'])
                ->make(true);
        }
 
        return view('vendorlist/index')->render();

    } else{
            return redirect()->to('/workreport');
        }
    }

    public function create()
    {
    
        $city = DB::table('citymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $state = DB::table('statemaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $country = DB::table('countrymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $regis = DB::table('regis')->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })->where('id', '!=', '1')->orderBy('fname', 'ASC')->pluck('fname', 'empid');

        return view('vendorlist.create')->with(compact('city', 'state', 'country', 'regis'));
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:15',

            'phone' => 'required|digits:10',
            'status' => 'required|string|max:255',
            'summary' => 'required|string',
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
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'company_name' => $request->company_name,
            'gst_number' => $request->gst_number,
            'stdcode' => '+91',
            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'empid' => request()->session()->get('empid'),
            'status' => $request->status,
            'summary' => $request->summary,
            'emailid' => $request->emailid,
            'alternateemail' => $request->alternateemail,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'country' => $request->country,
            'status' => $request->status,

            'shipping_title' => $request->shipping_title ?? $request->title,
            'shipping_firstname' => $request->shipping_firstname ?? $request->firstname,
            'shipping_lastname' => $request->shipping_lastname ?? $request->lastname,
            'shipping_phone' => $request->shipping_phone ?? $request->phone,
            'shipping_address' => $request->shipping_address ?? $request->address,
            'shipping_city' => $request->shipping_city ?? $request->city,
            'shipping_state' => $request->shipping_state ?? $request->state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->pincode,

        ];

        $Selectmobile = DB::table('vendorlist')->where('phone', $request->phone)->where('gst_number', $request->gst_number)->where('company_name', $request->company_name)->get();

        if (count($Selectmobile) > 0) {
            session()->flash('secmessage', 'Vendor List Already Exists in our Database.');
            return response()->json(['status' => 0, 'message' => 'Vendor List Already Exists in our Database.'], 200);
        } else {
            $lead_id = DB::table('vendorlist')->insertGetId($val);
            session()->flash('secmessage', 'Vendor List Successfully Created.');
            return response()->json(['status' => 1, 'message' => 'Vendor List Successfully Created.'], 200);
        }
    }


    public function edit($id)
    {
        $vendorlist = DB::table('vendorlist')->find($id);

        $country = DB::table('countrymaster')->orderBy('name', 'ASC')->get();

        $state = DB::table('statemaster')->orderBy('name', 'ASC')->pluck('name', 'name');

        return view('vendorlist.edit')->with(compact('vendorlist', 'country', 'state'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'account' => 'required',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:15',
            'phone' => 'required|digits:10',
            'status' => 'required|string|max:255',
            'summary' => 'required|string',
            'emailid' => 'required|email|max:255',
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

            'company_name' => $request->account,
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gst_number' => $request->gst_number,

            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'empid' => request()->session()->get('empid'),
            'status' => $request->status,
            'summary' => $request->summary,
            'emailid' => $request->emailid,
            'alternateemail' => $request->alternateemail,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'country' => $request->country,
            'status' => $request->status,

            'shipping_title' => $request->shipping_title ?? $request->title,
            'shipping_firstname' => $request->shipping_firstname ?? $request->firstname,
            'shipping_lastname' => $request->shipping_lastname ?? $request->lastname,
            'shipping_phone' => $request->shipping_phone ?? $request->phone,
            'shipping_address' => $request->shipping_address ?? $request->address,
            'shipping_city' => $request->shipping_city ?? $request->city,
            'shipping_state' => $request->shipping_state ?? $request->state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->pincode,
        ];

        $upd = DB::table('vendorlist')->where('id', $id)->update($val);
        session()->flash('secmessage', 'Vendor List Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Vendor List Updated Successfully.'], 200);
    }

}
