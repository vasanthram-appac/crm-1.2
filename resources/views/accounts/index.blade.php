@extends('layouts/app')

@section('title','Accounts')

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
    .leadcl-status{
        cursor: pointer;
    }
</style>
@endsection

@section('content')

<div class="appac_show"></div>
<div class="row m-0 appac_hide">
    <div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
            <li class="nav-item">
                <a class="nav-link active" href="/accounts"><b>Accounts</b></a>
            </li>
            @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1')
            <li class="nav-item">
                <a class="nav-link" href="/proforma"><b>Proforma</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/invoice"><b>Invoice</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/paymententry"><b>Payment Entry</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/lead"><b>Leads</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/opportunity"><b>Opportunity</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/serverdetails"><b>Renewals</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/newnbd"><b>New NBD</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/dmworks"><b>DM Works</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/asset_library"><b>Asset Library</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/required_input"><b>Required Input</b></a>
            </li>
        </ul>
    </div>
    <div class="profile col-12 col-lg-12 col-xl-12 my-2 col-xxl-12">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Accounts</h1>
        </div>
    </div>
    <div class=" m-0 appac_hide col-wrap ">
    <div class="lead-charthed row pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-10 col-md-12 col-sm-12 p-0 pad-rig-30">

            <div class="bio  rounded-30  piechart-leads">
                <div class="">
                    <h4 class="ch-2">Accounts</h4>
                </div>

                <div class="d-flex align-items-center justify-content-center  h-100   flex-direction-column ">

                    <div class="chart-container mb-5">
                        <div class="leadcl-status" data-status="All"> 
                            <button class="btn bg-primary text-white ft-15 pri-text-color m-0 ">All</button> 
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="1">
                            <div id="chart1" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="active">
                            <div id="chart2" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="inactive">
                            <div id="chart3" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="Download">
                            <div id="chart4" class="chart"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
  
    </div> 
    </div> 
    <div class="col-lg-12 col-sm-12 p-0">
        <div class="panel row" id="firstRow">
            <!-- <div class="add-newproduct-tab">
                <div class="gradient-card-header">
                    <h2 class="white-text mx-3">Leads</h2>
                </div>
            </div> comment by vasanth-->


            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>


            <div class="p-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered accounts-tab">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Company Name</th>
                            <th class="text-grey">City</th>
                            <th class="text-grey">Assigned To</th>
                            <th class="text-grey">Assigned Name</th>
                            <th class="text-grey">Status

                                <select name="account_status" class="tab-sel form-select" id="account_status">
                                    <option value="">Select</option>
                                    <option value="All" @if(request()->session()->get('active_status') == 'All') selected @endif>All</option>
                                    <option value="1" @if(request()->session()->get('active_status') == '1') selected @endif>Key Accounts</option>
                                    <option value="active" @if(request()->session()->get('active_status') == 'active') selected @endif>Active Accounts</option>
                                    <option value="inactive" @if(request()->session()->get('active_status') == 'inactive') selected @endif>Inactive Accounts</option>
                                    <option value="Download" @if(request()->session()->get('active_status') == 'Download') selected @endif>Download Accounts</option>
                                    <!-- <option value="AM001" @if(request()->session()->get('active_status') == 'AM001') selected @endif>Assigned to Balakrishnan</option>
                                    <option value="AM081" @if(request()->session()->get('active_status') == 'AM081') selected @endif>Assigned to Deepak</option>
                                    <option value="AM088" @if(request()->session()->get('active_status') == 'AM088') selected @endif>Assigned to Teresa</option> -->
                                </select>


                            </th>

                            <th class="text-grey">Key Account</th>
                            <!-- <th class="text-grey">Download Account</th> -->
                            <th class="text-grey">Action</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="modal fade show sp_edit in" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="account_type_modal">
                <div class="bind_customer"></div>
            </div>
            <div class="modal fade customer_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" role="dialog" style="">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->

                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <!--Body-->
                <div class="error-modal px-2 pb-1">

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawCharts);

    var total = @json($allActivests);
    var hot = @json($key);
    var cold = @json($active);
    var Warm = @json($inactive);
    var Reject = @json($download);




    var hot_val = Math.round((hot.length / total.length) * 100)
    var cold_val = Math.round((cold.length / total.length) * 100)
    var warm_val = Math.round((Warm.length / total.length) * 100)
    var reject_val = Math.round((Reject.length / total.length) * 100)


    function drawCharts() {
        drawSemiCircleChart("chart1", hot_val, "#5884c1", "Key Accounts");
        drawSemiCircleChart("chart2", warm_val, "#8caacf", "Active Accouns");
        drawSemiCircleChart("chart3", cold_val, "#7ab6db", "Inactive Accounts");
        drawSemiCircleChart("chart4", reject_val, "#a4a5a7", "Download Accounts");
    }

    function drawSemiCircleChart(elementId, percentage, color, label, status) {
        const data = google.visualization.arrayToDataTable([
            ["Label", "Value"],
            ["Progress", percentage],
            ["", 100 - percentage]


        ]);
        var status;
        const options = {
            animation: {
                startup: true,
                duration: 1500,
                easing: 'out'
            },
            pieHole: 0.7,
            pieSliceTextStyle: {
                color: "transparent"
            },
            pieSliceBorderColor: "transparent",
            legend: "none",
            pieStartAngle: 230,
            pieEndAngle: 250,
            slices: {
                0: {
                    color: color
                },
                1: {
                    color: "#e6e6e6"
                }
            },

        };

        const chart = new google.visualization.PieChart(document.getElementById(elementId));
        chart.draw(data, options);

        // Add the percentage label and description in the center
        document.getElementById(elementId).innerHTML += `
    <div class="chart-label">
      <div>${percentage}%</div>
      <div class="status"></div>
      <div>${label}</div>
    </div>
  `;
    }

    
</script>
<script>
    // document.addEventListener("DOMContentLoaded", function () {
    //     // Check if a session flash message exists
    //     if (document.querySelector('.secmessage')) {
    //         // Trigger the reload
    //         window.location.reload();
    //     }
    // });

    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Accounts::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'assignedto',
                    name: 'assignedto'
                },
                {
                    data: 'assignedname',
                    name: 'assignedname'
                },
                {
                    data: 'active_status',
                    name: 'active_status',
                    orderable: false
                },
                {
                    data: 'key_status',
                    name: 'key_status'
                },
                // {
                //     data: 'download_status',
                //     name: 'download_status'
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                // Add more columns as needed
            ],
            "drawCallback": function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                var start = pageInfo.start;
                api.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = start + i + 1;
                });
            },
            searching: true,
            language: {
                search: '',
                searchPlaceholder: 'Search'
            },
            <?php if (session()->get('role') == 'superadmin') : ?>
                dom: 'lBfrtip', // 'l' for length dropdown, 'B' for buttons
                buttons: [{
                        extend: 'csv',
                        text: 'Export CSV'
                    },
                    {
                        extend: 'excel',
                        text: 'Export Excel'
                    },
                    'colvis' // Column visibility button
                ]
            <?php endif; ?>
        });

        // Add an icon to the search input
        $('.dataTables_filter').addClass('mb-3 position-relative');
        $('.dataTables_filter label').addClass('d-flex align-items-center');
        $('.dataTables_filter input').addClass('form-control ps-5'); // Add padding to the left for the icon
        $('.dataTables_filter').prepend('<i class="fas fa-search position-absolute" style="left: 30px; top: 50%; transform: translateY(-50%); color: #999;"></i>');

        $('.dataTables_filter').addClass('mb-3');
        $('#example_info').addClass('mt-2');
        $('#example_paginate').addClass('mt-3');
        $('.dt-buttons').addClass('ps-2');
        $('#example_wrapper').addClass('overflow-x-auto');


        $(document).on('submit', 'form', function(e) {
            e.preventDefault();

            var form = $(this);
            var container = form.closest('.modal');

            var formData = new FormData(form[0]); // Create a FormData object

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {

                    $('#session_message').css('display', 'block');
                    $('#session_message').text(response.message);

                    setTimeout(function() {
                        $('#session_message').hide();
                    }, 5000);
                    if (typeof response.reload !== 'undefined') {
                        $('.appac_show').hide();
                        $('.appac_hide').show();

                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        var cid = response.cid;
                        $('.customer_modal').modal('hide');
                        // $('.appac_show').hide();
                        // $('.appac_hide').show();
                        cat_table.ajax.reload(null, false); // Prevents table state reset on reload
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 500);
                       $('[data-cid="' + cid + '"]').trigger('click');
                    }



                },
                error: function(xhr) {
                    // Handle other types of errors (e.g., server error)

                    var errors = xhr.responseJSON.errors;
                    var errorString = '';

                    for (var key in errors) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }

                    // Show errors in a Bootstrap modal (assuming you are using Bootstrap)
                    $('#errorModal .error-modal').html(errorString);
                    $('#errorModal').modal('show');
                }
            });
        });

        // Use event delegation since the buttons are loaded dynamically
        $(document).on('click', '.viewemp', function() {
            var empid = $(this).data('id');
            window.location.href = "/profile?id=" + empid;
        });

       $(document).ready(function() {
    // Trigger on clicking a status button
    $('.leadcl-status').on('click', function() {
        var status = $(this).data('status');
        fetchStatus(status);
    });

    // Trigger on changing the account_status dropdown
    $('select[name="account_status"]').on('change', function() {
        var status = $(this).val();
        fetchStatus(status);
    });

    // Fetch status via AJAX
    function fetchStatus(status) {
        $.ajax({
            url: "{{ action([App\Http\Controllers\Accounts::class, 'index']) }}",
            type: 'GET',
            data: {
                status: status
            },
            success: function(response) {
                window.location.reload(); // You may want to update the DOM instead of reloading
            },
            error: function(xhr) {
                var errors = xhr.responseJSON?.errors || {};
                var errorString = '';

                for (var key in errors) {
                    if (errors[key].length) {
                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                    }
                }

                $('#errorModal .error-modal').html(errorString);
                $('#errorModal').modal('show');
            }
        });
    }
});


    });
</script>
@endsection