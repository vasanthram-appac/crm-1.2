@extends('layouts/app')

@section('title','Vendor List')

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
        @if(request()->session()->get('empid') == 'AM090' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
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
        <li class="nav-item">
            <a class="nav-link" href="/purchaseorder"><b>Purchase Order</b></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="/vendorlist"><b>Vendor List</b></a>
        </li>

    </ul>
</div>
<div class="profile  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between  align-items-center  p-15">
    <div class="profile-head">
        <h1 class="ch2 comp-name">Vendor List</h1>
    </div>
    <div class="justify-content-sm-end d-flex">
        <div class=""></div>
        <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 " data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Vendorlist::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add Vendor List</button>
    </div>
</div>
<div class=" m-0 appac_hide col-wrap ">

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
                            <th class="text-grey">Vendor Name</th>
                            <th class="text-grey">Phone</th>
                            <th class="text-grey">Email ID</th>
                            <th class="text-grey">City Name</th>
                            <th class="text-grey">Created By</th>
                            <th class="text-grey">Status </th>
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
            ajax: "{{ action([App\Http\Controllers\Vendorlist::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'created_at',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
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
                    data: 'empid',
                    name: 'empid'
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


        $('.leadcl-status').on('click', function(){

           var status= $(this).data('status');

           Status(status);

        });

        

    });
</script>
@endsection