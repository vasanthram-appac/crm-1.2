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

class User extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM098' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8'){
        
        if (request()->ajax()) {
            $data = DB::table('regis')
            ->orderByRaw('CAST(status AS SIGNED) DESC')  // Cast status to integer
            ->orderBy('id', 'ASC')

            ->get();
        
        

            if (count($data)) {
                foreach ($data as $udata) {

                    $udata->status = ($udata->status == 1) ? 'Active' : 'Inactive';

                    $departments = [
                        1 => 'Management',
                        2 => 'Design',
                        3 => 'Development',
                        4 => 'Promotion',
                        5 => 'Content Writer',
                        6 => 'Marketing',
                        7 => 'Client Coordinator',
                        8 => 'Accounts'
                    ];

                    // Assign the department name or an empty string if dept_id is not in the array
                    $udata->dept_id = $departments[$udata->dept_id] ?? '';
                }
            }

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                 ->addColumn('empid', function ($row) {
                    return '
                            <button class="btn  btn-modal text-lblue viewemp" data-id="' . base64_encode($row->empid) . '">' . $row->empid . ' </button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn  btn-modal" data-container=".customer_modal" data-href="' . action([User::class, 'edit'], [$row->id]) . '">
                 <i class="fi fi-ts-file-edit"></i> 
				 <span class="tooltiptext">edit</span>
				 </button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					 <span class="tooltiptext">delete</span>
					</button>';
                })
                ->rawColumns(['sno', 'empid', 'action'])
                ->make(true);
        }

        return view('user/index')->render();
        }else{
            return redirect()->to('/workreport');
        }

    }

    public function create(Request $request)
    {

        $department_master=DB::table('department_master')->pluck('department_name','id');

        return view('user/create')->with(compact('department_master'));
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'lname' => ['required', 'string', 'max:40', 'regex:/^[a-zA-Z\s]+$/'],
            'emailid' => 'required|email|max:50',
            'personalemailid' => 'required|email|max:50',
            'mno' => 'required|digits:10|unique:regis,mno',

            'altmno' => 'nullable|digits:10',
            'emergencycontact' => 'required|digits:10',
            'emergencycontactperson' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'address' => 'required|max:300',
            'landmark' => 'required|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',

            'city' => 'required|string|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',
            'state' => 'required|string|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',
            'pincode' => 'required|digits:6',
            'designation' => 'required|string|max:50',
            'department' => 'required|exists:department_master,id',

            'emptype' => 'required|in:1,2',
            'dob' => 'required|date',
            'role' => 'required|in:superadmin,admin,subadmin,user',
            'doj' => 'required|date',
            'bloodgroup' => 'required|max:5',
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            'confirmpwd' => 'required|same:password',



            'photo' => 'required|mimes:jpeg,jpg,png|file|max:1024',
            'resume' => 'nullable|mimes:pdf|file|max:1024',
            'addressproof' => 'required|mimes:pdf|file|max:1024',
            'identityproof' => 'required|mimes:pdf|file|max:1024',

            'acholder' => 'required|string|max:40',
            'bankname' => 'required|string|max:50',
            'branch' => 'required|string|max:30',
            'acno' => 'required|numeric|digits_between:9,18',
            'actype' => 'required|in:Savings account,Current account,Salary Account',
            'ifsccode' => 'required|max:15',
            'panno' => 'required|max:20',
            'salary' => 'required|max:15',
        ]);

        if ($request->emptype == 2) {
            $validator->addRules([
                'duration' => 'required|in:1 Month,3 Months,6 Months',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->emptype == 1) {

            $user = DB::table('regis')->where('emptype', 1)->where('status', 1)->orderBy('empid', 'desc')->first();
            $empid = preg_replace_callback('/\d+/', function ($matches) {
                return sprintf('%03d', $matches[0] + 1);
            }, $user->empid);
        } else {

            $user = DB::table('regis')->where('emptype', 2)->where('status', 1)->orderBy('empid', 'desc')->first();
            $empid = preg_replace_callback('/\d+/', function ($matches) {
                return sprintf('%03d', $matches[0] + 1);
            }, $user->empid);
        }

        $regis = [
            'fname' => ucfirst($request->fname),
            'lname' => ucfirst($request->lname),
            'mno' => $request->mno,
            'password' => base64_encode($request->password),
            'confirmpwd' => base64_encode($request->password),
            'emptype' => $request->emptype,
            'role' => $request->role,
            'company' => 'APPAC MEDIATECH PVT LTD',
            'status' => 1,
            'empid' => $empid,
            'emailid' => $request->emailid,
            'dept_id' => $request->department,
        ];

        if ($request->emptype == 2) {
            $regis['duration'] = $request->duration;
        }

        DB::table('regis')->insert($regis);

        $departments = [
            1 => 'Management',
            2 => 'Design',
            3 => 'Development',
            4 => 'Promotion',
            5 => 'Content Writer',
            6 => 'Marketing',
            7 => 'Client Coordinator',
            8 => 'Accounts',
            
        ];

        // Assign the department name or an empty string if dept_id is not in the array
        $department = $departments[$request->department] ?? '';

        $personal = [
            'fname' => ucfirst($request->fname),
            'lname' => ucfirst($request->lname),
            'doj' => $request->doj,
            'dob' => $request->dob,
            'bloodgroup' => $request->bloodgroup,
            'officialemailid' => $request->emailid,
            'personalemailid' => $request->personalemailid,
            'mno' => $request->mno,
            'emergencycontact' => $request->emergencycontact,
            'emergencycontactperson' => $request->emergencycontactperson,
            'empid' => $empid,
            'emptype' => $request->emptype,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'permaddress' => $request->address,
            'permlandmark' => $request->landmark,
            'permcity' => $request->city,
            'permstate' => $request->state,
            'permpincode' => $request->pincode,
            'designation' => $request->designation,
            'department' => $department,
            'salary' => $request->salary,
        ];

        if (!empty($request->altmno)) {
            $regis['altmno'] = $request->altmno;
        }

        $pid = DB::table('personalprofile')->insertGetId($personal);

        $bank = [

            'empid' => $empid,
            'bankname' => $request->bankname,
            'acholder' => $request->acholder,
            'acno' => $request->acno,
            'ifsccode' => $request->ifsccode,
            'branch' => $request->branch,
            'actype' => $request->actype,
            'panno' => $request->panno,
        ];

        DB::table('bankinfo')->insert($bank);

        if ($request->hasFile('photo')) {
            // Get the original file name and extension
            $identity = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid . $request->fname . '_profile.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadphoto');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('photo')->move($folderPath, $fileName)) {
                $photo = $fileName;
            }
        }

        if ($request->hasFile('resume')) {
            // Get the original file name and extension
            $resume = $request->file('resume')->getClientOriginalName();
            $extension = $request->file('resume')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid . $request->fname . '_resume.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadresume');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with proper permissions
            }

            // Move the file to the designated folder
            $filePath = $folderPath . '/' . $fileName;
            if ($request->file('resume')->move($folderPath, $fileName)) {
                $resume = $fileName;
            }
        }

        if ($request->hasFile('addressproof')) {
            // Get the original file name and extension
            $address = $request->file('addressproof')->getClientOriginalName();
            $extension = $request->file('addressproof')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid . $request->fname . '_aadhar_addressproof.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadaddressproof');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('addressproof')->move($folderPath, $fileName)) {
                $addressproof = $fileName; // Store the file name or process it as needed
            }
        }

        if ($request->hasFile('identityproof')) {
            // Get the original file name and extension
            $identity = $request->file('identityproof')->getClientOriginalName();
            $extension = $request->file('identityproof')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid . $request->fname . '_pancard_idproof.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadidenityproof');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('identityproof')->move($folderPath, $fileName)) {
                $identityproof = $fileName; // Store the file name or process it as needed
            }
        }

        $documents = [
            'profileid' => $pid,
            'empid' => $empid,
            'addressproof' => $addressproof,
            'identityproof' => $identityproof,
            'photo' => $photo,
            'resume' => $resume,
            'avatar' => implode('', array_map(fn($w) => $w[0], explode(' ', strtolower($request->fname)))),
        ];

        DB::table('documentsupload')->insert($documents);



        // Success message and response
        session()->flash('secmessage', 'User details added Successfully.');
        return response()->json(['status' => 1, 'message' => 'User details added Successfully.'], 200);
    }



    public function edit($id)
    {

        $user = DB::table('regis')->select('id', 'fname', 'lname', 'mno', 'emptype', 'role', 'status', 'emailid', 'dept_id', 'empid', 'duration')->find($id);

        $profile = DB::table('personalprofile')->where('empid', $user->empid)->first();

        $document = DB::table('documentsupload')->where('empid', $user->empid)->first();

        $bank = DB::table('bankinfo')->where('empid', $user->empid)->first();

        $department_master=DB::table('department_master')->pluck('department_name','id');

        // dd($user,$profile,$document,$bank);
        return view('user.edit')->with(compact('user', 'profile', 'document', 'bank', 'department_master'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'fname' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'lname' => ['required', 'string', 'max:40', 'regex:/^[a-zA-Z\s]+$/'],
            'emailid' => 'required|email|max:50',
            'personalemailid' => 'required|email|max:50',
            'mno' => [
                'required',
                'digits:10',
                Rule::unique('regis', 'mno')->ignore($id),
            ],

            'altmno' => 'nullable|digits:10',
            'emergencycontact' => 'required|digits:10',
            'emergencycontactperson' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:40',
            'address' => 'required|max:300',
            'landmark' => 'required|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',

            'city' => 'required|string|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',
            'state' => 'required|string|regex:/^[a-zA-Z\s\.\/&,]+$/|max:40',
            'pincode' => 'required|digits:6',
            'designation' => 'required|string|max:50',
            'department' => 'required|exists:department_master,id',

            'emptype' => 'required|in:1,2',
            'dob' => 'required|date',
            'role' => 'required|in:superadmin,admin,subadmin,user',
            'doj' => 'required|date',
            'bloodgroup' => 'required|max:5',

            'acholder' => 'required|string|max:40',
            'bankname' => 'required|string|max:50',
            'branch' => 'required|string|max:30',
            'acno' => 'required|numeric|digits_between:9,18',
            'actype' => 'required|in:Savings account,Current account,Salary Account',
            'ifsccode' => 'required|max:15',
            'panno' => 'required|max:20',
            'salary' => 'required|max:15',
        ]);

        if (!empty($request->photo)) {
            $validator->addRules([
                'photo' => 'required|mimes:jpeg,jpg,png|file|max:1024',
            ]);
        }

        if (!empty($request->resume)) {
            $validator->addRules([
                'resume' => 'required|mimes:pdf|file|max:1024',
            ]);
        }

        if (!empty($request->addressproof)) {
            $validator->addRules([
                'addressproof' => 'required|mimes:pdf|file|max:1024',
            ]);
        }

        if (!empty($request->identityproof)) {
            $validator->addRules([
                'identityproof' => 'required|mimes:pdf|file|max:1024',
            ]);
        }

        if (!empty($request->password)) {
            $validator->addRules([
                'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                'confirmpwd' => 'required|same:password',
            ]);
        }

        if ($request->emptype == 2) {
            $validator->addRules([
                'duration' => 'required|in:1 Month,3 Months,6 Months',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // dd($request->all());


        $regis = [
            'fname' => ucfirst($request->fname),
            'lname' => ucfirst($request->lname),
            'mno' => $request->mno,
            'emptype' => $request->emptype,
            'role' => $request->role,
            'company' => 'APPAC MEDIATECH PVT LTD',
            'status' => $request->status,
            'emailid' => $request->emailid,
            'dept_id' => $request->department,
        ];

        if ($request->emptype == 2) {
            $regis['duration'] = $request->duration;
        }

        if (!empty($request->password)) {
            $regis['password'] = base64_encode($request->password);
            $regis['confirmpwd'] = base64_encode($request->password);
        }

        $empid = DB::table('regis')->select('empid')->find($id);
        // dd($empid);
        DB::table('regis')->where('id', $id)->update($regis);

        $departments = [
            1 => 'Management',
            2 => 'Design',
            3 => 'Development',
            4 => 'Promotion',
            5 => 'Content Writer',
            6 => 'Marketing',
            7 => 'Client Coordinator',
            8 => 'Accounts'
        ];

        // Assign the department name or an empty string if dept_id is not in the array
        $department = $departments[$request->department] ?? '';

        $personal = [
            'fname' => ucfirst(strtolower($request->fname)),
            'lname' => ucfirst(strtolower($request->lname)),
            'doj' => $request->doj,
            'dob' => $request->dob,
            'bloodgroup' => $request->bloodgroup,
            'officialemailid' => $request->emailid,
            'personalemailid' => $request->personalemailid,
            'mno' => $request->mno,
            'emergencycontact' => $request->emergencycontact,
            'emergencycontactperson' => $request->emergencycontactperson,
            'emptype' => $request->emptype,
            'address' => $request->address,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'permaddress' => $request->address,
            'permlandmark' => $request->landmark,
            'permcity' => $request->city,
            'permstate' => $request->state,
            'permpincode' => $request->pincode,
            'designation' => $request->designation,
            'department' => $department,
            'salary' => $request->salary,
            'appraisaldate' => $request->appraisaldate,
            'nxtappraisaldate' => $request->nxtappraisaldate,
        ];

        // Add optional field if present
        if (!empty($request->altmno)) {
            $personal['altmno'] = $request->altmno;
        }

        // Update the record in the database
        $pid = DB::table('personalprofile')->where('empid', $empid->empid)->update($personal);


        $bank = [
            'bankname' => $request->bankname,
            'acholder' => $request->acholder,
            'acno' => $request->acno,
            'ifsccode' => $request->ifsccode,
            'branch' => $request->branch,
            'actype' => $request->actype,
            'panno' => $request->panno
        ];

        DB::table('bankinfo')->where('empid', $empid->empid)->update($bank);

        $link = DB::table('documentsupload')->where('empid', $empid->empid)->first();

        if ($request->hasFile('photo')) {

            if (!empty($link->photo)) {
                unlink(public_path('uploadphoto/' . $link->photo));
            }

            // Get the original file name and extension
            $identity = $request->file('photo')->getClientOriginalName();
            $extension = $request->file('photo')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid->empid . $request->fname . '_profile.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadphoto');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('photo')->move($folderPath, $fileName)) {
                $photo = $fileName;
            }
        }

        if ($request->hasFile('resume')) {
            if (!empty($link->resume)) {
                unlink(public_path('uploadresume/' . $link->resume));
            }
            // Get the original file name and extension
            $resume = $request->file('resume')->getClientOriginalName();
            $extension = $request->file('resume')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid->empid . $request->fname . '_resume.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadresume');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with proper permissions
            }

            // Move the file to the designated folder
            $filePath = $folderPath . '/' . $fileName;
            if ($request->file('resume')->move($folderPath, $fileName)) {
                $resume = $fileName;
            }
        }

        if ($request->hasFile('addressproof')) {
            if (!empty($link->addressproof)) {
                unlink(public_path('uploadaddressproof/' . $link->addressproof));
            }
            // Get the original file name and extension
            $address = $request->file('addressproof')->getClientOriginalName();
            $extension = $request->file('addressproof')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid->empid . $request->fname . '_aadhar_addressproof.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadaddressproof');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('addressproof')->move($folderPath, $fileName)) {
                $addressproof = $fileName; // Store the file name or process it as needed
            }
        }

        if ($request->hasFile('identityproof')) {
            if (!empty($link->identityproof)) {
                unlink(public_path('uploadidentityproof/' . $link->identityproof));
            }
            // Get the original file name and extension
            $identity = $request->file('identityproof')->getClientOriginalName();
            $extension = $request->file('identityproof')->getClientOriginalExtension();

            // Construct the new file name
            $fileName = $empid->empid . $request->fname . '_pancard_idproof.' . $extension;

            // Define the target folder
            $folderPath = public_path('uploadidenityproof');

            // Check if the folder exists, if not, create it
            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true); // Creates the folder with appropriate permissions
            }

            // Move the file to the designated folder
            if ($request->file('identityproof')->move($folderPath, $fileName)) {
                $identityproof = $fileName; // Store the file name or process it as needed
            }
        }

        $documents = [];


        if (isset($photo) && !empty($photo)) {

            $documents['photo'] = $photo;
        }
        if (isset($resume) && !empty($resume)) {

            $documents['resume'] = $resume;
        }
        if (isset($addressproof) && !empty($addressproof)) {

            $documents['addressproof'] = $addressproof;
        }
        if (isset($identityproof) && !empty($identityproof)) {

            $documents['identityproof'] = $identityproof;
        }

        // Update only if there are fields to update
        if (!empty($documents)) {
            DB::table('documentsupload')->where('empid', $empid->empid)->update($documents);
        }

        session()->flash('secmessage', 'User details Updated Successfully.');
        return response()->json(['status' => 1, 'message' => 'User details Updated Successfully.'], 200);
    }

    public function destroy($id)
    {
        DB::table('regis')->where('id', $id)->update(['status' => 0]);
        session()->flash('secmessage', 'User Deleted Successfully!');
        return response()->json(['status' => 1, 'message' => 'User Deleted Successfully!'], 200);
    }
}
