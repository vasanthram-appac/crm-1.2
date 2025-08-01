@extends('layouts/app')

@section('title','Domain')

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
       @include('layouts/partials/renewalsmenu')
    </div>
    <div class="profile  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Domain</h1>
        </div>
        <div class="justify-content-sm-end d-flex">
            <div class=""></div>
            <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0" data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Domain::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add Domain</button>
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
                <table id="example" class="dataTable mt-6 table table-bordered domain-tb">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Account Name</th>
                            <th class="text-grey">Domain Name</th>
                            <th class="text-grey">Next Renewal Date</th>
                            <th class="text-grey">Day</th>
                            <th class="text-grey">Remaining Days</th>
                            <th class="text-grey">Domain Manager</th>
                            <th class="text-grey"></th>
                            <!-- <th class="text-grey">Oppourtunity Status
                                <select class="d-block" name="oppourtunity_status">
                                    <option value="">Select</option>
                                    <option value="all" @if(request()->session()->get('oppourtunity_status') == 'all') selected @endif>All</option>
                                    <option value="inactive" @if(request()->session()->get('oppourtunity_status') == 'inactive') selected @endif>Inactive</option>
                                </select>
                            </th> -->
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
            ajax: "{{ action([App\Http\Controllers\Domain::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'companyname',
                    name: 'companyname'
                },
                {
                    data: 'domainname',
                    name: 'domainname'
                },

                {
                    data: 'dateofexpire',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'DateFormat',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },

                {
                    data: 'remainday1',
                    name: 'remainday1'
                },
                {
                    data: 'domain_manager',
                    name: 'domain_manager'
                },
                {
                    data: '',
                    name: ''
                },
                // {
                //     data: 'oppourtunity_status',
                //     name: 'oppourtunity_status',
                //     orderable: false
                // },
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
                text: "Are you sure you want to delete the Domain?",
                icon: "warning",
                buttons: true,
                dangerMode: true,

                // timer: 4000,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '/domain/' + Id, // Change this to your endpoint
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
                    window.location.href = '/domain';
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





    });
</script>
@endsection