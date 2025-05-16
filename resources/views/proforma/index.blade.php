@extends('layouts/app')

@section('title','Proforma')

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
        <ul class="nav nav-tabs  my-4  justify-content-end  mb-0  ">
            <li class="nav-item">
                <a class="nav-link " href="/accounts"><b>Accounts</b></a>
            </li>
            @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1')
            <li class="nav-item">
                <a class="nav-link active" href="/proforma"><b>Proforma</b></a>
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
    <div class="profile  prof  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex  justify-content-between  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name m-0">Proforma</h1>
        </div>
        <div class="justify-content-sm-end search-bar d-flex w-100">
            <div class="row  form-flex">
                {!! Form::open(['route' => ['accountsid'], 'method' => 'Post']) !!}
                {!! Form::label('company_name', 'Company Name', ['class' => 'label-color '] ) !!}
                {!! Form::select('accountsid', $accounts, null, ['class' => 'form-select', 'required']) !!}
                <button type="submit" data-id="8" class="frm-btn pri-text-color bcreate " role="button" data-container=".customer_modal">Create </button>
                {!! Form::close() !!}
                <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 bcreateview" data-container=".customer_modal" style="display: none;" data-href="{{action([App\Http\Controllers\Proforma::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Create </button>
            </div>
        </div>
    </div>
    <div>
        <p class="d-block" style="cursor: pointer;" id="pendingstatus">Pending ({{$proformadata->total_open}}) - {{number_format($proformadata->total_grosspay ?? 0,2)}}</p>
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
                            <th class="text-grey">Created By</th>
                            <th class="text-grey">Invoice No</th>
                            <th class="text-grey">Invoice Date</th>
                            <th class="text-grey">Client Name</th>
                            <th class="text-grey">Net Pay</th>
                            <th class="text-grey">Status
                                <select class="d-block form-select" name="proforma_status">
                                    <option value="">Select</option>
                                    <option value="all" @if(request()->session()->get('proforma_status') == 'all') selected @endif>All</option>
                                    <option value="open" @if(request()->session()->get('proforma_status') == 'open') selected @endif>Open</option>
                                    <option value="suspence" @if(request()->session()->get('proforma_status') == 'suspence') selected @endif>Suspence</option>
                                    <option value="closed" @if(request()->session()->get('proforma_status') == 'closed') selected @endif>Close</option>
                                    <option value="cancelled" @if(request()->session()->get('proforma_status') == 'cancelled') selected @endif>Cancelled</option>
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
<script>
    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Proforma::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'fname',
                    name: 'fname'
                },
                {
                    data: 'invoice_no',
                    name: 'invoice_no'
                },

                {
                    data: 'invoice_date',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'companyname',
                    name: 'companyname'
                },
                {
                    data: 'grosspay',
                    name: 'grosspay'
                },
                {
                    data: 'paymentstatus',
                    name: 'paymentstatus',
                    orderable: false,
                    searchable: false
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

        $(document).on('click', '.bcreate', function() {

            setTimeout(function() {
                $('.bcreateview').trigger('click');
            }, 1000);
        });

        $(document).on('click', '.conformdelete', function() {
            var Id = $(this).data('id');
            var inId = $(this).data('inid');
            swal({
                title: "Alert",
                text: "Are you sure you want to delete the Proforma?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

                // timer: 4000,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/proforma/' + Id, // Change this to your endpoint
                        type: 'DELETE',
                        data: {
                            id: Id,
                            _token: '{{ csrf_token() }}',

                        },
                        success: function(response) {


                            $.ajax({
                                url: '/proforma/' + inId + '/edit',
                                method: 'GET',
                                success: function(result) {

                                    $('.customer_modal').html(result);


                                    if (container !== '.appac_show') {
                                        $(container).modal('show');
                                    } else {
                                        $('.appac_hide').hide();
                                    }
                                },

                            });

                        },
                        error: function(error) {

                            console.error(error);

                        }
                    });
                } else {
                    setTimeout(function() {
                        $.ajax({
                            url: '/proforma/' + inId + '/edit',
                            method: 'GET',
                            success: function(result) {

                                $('.customer_modal').html(result);


                                if (container !== '.appac_show') {
                                    $(container).modal('show');
                                } else {
                                    $('.appac_hide').hide();
                                }
                            },

                        });
                    }, 1000);
                }
            });
        });

        $(document).on('click', '.conformconvert', function() {
            var Id = $(this).data('id');
            // alert(Id);
            swal({
                title: "Alert",
                text: "Are you sure you want to convert this proforma (No: " + Id + ") into an invoice?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

                // timer: 4000,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/convertinvoice/' + Id, // Change this to your endpoint
                        type: 'GET',
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
                    window.location.href = '/proforma';
                }
            });
        });

        $('#pendingstatus').on('click', function() {
            Oppourtunity('open');
        });

        function Oppourtunity(pid = null) {
            let id = pid ? pid : $('select[name="proforma_status"]').val();

            $.ajax({
                url: "{{ route('proforma.index') }}", // Better to use named route if available
                type: 'GET',
                data: {
                    pstatus: id
                },
                success: function(response) {
                    // Instead of full page reload, update content dynamically (if possible)
                    window.location.reload(); // Only if necessary
                },
                error: function(xhr) {
                    let errorString = '';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorString += '<span class="text-danger">' + value[0] + '</span><br>';
                        });

                        $('#errorModal .error-modal').html(errorString);
                        $('#errorModal').modal('show');
                    }
                }
            });
        }

        // Trigger on change
        $('select[name="proforma_status"]').on('change', function() {
            Oppourtunity();
        });

        function accountsid(selectElement) {

            var selectedValue = selectElement.value;

            $.ajax({
                url: '/accountsid', // Change this to your endpoint
                type: 'POST',
                data: {
                    id: selectedValue,
                    _token: '{{ csrf_token() }}',

                },
                success: function(response) {


                },
                error: function(error) {

                    console.error(error);

                }
            });
        }


        $(document).on('click', '.invoicestatus', function() {

            var Id = $(this).data('id');
            var inid = $(this).data('inid');
            var status = $(this).siblings('.paymentstatus').val();

            $.ajax({
                url: '/paymentstatus', // Change this to your endpoint
                type: 'POST',
                data: {
                    id: Id,
                    inid: inid,
                    status: status,
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

        });



    });
</script>
@endsection