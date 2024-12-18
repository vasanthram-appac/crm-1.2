<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use DateTime;
use DB;

class Enquiryreport extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            if ($request->has('daterange')) {
                // Validation
                $validator = \Validator::make($request->all(), [    

                    'website' => 'nullable|exclude_if:pro_website,null', 
                    'pro_website' => 'nullable|exclude_if:website,null',

                ], [          

                    'website.exclude_if' => 'Please select either a website or promotion website, not both.',
                    'pro_website.exclude_if' => 'Please select either a website or promotion website, not both.',

                ])->after(function ($validator) use ($request) {

                    $daterange = $request->input('daterange');
                    $website = $request->input('website');
                    $pro_website = $request->input('pro_website');
                    
                    if ($daterange) {
                        $dates = explode(' - ', $daterange);
                        if (count($dates) !== 2) {
                            $validator->errors()->add('daterange', 'Please provide a valid date range.');
                        }
                    }
                    
                    if ($website && $pro_website) {
                        $validator->errors()->add('website', 'Please select either a website or promotion website, not both.');
                    }
                });
            
                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors(),
                    ], 422);
                }                                
            }
            
            $query = DB::connection('mysql_second')->table('website_enquiry_data')->where('flag_identity', 1);
            $db_date = DB::raw("STR_TO_DATE(enquiry_date, '%d-%m-%Y')");

            $website = $request->input('website');
            $pro_website = $request->input('pro_website');
            $daterange = $request->input('daterange');

            $startDate = '';
            $endDate = '';

            if ($daterange) {
                
                $dates = explode(' - ', $daterange);
                if (count($dates) == 2) {
                    $startDate = date('Y-m-d', strtotime($dates[0]));  
                    $endDate = date('Y-m-d', strtotime($dates[1]));    
                    
                    $query->whereBetween($db_date, [$startDate, $endDate]);                  
                }
            }else {
                // Default to current month
                $query->whereMonth($db_date, now()->month)
                      ->whereYear($db_date, now()->year);
            }
            
            if ($request->has('website') && !empty($request->website)) {
                $query->where('website', $request->website);
            }

            if ($request->has('pro_website') && !empty($request->pro_website)) {
                $query->where('website', $request->pro_website);
            }

            // Pagination
            $perPage = $request->get('length', 10);
            $start = $request->get('start', 0);
            $currentPage = ($start / $perPage) + 1;

            $data = $query->paginate($perPage, ['*'], 'page', $currentPage);

            // Add 'sno' (Serial Number) to the data response
            $data->getCollection()->transform(function ($item, $key) use ($start) {
                $item->sno = $start + $key + 1;
                return $item;
            });
                      
            
            $totalEnquiries = [];
            $currentDate = new DateTime();

            if ($startDate && $endDate) {
                $startDateObj = DateTime::createFromFormat('Y-m-d', $startDate);
                $endDateObj = DateTime::createFromFormat('Y-m-d', $endDate);

                $dateRangeInDays = $startDateObj->diff($endDateObj)->days;
                
                if ($dateRangeInDays > 365) {
                    // Define date ranges for more than one year
                    $lasttwelveMonthsStart = (clone $currentDate)->modify('-12 months')->modify('first day of this month');
                    $lastSixMonthsStart = (clone $currentDate)->modify('-6 months')->modify('first day of this month');
                    $lastThreeMonthsStart = (clone $currentDate)->modify('-3 months')->modify('first day of this month');
                    $currentMonthStart = (clone $currentDate)->modify('first day of this month');
                    $lastMonthStart = (clone $currentDate)->modify('-1 month')->modify('first day of this month');
                    $lastMonthEnd = (clone $currentDate)->modify('-1 month')->modify('last day of this month');

                    // Ranges for the response
                    $ranges = [
                        ['label' => 'Current Year', 'start' => $lasttwelveMonthsStart->format('Y-m-d'), 'end' => $currentDate->format('Y-m-d')],
                        ['label' => 'Last 6 Months', 'start' => $lastSixMonthsStart->format('Y-m-d'), 'end' => $currentDate->format('Y-m-d')],
                        ['label' => 'Last 3 Months', 'start' => $lastThreeMonthsStart->format('Y-m-d'), 'end' => $currentDate->format('Y-m-d')],
                        ['label' => 'Current Month', 'start' => $currentMonthStart->format('Y-m-d'), 'end' => $currentDate->format('Y-m-d')],
                        ['label' => 'Last Month', 'start' => $lastMonthStart->format('Y-m-d'), 'end' => $lastMonthEnd->format('Y-m-d')],
                    ];

                    foreach ($ranges as $range) {
                        $totalEnquiry = DB::connection('mysql_second')->table('website_enquiry_data')
                            ->where('flag_identity', 1)
                            ->whereBetween(DB::raw("STR_TO_DATE(enquiry_date, '%d-%m-%Y')"), [$range['start'], $range['end']]);

                        // Apply website filters if provided
                        if ($request->has('website') && !empty($request->website)) {
                            $totalEnquiry->where('website', $request->website);
                        }
                        if ($request->has('pro_website') && !empty($request->pro_website)) {
                            $totalEnquiry->where('website', $request->pro_website);
                        }

                        $totalEnquiries[] = [
                            'month' => $range['label'],
                            'totalEnquiryCount' => $totalEnquiry->count(),
                        ];
                    }
                } else {
                    // For date ranges within one year
                    $totalEnquiry = DB::connection('mysql_second')->table('website_enquiry_data')
                        ->where('flag_identity', 1)
                        ->whereBetween(DB::raw("STR_TO_DATE(enquiry_date, '%d-%m-%Y')"), [$startDate, $endDate]);

                    // Apply website filters if provided
                    if ($request->has('website') && !empty($request->website)) {
                        $totalEnquiry->where('website', $request->website);
                    }
                    if ($request->has('pro_website') && !empty($request->pro_website)) {
                        $totalEnquiry->where('website', $request->pro_website);
                    }

                    $totalEnquiries[] = [
                        'month' => 'Selected Range',
                        'totalEnquiryCount' => $totalEnquiry->count(),
                    ];
                }
            } else {
                // If no date range is selected, show the current month's data by default
                $currentMonthStart = (clone $currentDate)->modify('first day of this month');
                $totalEnquiry = DB::connection('mysql_second')->table('website_enquiry_data')
                    ->where('flag_identity', 1)
                    ->whereBetween(DB::raw("STR_TO_DATE(enquiry_date, '%d-%m-%Y')"), [$currentMonthStart->format('Y-m-d'), $currentDate->format('Y-m-d')]);
            
                $totalEnquiries[] = [
                    'month' => 'Current Month',
                    'totalEnquiryCount' => $totalEnquiry->count(),
                ];
            }
                  
            // Initialize arrays
            $enquiryCounts = [];
            $months = [];
            $monthCounts = [];

            // Get the current date
            $currentDate = new DateTime();
            $currentMonth = (int)$currentDate->format('m'); // Current month
            $currentYear = (int)$currentDate->format('Y'); // Current year

            // Check if a custom date range was provided; if not, use the current month
            if (!$startDate || !$endDate) {
                // Set the start date to the first day of the current month
                $startDate = $currentDate->format('Y-m-01'); // First day of the current month
                
                // Set the end date to the current date
                $endDate = $currentDate->format('Y-m-d');
            }else{

                // Create DateTime objects for the start and end date
                $startDateObj = new DateTime($startDate);
                $endDateObj = new DateTime($endDate);
                $interval = $startDateObj->diff($endDateObj);

                // Check if the selected range exceeds the current month (April in this case)
                $currentMonth = (int)date('m'); // Current month
                $selectedStartMonth = (int)$startDateObj->format('m'); // Selected start month

                // If the selected range goes beyond the current month, set the start date to April of the current year
                if ($selectedStartMonth < 4 && $currentMonth >= 4) {
                    $startDate = (new DateTime('first day of April this year'))->format('Y-m-d'); // Start from April of the current year
                }
            }

            // Build the query to filter by date range
            $query->whereBetween($db_date, [$startDate, $endDate]);

            // Create DateTime objects for the range
            $start = new DateTime($startDate);
            $end = new DateTime($endDate);

            while ($start <= $end) {
                // Get the month and year for the current iteration
                $monthName = $start->format('M'); // Short month name (e.g., Jan, Feb)
                $year = $start->format('Y'); // Year (e.g., 2024)

                // Count the enquiries for this specific month
                $monthStart = $start->format('Y-m-01'); // First day of the month
                $monthEnd = $start->format('Y-m-t'); // Last day of the month

                $monthQuery = clone $query; // Clone the base query to modify it for each month
                $enquiryCount = $monthQuery->whereBetween($db_date, [$monthStart, $monthEnd])->count();

                // Add the result to the array
                $enquiryCounts[] = [
                    'month' => $monthName,
                    'enquiries' => $enquiryCount,
                ];

                // Move to the next month
                $start->modify('+1 month');
            }

            // Prepare data for the view (Google Chart will use this)
            $enquiryCountsArray = $enquiryCounts;  // Already an array at this point
            $months = array_column($enquiryCountsArray, 'month');
            $monthCounts = array_column($enquiryCountsArray, 'enquiries');

            // Prepare data for the Google Chart or any other charting library
            $enquiryCounts = array_map(function($month, $count) {
                return [
                    'month' => $month,  // Month name
                    'enquiries' => $count  // Number of enquiries
                ];
            }, $months, $monthCounts);

            // Return the response
            return response()->json([
                'draw' => $request->get('draw'),
                'recordsTotal' => DB::connection('mysql_second')->table('website_enquiry_data')->count(),
                'recordsFiltered' => $data->total(),
                'data' => $data->items(),
                'enquiryCounts' => $enquiryCounts,
                'totalEnquiries' => $totalEnquiries,
            ]);
        }

        // Return default view with filter options
        $websites = DB::connection('mysql_second')->table('company_master')->pluck('comp_website', 'comp_website');
        $pro_websites = DB::connection('mysql_second')->table('company_master')->where('promotion', 1)->orderBy('comp_website')->get();
        
        return view('enquiryreport.index', compact('websites', 'pro_websites'));

    }      
}


