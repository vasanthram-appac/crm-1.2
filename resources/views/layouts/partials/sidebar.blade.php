<!-- Sidebar-->
@php
$route = explode('.', Route::currentRouteName())[0];

@endphp








<!-- Sidebar-->
@php
$route = explode('.', Route::currentRouteName())[0];
@endphp
<div class=" nav-boxshadow left-side-bar" id="sidebar-wrapper" style="height:100vh">
    <div class="sidebar-heading fw-bolder d-flex justify-content-between align-items-center text-white cursive">
        <img src="{{ asset('asset/image/appac-logo.png') }}" width="100 " class="toggle_close" alt="">
        <img src="https://appacmedia.com/images/favicon.png" width="30 " class="toggle_open" alt="">
    </div>
    <div class="bg-white-clr">
        <div class="side-menu-hed">
            <div class="menu-list-group menu-list-group-flush gap-2  menus">

                @if(request()->session()->get('role') != 'user')
                <span id="m4">
                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='dashboard') bg-active @else  @endif " href="/dashboard">
                        <img src="{{ asset('asset/image/dashboard.png') }}" width="22" alt="">
                        <p>Dashboard </p>
                    </a>
                </span>
				@else
					 <span id="m4">
                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='userdashboard') bg-active @else  @endif " href="/userdashboard">
                        <img src="{{ asset('asset/image/dashboard.png') }}" width="22" alt="">
                        <p>Dashboard </p>
                    </a>
                </span>
                @endif
                <!-- <span id="m1">
    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3">
        <img src="{{ asset('asset/image/dashboard.png') }}" width="22" alt="">
        <p class="mb-0">Dashboard</p><svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
	<path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
</svg>
    </div>
    <ul class="sub-menu">
        <li><a class="">Menu 1</a></li>
        <li><a class="">Menu 2</a></li>
        <li><a class="">Menu 3</a></li>
    </ul>
</span> -->

                <span id="m2" class="@if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip'  || $route=='usermodule') active @else  @endif">
                <a href="/usermodule"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile' || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='usermodule') bg-active @else  @endif">
                        <img src="{{ asset('asset/image/user-module.png') }}" width="22" alt="">
                        <p class="mb-0"> My Universe </p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div></a>
                    <ul class="sub-menu @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='userdashboard'  || $route=='usermodule' ) active @else  @endif">
                    <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='profile') bg-bactive @else  @endif " href="/profile">View Profile</a></li>
                    @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='user') bg-bactive @else  @endif " href="/user">Employee</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leaveapproval') bg-bactive @else  @endif " href="/leaveapproval">Leave Approval</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='payslip') bg-bactive @else  @endif " href="/payslip"> Payslip</a></li>
                        @endif
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='applyleave') bg-bactive @else  @endif " href="/applyleave">Apply Leave</a></li>
                        
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='celebration') bg-bactive @else  @endif " href="/celebration">Celebration</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='resignation') bg-bactive @else  @endif " href="/resignation">Resignation</a></li>
						

                    </ul>
                </span>

                <span id="m3" class="@if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
                <a href="/workoperations"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') bg-active @else  @endif">
                        <img src="{{ asset('asset/image/work-operations.png') }}" width="22" alt="">
                        <p class="mb-0">  Work Operations</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div></a>
                    <ul class="sub-menu @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
                        @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='task') bg-bactive @else  @endif " href="/task"> Task View</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='workorderview') bg-bactive @else  @endif " href="/workorderview"> Work Order View </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='wip') bg-bactive @else  @endif " href="/wip"> WIP </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='promotion') bg-bactive @else  @endif " href="/promotion"> Promotion </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='design') bg-bactive @else  @endif " href="/design"> Design </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='content') bg-bactive @else  @endif " href="/content"> Content </a></li>
                        @endif
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='taskview') bg-bactive @else  @endif " href="/taskview"> Task </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='workorder') bg-bactive @else  @endif " href="/workorder"> Work Order </a></li>
                    </ul>
                </span>

                @if(request()->session()->get('role') != 'user')
                <span id="m4">
                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='accounts') bg-active @else  @endif " href="/accounts">
                        <img src="{{ asset('asset/image/accounts.png') }}" width="22" alt="">
                        <p>Accounts </p>
                    </a>
                </span>

                <span id="m5" class="@if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') active @else  @endif">
                <a href="/payments"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') bg-active @else  @endif">
                        <img src="{{ asset('asset/image/payments.png') }}" width="22" alt="">
                        <p class="mb-0">Payments</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div></a>
                    <ul class="sub-menu @if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='proforma') bg-bactive @else  @endif " href="/proforma"> Proforma </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='invoice') bg-bactive @else  @endif " href="/invoice"> Invoice </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='paymententry') bg-bactive @else  @endif " href="/paymententry"> Payment Entry </a></li>

                    </ul>
                </span>

                <span id="m6" class="@if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') active @else  @endif">
                  <a href="/serverdetails"><div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') bg-active @else  @endif">
                        <img src="{{ asset('asset/image/server-details.png') }}" width="22" alt="">
                        <p class="mb-0">Technology</p><svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div></a>  
                    <ul class="sub-menu @if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='hosting') bg-bactive @else  @endif " href="/hosting"> Hosting </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='domain') bg-bactive @else @endif " href="/domain"> Domain </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='email') bg-bactive @else  @endif " href="/email"> Email </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='ssl') bg-bactive @else @endif " href="/ssl"> SSL </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey anchor sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='dmcontract') bg-bactive @else  @endif " href="/dmcontract"> DM Contract </a></li>
                    </ul>
                </span>

                <!-- <span id="m7">
    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3">
        <img src="{{ asset('asset/image/enquiry.png') }}" width="22" alt="">
        <p class="mb-0">Enquiry</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
	<path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
</svg>
    </div>
    <ul class="sub-menu">
        <li><a class="">Menu 1</a></li>
        <li><a class="">Menu 2</a></li>
        <li><a class="">Menu 3</a></li>
    </ul>
</span> -->

                <span id="m8" class="@if($route=='lead' || $route=='opportunity' || $route=='leads') active @else  @endif">
                 <a href="/leads">   <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='lead' || $route=='opportunity' || $route=='leads') active bg-active @else  @endif ">
                        <img src="{{ asset('asset/image/leads.png') }}" width="22" alt="">
                        <p class="mb-0">Leads</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div></a>
                    <ul class="sub-menu @if($route=='lead' || $route=='opportunity' || $route=='leads') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='lead') bg-bactive @else  @endif " href="/lead"> Leads </a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='opportunity') bg-bactive  @else  @endif " href="/opportunity"> Opportunity </a></li>
                    </ul>
                </span>
                @endif


                <span id="m9" class="@if($route=='employeereport' || $route=='report' || $route=='workreport'|| $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                  <a href="/reports">  <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active bg-active @else  @endif">
                        <img src="{{ asset('asset/image/reports.png') }}" width="22" alt="">
                        <p class="mb-0">Reports</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div> </a>
                    <ul class="sub-menu @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='workreport') bg-bactive @else  @endif " href="/workreport">Work Report</a></li>
                        @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='employeereport') bg-bactive @else  @endif " href="/employeereport">Employee Report</a></li>
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='monthlyreport') bg-bactive @else  @endif " href="/monthlyreport">Monthly Report</a></li> 
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='enquiryreport') bg-bactive @else  @endif " href="/enquiryreport">Enquiry Report</a></li><li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leadhistory') bg-bactive @else  @endif " href="/leadhistory">Lead History</a></li>
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='fiscal') bg-bactive @else  @endif " href="/fiscal">Fiscal</a></li>

					   @endif

                    </ul>
                </span>
				   @if(request()->session()->get('role') != 'user')
                   <!-- @if (request()->session()->get('empid') == 'AM001' || request()->session()->get('empid') == 'AM090') 
                  <span id="m4">
                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='fiscal') bg-active @else  @endif " href="/fiscal">
                        <img src="{{ asset('asset/image/money-growth.png') }}" width="22" alt="">
                        <p>Revenue </p>
                    </a>
                </span> 
                @endif -->
				<!-- <span id="m7" class="@if($route=='fiscal' || $route=='revenue') active @else  @endif">
                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='fiscal' || $route=='revenue') active bg-active @else  @endif">
                        <img src="{{ asset('asset/image/money-growth.png') }}" width="22" alt="">
                        <p class="mb-0">Revenue</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div>
                    <ul class="sub-menu @if($route=='fiscal' || $route=='revenue') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='fiscal') bg-bactive @else  @endif " href="/fiscal">Fiscal</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='revenue') bg-bactive @else  @endif " href="/revenue">Revenue</a></li>
                    </ul>
                </span> -->
				
					  
				
				<span id="m7" class="@if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active @else  @endif">
                 <a href="/documents">  <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active bg-active @else  @endif">
                        <img src="{{ asset('asset/image/document-icon.png') }}" width="22" alt="">
                        <p class="mb-0">My Documents</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div> </a> 
                    <ul class="sub-menu @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter') bg-bactive @else  @endif " href="/offerletter">Offer Letter</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='webproposal') bg-bactive @else  @endif " href="/webproposal">Web Proposal</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='digitalproposal') bg-bactive @else  @endif " href="/digitalproposal">Digital Proposal</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='ratecards') bg-bactive @else  @endif " href="/ratecards">Rate Cards</a></li>
                  
                    </ul>
                </span>
				
				  <span id="m7" class="@if($route=='sociallogin' || $route=='questionnaire' || $route=='documentupload' || $route=='inventary' || $route=='googlesheet' || $route=='backup' || $route=='settings') active @else  @endif">
                  <a href="/settings">  <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='sociallogin' || $route=='questionnaire' || $route=='documentupload' || $route=='inventary' || $route=='googlesheet' || $route=='backup' || $route=='settings') active bg-active @else  @endif">
                        <img src="{{ asset('asset/image/setting.png') }}" width="22" alt="">
                        <p class="mb-0">Settings</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                            <path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
                        </svg>
                    </div> </a>
                    <ul class="sub-menu @if($route=='sociallogin' || $route=='questionnaire' || $route=='documentupload' || $route=='inventary' || $route=='googlesheet' || $route=='backup' || $route=='settings') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='sociallogin') bg-bactive @else  @endif " href="/sociallogin">Social Login</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='questionnaire') bg-bactive @else  @endif " href="/questionnaire">Questionnaire</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='documentupload') bg-bactive @else  @endif " href="/documentupload">Document Upload</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='inventary') bg-bactive @else  @endif " href="/inventary">Inventary</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='googlesheet') bg-bactive @else  @endif " href="/googlesheet">Google Sheet</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='backup') bg-bactive @else  @endif " href="/backup">Backup</a></li>

                    </ul>
                </span>
 @endif
                <!-- <span id="m10">
    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3">
        <img src="{{ asset('asset/image/documents.png') }}" width="22" alt="">
        <p class="mb-0">Documents</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
	<path fill="none" stroke="#616161" stroke-linecap="round" d="m9.929 4.858l6.364 6.364a1 1 0 0 1 0 1.414L9.929 19" />
</svg>
    </div>
    <ul class="sub-menu">
        <li><a class="">Menu 1</a></li>
        <li><a class="">Menu 2</a></li>
        <li><a class="">Menu 3</a></li>
    </ul>
</span> -->

            </div>

        </div>
    </div>
</div>