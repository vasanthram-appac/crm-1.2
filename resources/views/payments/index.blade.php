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

            <div class="g-data ps-3"><a  onclick="Status('1')" href="#">
                        <div class="bio  rounded-30  piechart-leads 2">
                            <div class="svg-d">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center ">Key Accounts</h3>
                            <h4>{{$keyaccount}}</h4>
                        </div>
                    </a>
                </div>
            <div class="g-data ps-3"><a onclick="Status('active')" href="#">
                        <div class="bio  rounded-30  piechart-leads dash-2">
                            <div class="svg-d">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center ">Active Accounts</h3>
                            <h4>{{$active}}</h4>
                        </div>
                    </a>
                </div>
            <div class="g-data ps-3"><a onclick="Status('inactive')" href="#">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center ">Inactive Accounts</h3>
                            <h4>{{$inactive}}</h4>
                        </div>
                    </a>
                </div>
                    <div class="g-data ps-3"><a onclick="Status('Download')" href="#">
                        <div class="bio  rounded-30  piechart-leads dash-3">
                            <div class="svg-d">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center ">Download Accounts</h3>
                            <h4>{{$download}}</h4>
                        </div>
                    </a>
                </div>
            <div class="g-data ps-3"><a href="/proforma">
                        <div class="bio  rounded-30  piechart-leads dash-4">
                            <div class="svg-d">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4164 17.9215L13.5197 14.8182L12.2237 13.5054L10.6892 15.0399L10.6891 5.15031L12.2236 6.68484L13.5366 5.37188L10.4162 2.2686C10.0581 1.91047 9.46142 1.91047 9.10328 2.2686L6 5.37188L7.31296 6.68484L8.84749 5.15031V15.0399L7.31296 13.5054L6 14.8183L9.10328 17.9216C9.47841 18.2795 10.0581 18.2795 10.4162 17.9214L10.4164 17.9215Z" fill="#95999C" />
                                </svg>
                            </div>
                            <h3 class="text-center ">Proforma</h3>
                            <h4>{{$proforma}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/invoice">
                        <div class="bio  rounded-30  piechart-leads dash-5">
                            <div class="svg-d">
                            <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.38346 0.619057C6.31874 0.543522 6.2243 0.5 6.12484 0.5C6.02537 0.5 5.93093 0.543522 5.86621 0.619057C5.62468 0.901491 0 7.61517 0 10.8272C0.0180011 12.4349 0.672866 13.9699 1.82117 15.0951C2.96948 16.2204 4.51724 16.8442 6.12495 16.8298C7.73262 16.8442 9.28044 16.2204 10.4287 15.0951C11.577 13.9699 12.2319 12.435 12.2499 10.8272C12.2499 7.61517 6.62518 0.901386 6.38368 0.619057H6.38346ZM8.3196 14.9447C8.27266 14.9701 8.21991 14.983 8.16648 14.982C8.00971 14.9811 7.8738 14.8732 7.83745 14.7207C7.80111 14.5681 7.8738 14.4104 8.01336 14.339C8.66902 14.015 9.2216 13.5149 9.60919 12.8947C9.9969 12.2744 10.2042 11.5586 10.2081 10.8273C10.2081 10.6394 10.3604 10.4871 10.5484 10.4871C10.7363 10.4871 10.8886 10.6394 10.8886 10.8273C10.8852 11.6845 10.643 12.5237 10.1892 13.2511C9.73543 13.9783 9.08808 14.5647 8.31961 14.9446L8.3196 14.9447Z" fill="#B1B5C3" />
                                </svg>
                            </div>
                            <h3 class="text-center">Invoice</h3>
                            <h4>{{$invoice}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/paymententry">
                        <div class="bio  rounded-30  piechart-leads dash-6">
                            <div class="svg-d">
                                <img src="/img/payment entry.png"/>
                            </div>
                            <h3 class="text-center ">Payment Entry</h3>
                            <h4>{{$payment}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data ps-3"><a href="/lead">
                        <div class="bio  rounded-30  piechart-leads dash-7">
                            <div class="svg-d">

                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="user" fill="#37474f">
                                            <path d="m11.021 11.594c-.733.854-1.807 1.406-3.021 1.406-1.2 0-2.265-.54-2.998-1.377-2.276.603-5.002 1.677-5.002 3.377v1h16s0-.167 0-1c0-1.753-2.717-2.819-4.979-3.406z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                            <path d="m4 5c0-.995-.037-5 3.969-5s4.031 4.083 4.031 5c0 2-1.438 6-4 6s-4-3.958-4-6z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <h3 class="text-center ">Leads</h3>
                            <h4>{{$leads}}</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/opportunity">
                        <div class="bio  rounded-30  piechart-leads dash-8">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Opportunity</h3>
                            <h4>{{$opportunity}}</h4>
                        </div>
                    </a>
                </div>
                <div class="g-data ps-3"><a href="/serverdetails">
                        <div class="bio  rounded-30  piechart-leads dash-9">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Renewals</h3>
                            <h4>5</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/newnbd">
                        <div class="bio  rounded-30  piechart-leads dash-9">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">New NBD</h3>
                            <h4>0</h4>
                        </div>
                    </a>
                </div>

                <div class="g-data ps-3"><a href="/dmworks">
                        <div class="bio  rounded-30  piechart-leads dash-9">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">DM Works</h3>
                            <h4>0</h4>
                        </div>
                    </a>
                </div>
                
                <div class="g-data ps-3"><a href="/asset_library">
                        <div class="bio  rounded-30  piechart-leads dash-9">
                            <div class="svg-d">
                                <svg id="Layer_1" enable-background="new 0 0 16 16" height="20" viewBox="0 0 16 16" width="20" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs">
                                    <g width="100%" height="100%" transform="matrix(1,0,0,1,0,0)">
                                        <g id="star">
                                            <path d="m8 0c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm4 14-4-3-4 3 1-5-4-3h5l2-5 2 5h5l-4 3z" fill="#b1b5c3" fill-opacity="1" data-original-color="#37474fff" stroke="none" stroke-opacity="1" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h3 class="text-center">Asset Library</h3>
                            <h4>0</h4>
                        </div>
                    </a>
                </div>

            </div> 
        </div>
    </div>
   
</div>

@endsection

@section('script')

<script>

function Status(e) {
var status = e;

$.ajax({
    url: "{{ action([App\Http\Controllers\Accounts::class, 'index']) }}",
    type: 'GET',
    data: {
        status: status
    },
    success: function(response) {
        window.location.href="/accounts";
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
}
</script>

@endsection
