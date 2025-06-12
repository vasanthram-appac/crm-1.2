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

class Newnbdquestioner extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {

            $data = DB::table('newnbdquestioner')
                ->orderByDesc('id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('website_link', function ($row) {
                    if (!empty($row->website_link)) {
                        return '<a href="' . $row->website_link . '" target="_blank" style="text-decoration:none;">View</a>';
                    } else {
                        return '';
                    }
                })
                // ->addColumn('action', function ($row) {
                //     return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Newnbd::class, 'edit'], [$row->tid]) . '">
                //                 <i class="fi fi-ts-file-edit"></i>
                // 				<span class="tooltiptext  last">edit</span>
                //             </button>';
                // })
                ->rawColumns(['sno', 'website_link'])
                ->make(true);
        }

        return view('newnbdquestioner.index');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:100',
            'mobile' => 'required|digits_between:6,15',
            'email' => 'required|email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'business_name' => 'required|string|max:255',
            'turnover' => 'required|string|max:50',
            'business_type' => 'required|string',
            'monthly_budget' => 'required|string',
            'description' => 'required|string|max:1000',
            'other' => 'required_if:business_type,Others|string|max:500',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (
                empty($request->scope_of_work) &&
                empty($request->scope_of_workf) &&
                empty($request->scope_of_works) &&
                empty($request->scope_of_workt)
            ) {
                $validator->errors()->add('scope_of_work', 'At least one Scope of Work must be selected.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $val = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'business_name' => $request->business_name,
            'website_link' => $request->website_link,
            'description' => $request->description,
            'turnover' => $request->turnover,
            'business_type' => $request->business_type,
            'scope_of_work' => implode(', ', array_filter([
                $request->scope_of_work ?? '',
                $request->scope_of_workf ?? '',
                $request->scope_of_works ?? '',
                $request->scope_of_workt ?? ''
            ])),
            'monthly_budget' => $request->monthly_budget,
        ];

        if ($request->business_type == "Others") {
            $val['other'] = $request->other;
        }

        $insert = DB::table('newnbdquestioner')->insert($val);


        $htmlContent = '<html><title>Questioner Details</title><head></head><body><table style="background:#efeded" cellpadding="0" cellspacing="0" bgcolor="#EFEDED" border="0" width="575px"><tbody><tr><td align="center"><table width="96%" cellpadding="0" cellspacing="0"border="0"><tbody><tr><td style="border-top:5px solid #1e96d3;background:#fff;margin:0;padding:20px;border-spacing:0px"><table width="100%" cellpadding="0" cellspacing="0"><tbody>
         <tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><p style="color:#000;font-size:13px;margin:0;font-family:Arial,Helvetica,sans-serif"> <strong> Dear Sir/Madam, </strong> <br></p></td></tr>
         <tr><td style="margin:0;padding:0 0 5px 0"><p style="font-size:13px;background-color:rgb(234,234,234);color:rgb(0,0,0);font-family:Arial,Helvetica,sans-serif;font-weight:bold;line-height:1.5em;margin:0px;padding:0.4em;text-align:left"> New NBD Questioner</p></td></tr>

         <tr><td style="margin:0;padding:0px 0px 15px 0px;border-spacing:0px"><table style="font-family:Helvetica,Arial,sans-serif;font-size:12px;font-weight:bold;margin-top:10px;width:100%"><tbody>
         <tr><td style="width:200px;padding:4px 0">Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->name . '</td></tr>
         <tr><td style="width:200px;padding:4px 0">Email ID:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->email . '</td></tr>
         <tr><td style="width:200px;padding:4px 0">Mobile :</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->mobile . '</td></tr>

         <tr><td style="width:200px;padding:4px 0">Business Name:</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->business_name . ' </td></tr>
         <tr><td style="width:200px;padding:4px 0">Turnover</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->turnover . '</td></tr>

        <tr><td style="width:200px;padding:4px 0">Business Type</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->business_type . '</td></tr>';
        if ($request->business_type == "Others") {
            $htmlContent .= '<tr><td style="width:200px;padding:4px 0">Others</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->other . '</td></tr>';
        }

        $scopeFields = [
            $request->scope_of_work ?? null,
            $request->scope_of_workf ?? null,
            $request->scope_of_works ?? null,
            $request->scope_of_workt ?? null
        ];

        $shownScopeLabel = false;

        foreach ($scopeFields as $scope) {
            if (!empty($scope)) {
                $htmlContent .= '<tr>
            <td style="width:200px;padding:4px 0">' .
                    (!$shownScopeLabel ? 'Scope of Work' : '') .
                    '</td>
            <td>:</td>
            <td style="font-weight:normal">' . $scope . '</td>
        </tr>';
                $shownScopeLabel = true;
            }
        }

        $htmlContent .= '<tr><td style="width:200px;padding:4px 0">Budget</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->monthly_budget . '</td></tr>';

        if (!empty($request->website_link)) {
            $htmlContent .= '<tr><td style="width:200px;padding:4px 0">Website</td><td style="padding-right:10px"> :</td><td style="font-weight:normal"> ' . $request->website_link . '</td></tr>';
        }

        $htmlContent .= '<tr><td colspan="3" style="width:200px;padding:4px 0">Description</td></tr>

                                  <tr><td colspan="3" ><p>' . $request->description . '</p></td></tr>

                                  </tbody></table></td></tr></tbody></table></td></tr><tr><td style="margin:0;padding:15px  0"></td></tr></tbody></table></td></tr></tbody></table></body></html>';

        $bccEmail = env('SUPPORTMAIL');
        $founderEmail = env('FOUNDERMAIL');
        $infoMail = env('INFOMAIL');
        $managerMail = env('MANAGERMAIL');
        $thesupport = env('THESUPPORTMAIL');
        $info = env('INFOMAILCOM');

        Mail::send([], [], function ($message) use (

            $founderEmail,
            $managerMail,
            $bccEmail,
            $infoMail,
            $info,
            $thesupport,
            $htmlContent,
        ) {

            // Set recipients
            $message->to($founderEmail)
                ->cc(array_merge([$managerMail, $info, $thesupport]))
                ->bcc($bccEmail)
                ->replyTo($info, 'Appac Media')
                ->from($infoMail, 'Appac Media')
                ->subject('NBD Questioner')
                ->html($htmlContent);
        });

        return response()->json(['status' => 1, 'message' => 'Added Successfully.'], 200);
    }
}
