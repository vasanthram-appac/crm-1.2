@extends('layouts/app')

@section('title','Documents')

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

            <div class="g-data ps-3"><a href="/offerletter">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                            <img src="/img/offer-letter.png" />

                            </div>
                            <h3 class="text-center ">Offer Letter</h3>
                            <h4>{{$offer}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/webproposal">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                            <img src="/img/proposal.png" />
                            </div>
                            <h3 class="text-center">Web Proposal</h3>
                            <h4>{{$web}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/digitalproposal">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
                                 <img src="/img/digital-proposal.png" />
                            </div>
                            <h3 class="text-center ">Digital Proposal</h3>
                            <h4>{{$digital}}</h4>
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>
   
</div>

@endsection


