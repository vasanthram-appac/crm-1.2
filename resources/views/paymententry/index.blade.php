@extends('layouts/app')

@section('title','Payment Entry')

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

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 43px !important;
        border: 0 !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
        padding-top: 7px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 10px !important;
        right: 1px;
        width: 20px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection

@section('content')

<div class="appac_show"></div>
<div class="row m-0 appac_hide">
    <div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
            <li class="nav-item">
                <a class="nav-link " href="/accounts"><b>Accounts</b></a>
            </li>
            @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
            <li class="nav-item">
                <a class="nav-link " href="/proforma"><b>Proforma</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/invoice"><b>Invoice</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/paymententry"><b>Payment Entry</b></a>
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
            <li class="nav-item">
                <a class="nav-link" href="/expocustomer"><b>Expo</b></a>
            </li>
        </ul>
    </div>

    <div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">

        <div class="col-lg-3 col-sm-12">
            <div class="form-group">
                {!! Form::label('companyname', 'Company Name', ['class' => 'label-color py-2']) !!}
                {!! Form::select('company_name', $accounts, null, ['class' => 'form-select select2', 'required' => true]) !!}
            </div>
        </div>

        <div class="col-lg-3 col-sm-12">
            <div class="form-group px-2">
                {!! Form::label('reportrange', 'Date', ['class' => 'label-color py-2']) !!}
                <input type="text" name="daterange" id="reportrange" class="form-control " />
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
                    @if(request()->session()->has('totalpaymententry'))
                    INR. {{request()->session()->get('totalpaymententry')}}
                    @else
                    INR. 0.00
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Payment Entry</h1>
        </div>
        <div class="justify-content-sm-end d-flex">
            <div class=""></div>
            <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 " data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Paymententry::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add Payment</button>
        </div>
    </div>



    <!-- <div class="lead-charthed d-flex flex-wrap pt-4">
        <div class="col-lg-8 col-md-8 col-sm-12 p-0 pr-30">
            <div class="d-flex align-items-center justify-content-center piechart-leads">
                <div class="chart-container">
                    <div id="chart1" class="chart"></div>
                    <div id="chart2" class="chart"></div>
                    <div id="chart3" class="chart"></div>
                    <div id="chart4" class="chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
            <div id="bar_chart"></div>
        </div>
    </div> -->
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
                <table id="example" class="dataTable mt-6 table table-bordered ">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.No</th>
                            <th class="text-grey">Company name</th>
                            <th class="text-grey">Date</th>
                            <th class="text-grey">Amount</th>
                            <th class="text-grey">Bank Name</th>
                            <th class="text-grey">Cheque No</th>
                            <th class="text-grey">NEFT/RTGS No</th>
                            <th class="text-grey">Payment Mode</th>
                            <th class="text-grey">Product/Service</th>
                            <th class="text-grey">Created by</th>
                            <th class="text-grey">Proforma/Invoice No</th>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Paymententry::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'paydate',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'payamount',
                    name: 'payamount'
                },
                {
                    data: 'bankname',
                    name: 'bankname'
                },
                {
                    data: 'chequeno',
                    name: 'chequeno'
                },
                {
                    data: 'neftnumber',
                    name: 'neftnumber'
                },
                {
                    data: 'paymentmode',
                    name: 'paymentmode'
                },
                {
                    data: 'productservice',
                    name: 'productservice'
                },
                {
                    data: 'account_manager',
                    name: 'account_manager'
                },
                {
                    data: 'proinv',
                    name: 'proinv'
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


        $(document).on('click', '.conformdelete', function() {
            var Id = $(this).data('id');
            swal({
                title: "Alert",
                text: "Are you sure you want to delete the DM contract?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

                // timer: 4000,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/dmcontract/' + Id, // Change this to your endpoint
                        type: 'DELETE',
                        data: {
                            id: Id,
                            _token: '{{ csrf_token() }}',

                        },
                        success: function(response) {
                            $('#session_message').css('display', 'block');
                            $('#session_message').text(response.message);

                            setTimeout(function() {
                                $('#session_message').hide();
                            }, 5000);

                            cat_table.ajax.reload();

                        },
                        error: function(error) {

                            console.error(error);

                        }
                    });
                } else {
                    window.location.href = '/dmcontract';
                }
            });
        });

    });

    $(document).ready(function() {
        $('.select2').select2({
            width: '100%'
        });
    });

    $('#searchpaysubmit').on('click', function() {
        var companyname = $('[name="company_name"]').val();
        var daterange = $('[name="daterange"]').val();

        if (companyname == "" || companyname == 0) {
            alert("Please select a company name.");
            return false;
        }
        if (!daterange) {
            alert("Please select a date range.");
            return false;
        }

        $.ajax({
            url: "{{ action([App\Http\Controllers\Paymententry::class, 'index']) }}",
            type: 'GET',
            data: {
                companyname: companyname,
                daterange: daterange,
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

    function searchpayment(companyname, daterange) {

    }

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
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Last Six Months': [moment().subtract(6, 'months').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Financial Year': [
                    moment().month() < 3 ?
                    moment().subtract(1, 'year').startOf('year').month(3).startOf('month') // April 1 of last year
                    :
                    moment().startOf('year').month(3).startOf('month'), // April 1 of this year
                    moment().month() < 3 ?
                    moment().startOf('year').month(2).endOf('month') // March 31 of this year
                    :
                    moment().add(1, 'year').startOf('year').month(2).endOf('month') // March 31 of next year
                ]
            }
        }, cb);

        cb(start, end);
    });
</script>

@endsection