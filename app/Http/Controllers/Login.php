<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Validator;

use DB;

class Login extends Controller
{

    public function index()
    {
		
        request()->session()->put('serverip', request()->header('X-Forwarded-For'));

        if (request()->session()->has('empid') && request()->session()->get('empid') != null && request()->session()->get('otp') == null) {
            // dd(request()->session()->get('customer_id'));
              if(request()->session()->get('role') !='user'){
                return redirect()->to('/dashboard');
            }else{
                return redirect()->to('/userdashboard');
            }
        } else {
            return view('login/index')->render();
        }
    }

    public function Login(Request $request)
    {
 
        if (env('IPADDRESS') == request()->session()->get('serverip') || env('IPADDRESSJIO')==request()->session()->get('serverip')) {

            $user = DB::table('regis')->where('empid', $request->username)->where('status', 1)->get();

            
            if (request()->session()->has('empid') && request()->session()->get('empid') != null) {

                
            if(request()->session()->get('role') !='user'){
                return redirect()->to('/dashboard');
            }else{
                return redirect()->to('/userdashboard');
            }
            } else {

                // if (count($user) > 0 && Hash::check($request->password, $user[0]->password)) {
					
					if (count($user) > 0 && base64_encode($request->password) == $user[0]->password) {

                    $token = implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));

                    $data = [
                        'token' => $token
                    ];

                    $userupdate = DB::table('regis')->where('id', $user[0]->id)->update($data);
                    $id = $user[0]->id;

                    request()->session()->put('empid', $user[0]->empid);
                    request()->session()->put('token', $token);

                    request()->session()->put('emailid', $user[0]->emailid);
                    request()->session()->put('password', $user[0]->password);
                    request()->session()->put('role', $user[0]->role);
                    request()->session()->put('company', $user[0]->company);
                    request()->session()->put('id', $user[0]->id);
                    request()->session()->put('fname', $user[0]->fname);
                    request()->session()->put('lname', $user[0]->lname);
                    request()->session()->put('dept_id', $user[0]->dept_id);
                    request()->session()->put('login_time_stamp', time());

                    $photo = DB::table('documentsupload')->where('empid', $user[0]->empid)->first();
                    request()->session()->put('profilephoto',$photo->photo);
                    request()->session()->put('avatarphoto',$photo->avatar);

                    
            if($user[0]->role !='user'){
                return redirect()->to('/dashboard');
            }else{
                return redirect()->to('/userdashboard');
            }
                } else {
                    return redirect()->back()->with('secmessage', 'Invalid Username and Password');
                }
            }
        } else {

            $user = DB::table('regis')->where('empid', $request->username)->where('status', 1)->get();

            // dd($user->password);
            if (request()->session()->has('empid') && request()->session()->get('empid') != null) {

                  if(request()->session()->get('role') !='user'){
                return redirect()->to('/dashboard');
            }else{
                return redirect()->to('/userdashboard');
            }
            } else {

                if (count($user) > 0) {

                    $fname   = $user[0]->fname;
                    $lname   = $user[0]->lname;
                    $email   = $user[0]->emailid;
                    $otp = rand(100000, 999999);

                    // $bccEmail = env('SUPPORTMAIL');
                    $replyToEmail = "info@appacmedia.org";

                    $replyToEmail = env('TECHADMINMAIL');
                    $cc = env('FOUNDERMAIL');
       
                    $infomail = env('INFOMAIL');
                    $appname= env('APP_NAME');

                //     Mail::send([], [], function ($message) use ($email, $infomail, $fname, $lname, $otp, $appname) {
                //         $message->to($email) 
                //             // ->bcc($bccEmail) 
                //             ->replyTo($infomail) 
                //             ->from($infomail, $appname) 
                //             ->subject('OTP for verification') 
                //             ->html('
                //     <span style="margin-top:50px;"></span>
                //     Dear ' . $fname . ' ' . $lname . ',<br><br>
                //     Thanks for your interest. Your OTP is ' . $otp . ' for verification from Appac Media.<br>
                // '); // Set the HTML content directly
                //     });

                    request()->session()->put('otp', $otp);
                    request()->session()->put('empid', $user[0]->empid);

                    $val = [

                        "empid" => $user[0]->empid,
                        "otp" => $otp,
                        "ipaddress" => request()->session()->get('serverip'),

                    ];


                    $upd = DB::table('otp')->insert($val);

                    return redirect()->back()->with('secmessage', 'Please enter your email OTP.');
                } else {
                    return redirect()->back()->with('secmessage', 'Invalid Username and Password');
                }
            }
        }
    }

    public function verifyotp(Request $request)
    {


        $otp = DB::table('otp')->select('otp')->where('empid', request()->session()->get('empid'))->orderBy('id', 'desc')->first();

        if ($otp->otp == $request->otp) {
            request()->session()->put('otp', "");
            $user = DB::table('regis')->where('empid',  request()->session()->get('empid'))->where('status', 1)->get();


            $token = implode('-', str_split(substr(strtolower(md5(microtime() . rand(1000, 9999))), 0, 30), 6));

            $data = [
                'token' => $token
            ];

            $userupdate = DB::table('regis')->where('id', $user[0]->id)->update($data);
            $id = $user[0]->id;
            $fname = $user[0]->fname;
            $lname = $user[0]->lname;

            request()->session()->put('empid', $user[0]->empid);
            request()->session()->put('token', $token);

            request()->session()->put('emailid', $user[0]->emailid);
            request()->session()->put('password', $user[0]->password);
            request()->session()->put('role', $user[0]->role);
            request()->session()->put('company', $user[0]->company);
            request()->session()->put('id', $user[0]->id);
            request()->session()->put('fname', $user[0]->fname);
            request()->session()->put('lname', $user[0]->lname);
            request()->session()->put('dept_id', $user[0]->dept_id);
            request()->session()->put('login_time_stamp', time());

            $photo = DB::table('documentsupload')->where('empid', $user[0]->empid)->first();
            request()->session()->put('profilephoto',$photo->photo);
            request()->session()->put('avatarphoto',$photo->avatar);


            $bccEmail = env('SUPPORTMAIL');
            $replyToEmail = env('TECHADMINMAIL');
            $cc = env('FOUNDERMAIL');
            $ip = request()->session()->get('empid');
            $infomail = env('INFOMAIL');
            $appname= env('APP_NAME');
            
            // Mail::send([], [], function ($message) use ($cc, $replyToEmail, $bccEmail, $fname, $lname, $ip, $infomail, $appname) {
            //     $message->to($replyToEmail)
            //             ->cc($cc)
            //             ->bcc($bccEmail)
            //             // ->bcc('kavin.appac@gmail.com')
            //             ->replyTo($replyToEmail)
            //             ->from($infomail, $appname)
            //             ->subject('CRM Login Alert')
            //             ->html(
            //                 '<span style="margin-top:50px;"></span>' .
            //                 'Dear Team,<br><br>' .
            //                 'CRM has been tried to login outside the office, Employee name: ' . $fname . ' ' . $lname . ' & IP address: ' . $ip . '<br>'
            //             ); // Set the HTML content directly
            // });

            if($user[0]->role !='user'){
                return redirect()->to('/dashboard');
            }else{
                return redirect()->to('/userdashboard');
            }
            
        } else {
            return redirect()->back()->with('secmessage', 'Invalid OTP');
        }
    }



    public function Logout(Request $request)
    {
        session()->flush();
        request()->session()->put('empid', "");
        request()->session()->put('token', "");
        request()->session()->put('usertype', "");
        return response()->json(['status' => 1], 200);
    }
}
