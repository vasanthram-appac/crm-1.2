@extends('layouts.app')

@section('title', 'Leads History')

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

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')

<div class="appac_show"></div>
<div class="row m-0 appac_hide">
    <div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
      @include('layouts/partials/reportmenu')
    </div>
    <div class="col-12">
        <div class="row  col-wrap">
            <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
                <div class="bio  rounded-30 bg-white  client-li">
                    <div class=" row" id="firstRow">
                        <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>
                        <div class="widget-body">
                            <h4>Client Wise Enquiry Report</h4>
                            {!! Form::open(['id' => 'form1', 'class' => 'form-filter']) !!}
                            @csrf
                            <div class="control-group mb-2">
                                {!! Form::label('reportrange', 'Select Date Range *', ['class' => 'label-color control-label mb-2']) !!}
                                <input type="text" name="daterange" id="reportrange" class="form-control" />
                            </div>

                            <div class="control-group mb-2">
                                {!! Form::label('website', 'Client *', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('website', $accounts, null, ['class' => 'span6 form-control select2']) !!}
                            </div>

                            <div class="control-group mb-2">
                                {!! Form::label('employee', 'Employee *', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('employee', $regis, null, ['class' => 'span6 form-control select2']) !!}
                            </div>

                            <div class="text-end">
                                <label class="err_lbl"></label><br>
                                <div class="btn-g2">
                                    <div></div>
                                    <div></div>
                                    <button type="submit" name="sub_form" class="frm-btn pri-text-color" id="filterBtn1"> View Enquiries </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class=" col-lg-12 col-xl-4 col-md-12 col-sm-12">
                <div class="bio  rounded-30  piechart-leads lead-grap">
                    <div class="">
                        <h4 class="ch-2">History Total Counts</h4>
                    </div>
                    <div class="table-responsive  p-0">
                        <div id="piechart_3d" class="pieChart" style="width: 100%; height:100%;min-height:365px;text-align:center;margin:auto" class="p-0"></div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-12 col-xl-4 col-md-12 col-sm-12">
                <div class="bio  rounded-30  piechart-leads lead-grap">
                    <div class="">
                        <h4 class="ch-2">Leads Total Counts</h4>
                    </div>
                    <div class="table-responsive  p-0">
                        <div id="piechart_3d1" class="pieChart" style="width: 100%; height:100%;min-height:365px;text-align:center;margin:auto" class="p-0"></div>
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
                    <th class="text-grey">Emp.Name</th>
                    <th class="text-grey">Company</th>
                    <th class="text-grey" style="width:490px !important;">Summary</th>
                    <th class="text-grey">Subject</th>
                    <th class="text-grey">Date</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="errorModal" role="dialog">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <div class="modal-content">
                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Error</h4>
                <div class="error-modal px-2 pb-1"></div>
            </div>
        </div>
    </div>
</div>

</div>

@endsection

@section('script')

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $(document).ready(function() {
        // Apply Select2 to elements with the "select2" class
        $('.select2').select2({
            placeholder: "Select a Website", // Placeholder text
            allowClear: true // Option to clear the selection
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Set start and end dates to the current month
        var start = moment().startOf('month'); // Start of the current month
        var end = moment().endOf('month'); // End of the current month

        // Callback function to update the input and store the value in localStorage
        function cb(start, end) {
            $('#reportrange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
            localStorage.setItem('daterange', start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
        }

        // Activate form dynamically on button click
        $('.frm-btn').on('click', function(e) {
            e.preventDefault();
            $('.form-filter').removeClass('active'); // Remove active class from all forms
            $(this).closest('form').addClass('active'); // Add active class to the clicked form's parent
            $(this).closest('form').submit(); // Trigger form submission
        });

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: function(data, callback, settings) {
                var activeForm = $('form.active');
                var filterData = {
                    daterange: activeForm.find('input[name="daterange"]').val(),
                    website: activeForm.find('select[name="website"]').val(),
                    employee: activeForm.find('select[name="employee"]').val(),
                    draw: settings.iDraw,
                    start: settings._iDisplayStart,
                    length: settings._iDisplayLength
                };

                $.ajax({
                    url: "{{ action([App\Http\Controllers\Leadhistory::class, 'index']) }}",
                    data: filterData,
                    success: function(response) {
                        // Process table data
                        callback({
                            draw: response.draw,
                            recordsTotal: response.recordsTotal,
                            recordsFiltered: response.recordsFiltered,
                            data: response.data
                        });

                        drawChart(response.totallead);
                        drawChart2(response.totalHistroy);

                    },
                    error: function(xhr) {
                        var response = xhr.responseJSON;
                        console.log(xhr); // Log the error to inspect the response

                        // Clear previous error messages
                        $('#errorModal .error-modal').html('');

                        // Check if the error is triggered by form submission (i.e., when status is 422)
                        if (xhr.status === 422) { // Validation errors are 422
                            var errors = response.errors;
                            var errorString = '';
                            $.each(errors, function(key, value) {
                                errorString += '<span class="text-danger">' + value[0] + '</span><br>';
                            });

                            // Only display the error modal after form submission (not on page load)
                            if ($('form.form-filter').hasClass('active')) {
                                $('#errorModal .error-modal').html(errorString);
                                $('#errorModal').modal('show'); // Show the modal with error messages
                            }
                        }
                    }
                });
            },
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'fname',
                    name: 'fname'
                },
                {
                    data: 'companyname',
                    name: 'companyname',
                    render: function(data, type, row, meta) {
                        return data; // Already safe HTML from server
                    }
                },
                {
                    data: 'summary',
                    name: 'Summary'
                },
                {
                    data: 'subject',
                    name: 'Subject'
                },
                {
                    data: 'datetimestamp',
                    name: 'datetimestamp'
                }
            ],
            drawCallback: function(settings) {
                var api = this.api();
                var pageInfo = api.page.info();
                api.column(0, {
                    page: 'current'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = pageInfo.start + i + 1;
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

        // Form submission handler
        $('form.form-filter').on('submit', function(e) {
            e.preventDefault();
            cat_table.ajax.reload();
        });

        // Initialize the date range picker
        $('#reportrange').daterangepicker({
            showDropdowns: true,
            autoUpdateInput: false,
            linkedCalendars: false, // ✅ This prevents the end calendar from jumping when you pick the start date
            startDate: moment('01/01/2020', 'MM/DD/YYYY'),
            endDate: moment('01/01/2025', 'MM/DD/YYYY'),
            minDate: '01/01/2000',
            maxDate: '12/31/2030',
            locale: {
                format: 'MM/DD/YYYY',
                cancelLabel: 'Clear'
            },
            ranges: {
                'All': [moment('01/01/2019'), moment()],
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Last 3 Months': [moment().subtract(3, 'months').startOf('month'), moment().endOf('month')],
                'Last 6 Months': [moment().subtract(6, 'months').startOf('month'), moment().endOf('month')],
                'Last 12 Months': [moment().subtract(11, 'months').startOf('month'), moment().endOf('month')],
            }
        }, function(start, end) {
            $('#reportrange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
        });

        // Set default range to the current month
        cb(start, end);
    });

    // Google Chart
    google.charts.load('current', {
        packages: ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart(totalEnquiries) {
        console.log(totalEnquiries);

        const container = document.getElementById("piechart_3d1");
        if (!container) {
            console.error("Container #piechart_3d not found");
            return;
        }

        const data = new google.visualization.DataTable();
        data.addColumn("string", "Nmae");
        data.addColumn("number", "Count");
        data.addColumn({
            type: "string",
            role: "tooltip",
            p: {
                html: true
            }
        });

        // Add rows of data to the table
        totalEnquiries.forEach(item => {
            if (item.name && item.count !== undefined) {
                data.addRow([
                    item.name,
                    item.count,
                    `${item.name}: ${item.count}`
                ]);
            } else {
                console.warn("Skipping invalid data:", item);
            }
        });

        const options = {
            is3D: true,
            sliceVisibilityThreshold: 0,
            animation: {
                duration: 1000,
                easing: "out"
            },
            colors: ["#708094", "#01377E", "B9B7C8", "#5784C1", "#2F416A"],
            tooltip: {
                isHtml: true
            },
            pieSliceText: "label",
            legend: {
                position: "top",
                alignment: "center",
                textStyle: {
                    fontSize: 12
                }
            },
            chartArea: {
                width: "80%",
                height: "60%"
            },
        };

        const chart = new google.visualization.PieChart(container);
        chart.draw(data, options);
    }



    // Function to draw the pie chart
    function drawChart2(totalEnquiries) {
        console.log(totalEnquiries);

        const container = document.getElementById("piechart_3d");
        if (!container) {
            console.error("Container #piechart_3d not found");
            return;
        }

        const data = new google.visualization.DataTable();
        data.addColumn("string", "Nmae");
        data.addColumn("number", "Count");
        data.addColumn({
            type: "string",
            role: "tooltip",
            p: {
                html: true
            }
        });

        // Add rows of data to the table
        totalEnquiries.forEach(item => {
            if (item.name && item.count !== undefined) {
                data.addRow([
                    item.name,
                    item.count,
                    `${item.name}: ${item.count}`
                ]);
            } else {
                console.warn("Skipping invalid data:", item);
            }
        });

        const options = {
            is3D: true,
            sliceVisibilityThreshold: 0,
            animation: {
                duration: 1000,
                easing: "out"
            },
            colors: ["#708094", "#01377E", "B9B7C8", "#5784C1", "#2F416A"],
            tooltip: {
                isHtml: true
            },
            pieSliceText: "label",
            legend: {
                position: "top",
                alignment: "center",
                textStyle: {
                    fontSize: 12
                }
            },
            chartArea: {
                width: "80%",
                height: "60%"
            },
        };

        const chart = new google.visualization.PieChart(container);
        chart.draw(data, options);
    }
</script>


@endsection