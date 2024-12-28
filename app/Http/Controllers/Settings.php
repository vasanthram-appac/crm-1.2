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

class Settings extends Controller
{

    public function index(Request $request)
    {
        if (request()->session()->get('role') == 'user') {
            return redirect()->to('/workreport');
        }

        $social = DB::table('social_login')->count();

        $questionnaire = DB::table('questionnaire')->count();

        $document = DB::table('appac_document')->count();

        $inventory = DB::table('appac_inventory')->count();

        $googlesheet = DB::table('googlesheet')->count();

        $backup = DB::table('db_backup_logs')->count();

        return view('settings/index')->with(compact('social', 'questionnaire', 'document', 'inventory', 'googlesheet', 'backup'))->render();
    }
  
}