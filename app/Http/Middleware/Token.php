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

                return $next($req);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
