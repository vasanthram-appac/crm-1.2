@extends('layouts.app')

@section('title', 'Enquiry Report')

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
        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link  com ad-btn" href="/workreport"><b>Work Report</b></a>
            </li>
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link " href="/employeereport"><b>Employee Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/monthlyreport"><b>Monthly Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/enquiryreport"><b>Enquiry Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/leadhistory"><b>Account History</b></a>
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
                                {!! Form::label('reportrange', 'Select Date Range', ['class' => 'label-color control-label mb-2']) !!}
                                <input type="text" name="daterange" id="reportrange" class="form-control" />
                            </div>

                            <div class="control-group mb-2">
                                {!! Form::label('website', 'Client Website', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('website', ['' => 'All Websites'] + $websites->toArray(), null, ['class' => 'span6 form-control select2']) !!}
                            </div>

                            <b style="color: #0077ed; padding-left: 10px;">(Or)</b><br><br>

                            <div class="control-group mb-2">
                                {!! Form::label('pro_website', 'Promotion Website', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('pro_website', ['' => 'All Websites'] + $pro_websites->pluck('comp_website', 'comp_website')->toArray(), null, ['class' => 'span6 form-control select2']) !!}
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
                <div class="bio  rounded-30  piechart-leads">
                    <div class="">
                        <h4 class="ch-2">Month Wise Enquiry Details</h4>
                    </div>
                    <div class="table-responsive p-0">
                        <div id="bar_chart" style="width: 100%; height:100%;min-height:365px" class="p-0"></div>
                    </div>
                </div>
            </div>
            <div class=" col-lg-12 col-xl-4 col-md-12 col-sm-12">
                <div class="bio  rounded-30  piechart-leads">
                    <div class="">
                        <h4 class="ch-2">Total Enquiry Details</h4>
                    </div>
                    <div class=" p-0">
                        <div id="piechart_3d" style="width: 100%; height:100%;min-height:365px;text-align:center;margin:auto" class="p-0"></div>
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
                    <th class="text-grey">Name</th>
                    <th class="text-grey">Email</th>
                    <th class="text-grey">Mobile Number</th>
                    <th class="text-grey">Subject</th>
                    <th class="text-grey">City</th>
                    <th class="text-grey">Message</th>
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
                <h4 class="title ps-3 pt-1">Errors</h4>
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
            lengthMenu: [10, 100, 200, 300],
            ajax: function(data, callback, settings) {
                var activeForm = $('form.active');
                var filterData = {
                    daterange: activeForm.find('input[name="daterange"]').val(),
                    website: activeForm.find('select[name="website"]').val(),
                    pro_website: activeForm.find('select[name="pro_website"]').val(),
                    draw: settings.iDraw,
                    start: settings._iDisplayStart,
                    length: settings._iDisplayLength
                };

                $.ajax({
                    url: "{{ action([App\Http\Controllers\Enquiryreport::class, 'index']) }}",
                    data: filterData,
                    success: function(response) {
                        // Process table data
                        callback({
                            draw: response.draw,
                            recordsTotal: response.recordsTotal,
                            recordsFiltered: response.recordsFiltered,
                            data: response.data
                        });

                        drawChart(response.enquiryCounts);
                        drawChart2(response.totalEnquiries);

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
                    name: 'S.no'
                },
                {
                    data: 'name',
                    name: 'Name'
                },
                {
                    data: 'email',
                    name: 'Email'
                },
                {
                    data: 'mobile',
                    name: 'Mobile Number'
                },
                {
                    data: 'subject',
                    name: 'Subject'
                },
                {
                    data: 'city',
                    name: 'City'
                },
                {
                    data: 'message',
                    name: 'Message'
                },
                {
                    data: 'enquiry_date',
                    name: 'Date'
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

    function drawChart(enquiryCounts) {
        // Prepare the data for Google Charts
        const data = google.visualization.arrayToDataTable([
            ['Month', 'Enquiries', {
                role: 'style'
            }, {
                role: 'tooltip',
                p: {
                    html: true
                }
            }],
            ...enquiryCounts.map(({
                month,
                enquiries
            }) => [
                month,
                enquiries,
                '#d9e1ef',
                customTooltip(month, enquiries)
            ])
        ]);

        const options = {
            hAxis: {
                title: 'Month',
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
                },
            },
            legend: 'none',
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
                height: '80%',
            },
        };

        // Create and draw the chart
        const chart = new google.visualization.ColumnChart(document.getElementById('bar_chart'));
        chart.draw(data, options);
    }

    // Custom tooltip function
    function customTooltip(month, enquiries) {
        return `
        <div style="padding: 8px 10px; color: #fff; background-color: #888; border-radius: 4px;">
            <strong>${month}</strong><br>
            ${enquiries} Enquiries
        </div>`;
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
        data.addColumn("string", "Month");
        data.addColumn("number", "Enquiries");
        data.addColumn({
            type: "string",
            role: "tooltip",
            p: {
                html: true
            }
        });

        // Add rows of data to the table
        totalEnquiries.forEach(item => {
            if (item.month && item.totalEnquiryCount !== undefined) {
                data.addRow([
                    item.month,
                    item.totalEnquiryCount,
                    `${item.month}: ${item.totalEnquiryCount} enquiries`
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
                height: "80%"
            },
        };

        const chart = new google.visualization.PieChart(container);
        chart.draw(data, options);
    }
</script>


@endsection