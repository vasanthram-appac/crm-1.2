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

class Leads extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {

            if (request()->session()->get('oppourtunity_status') == "") {
                request()->session()->put('oppourtunity_status', 'inactive');
            }

            if (isset($request->id) && !empty($request->id)) {
                request()->session()->put('oppourtunity_status', $request->id);
            }

            if (request()->session()->get('lead_status') == "") {
                request()->session()->put('lead_status', 'All');
            }

            if (isset($request->status) && !empty($request->status)) {
                request()->session()->put('lead_status', $request->status);
            }

            if (request()->session()->get('oppourtunity_status') == 'all') {

                $data = DB::table('leads')
                    ->when(request()->session()->get('lead_status') != 'All', function ($query) use ($request) {
                        return $query->where('status', request()->session()->get('lead_status'));
                    })
                    ->orderBy('leads.id', 'desc')
                    ->get();
            } else {

                $data = DB::table('leads')
                    ->when(request()->session()->get('lead_status') != 'All', function ($query) use ($request) {
                        return $query->where('status', request()->session()->get('lead_status'));
                    })
                    ->where('oppourtunity_status', request()->session()->get('oppourtunity_status'))
                    ->orderBy('leads.id', 'desc')
                    ->get();
            }


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
                ->addColumn('company_name', function ($row) {
                    return '<button class="btn text-lblue btn-modal" data-container=".appac_show" data-href="' . route('leaddetail', ['id' => $row->id]) . '">' . $row->company_name . '</button>';
                })
                ->addColumn('assignedto', function ($row) {
                    return '<button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->assignedto) . '">' . $row->assignedto . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Leads::class, 'edit'], [$row->id]) . '">
                    <i class="fi fi-ts-file-edit"></i> 
					  <span class="tooltiptext ">edit</span>
					</button>
                            <button class="btn btn-modal" data-container=".customer_modal" data-href="' . route('opportunitydetail', ['id' => $row->id]) . '"><i class="fi fi-ts-user-check"></i>
							  <span class="tooltiptext last quer">Convert to opportunity</span>
							</button>';
                })
                ->rawColumns(['sno', 'action', 'company_name', 'phone', 'emailid', 'assignedto'])
                ->make(true);
        }
        $currentDate = Carbon::now();
        $leadCounts = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $currentDate->copy()->subMonths($i);
            $month = $date->format('m');
            $year = $date->format('Y');

            $leadCount = DB::table('leads')
                ->where('oppourtunity_status', 'active')
                ->where(DB::raw("SUBSTRING(leaddate, 4, 2)"), $month)
                ->where(DB::raw("SUBSTRING(leaddate, 7, 4)"), $year)
                ->count();

            $leadCounts[] = [
                'month' => $date->format('M Y'),
                'leads' => $leadCount
            ];
        }



        // The $leadCounts array now has lead counts for each of the last seven months
        // dd($leadCounts);


        $allActivests = DB::table('leads')->where('oppourtunity_status', 'active')->get();

        $Hot = DB::table('leads')->where('oppourtunity_status', 'active')->where('status', 'Hot')->get();
        $Cold = DB::table('leads')->where('oppourtunity_status', 'active')->where('status', 'Cold')->get();
        $Warm = DB::table('leads')->where('oppourtunity_status', 'active')->where('status', 'Warm')->get();
        $Reject = DB::table('leads')->where('oppourtunity_status', 'active')->where('status', 'Reject')->get();



        return view('leads/index')->with(compact('allActivests', 'Hot', 'Cold', 'Warm', 'Reject', 'leadCounts'))->render();
    }

    public function create()
    {
        $city = DB::table('citymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $state = DB::table('statemaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $country = DB::table('countrymaster')->orderBy('name', 'ASC')->pluck('name', 'name');
        $source = DB::table('leadmaster')->where('source', '!=', '0')->orderBy('id', 'ASC')->pluck('source', 'source');
        $status = DB::table('leadmaster')->where('status', '!=', '0')->orderBy('status', 'ASC')->pluck('status', 'status');
        $regis = DB::table('regis')->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })->where('id', '!=', '1')->orderBy('fname', 'ASC')->pluck('fname', 'empid');

        return view('leads.create')->with(compact('city', 'state', 'country', 'source', 'status', 'regis'));
    }

    public function store(Request $request)
    {

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
        /*Check Duplicate leads in database*/
        $Selectmobile = DB::table('leads')->where('phone', $request->phone)->where('gst_number', $request->gst_number)->where('company_name', $request->company_name)->get();

        if (count($Selectmobile) > 0) {
            session()->flash('secmessage', 'Lead Already Exists in our Database.');
            return response()->json(['status' => 0, 'message' => 'Lead Already Exists in our Database.'], 200);
        } else {

            $lead_id = DB::table('leads')->insertGetId($val);

            session()->flash('secmessage', 'Lead Successfully Created.');
            return response()->json(['status' => 1, 'message' => 'Lead Successfully Created.'], 200);
        }
    }

    public function edit($id)
    {
        $lead = DB::table('leads')->find($id);

        $country = DB::table('countrymaster')->orderBy('name', 'ASC')->get();

        $leadmaster = DB::table('leadmaster')->orderBy('source', 'ASC')->get();

        $state = DB::table('statemaster')->orderBy('name', 'ASC')->pluck('name', 'name');

        $assinedby = DB::table('regis')->select('fname')->where('status', 1)->where('empid', $lead->assignedto)->orderBy('fname', 'ASC')->first();

         $regis = DB::table('regis')->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })->where('id', '!=', '1')->orderBy('fname', 'ASC')->pluck('fname', 'empid');

        return view('leads.edit')->with(compact('lead', 'country', 'leadmaster', 'assinedby', 'state', 'regis'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'account' => 'required',
            'leaddate' => 'required|date',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',

            'company_name' => 'nullable|string|max:255',
            'gst_number' => 'nullable|string|max:15',

            'phone' => 'required|digits:10',

            'assignedto' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'summary' => 'required|string',
            'designation' => 'nullable|string|max:255',

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

            'company_name' => $request->account,
            'leaddate' => $request->leaddate,
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,

            'gst_number' => $request->gst_number,

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
            'oppourtunity_status' => $request->oppourtunity_status,

            'shipping_title' => $request->shipping_title ?? $request->title,
            'shipping_firstname' => $request->shipping_firstname ?? $request->firstname,
            'shipping_lastname' => $request->shipping_lastname ?? $request->lastname,
            'shipping_phone' => $request->shipping_phone ?? $request->phone,
            'shipping_address' => $request->shipping_address ?? $request->address,
            'shipping_city' => $request->shipping_city ?? $request->city,
            'shipping_state' => $request->shipping_state ?? $request->state,
            'shipping_pincode' => $request->shipping_pincode ?? $request->pincode,
        ];

        $upd = DB::table('leads')->where('id', $id)->update($val);
        session()->flash('secmessage', 'Lead Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Lead Updated Successfully.'], 200);
    }


    public function Leaddetail($id)
    {
        $lead = DB::table('leads')->find($id);
        $leadshistory = DB::table('leads_history')->where('leads_id', $id)->get();
        $enquiry_month = date("m-Y");
        $dailyreport = DB::table('dailyreport')->where('leadid', $id)->where('enquiry_month', $enquiry_month)->get();

        return view('leads.leaddetail')->with(compact('lead', 'leadshistory', 'dailyreport'));
    }

    public function Leaddetailupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'summary' => 'required',
            'subject' => 'required',
            'date'    => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $datetimestamp = $request->datetimestamp;
        $employee = $request->employee;
        $summary = htmlspecialchars($request->summary);
        $subject = $request->subject;
        $companyNameId = $request->company_name;

        // Retrieve company name using Eloquent
        $company = DB::table('leads')->where('id', $companyNameId)->first();

        if (!$company) {
            return response()->json(['status' => 0, 'message' => 'Company not found.'], 200);
        }

        $company_name_value = $company->company_name;
        $todaydate = date('Y-m-d');

        // Retrieve employee information
        $user = DB::table('regis')->where('empid', $employee)->first();

        if (!$user) {
            return response()->json(['status' => 0, 'message' => 'Employee not found.'], 200);
        }

        $empid_value1 = $user->fname;
        $empid_value2 = $user->lname;
        $mailid = $user->emailid;

        $val = [
            'datetimestamp' => $datetimestamp,
            'empid' => $employee,
            'subject' => $subject,
            'summary' => $summary,
            'leads_id' => $companyNameId,
            'submit_date' => $todaydate,
            'followupdate' => $request->date,
        ];

        $insert = DB::table('leads_history')->insert($val);

        if ($insert) {
            $infomail = env('INFOMAIL');
            $to = env('FOUNDERMAIL');
            $cc1 = env('SUPPORTMAIL');
            $cc = env('MANAGERMAIL');

            Mail::send([], [], function ($message) use ($cc, $cc1, $to, $infomail, $subject, $company_name_value, $empid_value1, $empid_value2, $employee, $datetimestamp, $summary) {
                $message->to($to)
                    ->cc($cc)
                    ->bcc($cc1)
                    ->from($infomail, $empid_value1)
                    ->subject($subject)
                    ->html(
                        '<html><title>Application</title><head></head><body>' .
                            '<table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px">' .
                            '<tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr>' .
                            '<td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px">' .
                            '<table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px">' .
                            '<p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Leads Status</p></td></tr>' .
                            '<tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Sir, </strong> <br></p></td></tr>' .
                            '<tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Leads Status Updated Through CRM Portal </p></td></tr>' .
                            '<tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0">Company Name:</td><td style="padding-right:10px"> : </td>' .
                            '<td style="font-weight:normal"> ' . htmlspecialchars($company_name_value) . ' </td> </tr>' .
                            '<tr><td style="width:200px;padding:4px 0">Employee Name:</td><td style="padding-right:10px"> : </td>' .
                            '<td style="font-weight:normal"> ' . htmlspecialchars($empid_value1 . " " . $empid_value2) . ' </td> </tr>' .
                            '<tr><td style="width:200px;padding:4px 0">EMP ID</td><td style="padding-right:10px"> : </td>' .
                            '<td style="font-weight:normal"> ' . htmlspecialchars($employee) . ' </td></tr><tr><td style="width:200px;padding:4px 0">Date of Info Updated</td> ' .
                            '<td style="padding-right:10px"> : </td> <td style="font-weight:normal"> ' . htmlspecialchars($datetimestamp) . ' </td></tr>' .
                            '<tr><td style="width:200px;padding:4px 0">Subject</td> <td style="padding-right:10px"> : </td> ' .
                            '<td style="font-weight:normal"> ' . htmlspecialchars($subject) . '  </td></tr><tr><td style="width:200px;padding:4px 0">Summary</td>' .
                            '<td style="padding-right:10px"> : </td><td style="font-weight:normal"> ' . htmlspecialchars($summary) . ' </td></tr>' .
                            '</tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px 0"></td>' .
                            '</tr></tbody></table></body></html>'
                    );
            });

            session()->flash('secmessage', 'Notes Created Successfully.');
            return response()->json(['status' => 1, 'message' => 'Notes Created Successfully.', 'reload' => '1'], 200);
        } else {
            session()->flash('secmessage', 'Notes Not Created Successfully.');
            return response()->json(['status' => 0, 'message' => 'Notes Not Created Successfully.'], 200);
        }
    }

    public function Opportunitydetail($id)
    {
        // Retrieve lead details by ID
        $lead = DB::table('leads')->find($id);

        // Retrieve opportunities based on conditions
        $opportunity = DB::table('leads')
            ->select('id', 'company_name', 'assignedto')
            ->where('oppourtunity_status', 'inactive')
            ->where('assignedto', request()->session()->get('empid'))
            ->orderBy('company_name', 'ASC')
            ->get();

        // Retrieve assigned employees
        $assignedto = DB::table('regis')
            ->select('empid', 'fname')
            ->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })
            ->where('id', '!=', '1')
            ->where('empid', $lead->assignedto)
            ->orderBy('fname', 'ASC')
            ->first();

        $assignedmanager = DB::table('regis')
            ->select('empid', 'fname')
            ->where('status', '1')
            ->where(function ($query) {
                $query->where('dept_id', '1')->orWhere('dept_id', '6');
            })
            ->where('id', '!=', '1')
            ->orderBy('fname', 'ASC')
            ->first();

        // Retrieve opportunity stages
        $opportunitymaster = DB::table('opportunitymaster')
            ->orderBy('id', 'ASC')
            ->pluck('id', 'oppourtunitystage');

        // Retrieve lead sources
        $source = DB::table('leadmaster')
            ->where('source', '!=', '0')
            ->orderBy('source', 'ASC')
            ->pluck('id', 'source');

        return view('leads.opportunity')->with(compact('lead', 'opportunity', 'assignedmanager', 'assignedto', 'opportunitymaster', 'source'));
    }

    public function Opportunityupdate(Request $request)
    {

        // Check for duplicate phone and email
        $Selectmobile = DB::table('opportunity')->where('phone', $request->phone)->where('emailid', $request->emailid)->get();

        if (count($Selectmobile) > 0) {
            session()->flash('secmessage', 'Opportunity Already Exists in our Database.');
            return response()->json(['status' => 0, 'message' => 'Opportunity Already Exists in our Database.'], 200);
        }

        // Update `leads` table
        $Lead = DB::table('leads')->where('id', $request->id)->update(['oppourtunity_status' => 'active']);

        $leaddata = DB::table('leads')->where('id', $request->id)->first();

        $val = [
            'opportunitydate' => $request->opportunitydate,
            'opportunityupdate' => $request->opportunityupdate,
            'comp_title' => $request->comp_title,
            'company_name' => $request->company_name,
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'summary' => $request->summary,
            'stdcode' => $request->stdcode,
            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'emailid' => $request->emailid,
            'alternateemail' => $request->alternateemail,
            'assignedto' => $request->assignedto,
            'opportunitystage' => $request->opportunitystage,
            'opportunitysource' => $request->opportunitysource,
            'accountmanager' => $request->accountmanager,
        ];

        $val1 = [
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'stdcode' => $request->stdcode,
            'phone' => $request->phone,
            'emailid' => $request->emailid,
            'company_name' => $request->company_name,
            'assignedto' => $request->assignedto,
            'accountmanager' => $request->accountmanager,
        ];

        $val2 = [
            'comp_title' => $request->comp_title,
            'company_name' => $request->company_name,
            'active_status' => 'active',
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'title' => $request->title,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gst_number' => $request->gst_number,
            'stdcode' => $request->stdcode,
            'phone' => $request->phone,
            'alternate_phone' => $request->alternate_phone,
            'emailid' => $request->emailid,
            'website' => $request->website,
            'assignedto' => $request->assignedto,
            'accountmanager' => $request->accountmanager,
            'status' => 1,

            'shipping_title' => $leaddata->shipping_title ?? $leaddata->title,
            'shipping_firstname' => $leaddata->shipping_firstname ?? $leaddata->firstname,
            'shipping_lastname' => $leaddata->shipping_lastname ?? $leaddata->lastname,
            'shipping_phone' => $leaddata->shipping_phone ?? $leaddata->phone,
            'shipping_address' => $leaddata->shipping_address ?? $leaddata->address,
            'shipping_city' => $leaddata->shipping_city ?? $leaddata->city,
            'shipping_state' => $leaddata->shipping_state ?? $leaddata->state,
            'shipping_pincode' => $leaddata->shipping_pincode ?? $leaddata->pincode,
        ];

        $Opportunity = DB::table('opportunity')->insert($val);
        $contacts = DB::table('contacts')->insert($val1);
        $accounts = DB::table('accounts')->insert($val2);


        session()->flash('secmessage', 'Opportunity and Contact Successfully Created.');
        return response()->json(['status' => 0, 'message' => 'Opportunity and Contact Successfully Created.'], 200);
    }
}
