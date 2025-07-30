@extends('layouts/app')

@section('title','Payments')

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

                <div class="g-data ps-3"><a href="https://appacmedia.com/works.php" target="blank">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3.5 5A2.5 2.5 0 0 1 6 2.5h10A2.5 2.5 0 0 1 18.5 5v5.5a.5.5 0 0 1-1 0V5A1.5 1.5 0 0 0 16 3.5H6A1.5 1.5 0 0 0 4.5 5v14.382a.5.5 0 0 0 .724.447l1-.5a1.5 1.5 0 0 1 1.57.142l.906.679a.5.5 0 0 0 .6 0l.862-.647a1.5 1.5 0 0 1 1.672-.086l.673.404a.5.5 0 1 1-.514.858l-.674-.404a.5.5 0 0 0-.557.028l-.862.647a1.5 1.5 0 0 1-1.8 0l-.906-.68a.5.5 0 0 0-.523-.046l-1 .5A1.5 1.5 0 0 1 3.5 19.382z"></path>
                                    <path fill="currentColor" d="M6.5 7a.5.5 0 0 1 .5-.5h6.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h3.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h3.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m11-1.5a3 3 0 1 0 0 6a3 3 0 0 0 0-6m-4 3a4 4 0 1 1 8 0a4 4 0 0 1-8 0m5.666-1.229a.5.5 0 0 1 0 .708l-2.104 2.103l-1.228-1.228a.5.5 0 0 1 .707-.708l.521.522l1.397-1.397a.5.5 0 0 1 .707 0"></path>
                                </svg>
                            </div>
                            <h3 class="text-center ">Website Works</h3>
                            <h4>45</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="https://appacmedia.com/corporate-branding-portfolio.php" target="blank">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M3.5 5A2.5 2.5 0 0 1 6 2.5h10A2.5 2.5 0 0 1 18.5 5v5.5a.5.5 0 0 1-1 0V5A1.5 1.5 0 0 0 16 3.5H6A1.5 1.5 0 0 0 4.5 5v14.382a.5.5 0 0 0 .724.447l1-.5a1.5 1.5 0 0 1 1.57.142l.906.679a.5.5 0 0 0 .6 0l.862-.647a1.5 1.5 0 0 1 1.672-.086l.673.404a.5.5 0 1 1-.514.858l-.674-.404a.5.5 0 0 0-.557.028l-.862.647a1.5 1.5 0 0 1-1.8 0l-.906-.68a.5.5 0 0 0-.523-.046l-1 .5A1.5 1.5 0 0 1 3.5 19.382z"></path>
                                    <path fill="currentColor" d="M6.5 7a.5.5 0 0 1 .5-.5h6.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h3.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m0 3a.5.5 0 0 1 .5-.5h3.5a.5.5 0 0 1 0 1H7a.5.5 0 0 1-.5-.5m11-1.5a3 3 0 1 0 0 6a3 3 0 0 0 0-6m-4 3a4 4 0 1 1 8 0a4 4 0 0 1-8 0m5.666-1.229a.5.5 0 0 1 0 .708l-2.104 2.103l-1.228-1.228a.5.5 0 0 1 .707-.708l.521.522l1.397-1.397a.5.5 0 0 1 .707 0"></path>
                                </svg>
                            </div>
                            <h3 class="text-center ">Corporate Branding</h3>
                            <h4>18</h4>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection