@extends('layouts/app')

@section('title','Lead')

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

            <div class="g-data ps-3"><a href="/lead">
                        <div class="bio  rounded-30  piechart-leads dash-1">
                            <div class="svg-d">

                            <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g id="user" fill="#37474f"><path d="m11.021 11.594c-.733.854-1.807 1.406-3.021 1.406-1.2 0-2.265-.54-2.998-1.377-2.276.603-5.002 1.677-5.002 3.377v1h16s0-.167 0-1c0-1.753-2.717-2.819-4.979-3.406z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1"/><path d="m4 5c0-.995-.037-5 3.969-5s4.031 4.083 4.031 5c0 2-1.438 6-4 6s-4-3.958-4-6z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1"/></g></g></svg>

                            </div>
                            <h3 class="text-center ">Leads</h3>
                            <h4>{{$leads}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/opportunity">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
                            <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs"><g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)"><g id="star"><path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1"/></g></g></svg>
                            </div>
                            <h3 class="text-center">Opportunity</h3>
                            <h4>{{$opportunity}}</h4>
                        </div>
                    </a>
                </div>

             

            </div>
        </div>
    </div>
   
</div>

@endsection


