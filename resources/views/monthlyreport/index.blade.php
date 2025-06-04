@extends('layouts.app')

@section('title', 'Employee Report')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv,
    .buttons-excel,
    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')
<!-- @if(session()->has('gdata'))
    @php
        $gdata = json_decode(session('gdata'), true); // Decode JSON back into an array
    @endphp

    <pre>{{ print_r($gdata, true) }}</pre>
@endif -->
<div class="appac_show"></div>

<div class="row m-0 appac_hide">
<div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link  com ad-btn" href="/workreport"><b>Work Report</b></a>
            </li>
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link " href="/employeereport"><b>Employee Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/monthlyreport"><b>Monthly Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/enquiryreport"><b>Enquiry Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/leadhistory"><b>Lead History</b></a>
            </li>
            @php
            $empid = request()->session()->get('empid');
            @endphp
            @if(in_array($empid, ['AM001', 'AM090']))
            
            <li class="nav-item">
                <a class="nav-link" href="/fiscal"><b>Fiscal</b></a>
            </li>
            @endif
            @endif        
        </ul>
    </div>
    <div class="col-lg-12 col-sm-12 p-0">
        <div class="row  col-wrap">
            <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
                <div class="bio  rounded-30 bg-white h-100  client-li">
                    <div class=" row" id="firstRow">
                        <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>
                        <div class="widget-body">
                            <h4>Clients</h4>

                            {!! Form::open(['route' => ['monthlyreport.store'], 'method' => 'POST']) !!}
                            @csrf
                            {!! Form::hidden('type', 'client', ['class' => 'form-control']) !!}
                            <div class="control-group mb-2">
                                {!! Form::label('promotionClients', 'Select', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('client', $clients, null, ['class' => 'form-select select2', 'placeholder' => 'Select a client']) !!}
                            </div>

                            <div class="control-group mb-2">
                                {!! Form::label('reportrange', 'Select Date Range', ['class' => 'label-color control-label mb-2']) !!}
                                <input type="text" name="daterange" id="reportrange" class="form-control" />
                            </div>
                            <div class="control-group mb-2">
                                {!! Form::label('employe', 'Select Employees', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('emp[]', $empl, null, ['class' => 'form-select select2','placeholder' => 'Select a employee', 'multiple' => 'multiple']) !!}
                            </div>

                            <div class="text-end">
                                <label class="err_lbl"></label><br>
                                <div class="btn-g2">
                                    <div></div>
                                    <div></div>
                                    <button type="submit" class="frm-btn pri-text-color" role="button"> Submit </button>
                                </div>
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-xxl-8 pr-20">
                <div class="bio  rounded-30 bg-white  client-li">
                    <div class="row col-wrap">



                        <div class="col-lg-12 col-xl-6 col-xxl-6 pr-20 d-flex align-items-center   d-none-800  justify-content-center">
                            <div class=" row" id="firstRow">
                                <div>
                                    <h1>Working Hours</h1>
                                    <h2></h2>
                                    <h1>{{$clientname}}</h1>

                                    <p> {{$daterange}}  {{ session('gdata') ? json_decode(session('gdata'))->All->hours : '0' }} Hrs  {{ session('gdata') ? json_decode(session('gdata'))->All->minutes : '0' }} Mins </p>
                                  
                                </div>

                            </div>
                        </div>



                        <div class="col-lg-12 col-xl-6 col-xxl-6 ">
                            <div class="col-lg-12 col-xl-6 col-xxl-6 pr-20 d-flex align-items-center   d-block-800  justify-content-center">
                                <div class=" row" id="firstRow">
                                    <div>
                                        <h1>Working Hours of</h1>
                                        <h2>Employe </h2>
                                        <h1> at Abhi Fine Products</h1>
                                    </div>

                                </div>
                            </div>
                            <div class="p-0 row" id="firstRow">
                                <div id="piechart_3d" style="width: auto;height:100%;min-height:365px;text-align:center;margin:auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Date of Report</th>
                            <th class="text-grey">Employee Name</th>
                            <th class="text-grey">Client Name</th>
                            <th class="text-grey">Project Name</th>
                            <th class="text-grey">Start Time</th>
                            <th class="text-grey">End Time</th>
                            <th class="text-grey">Total Working Time</th>
                            <th class="text-grey">Status</th>
                            <th class="text-grey">Submit Time</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" role="dialog">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <div class="modal-content">
                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <div class="error-modal px-2 pb-1"></div>
            </div>
        </div>
    </div>
</div>

@php

@endphp

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<!-- Include Daterangepicker CSS and JS -->
<script src="https://www.gstatic.com/charts/loader.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha384-xRVzT3eZUZ1X7KTHM8SbDk5t51zzmQlDWJ5gKw0KNY2ISDYXORfEYJkC0Wh8Kh9G" crossorigin="anonymous"></script>

<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    const gdata = @json($gdata); // Ensure PHP passes valid data
    console.log(gdata); // Debugging

    function drawChart() {
        const data = google.visualization.arrayToDataTable([
            ["Task", "Hours", {
                role: "tooltip",
                type: "string",
                p: {
                    html: true
                }
            }],
            [
                "Management",
                gdata.Management?.hours + gdata.Management?.minutes / 60 || 0.01,
                `Management: ${gdata.Management?.hours || 0} Hours . ${gdata.Management?.minutes || 0} mins`,
            ],
            [
                "Design",
                gdata.Design?.hours + gdata.Design?.minutes / 60 || 0.01,
                `Design: ${gdata.Design?.hours || 0} Hours . ${gdata.Design?.minutes || 0} mins`,
            ],
            [
                "Development",
                gdata.Development?.hours + gdata.Development?.minutes / 60 || 0.01,
                `Development: ${gdata.Development?.hours || 0} Hours . ${gdata.Development?.minutes || 0} mins`,
            ],
            [
                "Promotion",
                gdata.Promotion?.hours + gdata.Promotion?.minutes / 60 || 0.01,
                `Promotion: ${gdata.Promotion?.hours || 0} Hours . ${gdata.Promotion?.minutes || 0} mins`,
            ],
            [
                "ContentWriter",
                gdata.ContentWriter?.hours + gdata.ContentWriter?.minutes / 60 || 0.01,
                `ContentWriter: ${gdata.ContentWriter?.hours || 0} Hours . ${gdata.ContentWriter?.minutes || 0} mins`,
            ],
            [
                "Marketing",
                gdata.Marketing?.hours + gdata.Marketing?.minutes / 60 || 0.01,
                `Marketing: ${gdata.Marketing?.hours || 0} Hours . ${gdata.Marketing?.minutes || 0} mins`,
            ],
            [
                "Client",
                gdata.Client?.hours + gdata.Client?.minutes / 60 || 0.01,
                `Client: ${gdata.Client?.hours || 0} Hours . ${gdata.Client?.minutes || 0} mins`,
            ],

        ]);

        const options = {
            is3D: true,
            animation: {
                duration: 1000,
                easing: "out"
            },
            colors: ["#708094", "#01377E", "B9B7C8", "#5784C1", "#2F416A", "#3E5B82", "#6A8BB3"],
            tooltip: {
                isHtml: true
            },
            pieSliceText: "label",
            legend: {
                position: "top",
                alignment: "center",
                maxLines: 3,
                textStyle: {
                    fontSize: 12
                }
            },
            chartArea: {
                width: "90%",
                height: "75%"
            },
        };

        const chart = new google.visualization.PieChart(
            document.getElementById("piechart_3d")
        );
        chart.draw(data, options);
    }
</script>
<script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    const gdata = @json($gdata); // Ensure PHP passes valid data

    function drawChart2() {
        const data = google.visualization.arrayToDataTable([
            ["Task", "Hours", {
                role: "tooltip",
                type: "string",
                p: {
                    html: true
                }
            }],
            [
                "Management",
                gdata.Management?.hours + gdata.Management?.minutes / 60 || 0.01,
                `Management: ${gdata.Management?.hours || 0} Hours . ${gdata.Management?.minutes || 0} mins`,
            ],
            [
                "Design",
                gdata.Design?.hours + gdata.Design?.minutes / 60 || 0.01,
                `Design: ${gdata.Design?.hours || 0} Hours . ${gdata.Design?.minutes || 0} mins`,
            ],
            [
                "Development",
                gdata.Development?.hours + gdata.Development?.minutes / 60 || 0.01,
                `Development: ${gdata.Development?.hours || 0} Hours . ${gdata.Development?.minutes || 0} mins`,
            ],
            [
                "Promotion",
                gdata.Promotion?.hours + gdata.Promotion?.minutes / 60 || 0.01,
                `Promotion: ${gdata.Promotion?.hours || 0} Hours . ${gdata.Promotion?.minutes || 0} mins`,
            ],
            [
                "ContentWriter",
                gdata.ContentWriter?.hours + gdata.ContentWriter?.minutes / 60 || 0.01,
                `ContentWriter: ${gdata.ContentWriter?.hours || 0} Hours . ${gdata.ContentWriter?.minutes || 0} mins`,
            ],
            [
                "Marketing",
                gdata.Marketing?.hours + gdata.Marketing?.minutes / 60 || 0.01,
                `Marketing: ${gdata.Marketing?.hours || 0} Hours . ${gdata.Marketing?.minutes || 0} mins`,
            ],
            [
                "Client",
                gdata.Client?.hours + gdata.Client?.minutes / 60 || 0.01,
                `Client: ${gdata.Client?.hours || 0} Hours . ${gdata.Client?.minutes || 0} mins`,
            ],
            // Repeat for other categories
        ]);

        const options = {
            is3D: true,
            animation: {
                duration: 1000,
                easing: "out"
            },
            colors: ["#708094", "#01377E", "B9B7C8", "#5784C1", "#2F416A", "#3E5B82", "#6A8BB3"],
            tooltip: {
                isHtml: true
            },
            pieSliceText: "label",
            legend: {
                position: "top",
                alignment: "center",
                maxLines: 3,
                textStyle: {
                    fontSize: 12
                }
            },
            chartArea: {
                width: "90%",
                height: "75%"
            },
        };

        const chart = new google.visualization.PieChart(
            document.getElementById("piechart_3d2")
        );
        chart.draw(data, options);
    }
</script>
<script>
    $(function() {
        var start = moment('01/01/2019');
        var end = moment();

        function cb(start, end) {
            // Set the value of the input field
            $('#reportrange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));

            // Send selected date range to server via AJAX
            var daterange = {
                start: start.format('YYYY-MM-DD'), // Convert to YYYY-MM-DD format for comparison
                end: end.format('YYYY-MM-DD') // Same format for end date
            };

        }

        $('#reportrange').daterangepicker({
            autoUpdateInput: false,
            startDate: start,
            endDate: end,
            locale: {
                format: 'MM/DD/YYYY'
            },
            ranges: {
                'All': [moment('01/01/2019'), moment()],
                'Today': [moment(), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });
</script>
<script>
    $(function() {
        var start = moment('01/01/2019');
        var end = moment();

        function cb(start, end) {
            // Set the value of the input field
            $('#reportrange1').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));

            // Send selected date range to server via AJAX
            var daterange = {
                start: start.format('YYYY-MM-DD'), // Convert to YYYY-MM-DD format for comparison
                end: end.format('YYYY-MM-DD') // Same format for end date
            };
        }

        $('#reportrange1').daterangepicker({
            autoUpdateInput: false,
            startDate: start,
            endDate: end,
            locale: {
                format: 'MM/DD/YYYY'
            },
            ranges: {
                'All': [moment('01/01/2019'), moment()],
                'Today': [moment(), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select", // Optional placeholder
            allowClear: true // Optional clear button
        });
    });
</script>
<script>
    $(document).ready(function() {
        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Monthlyreport::class, 'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'report_date',
                    type: 'date-mm-dd',
                    orderData: 0
                },
                {
                    data: 'emp_fullname',
                    name: 'emp_fullname'
                },
                {
                    data: 'company_name_account',
                    name: 'company_name_account'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    data: 'start_time',
                    name: 'start_time'
                },
                {
                    data: 'end_time',
                    name: 'end_time'
                },
                {
                    data: 'total_time',
                    name: 'total_time'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'submit_time',
                    name: 'submit_time'
                }
            ],
            drawCallback: function(settings) {
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
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'Export CSV'
                },
                {
                    extend: 'excel',
                    text: 'Export Excel'
                },
                'colvis'
            ]
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

                    window.location.reload();
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




        $(".js-select2").select2({
            closeOnSelect: false,
            placeholder: "Select",
            allowClear: true,
            tags: true
        });
    });
</script>

@endsection