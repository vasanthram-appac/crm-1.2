<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $req, Closure $next)
    {
        $empid = request()->session()->get('empid');
        $token = request()->session()->get('token');
        //     dd($customer_id,$token);

        if ((!empty($empid)) && (!empty($token))) {

            $get_dtl = DB::table('regis')->where('empid', $empid)->where('token', $token)->get();

            if (count($get_dtl) == 0) {
                request()->session()->put('empid', '');
                request()->session()->put('token', '');
                session()->flush();
                return redirect()->to('/');
            } else {

                $month = date('m-Y');
                $today = date('d');
                $pays = DB::table('emp_payslip')->where('month_year', $month)->count();

                if ($pays == 0 && $today == '26') {

                    $data = DB::table('emp_salary')
                        ->select('emp_salary.*')
                        ->join('regis', 'emp_salary.empid', '=', 'regis.empid')
                        ->where('regis.status', 1)
                        ->orderByDesc('regis.status')->get();

                    if (count($data) > 0) {

                        foreach ($data as $pay) {
                                $tds = '0';
                            $basic = $pay->salary * (40 / 100);
                            $hra = $pay->salary * (30 / 100);
                            $conveyance = $pay->salary * (8 / 100);
                            $special = $pay->salary * (22 / 100);
                            $generatedate = date('Y-m-d H:i:s');

                            if ($pay->salary <= 21000) {
                                $employee_contribution = round((0.75 / 100) * $pay->salary);
                                $employer_contribution = round((3.25 / 100) * $pay->salary);
                                $esi = $employee_contribution + $employer_contribution;
                            } else {
                                $esi = 0;
                                $employee_contribution = 0;
                                $employer_contribution = 0;
                            }

                            $pdata = [
                                'empid' => $pay->empid,
                                'month_year' => date('m-Y'),
                                'specl_amt' => 0,
                                'lop' => 0,
                                'totalleave' => 0,
                                'other' => 0,
                                'generate_date' => $generatedate,
                                'generated_by' => 'admin',
                                'pf' => 0,
                                'pt' => 0,
                                'tds' => $tds,
                                'esi' => $esi,
                                'employee_contribution' => $employee_contribution,
                                'employer_contribution' => $employer_contribution,
                                'summary' => "",
                                'salary' => $pay->salary ,
                                'netsalary' => $pay->salary - $employee_contribution,
                                'basic_salary' => $basic,
                                'conveyance_allowance' => $conveyance,
                                'hra' => $hra,
                                'special_allowance' => $special,
                                'status' => 1,
                            ];

                            $last_id = DB::table('emp_payslip')->insertGetID($pdata);
                        }
                    }
                }

                return $next($req);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
