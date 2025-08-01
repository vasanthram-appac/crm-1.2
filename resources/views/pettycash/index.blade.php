@extends('layouts/app')

@section('title','Petty Cash')

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

        <div class="col-lg-2 col-sm-12">
            <div class="form-group mx-2">
                {!! Form::label('creditby', 'Credit By *', ['class' => 'label-color py-2']) !!}
                {!! Form::select('creditby', ['All' => 'All', 'AM001' => 'Balakrishnan', 'AM003' => 'Mohan', 'AM045' => 'Rohindh'], request()->session()->get('cashcreditby'), ['class' => 'form-select']) !!}
            </div>
        </div>

         <div class="col-lg-2 col-sm-12">
            <div class="form-group mx-2">
                {!! Form::label('ctype', 'Type *', ['class' => 'label-color py-2']) !!}
                {!! Form::select('ctype', ['All' => 'All', 'Debit' => 'Debit', 'Credit' => 'Credit'], request()->session()->get('cashtype'), ['class' => 'form-select', 'required']) !!}
            </div>
        </div>

        <div class="col-lg-2 col-sm-12">
            <div class="form-group px-2">
                {!! Form::label('month', 'Month', ['class' => 'label-color py-2']) !!}

                @php
                $start = new DateTime('2024-01-01');
                $end = new DateTime(); // current month
                $months = [];

                while ($start <= $end) {
                    $key=$start->format('m-Y'); // option value
                    $months[$key] = $key; // display text
                    $start->modify('+1 month');
                    }

                    $months = array_reverse($months, true); // current month first

                    @endphp

                    {!! Form::select('month', $months, request()->session()->get('cashmonth'), ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-2 col-sm-12">
            <div class="validate-input m-b-23 mx-5" style="margin-top: 2.7rem !important;">
                <button type="button" id="searchpaysubmit" data-id="8" class="frm-btn pri-text-color" role="button">
                    Submit
                </button>
            </div>
        </div>

        <div class="col-lg-3 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                <p class="fs-4 pt-5 totalamount mb-0">
                    @if(request()->session()->has('totalpettycash'))
                    INR. {{request()->session()->get('totalpettycash')}}
                    @else
                    INR. 0.00
                    @endif
                </p>
            </div>
        </div>
    </div>

    <div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Petty Cash</h1>
        </div>

        <div class=" justify-content-sm-end d-flex  gap-2 flex-wrap">
            <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0" data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Pettycash::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add Petty Cash</button>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 p-0">
        <div class="panel row" id="firstRow">

            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            <div class="p-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Added By</th>
                            <th class="text-grey">Paid To</th>
                            <th class="text-grey">Amount</th>
                            <th class="text-grey">Credit By</th>
                            <th class="text-grey">Date</th>
                            <th class="text-grey">Payment Mode</th>
                            <th class="text-grey">Type</th>
                            <th class="text-grey">Description</th>
                            <th class="text-grey">Action</th>
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
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Pettycash::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'gname',
                    name: 'gname'
                },
                {
                    data: 'paidto',
                    name: 'paidto'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'creditby',
                    name: 'creditby'
                },
                {
                    data: 'date',
                    type: 'date-mm-dd', 
                    orderData: 0
                },
                {
                    data: 'paymentmode',
                    name: 'paymentmode'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'description',
                    name: 'description'
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
                text: "Are you sure you want to delete the DM Works?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

                // timer: 4000,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/pettycash/' + Id, // Change this to your endpoint
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
                    window.location.href = '/pettycash';
                }
            });
        });

        $(document).on('click', '.viewemp', function() {
            var empid = $(this).data('id');
            window.location.href = "/profile?id=" + empid;
        });
        
           $('#searchpaysubmit').on('click', function() {

            var creditby = $('select[name="creditby"]').val();
            var month = $('select[name="month"]').val();
            var type = $('select[name="ctype"]').val();

            if (creditby == "" || creditby == 0) {
                alert("Please select a Credit By.");
                return false;
            }

             if (type == "" || type == 0) {
                alert("Please select a Type.");
                return false;
            }

            $.ajax({
                url: "{{ action([App\Http\Controllers\Pettycash::class, 'index']) }}",
                type: 'GET',
                data: {
                    creditby: creditby,
                    month: month,
                    type: type,
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