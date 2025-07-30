@extends('layouts/app')

@section('title','ESI')

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
<div class="row m-0 appac_hide">
    <div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        @include('financemenu/index')
    </div>

    <div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">

        <div class="col-lg-3 col-sm-12">
            <div class="form-group">
                {!! Form::label('empid', 'Employee', ['class' => 'label-color py-2']) !!}
                {!! Form::select('empid', $regis, request()->session()->get('payslipempid'), ['class' => 'form-select select2', 'required' => true]) !!}
            </div>
        </div>

        <div class="col-lg-3 col-sm-12">
            <div class="form-group px-2">
                {!! Form::label('month', 'Month', ['class' => 'label-color py-2']) !!}

                @php
                $start = new DateTime('2021-01-01');
                $end = new DateTime(); // current month
                $months = [];

                while ($start <= $end) {
                    $key=$start->format('m-Y'); // option value
                    $months[$key] = $key; // display text
                    $start->modify('+1 month');
                    }

                    $months = array_reverse($months, true); // current month first

                    @endphp

                    {!! Form::select('month', $months, request()->session()->get('payslipmonth'), ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-2 col-sm-12">
            <div class="validate-input m-b-23 mx-5" style="margin-top: 2.7rem !important;">
                <button type="button" id="searchpaysubmit" data-id="8" class="frm-btn pri-text-color" role="button">
                    Submit
                </button>
            </div>
        </div>

        <div class="col-lg-4 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                <p class="fs-4 pt-5 totalamount mb-0">
                    @if(request()->session()->has('esitotalsalary'))
                    INR. {{request()->session()->get('esitotalsalary')}}
                    @else
                    INR. 0.00
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">ESI</h1>
        </div>
   
    </div>
    <div class="col-lg-12 col-sm-12 p-0">
        <div class="panel row" id="firstRow">

            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            <div class="p-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered ">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">EMPID</th>
                            <th class="text-grey">Name</th>
                            <th class="text-grey">Month & year</th>
                            <th class="text-grey">Basic Salary</th>
                            <th class="text-grey">Conveyance</th>
                            <th class="text-grey">HRA</th>
                            <th class="text-grey">Special</th>
                            <th class="text-grey">Incentive</th>
                            <th class="text-grey">Gross Pay</th>
                            <th class="text-grey">Provident Fund</th>
                            <th class="text-grey">Employee Contribution</th>
                            <th class="text-grey">Employer Contribution</th>
                            <th class="text-grey">ESI</th>
                            <th class="text-grey">Professional Tax</th>
                            <th class="text-grey">LOP</th>
                            <th class="text-grey">TDS</th>
                            <th class="text-grey">Net Salary</th>
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
    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Esi::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'empid',
                    name: 'empid'
                },
                {
                    data: 'gname',
                    name: 'gname'
                },
                {
                    data: 'month_year',
                    type: 'date-mm-dd', 
                    orderData: 0
                },
                {
                    data: 'basic_salary',
                    name: 'basic_salary'
                },
                {
                    data: 'conveyance_allowance',
                    name: 'conveyance_allowance'
                },
                {
                    data: 'hra',
                    name: 'hra'
                },
                {
                    data: 'special_allowance',
                    name: 'special_allowance'
                },
                {
                    data: 'specl_amt',
                    name: 'specl_amt'
                },
                {
                    data: 'salary',
                    name: 'salary'
                },
                {
                    data: 'pf',
                    name: 'pf'
                },
                {
                    data: 'employee_contribution',
                    name: 'employee_contribution',
                    visible: true
                },
                {
                    data: 'employer_contribution',
                    name: 'employer_contribution',
                    visible: true
                },
                {
                    data: 'employee_contribution',
                    name: 'employee_contribution'
                },
                {
                    data: 'pt',
                    name: 'pt'
                },
                {
                    data: 'lop',
                    name: 'lop'
                },
                {
                    data: 'tds',
                    name: 'tds'
                },
                {
                    data: 'netsalary',
                    name: 'netsalary'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
               
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
            dom: 'lBfrtip', 
            buttons: [{
                    extend: 'excel',
                    text: 'Export Excel',
                    exportOptions: {
                       columns: ':visible'    
                    }
                },
                'colvis' // Column visibility button
            ]
        });

        $('.dataTables_filter').addClass('mb-3 position-relative');
        $('.dataTables_filter label').addClass('d-flex align-items-center');
        $('.dataTables_filter input').addClass('form-control ps-5'); // Add padding to the left for the icon
        $('.dataTables_filter').prepend('<i class="fas fa-search position-absolute" style="left: 30px; top: 50%; transform: translateY(-50%); color: #999;"></i>');

        $('.dataTables_filter').addClass('mb-3');
        $('#example_info').addClass('mt-2');
        $('#example_paginate').addClass('mt-3');
        $('.dt-buttons').addClass('ps-2');
        $('#example_wrapper').addClass('overflow-x-auto');

        let esiVisible = false; 

        $('#showesi').on('click', function() {
            esiVisible = !esiVisible;

            cat_table.column('employee_contribution:name').visible(esiVisible);
            cat_table.column('employer_contribution:name').visible(esiVisible);

            $.fn.dataTable.ext.search = $.fn.dataTable.ext.search.filter(function(f) {
                return !f._esiFilter;
            });

            if (esiVisible) {
     
                const esiFilter = function(settings, data, dataIndex) {
                    var employeeContribution = data[11];
                    var employerContribution = data[12];

                    return (
                        employeeContribution &&
                        employerContribution &&
                        employeeContribution != "0" &&
                        employerContribution != "0"
                    );
                };
                esiFilter._esiFilter = true; 
                $.fn.dataTable.ext.search.push(esiFilter);
            }

            cat_table.draw();

            $(this).text(esiVisible ? 'Hide ESI' : 'Show ESI');
        });

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
                        window.location.reload(); // Prevents table state reset on reload
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

     

        $('#searchpaysubmit').on('click', function() {
            var empid = $('[name="empid"]').val();
            var month = $('select[name="month"]').val();

            if (empid == "" || empid == 0) {
                alert("Please select a Employee.");
                return false;
            }

            $.ajax({
                url: "{{ action([App\Http\Controllers\Esi::class, 'index']) }}",
                type: 'GET',
                data: {
                    empid: empid,
                    month: month,
                    _token: '{{ csrf_token() }}',
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
        });

    });
</script>
@endsection