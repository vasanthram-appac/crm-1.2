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

class Resignation extends Controller
{

    public function index(Request $request)
    {


        if (request()->ajax()) {
            $data = DB::table('resignation')
                ->where('empid', request()->session()->get('empid'))
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })

                ->rawColumns(['sno'])
                ->make(true);
        }

        return view('resignation/index')->render();
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:100',
            'resignationdate' => 'required|date',
            'description' => 'required|max:2000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'subject' => $request->subject,
            'description' => $request->description,
            'resignationdate' => $request->resignationdate,
            'submitdate' => date("d-m-Y"),
            'empid' => request()->session()->get('empid'),
        ];

        $insert = DB::table('resignation')->insert($val);

        $user = DB::table('regis')->where('empid', request()->session()->get('empid'))->first();

        $bccEmail = env('SUPPORTMAIL');
        $founderEmail = env('FOUNDERMAIL');
        $infoMail = env('INFOMAIL');

        $appName = env('APP_NAME');

        Mail::send([], [], function ($message) use ($appName, $infoMail, $founderEmail, $bccEmail, $request, $user) {
            $message->to($founderEmail)
                ->cc($bccEmail)
                ->from($infoMail, $appName)
                ->subject($request->subject)
                ->html(
                    '<html><title></title><head></head>   <body> <table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="font-size:14px;color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:center">Resignation Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Hi Sir, </strong> <br></p></td></tr><tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> Resignation Details</p></td></tr><tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody><tr><td style="width:200px;padding:4px 0"> Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $user->fname . " " . $user->lname . '</td></tr><tr><td style="width:200px;padding:4px 0">Resignation Date</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->resignationdate . '</td></tr><tr><td style="width:200px;padding:4px 0">Reason</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->description . '</td></tr></tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>'
                );
        });

        session()->flash('secmessage', 'Sent Successfully.');
        return response()->json(['status' => 1, 'message' => 'Sent Successfully.'], 200);
    }
}
