@extends('layouts/app')

@section('title','Reports')

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

<div class="row m-0 appac_hide col-wrap ">

    <div class="lead-charthed d-flex flex-wrap pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0 ">

            <div class="row admin  dash-pie-chart">

            <div class="g-data ps-3"><a href="/workreport">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                            <img src="/img/wrok-report.png"  />

                            </div>
                            <h3 class="text-center ">Work Report</h3>
                            <h4>{{$dailyreport}}</h4>
                        </div>
                    </a>
                </div>
                @if(request()->session()->get('role') != 'user')
                <div class="g-data ps-3"><a href="/employeereport">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                            <svg id="Layer_1" enable-background="new 0 0 512 512" height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><path clip-rule="evenodd" d="m20.517 8h294.687v57.003c0 11.585 9.415 21 21 21h57.003v137.888c-2.127-.103-4.267-.158-6.42-.158-72.181 0-130.695 58.514-130.695 130.695s58.514 130.695 130.695 130.695c2.153 0 4.292-.056 6.42-.158v9.035c0 5.508-4.492 10-10 10h-362.69c-5.508 0-10-4.492-10-10v-476c0-5.508 4.492-10 10-10zm366.271 270.442c-22.365 0-40.496 18.131-40.496 40.496s18.131 40.496 40.496 40.496 40.496-18.131 40.496-40.496-18.13-40.496-40.496-40.496zm0-22.71c-54.508 0-98.695 44.187-98.695 98.695 0 24.248 8.75 46.45 23.258 63.632 11.076-30.965 40.671-53.133 75.438-53.133 34.774 0 64.368 22.163 75.437 53.133 14.508-17.182 23.258-39.383 23.258-63.632-.001-54.508-44.189-98.695-98.696-98.695zm0-16c-63.345 0-114.695 51.351-114.695 114.695s51.351 114.695 114.695 114.695 114.695-51.35 114.695-114.695-51.351-114.695-114.695-114.695zm-55.584-230.865v56.136c0 2.754 2.246 5 5 5h56.136c-.485-1.062-1.173-2.039-2.062-2.929l-56.145-56.145c-.889-.889-1.867-1.577-2.929-2.062zm-242.592 160.628h226.5c4.418 0 8-3.582 8-8s-3.582-8-8-8h-226.5c-4.418 0-8 3.582-8 8s3.582 8 8 8zm0-66.75h162.593c4.418 0 8-3.582 8-8s-3.582-8-8-8h-162.593c-4.418 0-8 3.582-8 8s3.582 8 8 8zm0 333.749h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.75h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.75h154.709c4.418 0 8-3.582 8-8s-3.582-8-8-8h-154.709c-4.418 0-8 3.582-8 8 0 4.419 3.582 8 8 8zm0-66.749h226.5c4.418 0 8-3.582 8-8s-3.582-8-8-8h-226.5c-4.418 0-8 3.582-8 8s3.582 8 8 8z" fill-rule="evenodd" fill="#b1b5c3" fill-opacity="1" data-original-color="#000000ff" stroke="none" stroke-opacity="1"/></g></svg>
                            </div>
                            <h3 class="text-center">Employee Report</h3>
                            <h4>{{$empreport}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/monthlyreport">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
                                <img src="/img/monthly-report.png"  />
                            </div>
                            <h3 class="text-center ">Monthly Report</h3>
                            <h4>{{$empreport}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/enquiryreport">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">
                                <img src="/img/enquiry-report.png"  />
                            </div>
                            <h3 class="text-center ">Enquiry Report</h3>
                            <h4>{{$enquiry}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/leadhistory">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">

                                <img src="/img/lead-history.png"  />

                            </div>
                            <h3 class="text-center ">Lead History</h3>
                            <h4>{{$notes}}</h4>
                        </div>
                    </a>
                </div>

                @php
                    $empid = request()->session()->get('empid');
                @endphp
                @if(in_array($empid, ['AM001', 'AM090']))
                <div class="g-data ps-3">
                    <a href="/fiscal">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">

                                <img src="/img/task.png"  />

                            </div>
                            <h3 class="text-center ">Fiscal</h3>
                            <h4 class="opacity-0">0</h4>
                        </div>
                    </a>
                </div>
                @endif

                @endif
            </div>
        </div>
    </div>
   
</div>

@endsection


