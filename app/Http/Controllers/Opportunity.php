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

class Opportunity extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }
        if (request()->ajax()) {
            $data = DB::table('opportunity')
                ->orderBy('opportunity.id', 'desc')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn  btn-modal" data-container=".customer_modal" data-href="' . action([Opportunity::class, 'edit'], [$row->id]) . '">
                     <i class="fi fi-ts-file-edit"></i> 
					 <span class="tooltiptext">edit</span>
					 </button>
                            <button class="btn  btn-modal" data-container=".appac_show" data-href="' . route('viewopportunity', ['id' => $row->id]) . '"><i class="fi fi-ts-user-check"></i> 
							<span class="tooltiptext">view</span>
							</button>';
                })
                ->rawColumns(['sno', 'action'])
                ->make(true);
        }

        return view('opportunity/index')->render();
    }

    public function Viewopportunity($id)
    {
        $opportunity = DB::table('opportunity')->where('id', $id)->first();
// dd($opportunity);
        return view('opportunity.create')->with(compact('opportunity'));
    }


    public function edit($id)
    {

        $opportunity = DB::table('opportunity')->where('id', $id)->first();

        $assignedto =  DB::table('regis')->where('status', '!=', 0)->orderBy('regis.fname', 'ASC')->pluck('fname','empid');

        $opportunitymaster = DB::table('opportunitymaster')->pluck('oppourtunitystage','oppourtunitystage');

        $source = DB::table('leadmaster')->pluck('source','source');



        return view('opportunity.edit')->with(compact('opportunity', 'assignedto', 'opportunitymaster', 'source'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'opportunitydate' => 'required|date',
            'opportunityupdate' => 'required|date',
            'comp_title' => 'nullable|string|max:255',
            'company_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'summary' => 'nullable|string',
            'stdcode' => 'nullable|string|max:10',
            'phone' => 'required|string|max:15',
            'alternate_phone' => 'nullable|string|max:15',
            'emailid' => 'required|email|max:255',
            'alternateemail' => 'nullable|email|max:255',
            'assignedto' => 'required|string',
            'oppourtunitystage' => 'required|string',
            'oppourtunitysource' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Prepare the data for updating
        $data = [
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
            'opportunitystage' => $request->oppourtunitystage,
            'opportunitysource' => $request->oppourtunitysource,
        ];
    
        // Update the record in the database
        DB::table('opportunity')->where('id', $id)->update($data);
    
        // Set a success message and return JSON response
        session()->flash('secmessage', 'Opportunity Details Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'Opportunity Details Updated Successfully.'], 200);
    }
    
}
