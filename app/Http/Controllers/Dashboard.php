<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DateTime;
use DB;

class Dashboard extends Controller
{

    public function index(Request $request)
    {
    
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {

            $data = DB::table('hosting')
            ->join('domainmaster', 'hosting.domainname', '=', 'domainmaster.id')
            ->join('accounts', 'hosting.company_name', '=', 'accounts.id')
            ->select(
                'hosting.*',
                'domainmaster.domainname',
                'accounts.company_name as companyname',
                'accounts.phone',
                'accounts.emailid',
                DB::raw("DATE_FORMAT(STR_TO_DATE(hosting.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat")
            )
            ->where('hosting.status', '0')
            ->orderBy('dateofexpire', 'ASC')
            ->get();
        

                foreach ($data as $domain) {
                    $currentDate = date('d-m-Y');  // Get the current date in d-m-Y format
                    $expiryDate = $domain->dateofexpire;  // Assuming it's in d-m-Y format
    
                    // Convert both dates to timestamp (seconds since epoch)
                    $currentTimestamp = strtotime($currentDate);
                    $expiryTimestamp = strtotime($expiryDate);
    
                    // Calculate the difference in days
                    $diff = ($expiryTimestamp - $currentTimestamp) / (60 * 60 * 24); // Difference in days
    
                    $diff = (int) $diff;  // Cast to integer for exact day count
        
                    // Determine status based on the difference in days
                    if ($diff > 0 && $diff <= 30) {
                        $bg = '#FFF3DD'; // Yellow
                        $cc = '#D68A00';
                        $remainday1 = '<b>' . $diff . '</b> Days Remaining';
                    } elseif ($diff > 30) {
                        $bg = '#F6FFF1'; // Green
                        $cc = '#38A800 ';
                        $remainday1 = '<b>' . $diff . '</b> Days Remaining';
                    } elseif ($diff == 0) {
                        $bg = '#F6FFF1'; // Green
                        $cc = '#38A800 ';
                        $remainday1 = 'Today is the day to Renew';
                    } else {
                        $bg = '#FFF0F0'; // Red
                        $cc = '#F41B1B';
                        $remainday1 = $diff;
                    }
                    $domain->cc = $cc;
                    $domain->bg = $bg;
                    $domain->remainday1 = $remainday1;
                }

                
    
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
                ->addColumn('remainday1', function ($row) {

                    $nextStatus = $row->bg == '#FFF0F0' ? 'Overdue for <b>' . abs($row->remainday1) . '</b> Days' : $row->remainday1;

                    return '<p style="padding: 5px 15px 6px; margin-bottom: 0; border-radius: 5px; color: ' . $row->cc . '; background-color: ' . $row->bg . ';">' . $nextStatus . '</p>';
    
                })
                ->rawColumns(['sno', 'companyname', 'domainname', 'remainday1', '',])
                ->make(true);
        }
        $currentDate = new DateTime();
        $leadCounts = [];
        $wipenqs = [];
        
        for ($i = 0; $i < 7; $i++) {
            $date = clone $currentDate; // Clone the current date
            $date->modify("-$i months");
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

        for ($i = 0; $i < 7; $i++) {
            $date = clone $currentDate; // Clone the current date
            $date->modify("-$i months");
            $month = $date->format('m');
            $year = $date->format('Y');
        
           // $servername = "appacmedia-data-rds-private-aps1.cdamytlhflpj.ap-south-1.rds.amazonaws.com";
            // $username = "appacprodadmin";
            // $password = "cS4#i7Ls!02DOmL";
            // $db = "appacdb";

            // $conn = new \mysqli($servername, $username, $password, $db);


            // if ($conn->connect_error) {
                // return response()->json([
                    // 'error' => 'Connection failed: ' . $conn->connect_error
                // ], 500);
            // }

            // $query = "SELECT COUNT(*) AS total FROM website_enquiry_data 
            // WHERE SUBSTRING(enquiry_date, 4, 2) = ? AND SUBSTRING(enquiry_date, 7, 4) = ?";
            // $stmt = $conn->prepare($query);
            // $stmt->bind_param("ss", $month, $year);
            // $stmt->execute();
            // $stmt->bind_result($wipenq);
            // $stmt->fetch();
			
			$wipenq = DB::connection('mysql_second') // Specify the second database connection
    ->table('website_enquiry_data')
    ->where(DB::raw("SUBSTRING(enquiry_date, 4, 2)"), $month)
    ->where(DB::raw("SUBSTRING(enquiry_date, 7, 4)"), $year)
    ->count();

        
            $wipenqs[] = [
                'month' => $date->format('M Y'),
                'leads' => $wipenq
            ];
        }

        


        $activeAcc = DB::table('accounts')->where('status', '!=', 0)->count();
        $proforma = DB::table('proformadetails')->count();
        $invoice = DB::table('invoicedetails')->count();
        $wip_history = DB::table('wip_history')->count();
        $keyaccounts = DB::table('accounts')->where('status', '!=', 0)->where('active_status', 'active')->where('key_status', 1)->count();

        $website_enquiry_data=DB::connection('mysql_second')->table('website_enquiry_data')->where('flag_identity',1)->count();
    
        $aallead = DB::table('leads')->count();

        $opportunity = DB::table('opportunity')->count();

        $work_order = DB::table('work_order')->count();

        $dailyreport = DB::table('dailyreport')->where('report_date1', date('Y-m-d', strtotime('-1 day')))->count();
    
        return view('dashboard/index')->with(compact('leadCounts','activeAcc','proforma','invoice','wip_history' ,'keyaccounts','aallead','wipenqs','opportunity','website_enquiry_data','work_order','dailyreport'))->render();
    }


    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
          
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'gst_number' => 'required|string|max:15',
           
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
        
         
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val=[

        'leaddate'=>date('d-m-Y'),
        'title'=>$request->title,
        'firstname'=>$request->firstname,
        'lastname'=>$request->lastname,
        'company_name'=>$request->company_name,
        'gst_number'=>$request->gst_number,
        'stdcode'=>'+91',
        'phone'=>$request->phone,
        'alternate_phone'=>$request->alternate_phone,
        'assignedto'=>$request->assignedto,
        'status'=>$request->status,
        'summary'=>$request->summary,
        'designation'=>$request->designation,
        'department'=>$request->department,
        'emailid'=>$request->emailid,
        'alternateemail'=>$request->alternateemail,
        'website'=>$request->website,
        'leadsource'=>$request->leadsource,
        'address'=>$request->address,
        'city'=>$request->city,
        'state'=>$request->state,
        'pincode'=>$request->pincode,
        'country'=>$request->country,
        'oppourtunity_status'=>'inactive',

    ];
        /*Check Duplicate leads in database*/
        $Selectmobile=DB::table('leads')->where('phone',$request->phone)->where('gst_number',$request->gst_number)->get();
      

        if(count($Selectmobile) > 0)
        {
            session()->flash('secmessage', 'Lead Already Exists in our Database.');
            return response()->json(['status' => 0, 'message' => 'Lead Already Exists in our Database.'], 200);
        }
        else
        {
      
            $lead_id = DB::table('leads')->insertGetId($val);
            
            session()->flash('secmessage', 'Lead Successfully Created.');
            return response()->json(['status' => 1, 'message' => 'Lead Successfully Created.'], 200);
        
        }
    }



    

   

  
}