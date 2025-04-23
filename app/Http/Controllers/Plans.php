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

class Plans extends Controller
{

    public function index(Request $request)
    {
        if(request()->session()->get('role') =='user'){
            return redirect()->to('/workreport');
        }

        if (request()->ajax()) {
            $data = DB::table('plans')
                ->join('domainmaster', 'plans.domainname', '=', 'domainmaster.id')
                ->join('accounts', 'plans.company_name', '=', 'accounts.id')
                ->select('plans.*', 'domainmaster.domainname', 'accounts.company_name as companyname', 'accounts.phone', 'accounts.emailid', DB::raw("DATE_FORMAT(STR_TO_DATE(plans.dateofexpire, '%d-%m-%Y'), '%Y-%m-%d') as DateFormat"))
                ->where('plans.status', '0')
                ->orderBy('id', 'ASC')
                ->get();
            // dd($data);
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
                    $remainday1 ='<b>'.$diff .'</b>'. ' Days Remaining';
                } elseif ($diff > 30) {
                    $bg = '#F6FFF1'; // Green
                    $cc = '#38A800 ';
                    $remainday1 = '<b>'.$diff .'</b>'. ' Days Remaining';
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
                ->addColumn('', function ($row) {
                    // Determine the next active status based on the current status
                    $nextStatus = $row->status == '0' ? '1' : '0';
                    $nextStatusLabel = $row->status == '0' ? '<i class="fi fi-ts-toggle-off"></i> <span class="tooltiptext">active</span>' : '<i class="fi fi-ts-toggle-on"></i> <span class="tooltiptext">inactive</span>';

                    return '<button class="btn btn-modal  change-status" data-container=".appac_show" data-href="' . route('domainstatusupdate', [
                        'id' => $row->id,
                        'status' => $nextStatus,
                        'table' => 'plans',
                    ]) . '">' . $nextStatusLabel . '</button>';
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Plans::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
					 <span class="tooltiptext">edit</span>
					</button>
                    <button class="btn btn-modal conformdelete" data-id="' . $row->id . '"><i class="fi fi-ts-trash-xmark"></i>
					<span class="tooltiptext">delete</span>
					</button>';
                })

                ->rawColumns(['sno', 'companyname', 'domainname', 'remainday1', '', 'action'])
                ->make(true);
        }

        return view('plans/index')->render();
    }

    public function create(Request $request)
    {
        $domainmaster = DB::table('domainmaster')
            ->join('accounts', 'domainmaster.company_name', '=', 'accounts.id')
            ->where('domainmaster.domainname', '!=', '')
            ->groupBy('domainmaster.company_name')
            ->groupBy('accounts.company_name')
            ->groupBy('accounts.id')
            ->orderBy('accounts.company_name', 'ASC')
            ->select('domainmaster.company_name', 'accounts.company_name as company_name_full', 'accounts.id')
            ->get();
        // dd(  $domainmaster);
        // return view('domain/create')->render();
        return view('plans/create', compact('domainmaster'))->render();
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Define validation rules for inputs
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'domainname' => 'required|string',
            'dateofregis' => 'required|date',
            'plansperiod' => 'required',
            'amount' => 'required',
            'planstype' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $existingDomain = DB::table('plans')
            ->where('company_name', $request->company_name)
            ->where('domainname', $request->domainname)
            ->where('type',$request->planstype)
            ->exists();

        if ($existingDomain) {
            session()->flash('secmessage', 'Plans Already added in Server');
            return response()->json(['status' => 1, 'message' => 'Plans Already added in Server'], 200);
        }

        // Format dates
        $registerDate = date("d-m-Y", strtotime($request->dateofregis));
        $plansPeriod = $request->plansperiod;
        $effectiveDate = date('Y-m-d', strtotime("+$plansPeriod months", strtotime($request->dateofregis)));
        $dateOfExpire = date("d-m-Y", strtotime($effectiveDate));
        $domainMonth = date("M-Y", strtotime($effectiveDate));

        // Retrieve the current user's email ID and current date/time
        $empid = request()->session()->get('empid');
        $datetime = date("F j, Y, g:i A");

        // Prepare data for insertion
        $domainData = [
            'company_name' => $request->company_name,
            'domainname' => $request->domainname,
            'dateofregis' => $registerDate,
            'plansperiod' => $plansPeriod,
            'dateofexpire' => $dateOfExpire,
            'dateofexpire1' => $effectiveDate,
            'plansmonth' => $domainMonth,
            'empid' => $empid,
            'datetime' => $datetime,
            'amount' => $request->amount,
            'type' => $request->planstype,
      
        ];

        // Insert data into the database
        DB::table('plans')->insert($domainData);

        session()->flash('secmessage', 'Server details Successfully Added.');
        return response()->json(['status' => 1, 'message' => 'Server details Successfully Added.'], 200);
    }

    public function edit($id)
    {
        $plans = DB::table('plans')->select('id', 'company_name', 'domainname', 'dateofregis', 'dateofexpire', 'plansperiod', 'empid', 'datetime', 'amount', 'type')->find($id);

        $accounts = DB::table('accounts')->select('id', 'company_name')->find($plans->company_name);

        $domainmaster = DB::table('domainmaster')->select('domainname')->find($plans->domainname);

        return view('plans.edit')->with(compact('plans', 'accounts', 'domainmaster'));
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'renewaldate' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Date formatting
        $renewaldate = date("d-m-Y", strtotime($request->renewaldate));

        // Extracting data from the request
        $plansPeriod = $request->plansperiod;
        $effectiveDate = date('Y-m-d', strtotime("+$plansPeriod months", strtotime($renewaldate)));
        $expireDateFormatted = date("d-m-Y", strtotime($effectiveDate));
        $thisMonth = date("M", strtotime($effectiveDate));
        $thisYear = date("Y", strtotime($effectiveDate));
        $plansMonth = "$thisMonth-$thisYear";

        $data = [
            'company_name' => $request->companyid,
            'domainname' => $request->domainname,
            'dateofregis' => $renewaldate,
            'plansperiod' => $plansPeriod,
            'dateofexpire' => $expireDateFormatted,
            'dateofexpire1' => $effectiveDate,
            'plansmonth' => $plansMonth,
            'empid' => request()->session()->get('empid'),
            'datetime' => date("F j, Y, g:i A"),
            'amount' => $request->amount,
            'type' => $request->planstype,
        ];

        // Update the plans record
        $updated = DB::table('plans')->where('id', $id)->update($data);

        session()->flash('secmessage', 'Server details updated successfully.');
        return response()->json(['status' => 1, 'message' => 'Server details updated successfully.'], 200);
    }

    public function destroy($id)
    {

        $upd = DB::table('plans')->where('id', $id)->delete();
        session()->flash('secmessage', 'Plans Deleted Successfully!');

        return response()->json(['status' => 1, 'message' => 'Plans Deleted Successfully!'], 200);
    }



}
