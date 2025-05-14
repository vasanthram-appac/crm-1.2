<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/favicon.png">

    <title>@yield('title')</title>

    @include('layouts/partials/css')
    @yield('css')

    <style>
        .confirmdanger {
            background-color: #0c97e2;
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('asset/js/app.js') }}" defer></script>

</head>

<body>
    <div id="app">
        <div class=" active" id="wrapper">
            @php
            $route = explode('.', Route::currentRouteName())[0];

            @endphp








            <!-- Sidebar-->
            @php
            $route = explode('.', Route::currentRouteName())[0];
            @endphp

            <div id="page-content-wrapper" class="w-100">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg bg-primary-head border-0 pt-2 pb-2">

                    <div class="container-fluid justify-content-between gap-4 ps-5 pe-5  nav-div">
                        <div class="d-flex gap-3">
                            <div class="sidebar-heading fw-bolder d-flex justify-content-between align-items-center text-white cursive">
                                @if(request()->session()->get('role') != 'user')

                                <a class="" href="/dashboard">
                                    <img src="{{ asset('asset/image/appac-logo.png') }}" width="100 " class="toggle_close" alt="">
                                    <img src="https://appacmedia.com/images/favicon.png" width="30 " class="toggle_open" alt="">
                                </a>

                                @else
                                <a class="" href="/userdashboard">
                                    <img src="{{ asset('asset/image/appac-logo.png') }}" width="100 " class="toggle_close" alt="">
                                    <img src="https://appacmedia.com/images/favicon.png" width="30 " class="toggle_open" alt="">
                                </a>

                                @endif

                            </div>
                            <div class="d-flex  align-items-center ">
                                <div class="hamburger ms-3" onclick="toggleMenu()">
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                    <div class="bar"></div>
                                </div>

                            </div>

                        </div>
                        <div class="menu-list-group menu-list-group-flush gap-2  menus">

                           
                            @if(request()->session()->get('role') != 'user')

                            <span id="m1" class="home-menu  d-flex align-items-center  me-3 @if($route=='dashboard') active @else  @endif">
                                <a href="/dashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 512 512"><path fill="none" stroke="#7d7c8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="25" d="M80 212v236a16 16 0 0 0 16 16h96V328a24 24 0 0 1 24-24h80a24 24 0 0 1 24 24v136h96a16 16 0 0 0 16-16V212"/><path fill="none" stroke="#7d7c8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="25" d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256m368-77V64h-48v69"/></svg>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='userdashboard'  || $route=='usermodule' ) active @else  @endif">
                    <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='profile') bg-bactive @else  @endif " href="/profile">View Profile</a></li>
                    @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='user') bg-bactive @else  @endif " href="/user">Employee</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leaveapproval') bg-bactive @else  @endif " href="/leaveapproval">Leave Approval</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='payslip') bg-bactive @else  @endif " href="/payslip"> Payslip</a></li>
                        @endif
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='applyleave') bg-bactive @else  @endif " href="/applyleave">Apply Leave</a></li>
                        
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='celebration') bg-bactive @else  @endif " href="/celebration">Celebration</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='resignation') bg-bactive @else  @endif " href="/resignation">Resignation</a></li>
						

                    </ul> -->
                            </span>
                            
                            
                            @endif
                   


                        @if(request()->session()->get('role') == 'user')
                         
                        <span id="m1" class="home-menu  d-flex align-items-center  me-3 @if($route=='userdashboard') active @else  @endif">
                                <a href="/userdashboard">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 512 512"><path fill="none" stroke="#7d7c8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="25" d="M80 212v236a16 16 0 0 0 16 16h96V328a24 24 0 0 1 24-24h80a24 24 0 0 1 24 24v136h96a16 16 0 0 0 16-16V212"/><path fill="none" stroke="#7d7c8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="25" d="M480 256L266.89 52c-5-5.28-16.69-5.34-21.78 0L32 256m368-77V64h-48v69"/></svg>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='userdashboard'  || $route=='usermodule' ) active @else  @endif">
                    <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='profile') bg-bactive @else  @endif " href="/profile">View Profile</a></li>
                    @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='user') bg-bactive @else  @endif " href="/user">Employee</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leaveapproval') bg-bactive @else  @endif " href="/leaveapproval">Leave Approval</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='payslip') bg-bactive @else  @endif " href="/payslip"> Payslip</a></li>
                        @endif
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='applyleave') bg-bactive @else  @endif " href="/applyleave">Apply Leave</a></li>
                        
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='celebration') bg-bactive @else  @endif " href="/celebration">Celebration</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='resignation') bg-bactive @else  @endif " href="/resignation">Resignation</a></li>
						

                    </ul> -->
                            </span>

                            @endif

                            <span id="m2" class="@if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip'  || $route=='usermodule') active @else  @endif">
                                <a href="/usermodule">
                                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile' || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='usermodule') bg-active @else  @endif">
                                        <img src="{{ asset('asset/image/user-module.png') }}" width="22" alt="">
                                        <p class="mb-0"> My Universe </p>

                                    </div>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile'  || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='userdashboard'  || $route=='usermodule' ) active @else  @endif">
                    <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='profile') bg-bactive @else  @endif " href="/profile">View Profile</a></li>
                    @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='user') bg-bactive @else  @endif " href="/user">Employee</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leaveapproval') bg-bactive @else  @endif " href="/leaveapproval">Leave Approval</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='payslip') bg-bactive @else  @endif " href="/payslip"> Payslip</a></li>
                        @endif
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='applyleave') bg-bactive @else  @endif " href="/applyleave">Apply Leave</a></li>
                        
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='celebration') bg-bactive @else  @endif " href="/celebration">Celebration</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='resignation') bg-bactive @else  @endif " href="/resignation">Resignation</a></li>
						

                    </ul> -->
                            </span>

                            <span id="m3" class="@if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
                                <a href="/workoperations">
                                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') bg-active @else  @endif">
                                        <img src="{{ asset('asset/image/work-operations.png') }}" width="22" alt="">
                                        <p class="mb-0"> Work Operations</p>

                                    </div>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
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
                    </ul> -->
                            </span>

                            @if(request()->session()->get('role') != 'user')
                            <span id="m4">
                                <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='account') bg-active @else  @endif " href="/account">
                                    <img src="{{ asset('asset/image/accounts.png') }}" width="22" alt="">
                                    <p>Accounts </p>
                                </a>
                            </span>

                            <!-- Payments Menu -->

                            <!-- <span id="m5" class="@if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') active @else  @endif">
                <a href="/payments"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') bg-active @else  @endif">
                        <img src="{{ asset('asset/image/payments.png') }}" width="22" alt="">
                        <p class="mb-0">Payments</p>
                    </div></a>
                </span> -->

                            <!-- <span id="m6" class="@if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') active @else  @endif">
                                <a href="/serverdetails">
                                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') bg-active @else  @endif">
                                        <img src="{{ asset('asset/image/server-details.png') }}" width="22" alt="">
                                        <p class="mb-0">Renewals</p>
                                    </div>
                                </a>
                            </span> -->
                            @endif


                            <span id="m9" class="@if($route=='employeereport' || $route=='report' || $route=='workreport'|| $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                                <a href="/reports">
                                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active bg-active @else  @endif">
                                        <img src="{{ asset('asset/image/reports.png') }}" width="22" alt="">
                                        <p class="mb-0">Reports</p>

                                    </div>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='workreport') bg-bactive @else  @endif " href="/workreport">Work Report</a></li>
                        @if(request()->session()->get('role') != 'user')
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='employeereport') bg-bactive @else  @endif " href="/employeereport">Employee Report</a></li>
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='monthlyreport') bg-bactive @else  @endif " href="/monthlyreport">Monthly Report</a></li> 
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='enquiryreport') bg-bactive @else  @endif " href="/enquiryreport">Enquiry Report</a></li><li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='leadhistory') bg-bactive @else  @endif " href="/leadhistory">Lead History</a></li>
                      <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='fiscal') bg-bactive @else  @endif " href="/fiscal">Fiscal</a></li>

                      
                    </ul> -->
                                @endif
                            </span>
                            @if(request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('empid') == 'AM090')
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
                                <a href="/documents">
                                    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active bg-active @else  @endif">
                                        <img src="{{ asset('asset/image/document-icon.png') }}" width="22" alt="">
                                        <p class="mb-0">My Documents</p>

                                    </div>
                                </a>
                                <!-- <ul class="sub-menu @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active @else  @endif">
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter') bg-bactive @else  @endif " href="/offerletter">Offer Letter</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='webproposal') bg-bactive @else  @endif " href="/webproposal">Web Proposal</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='digitalproposal') bg-bactive @else  @endif " href="/digitalproposal">Digital Proposal</a></li>
                        <li><a class="menu-list-group-item menu-list-group-item-action anchor menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='ratecards') bg-bactive @else  @endif " href="/ratecards">Rate Cards</a></li>
                  
                    </ul> -->
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

                        <div class="d-flex align-items-center gap-4">
                            <div class="bell pro-d" style="height: 30px !important;">
                                <p id="totalcount" style="position: absolute; padding-left: 30px;"></p>
                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 32 32"><path fill="none" stroke="#7d7c8c" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M8 17c0-5 1-11 8-11s8 6 8 11s3 8 3 8H5s3-3 3-8m12 8s0 4-4 4s-4-4-4-4m4-22v3"/></svg>
                            </div>

                            <div class="pro-div  notify-div" style="">
                                <div class="side-menu-hed h-auto">
                                    <div class="menu-list-group pt-3 p-2 menu-list-group-flush gap-2  menus">
                                        <div class="menus">
                                            <div id="appenttoday"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(request()->session()->get('role') != 'user')
                            <a href="/settings"> <img src="{{ asset('asset/image/setting.png') }}" width="22" alt=""></a>
                            @endif
                            <!-- Left Side Of Navbar
                                        <ul class="navbar-nav me-auto"></ul> comment by vasanth-->

                            <!-- Right Side Of Navbar -->
                            <!-- <ul class="list-unstyled ms-auto mb-0">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link pri-text-color mt-0" onclick="logout()" href="#">
                                                    Logout
                                                </a>
                                            </li>

                                        </ul> comment by vasanth-->
                            <div class="no-border">
                                <button class="pro-d">
                                    <img class="w-100" src="{{ request()->session()->has('profilephoto') && request()->session()->get('profilephoto') ? asset('uploadphoto/' . request()->session()->get('profilephoto'))  : asset('asset/image/avatar/' . request()->session()->get('avatarphoto').'.png') }}" alt="Employee profile">
                                </button>


                                <div class="pro-div">
                                    <div class="side-menu-hed h-auto">
                                        <div class="menu-list-group pt-3 p-2 menu-list-group-flush gap-2  menus">
                                            <div class=" menus">
                                                <!-- <span id="m11">
    <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3">
        <img src="{{ asset('asset/image/settings.png') }}" width="22" alt="">
        <p class="mb-0">Settings</p>
    </div>
</span> -->
                                                <span id="m8">
                                                    <a class=" menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3" href="/profile">
                                                        <img src="{{ asset('asset/image/carbon-user-profile.png') }}" width="22" alt="">
                                                        <p class="pro-p">View Profile</p>
                                                    </a>
                                                </span>
                                                <span id="m8">
                                                    <a class=" menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3" onclick="logout()" href="#">
                                                        <img src="{{ asset('asset/image/login.png') }}" width="22" alt="">
                                                        <p class="pro-p">Logout</p>
                                                    </a>
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="sidemenu">
                        <div>


                            <div class="menu-list-group menu-list-group-flush gap-2  menus">


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
                                    <a href="/usermodule">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile' || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='usermodule') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/user-module.png') }}" width="22" alt="">
                                            <p class="mb-0"> My Universe </p>

                                        </div>
                                    </a>

                                </span>

                                <span id="m3" class="@if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
                                    <a href="/workoperations">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/work-operations.png') }}" width="22" alt="">
                                            <p class="mb-0"> Work Operations</p>

                                        </div>
                                    </a>

                                </span>

                                @if(request()->session()->get('role') != 'user')
                                <span id="m4">
                                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='account') bg-active @else  @endif " href="/account">
                                        <img src="{{ asset('asset/image/accounts.png') }}" width="22" alt="">
                                        <p>Accounts </p>
                                    </a>
                                </span>
                                <!-- 
<span id="m5" class="@if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') active @else  @endif">
<a href="/payments"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') bg-active @else  @endif">
        <img src="{{ asset('asset/image/payments.png') }}" width="22" alt="">
        <p class="mb-0">Payments</p>
      
    </div></a>
   
</span> -->

                                <!-- <span id="m6" class="@if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') active @else  @endif">
                                    <a href="/serverdetails">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/server-details.png') }}" width="22" alt="">
                                            <p class="mb-0">Renewals</p>
                                        </div>
                                    </a>

                                </span> -->

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


                                @endif


                                <span id="m9" class="@if($route=='employeereport' || $route=='report' || $route=='workreport'|| $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                                    <a href="/reports">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/reports.png') }}" width="22" alt="">
                                            <p class="mb-0">Reports</p>

                                        </div>
                                    </a>

                                </span>
                                @if(request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('empid') == 'AM090')
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
                                    <a href="/documents">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/document-icon.png') }}" width="22" alt="">
                                            <p class="mb-0">My Documents</p>

                                        </div>
                                    </a>

                                </span>

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
                    <div class="sidemenu">
                        <div>


                            <div class="menu-list-group menu-list-group-flush gap-2  menus">


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
                                    <a href="/usermodule">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='user' || $route=='applyleave' || $route=='leaveapproval' || $route=='profile' || $route=='resignation'  || $route=='celebration'  || $route=='payslip' || $route=='usermodule') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/user-module.png') }}" width="22" alt="">
                                            <p class="mb-0"> My Universe </p>

                                        </div>
                                    </a>

                                </span>

                                <span id="m3" class="@if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') active @else  @endif">
                                    <a href="/workoperations">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='task' || $route=='taskview' || $route=='workorderview' || $route=='workorder' || $route=='wip' || $route=='promotion' || $route=='design' || $route=='content' || $route=='workoperations') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/work-operations.png') }}" width="22" alt="">
                                            <p class="mb-0"> Work Operations</p>

                                        </div>
                                    </a>

                                </span>

                                @if(request()->session()->get('role') != 'user')
                                <span id="m4">
                                    <a class="ma menu-list-group-item menu-list-group-item-action menu-list-group-item-dark anchor border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='account') bg-active @else  @endif " href="/account">
                                        <img src="{{ asset('asset/image/accounts.png') }}" width="22" alt="">
                                        <p>Accounts </p>
                                    </a>
                                </span>
                                <!-- 
<span id="m5" class="@if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') active @else  @endif">
<a href="/payments"> <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='proforma' || $route=='invoice' || $route=='paymententry' || $route=='payments') bg-active @else  @endif">
        <img src="{{ asset('asset/image/payments.png') }}" width="22" alt="">
        <p class="mb-0">Payments</p>
      
    </div></a>
   
</span> -->

                                <span id="m6" class="@if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') active @else  @endif">
                                    <a href="/serverdetails">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='hosting' || $route=='domain' || $route=='email' || $route=='ssl'  || $route=='dmcontract'  || $route=='serverdetails') bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/server-details.png') }}" width="22" alt="">
                                            <p class="mb-0">Renewals</p>
                                        </div>
                                    </a>

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


                                @endif


                                <span id="m9" class="@if($route=='employeereport' || $route=='report' || $route=='workreport'|| $route=='monthlyreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active @else  @endif">
                                    <a href="/reports">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3 @if($route=='employeereport' || $route=='report' || $route=='workreport' || $route=='enquiryreport'|| $route=='leadhistory'|| $route=='reports' || $route=='fiscal') active bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/reports.png') }}" width="22" alt="">
                                            <p class="mb-0">Reports</p>

                                        </div>
                                    </a>

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
                                    <a href="/documents">
                                        <div class="menu-list-group-item menu-list-group-item-action menu-list-group-item-dark border-0 text-grey sidebar-hedtwo bg-white d-flex align-items-center gap-3  @if($route=='offerletter' || $route=='webproposal' || $route=='digitalproposal' || $route=='documents' || $route=='ratecards') active bg-active @else  @endif">
                                            <img src="{{ asset('asset/image/document-icon.png') }}" width="22" alt="">
                                            <p class="mb-0">My Documents</p>

                                        </div>
                                    </a>

                                </span>

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
                </nav>

                <div class="lgrey-bg  w-100  ">
                    <div class="container">
                        <!--<a href="javascript:window.location.reload()">Back</a>-->
                    
                        <main class="py-2">
                            @yield('content')

                        </main>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

@include('layouts/partials/js')
@yield('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    function logout() {
        sessionStorage.setItem('sessionvariable', 'false');
        sessionStorage.clear();
        swal({
            title: "Alert",
            text: "Do you want to logout?",
            icon: "warning",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Okay",
                    value: true,
                    visible: true,
                    className: "confirmdanger", // Change this class to change the button color
                    closeModal: true
                }
            },
            closeOnClickOutside: false
        }).then((value) => {
            if (value) {
                $.ajax({
                    url: '{{ url("/logout") }}',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Redirect to the logout URL upon successful logout

                        window.location.href = '{{ url("/") }}';
                    },
                    error: function(error) {
                        // Handle errors if necessary
                    }
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('.pro-d').on("click", function(e) {
            e.stopPropagation();

            $('.pro-div').not($(this).siblings('.pro-div')).removeClass('active');

            $(this).siblings('.pro-div').toggleClass('active');
        });

        $(document).on("click", function() {
            $('.pro-div').removeClass('active');
        });

        $('.pro-div').on("click", function(e) {
            e.stopPropagation();
        });

        $.ajax({
            url: "/todaydetails",
            type: 'GET',
            success: function(response) {

                if (response.count > 0) {
                    $("#totalcount").text(response.count);

                    // $(".bell").css('background-color','red');
                    $("#totalcount").css('color','#108dd7');
                    $(".bell").addClass('active')
                    $(".bell").css('position','relative');
                }

                let html = '';

                // HOSTING
                if (response.hosting.length > 0) {
                    html += '<div><h5>Hosting Expiry</h5>';
                    response.hosting.forEach(item => {
                        html += '<p><a href="/hosting"><strong>' + item.companyname + '</strong> - ' + item.DateFormat + '</a></p></div>';
                    });
                }

                // SEO CLIENT
                if (response.seo_client.length > 0) {
                    html += '<div><h5>DM Contract Expiry</h5>';
                    response.seo_client.forEach(item => {
                        html += '<p><a href="/dmcontract"><strong>' + item.companyname + '</strong> - ' + item.DateFormat + '</a></p></div>';
                    });
                }

                // DOMAIN
                if (response.domain.length > 0) {
                    html += '<div><h5>Domain Expiry</h5>';
                    response.domain.forEach(item => {
                        html += '<p><a href="/domain"><strong>' + item.companyname + '</strong> - ' + item.DateFormat + '</a></p></div>';
                    });
                }

                // EMAIL SERVER
                if (response.emailserver.length > 0) {
                    html += '<div><h5>Email Server Expiry</h5>';
                    response.emailserver.forEach(item => {
                        html += '<p><a href="/email"><strong>' + item.companyname + '</strong> - ' + item.DateFormat + '</a></p></div>';
                    });
                }

                // SSL CERTIFICATE
                if (response.ssl_certificate.length > 0) {
                    html += '<div><h5>SSL Certificate Expiry</h5>';
                    response.ssl_certificate.forEach(item => {
                        html += '<p><a href="/ssl"><strong>' + item.companyname + '</strong> - ' + item.DateFormat + '</a></p></div>';
                    });
                }

                // CALENDAR
                if (response.calendar.length > 0) {
                    html += '<div><h5>Special Day</h5>';
                    response.calendar.forEach(item => {
                        html += '<p><a href="/celebration"><strong>' + item.reason + '</strong> - ' + item.datelist_one + '</a></p></div>';
                    });
                }

                // BIRTHDAYS
                if (response.birthdayData.length > 0) {
                    html += '<div><h5>Birthdays Today</h5>';
                    response.birthdayData.forEach(item => {
                        html += '<p><a href="/celebration"> Happy Birthday 🎉 <strong>' + item.fname + '</strong></a></p></div>';
                    });
                } //2024-11-13

                if (html == "") {
                    html = '<div><p class="text-muted">No data found.</p></div>';
                }

                $('#appenttoday').html(html);
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorString = '';

                for (var key in errors) {
                    errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                }

                $('#errorModal .error-modal').html(errorString);
                $('#errorModal').modal('show');
            }
        });

    });

    // document.addEventListener('click', function(event) {
    //     const proD = document.querySelector('.pro-d');
    //     const proDiv = document.querySelector('.pro-div');

    //     // Check if the click is outside both `.pro-d` and `.pro-div`
    //     if (!proD.contains(event.target) && !proDiv.contains(event.target)) {
    //         proDiv.closest('div').classList.remove('active');  
    //     }
    // });

    // document.querySelector('.pro-d').addEventListener('click', function(event) {
    //     const proDiv = document.querySelector('.pro-div');
    //     proDiv.closest('div').classList.toggle('active'); // Toggles the 'active' class
    //     event.stopPropagation(); // Prevent event bubbling to the document click listener
    // });
</script>
<script>
    function toggleFullScreen() {
        const fullscreenIcon = document.getElementById("fullscreen-icon");

        if (!document.fullscreenElement) {
            // Enter fullscreen
            document.documentElement.requestFullscreen().catch((err) => {
                console.error(`Error attempting to enable fullscreen mode: ${err.message} (${err.name})`);
            });

            // Change to "Exit fullscreen" icon
            fullscreenIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.1" 
                    d="M8.531 21.25v-3.469A2.31 2.31 0 0 0 6.22 15.47H2.75m12.719 5.78v-3.469a2.31 2.31 0 0 1 2.312-2.312h3.469M8.531 2.75v3.469A2.31 2.31 0 0 1 6.22 8.53H2.75m18.5.001h-3.469A2.31 2.31 0 0 1 15.47 6.22V2.75" />
            </svg>
        `;
        } else {
            // Exit fullscreen
            document.exitFullscreen();

            // Change back to "Enter fullscreen" icon
            fullscreenIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                <path fill="none" stroke="#999999" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                    d="M2.75 15.469v3.469a2.313 2.313 0 0 0 2.313 2.312H8.53m12.72-5.781v3.469a2.31 2.31 0 0 1-2.312 2.312h-3.47M2.75 8.531V5.062A2.31 2.31 0 0 1 5.063 2.75H8.53m6.939 0h3.469a2.313 2.313 0 0 1 2.312 2.313V8.53" />
            </svg>
        `;
        }
    }

    $(document).ready(function() {

    });
</script>

</html>