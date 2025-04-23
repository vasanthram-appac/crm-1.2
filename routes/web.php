<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\Leads;
use App\Http\Controllers\Opportunity;
use App\Http\Controllers\Accounts;
use App\Http\Controllers\Domain;
use App\Http\Controllers\Email;
use App\Http\Controllers\Hosting;
use App\Http\Controllers\Employeereport;
use App\Http\Controllers\Report;
use App\Http\Controllers\Proforma;
use App\Http\Controllers\Invoice;
use App\Http\Controllers\Task;
use App\Http\Controllers\Query;
use App\Http\Controllers\Taskview;
use App\Http\Controllers\Workorderview;
use App\Http\Controllers\Workquery;
use App\Http\Controllers\Workorder;
use App\Http\Controllers\Design;
use App\Http\Controllers\Content;
use App\Http\Controllers\Offerletter;
use App\Http\Controllers\Webproposal;
use App\Http\Controllers\Digitalproposal;
use App\Http\Controllers\Paymententry;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('proforma/index');
// });

Route::get('/', [Login::class, 'index'])->name('index');

Route::post('/login', [Login::class, 'Login'])->name('Login');

Route::post('/verifyotp', [Login::class, 'Verifyotp'])->name('verifyotp');

Route::middleware('token')->group (function(){

Route::resource('/lead','App\Http\Controllers\Leads'); 

Route::get('/leaddetail/{id}', [Leads::class, 'Leaddetail'])->name('leaddetail');

Route::post('/leaddetailupdate', [Leads::class, 'Leaddetailupdate'])->name('leaddetailupdate');

Route::get('/opportunitydetail/{id}', [Leads::class, 'Opportunitydetail'])->name('opportunitydetail');

Route::post('/opportunityupdate', [Leads::class, 'OpportunityUpdate'])->name('opportunityupdate');

Route::resource('/opportunity','App\Http\Controllers\Opportunity'); 

Route::get('/viewopportunity/{id}', [Opportunity::class, 'Viewopportunity'])->name('viewopportunity');

Route::resource('/accounts','App\Http\Controllers\Accounts'); 

Route::get('/viewaccounts/{id}', [Accounts::class, 'Viewaccounts'])->name('viewaccounts');

Route::get('/statusupdate/{id}/{active_status}', [Accounts::class, 'Statusupdate'])->name('statusupdate');

Route::get('/keystatus/{id}/{key_status}', [Accounts::class, 'Keystatus'])->name('keystatus');

Route::resource('/domain','App\Http\Controllers\Domain');

Route::get('/domainstatusupdate/{id}/{status}/{table}', [Domain::class, 'domainstatusupdate'])->name('domainstatusupdate');

Route::post('/websitelistload', [Domain::class, 'Websitelistload'])->name('websitelistload');

Route::resource('/hosting','App\Http\Controllers\Hosting');

Route::get('/adddomain', [Hosting::class, 'adddomain'])->name('adddomain');

Route::post('/updatedomain', [Hosting::class, 'updatedomain'])->name('updatedomain');

Route::resource('/email','App\Http\Controllers\Email');

Route::get('/viewemail/{id}', [Email::class, 'Viewemail'])->name('viewemail');

Route::resource('/ssl','App\Http\Controllers\Ssl');

Route::resource('/dmcontract','App\Http\Controllers\Dmcontract');

Route::resource('/employeereport','App\Http\Controllers\Employeereport');

Route::post('/ereport', [Employeereport::class, 'report'])->name('ereport');

Route::resource('/report','App\Http\Controllers\Report');

Route::post('/sreport', [Report::class, 'sreport'])->name('sreport');

Route::resource('/user','App\Http\Controllers\User');

Route::resource('/applyleave','App\Http\Controllers\Applyleave');

Route::resource('/leaveapproval','App\Http\Controllers\Leaveapproval');

Route::resource('/profile','App\Http\Controllers\Profile');

Route::resource('/resignation','App\Http\Controllers\Resignation');

Route::resource('/workreport','App\Http\Controllers\Workreport');

Route::resource('/celebration','App\Http\Controllers\Celebration');

Route::resource('/payslip','App\Http\Controllers\Payslip');

Route::resource('/proforma','App\Http\Controllers\Proforma');

Route::post('/paymentstatus', [Proforma::class, 'paymentstatus'])->name('paymentstatus');

Route::post('/accountsid', [Proforma::class, 'accountsid'])->name('accountsid');

Route::get('/pprint/{id}', [Proforma::class, 'print'])->name('pprint');

Route::get('/convertinvoice/{id}', [Proforma::class, 'convertinvoice'])->name('convertinvoice');

Route::resource('/invoice','App\Http\Controllers\Invoice');

Route::get('/iprint/{id}', [Invoice::class, 'print'])->name('iprint');

Route::post('/invoicestatus', [Invoice::class, 'invoicestatus'])->name('invoicestatus');

Route::post('/invoiceaccountsid', [Invoice::class, 'accountsid'])->name('invoiceaccountsid');

Route::resource('/paymententry','App\Http\Controllers\Paymententry'); 

Route::post('/searchpayment', [Paymententry::class, 'searchpayment'])->name('searchpayment');

Route::resource('/task','App\Http\Controllers\Task');

Route::get('/taskstatus/{id}/{status}', [Task::class, 'taskstatus'])->name('taskstatus');

Route::get('/queryindex/{id}', [Query::class, 'index'])->name('queryindex');

Route::get('/queryadd/{id}', [Query::class, 'queryadd'])->name('queryadd');

Route::post('/querystore', [Query::class, 'querystore'])->name('querystore');

Route::resource('/taskview','App\Http\Controllers\Taskview');

Route::post('/taskcompletestatus', [Taskview::class, 'taskcompletestatus'])->name('taskcompletestatus');

Route::resource('/workorderview','App\Http\Controllers\Workorderview');

Route::get('/workstatus/{id}/{status}', [Workorderview::class, 'workstatus'])->name('workstatus');

Route::post('/getempid', [Workorderview::class, 'getempid'])->name('getempid');

Route::get('/workqueryindex/{id}', [Workquery::class, 'index'])->name('workqueryindex');

Route::get('/workqueryadd/{id}', [Workquery::class, 'queryadd'])->name('workqueryadd');

Route::post('/workquerystore', [Workquery::class, 'querystore'])->name('workquerystore');

Route::resource('/workorder','App\Http\Controllers\Workorder');

Route::post('/workorderstatus', [Workorder::class, 'workorderstatus'])->name('workorderstatus');

Route::resource('/wip','App\Http\Controllers\Wip');

Route::resource('/promotion','App\Http\Controllers\Promotion');

Route::resource('/dashboard','App\Http\Controllers\Dashboard');

Route::resource('/monthlyreport','App\Http\Controllers\Monthlyreport');

Route::resource('/userdashboard','App\Http\Controllers\Userdashboard');

Route::resource('/enquiryreport','App\Http\Controllers\Enquiryreport');

Route::resource('/design','App\Http\Controllers\Design');

Route::post('/designstatus', [Design::class, 'designstatus'])->name('designstatus');

Route::resource('/content','App\Http\Controllers\Content');

Route::post('/contentstatus', [Content::class, 'contentstatus'])->name('contentstatus');

Route::resource('/sociallogin','App\Http\Controllers\Sociallogin');

Route::resource('/questionnaire','App\Http\Controllers\Questionnaire');

Route::resource('/documentupload','App\Http\Controllers\Documentupload');

Route::resource('/inventary','App\Http\Controllers\Inventary');

Route::resource('/leadhistory','App\Http\Controllers\Leadhistory');

Route::resource('/googlesheet','App\Http\Controllers\Googlesheet');

Route::resource('/backup','App\Http\Controllers\Backup');

Route::resource('/offerletter','App\Http\Controllers\Offerletter');

Route::post('/approval', [Offerletter::class, 'approval'])->name('approval');

Route::resource('/webproposal','App\Http\Controllers\Webproposal');

Route::resource('/digitalproposal','App\Http\Controllers\Digitalproposal');

Route::resource('/clientdashboard','App\Http\Controllers\Clientdashboard');

Route::resource('/fiscal','App\Http\Controllers\Fiscal');

Route::resource('/revenue','App\Http\Controllers\Revenue');

Route::resource('/usermodule','App\Http\Controllers\Usermodule');

Route::resource('/workoperations','App\Http\Controllers\Workoperations');

Route::resource('/account','App\Http\Controllers\Payments');

Route::resource('/serverdetails','App\Http\Controllers\Serverdetails');

Route::resource('/leads','App\Http\Controllers\Lead');

Route::resource('/reports','App\Http\Controllers\Reports');

Route::resource('/documents','App\Http\Controllers\Documents');

Route::resource('/settings','App\Http\Controllers\Settings');

Route::resource('/ratecards','App\Http\Controllers\Ratecards');

Route::resource('/plans','App\Http\Controllers\Plans');

Route::get('/logout', [Login::class, 'Logout'])->name('Logout');

});


Route::get('/viewofferletter/{id}', [Offerletter::class, 'viewofferletter'])->name('viewofferletter');

Route::get('/viewwebproposal/{id}', [Webproposal::class, 'viewwebproposal'])->name('viewwebproposal');

Route::get('/viewdigitalproposal/{id}', [Digitalproposal::class, 'viewdigitalproposal'])->name('viewdigitalproposal');


