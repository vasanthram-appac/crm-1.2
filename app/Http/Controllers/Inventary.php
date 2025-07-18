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

class Inventary extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/userdashboard');
        }
        if ($request->ajax()) {

            $data = DB::table('appac_inventory')
                ->OrderbyDesc('id')
                ->get();

            return DataTables::of($data)
                ->addColumn('sno', function ($row) {
                    return '';
                })
                ->addColumn('description', function ($row) {
                    return $row->description;
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<button class="btn btn-modal" data-container=".customer_modal" data-href="' . action([Inventary::class, 'edit'], [$row->id]) . '"><i class="fi fi-ts-file-edit"></i>
                              <span class="tooltiptext">edit</span></button>';

                    $fileLink = '';
                    if (!empty($row->file)) {
                        $fileLink = ' <a href="' . $row->file . '" target="_blank" style="text-decoration:none;"><i class="fi fi-ts-user-check"></i></a>';
                    }

                    return $editBtn . $fileLink;
                })

                ->rawColumns(['sno', 'description', 'action'])
                ->make(true);
        }

        return view('inventary.index');
    }

    public function create(Request $request)
    {

        $vendor = DB::table('vendorlist')->pluck('company_name', 'id');

        return view('inventary/create')->with(compact('vendor'))->render();
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $vendorname = DB::table('vendorlist')->select('company_name')->where('id', $request->vendor_id)->first();

        $val = [
            'vendor_id' => $request->vendor_id,
            'vendor_name' => $vendorname->company_name,
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'taxable_value' => $request->taxable_value,
            'total_invoice_value' => $request->total_invoice_value,
            'empid' => request()->session()->get('empid'),
        ];

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $extension = strtolower($file->getClientOriginalExtension());

            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('assetlibrary/image');
                $path = "assetlibrary/image/";
            } else {
                $folderPath = public_path('assetlibrary/document');
                $path = "assetlibrary/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }
            $val['file'] = $filesave;
        }



        $insert = DB::table('appac_inventory')->insertGetId($val);

        session()->flash('secmessage', 'Asset Created Successfully');
        return response()->json(['status' => 1, 'message' => 'Asset Created Successfully'], 200);
    }

    public function edit($id)
    {

        $asset = DB::table('appac_inventory')->find($id);

        $vendor = DB::table('vendorlist')->pluck('company_name', 'id');

        return view('inventary/edit')->with(compact('asset', 'vendor'))->render();
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $vendorname = DB::table('vendorlist')->select('company_name')->where('id', $request->vendor_id)->first();
        $val = [
            'vendor_id' => $request->vendor_id,
            'vendor_name' => $vendorname->company_name,
            'date' => $request->date,
            'title' => $request->title,
            'description' => $request->description,
            'taxable_value' => $request->taxable_value,
            'total_invoice_value' => $request->total_invoice_value,
            'empid' => request()->session()->get('empid'),
        ];

        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();

            $extension = strtolower($file->getClientOriginalExtension());

            $imgExtensions = ['webp', 'png', 'jpg', 'jpeg'];

            if (in_array($extension, $imgExtensions)) {
                $folderPath = public_path('asset/image');
                $path = "asset/image/";
            } else {
                $folderPath = public_path('asset/document');
                $path = "asset/document/";
            }

            if (!is_dir($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            if ($request->file('file')->move($folderPath, $fileName)) {
                $filesave = $path . $fileName;
            }
            $val['file'] = $filesave;
        }

        $insert = DB::table('appac_inventory')->where('id', $id)->update($val);

        session()->flash('secmessage', 'Asset Updated Successfully');
        return response()->json(['status' => 1, 'message' => 'Asset Updated Successfully'], 200);
    }
}
