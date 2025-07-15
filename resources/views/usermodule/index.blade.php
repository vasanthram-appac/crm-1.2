@extends('layouts/app')

@section('title','Usermodule')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-excel {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')

<div class="appac_show"></div>

<div class="row m-0 appac_hide  col-wrap ">


    <div class="lead-charthed d-flex flex-wrap pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0 ">

            <div class="row admin  dash-pie-chart">

            <div class="g-data  ps-3"><a href="/profile">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">
                            <img src="/img/lead-1.png"/>
                            </div>
                            <h3 class="text-center">{{$user->fname}}</h3>
                            <h4>{{$user->empid}}</h4>
                        </div>
                    </a>
                </div>
            
            @if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')

                <div class="g-data ps-3"><a href="/leaveapproval">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
                            <img src="/img/approved.png"/>
                            </div>
                            <h3 class="text-center">Leave Approved</h3>
                            <h4>{{$leaveapproved}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/payslip">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">

                                <img src="/img/payslip.png"/>

                            </div>
                            <h3 class="text-center ">Payslip</h3>
                            <h4>{{$payslip}}</h4>
                        </div>
                    </a>
                </div>
                @endif
                <div class="g-data ps-3"><a href="/applyleave">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">
                            <img src="/img/apply-leave2.png"/>
                            </div>
                            <h3 class="text-center">Employee Leave</h3>
                            <h4>{{$leave}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data  ps-3"><a href="/celebration">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                <img src="/img/celebration.png"/>
                            </div>
                            <h3 class="text-center">Celebration</h3>
                            <h4>{{$calendar}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data  ps-3"><a href="resignation">
                        <div class="bio  rounded-30  piechart-leads dash-7">
                            <div class="svg-d">
                              <img src="/img/resigned.png"/>

                            </div>
                            <h3 class="text-center">Resignation</h3>
                      
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
   
</div>

@endsection


