@extends('layouts/app')

@section('title','Settings')

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

            <div class="g-data ps-3"><a href="/sociallogin">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                            <img src="/img/social-login.png" />
                  
                            </div>
                            <h3 class="text-center ">Social Login</h3>
                            <h4>{{$social}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/questionnaire">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                            <img src="/img/question.png" />
                            </div>
                            <h3 class="text-center">Questionnaire</h3>
                            <h4>{{$questionnaire}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/documentupload">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">

                                <img src="/img/upload.png" />

                            </div>
                            <h3 class="text-center ">Document Upload</h3>
                            <h4>{{$document}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/googlesheet">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">

                                <img src="/img/google-sheets.png" />

                            </div>
                            <h3 class="text-center ">Google Sheet</h3>
                            <h4>{{$googlesheet}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/backup">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">

                                <img src="/img/backup.png" />

                            </div>
                            <h3 class="text-center ">Backup</h3>
                            <h4>{{$backup}}</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
   
</div>

@endsection


