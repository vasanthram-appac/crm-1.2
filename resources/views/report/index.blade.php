@extends('layouts.app')

@section('title', 'Report')

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

<div class="appac_show"></div>
<div class="row m-0 appac_hide">
    <div class="col-lg-12 col-sm-12 p-0">
        <div class="panel row" id="firstRow">
            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="profile-side-box green bio rounded-30 bg-white">
                        <div class="widget-body">
                            <h4>Client Comments</h4>

                            {!! Form::open(['route' => ['ereport'], 'method' => 'POST']) !!}
                            @csrf

                            <div class="control-group mb-2">
                                {!! Form::label('daterange', 'Date', ['class' => 'label-color control-label mb-2']) !!}
                                @if(session()->has('aireportdate') && !empty(session()->has('aireportdate')))
                                {!! Form::text('daterange', null, ['class' => ' form-control', 'required', 'id' => 'reportrange']) !!}
                                @else
                                {!! Form::text('daterange', null, ['class' => ' form-control', 'required', 'id' => 'reportrange']) !!}
                                @endif

                            </div>

                            <div class="control-group validate-input mb-2">
                                {!! Form::label('employee', 'Employee', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('empid[]', $user->pluck('fname', 'empid')->prepend('All', 'all'), null, ['class' => 'js-select2 input100', 'multiple' => true]) !!}
                            </div>

                            <b style="color: #FF5722;">(OR)</b><br><br>

                            <div class="control-group mb-2">
                                {!! Form::label('dept_id', 'Department', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('dept_id', $department_master->prepend('Select', ''), null, ['class' => 'form-control']) !!}
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

                <div class="col-md-6">
                    @if(session()->has('aireportdate') && !empty(session()->has('aireportdate')))
                    <div>{{ date('d-m-Y', strtotime(session()->get('aireportdate'))) }}</div>
                    @else
                    <div>{{ date('d-m-Y', strtotime('-1 day')) }}</div>
                    @endif


                    @if(session()->has('aireport') && count(session('aireport')->active) > 0)
                    <div>Active Users: {{ count(session('aireport')->active) }}</div>
                    @foreach(session('aireport')->active as $activeuser)
                    <div>{{ $activeuser->fname }}</div>
                    @endforeach
                    @endif

                    @if(session()->has('aireport') && count(session('aireport')->inactive) > 0)
                    <div>Inactive Users: {{ count(session('aireport')->inactive) }}</div>
                    @foreach(session('aireport')->inactive as $inactiveuser)
                    <div>{{ $inactiveuser->fname }}</div>
                    @endforeach
                    @endif
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

@endsection

@section('script')

<script src="https://cdn.jsdelivr.net/npm/moment/moment.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.js"></script>

<script>
    $(document).ready(function() {
        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Employeereport::class, 'index']) }}",
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
                    data: 'empname',
                    name: 'empname'
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

        var start = moment('01/01/2019'); // Default start date
        var end = moment(); // Default end date (current date)

        function cb(start, end) {
            $('#reportrange').val(start.format('MM/DD/YYYY') + ' - ' + end.format('MM/DD/YYYY'));
        }

        // Initialize daterangepicker
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'All': ['01/01/2019', moment()], // From a specific start date to now
                'Today': [moment(), moment()], // Today only
                'Previous Day': [moment().subtract(1, 'day'), moment().subtract(1, 'day')], // Previous day
                'This Month': [moment().startOf('month'), moment().endOf('month')], // Current month
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')] // Last month
            }
        }, cb);

        // Trigger the callback to update the input field on page load
        cb(start, end);

        $(".select2").select2({
            closeOnSelect: false,
            placeholder: "Select",
            allowClear: true,
            tags: true
        });
    });
</script>
@endsection