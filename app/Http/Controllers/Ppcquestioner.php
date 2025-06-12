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

class Ppcquestioner extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }
        // dd($request);
        if ($request->ajax()) {

            $data = DB::table('client_questionnaire')
                ->orderByDesc('id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('website', function ($row) {
                    if (!empty($row->website)) {
                        $url = (preg_match("/^https?:\/\//", $row->website)) ? $row->website : 'https://' . $row->website;
                        return '<a href="' . $url . '" target="_blank" style="text-decoration:none;">View</a>';
                    } else {
                        return '';
                    }
                })
                ->addColumn('landing_page_URL', function ($row) {
                    if (!empty($row->landing_page_URL)) {
                        $url = (preg_match("/^https?:\/\//", $row->landing_page_URL)) ? $row->landing_page_URL : 'https://' . $row->landing_page_URL;
                        return '<a href="' . $url . '" target="_blank" style="text-decoration:none;">View</a>';
                    } else {
                        return '';
                    }
                })

                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Ppcquestioner::class, 'edit'], [$row->id]) . '">
                                <i class="fi fi-ts-user-check"></i>
                				<span class="tooltiptext  last">View</span>
                            </button>';
                })
                ->rawColumns(['sno', 'website', 'landing_page_URL', 'action'])
                ->make(true);
        }

        return view('ppcquestioner.index');
    }

    public function edit($id)
    {
        $ppcquestioner = DB::table('client_questionnaire')->where('id', $id)->first();

        return view('ppcquestioner/edit', compact('ppcquestioner'))->render();
    }
}
