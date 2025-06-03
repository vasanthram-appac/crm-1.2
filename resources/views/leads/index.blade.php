@extends('layouts/app')

@section('title','Leads')

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
<div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
    <a id="preback" href="javascript:history.back()">Back</a>
    <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
        <li class="nav-item">
            <a class="nav-link " href="/accounts"><b>Accounts</b></a>
        </li>
        @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1')
        <li class="nav-item">
            <a class="nav-link " href="/proforma"><b>Proforma</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/invoice"><b>Invoice</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/paymententry"><b>Payment Entry</b></a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link active" href="/lead"><b>Leads</b></a>
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
<div class="profile  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between  align-items-center  p-15">
    <div class="profile-head">
        <h1 class="ch2 comp-name">Leads</h1>
    </div>
    <div class="justify-content-sm-end d-flex">
        <div class=""></div>
        <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 " data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Leads::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add Lead</button>
    </div>
</div>
<div class=" m-0 appac_hide col-wrap ">

    <div class="lead-charthed row pt-4 row-gap-3">
        <div class="col-lg-12 col-xl-8 col-md-12 col-sm-12 p-0 pad-rig-30">

            <div class="bio  rounded-30  piechart-leads">
                <div class="">
                    <h4 class="ch-2">Leads</h4>
                </div>

                <div class="d-flex align-items-center justify-content-center  h-100   flex-direction-column ">

                    <div class="chart-container mb-5">
                        <div class="leadcl-status" data-status="All"> <button class="btn bg-primary text-white ft-15 pri-text-color m-0 ">All</button> </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="Hot">
                            <div id="chart1" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="Warm">
                            <div id="chart2" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="Cold">
                            <div id="chart3" class="chart"></div>
                        </div>
                        <div class="d-flex justify-content-center leadcl-status" data-status="Reject">
                            <div id="chart4" class="chart"></div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class=" col-lg-12 col-xl-4 col-md-12 col-sm-12 p-0">
            <div class="bio  rounded-30  piechart-leads h-auto lead-grap">
                <div class="">
                    <h4 class="ch-2">Graph</h4>
                </div>


                <div class="table-responsive p-0  lead-grp">
                    <div id="bar_chart" style="width: 100%; height:250px;min-height:365px" class="p-0"></div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-lg-12 col-sm-12 p-0">
        <div class="panel row" id="firstRow">
   
            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
                <h2>Success</h2>
            </div>

            <div class="pt-4 table-responsive p-0">
                <table id="example" class="dataTable mt-6 table table-bordered ">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Date of Lead</th>
                            <th class="text-grey">Account Name</th>
                            <!-- <th class="text-grey">Full Name</th> -->
                            <th class="text-grey">Phone</th>
                            <th class="text-grey">Email ID</th>
                            <th class="text-grey">City Name</th>
                            <th class="text-grey">Lead Assigned To</th>
                            <!-- <th class="text-grey">Lead Source</th> -->
                            <th class="text-grey">Oppourtunity Status
                                <select class="d-block" name="oppourtunity_status">
                                    <option value="">Select</option>
                                    <option value="all" @if(request()->session()->get('oppourtunity_status') == 'all') selected @endif>All</option>
                                    <option value="active" @if(request()->session()->get('oppourtunity_status') == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if(request()->session()->get('oppourtunity_status') == 'inactive') selected @endif>Inactive</option>
                                </select>
                            </th>
                            <th class="text-grey">Status
                                <select class="d-block" name="lead_status">
                                    <option value="">Select</option>
                                    <option value="All" @if(request()->session()->get('lead_status') == 'All') selected @endif>All</option>
                                    <option value="Reject" @if(request()->session()->get('lead_status') == 'Reject') selected @endif>Reject</option>
                                    <option value="Warm" @if(request()->session()->get('lead_status') == 'Warm') selected @endif>Warm</option>
                                    <option value="Cold" @if(request()->session()->get('lead_status') == 'Cold') selected @endif>Cold</option>
                                    <option value="Hot" @if(request()->session()->get('lead_status') == 'Hot') selected @endif>Hot</option>
                                </select>
                            </th>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawCharts);

    var total = @json($allActivests);
    var hot = @json($Hot);
    var cold = @json($Cold);
    var Warm = @json($Warm);
    var Reject = @json($Reject);




    var hot_val = Math.round((hot.length / total.length) * 100)
    var cold_val = Math.round((cold.length / total.length) * 100)
    var warm_val = Math.round((Warm.length / total.length) * 100)
    var reject_val = Math.round((Reject.length / total.length) * 100)


    function drawCharts() {
        drawSemiCircleChart("chart1", hot_val, "#5884c1", "Hot Leads");
        drawSemiCircleChart("chart2", warm_val, "#8caacf", "Warm Leads");
        drawSemiCircleChart("chart3", cold_val, "#7ab6db", "Cold Leads");
        drawSemiCircleChart("chart4", reject_val, "#a4a5a7", "Rejected Leads");
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
    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        // Get last 7 months' lead data from the backend
        var leadCount = @json($leadCounts); // Data from PHP

        const leadCounts = leadCount
            .reverse() // Reverse the data order
            .map(({
                month,
                leads
            }) => ({
                month: month.split(' ')[0], // Extract only the month (e.g., "Nov" from "Nov 2024")
                leads: leads,
            }));

        // Prepare data for Google Charts
        const data = google.visualization.arrayToDataTable([
            ['Month', 'Leads', {
                role: 'style'
            }, {
                role: 'tooltip',
                p: {
                    html: true
                }
            }],
            ...leadCounts.map(({
                month,
                leads
            }) => [
                month,
                leads,
                '#d9e1ef',
                customTooltip(month, leads)
            ])
        ]);

        const options = {
            hAxis: {
                textStyle: {
                    color: '#666',
                    fontSize: 12
                }
            },
            vAxis: {
                minValue: 0,
                gridlines: {
                    color: '#eaeaea'
                },
                textStyle: {
                    color: '#666'
                }
            },
            legend: 'none',
            chartArea: {
                width: '80%',
                height: '70%'
            },
            tooltip: {
                isHtml: true
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            chartArea: {
                width: '80%',
                height: '50%',
            },
        };

        const chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
    }

    function customTooltip(month, leads) {
        return `
        <div style="padding: 8px 0px !important;width:100%; color: #fff; background-color: #282b32; border-radius: 5px;">
        <div style="padding: 8px 10px !important;width:80px;">
            <strong  >${month}</strong><br>
            <span style="color: #5884c1;">●</span> ${leads} No's
        </div>
        </div>`;
    }
</script>
<script>

          $(document).on('click', '.viewemp', function() {
            var empid = $(this).data('id');
            window.location.href = "/profile?id=" + empid;
        });

    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Leads::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'leaddate',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                // {
                //     data: 'firstname',
                //     name: 'firstname'
                // },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'emailid',
                    name: 'emailid'
                },

                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'assignedto',
                    name: 'assignedto'
                },
                // {
                //     data: 'leadsource',
                //     name: 'leadsource'
                // },
                {
                    data: 'oppourtunity_status',
                    name: 'oppourtunity_status',
                    orderable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false
                },

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
                        $('.customer_modal').modal('hide');
                        $('.appac_show').hide();
                        $('.appac_hide').show();
                        cat_table.ajax.reload(null, false); // Prevents table state reset on reload
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


        function Oppourtunity() {

            var id = $('select[name="oppourtunity_status"]').val();
            // alert(id);
            $.ajax({
                url: "{{ action([App\Http\Controllers\Leads::class, 'index']) }}",
                type: 'GET',
                data: {
                    id: id
                },
                success: function(response) {
                    window.location.reload();

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

        $('select[name="oppourtunity_status"]').on('change', Oppourtunity);

        $('.leadcl-status').on('click', function(){

           var status= $(this).data('status');

           Status(status);

        });

        function Status(stat=null) {

            if(stat){
                var status = stat;
            }else{
                var status = $('select[name="lead_status"]').val();
            }

            $.ajax({
                url: "{{ action([App\Http\Controllers\Leads::class, 'index']) }}",
                type: 'GET',
                data: {
                    status: status
                },
                success: function(response) {
                    window.location.reload();

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

        $('select[name="lead_status"]').on('change', Status);

    });
</script>
@endsection