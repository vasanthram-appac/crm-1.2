@extends('layouts/app')

@section('title','Accounts')

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
<div class="profile col-12 col-lg-12 col-xl-12 my-2 col-xxl-12">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Accounts</h1>
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
                <table id="example" class="dataTable mt-6 table table-bordered accounts-tab">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Company Name</th>
                            <th class="text-grey">City</th>
                            <th class="text-grey">Assigned To</th>
                            <th class="text-grey">Managed By</th>
                            <th class="text-grey">Status

                                <select name="account_status" class="tab-sel" id="account_status">
                                    <option value="">Select</option>
                                    <option value="All" @if(request()->session()->get('active_status') == 'All') selected @endif>All</option>
                                    <option value="1" @if(request()->session()->get('active_status') == '1') selected @endif>Key Accounts</option>
                                    <option value="active" @if(request()->session()->get('active_status') == 'active') selected @endif>Active Accounts</option>
                                    <option value="inactive" @if(request()->session()->get('active_status') == 'inactive') selected @endif>Inactive Accounts</option>
                                    <option value="AM001" @if(request()->session()->get('active_status') == 'AM001') selected @endif>Assigned to Balakrishnan</option>
                                    <option value="AM081" @if(request()->session()->get('active_status') == 'AM081') selected @endif>Assigned to Deepak</option>
                                    <option value="AM088" @if(request()->session()->get('active_status') == 'AM088') selected @endif>Assigned to Teresa</option>
                                </select>


                            </th>

                            <th class="text-grey">Key Account</th>
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

// document.addEventListener("DOMContentLoaded", function () {
//     // Check if a session flash message exists
//     if (document.querySelector('.secmessage')) {
//         // Trigger the reload
//         window.location.reload();
//     }
// });

    $(document).ready(function() {

        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Accounts::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'city',
                    name: 'city'
                },
                {
                    data: 'assignedto',
                    name: 'assignedto'
                },
                {
                    data: 'accountmanager',
                    name: 'accountmanager'
                },
                {
                    data: 'active_status',
                    name: 'active_status',
                    orderable: false
                },
                {
                    data: 'key_status',
                    name: 'key_status'
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
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
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

        function Status() {

            var status = $('select[name="account_status"]').val();

            $.ajax({
                url: "{{ action([App\Http\Controllers\Accounts::class, 'index']) }}",
                type: 'GET',
                data: {
                    status: status
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

        $('select[name="account_status"]').on('change', Status);


    });
</script>
@endsection