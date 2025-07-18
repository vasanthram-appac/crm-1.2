@extends('layouts/app')

@section('title','Server Details')

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
    <div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        @include('accountmenu/index')
    </div>

    <div class="lead-charthed d-flex flex-wrap pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 p-0 ">

            <div class="row admin  dash-pie-chart">

                <div class="g-data ps-3"><a href="/hosting">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                                <img src="/img/hosting.png" />

                            </div>
                            <h3 class="text-center ">Hosting</h3>
                            <h4>{{$hosting}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/domain">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                                <img src="/img/server.png" />
                            </div>
                            <h3 class="text-center">Domain</h3>
                            <h4>{{$domain}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/email">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">

                                <img src="/img/mail.png" />

                            </div>
                            <h3 class="text-center ">Email</h3>
                            <h4>{{$email}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/ssl">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">

                                <img src="/img/ssl-2.png" />

                            </div>
                            <h3 class="text-center ">SSL</h3>
                            <h4>{{$ssl}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/dmcontract">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">

                                <img src="/img/contract.png" />

                            </div>
                            <h3 class="text-center ">DM Contract</h3>
                            <h4>{{$seo}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/plans">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                <img src="/img/contract.png" />
                            </div>
                            <h3 class="text-center ">Plans</h3>
                            <h4>{{$plans}}</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection