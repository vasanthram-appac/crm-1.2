@extends('layouts/app')

@section('title','Work Order')

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
        @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link"  href="/task"><b>Create Task</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/workorderview"><b>Work Order</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/wip"><b>WIP</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/promotion"><b>Promotion</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/design"><b>Design</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link"  href="/content"><b>Content</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link"  href="/taskview"><b>Task View</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active"  href="/workorder"><b>Work Order View</b></a>
            </li>        
        </ul>
    </div>
<div class="profile  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Work Order </h1>
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
                            <th class="text-grey">S.No</th>
                            <th class="text-grey">Company Name</th>
                            <th class="text-grey">Assigned To</th>
                            <th class="text-grey">Assigned By</th>
                            <th class="text-grey">Date of Issue</th>
                            <th class="text-grey">Dead Line</th>
                            <th class="text-grey">Days</th>
                            <th class="text-grey">Description</th>
                            <th class="text-grey">Work Status</th>
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
            ajax: "{{ action([App\Http\Controllers\Workorder::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'emp',
                    name: 'emp'
                },
                {
                    data: 'assig_fname',
                    name: 'assig_fname'
                },

                {
                    data: 'issue_date',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'dead_line',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'days',
                    name: 'days'
                },
                {
                    data: 'project_description',
                    name: 'project_description'
                },
                {
                    data: 'status',
                    name: 'status'
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


        $(document).on('click', '.livestatus', function() {

            var Id = $(this).data('id');
            var status = $(this).siblings('.status').val();

            $.ajax({
                url: '/workorderstatus', // Change this to your endpoint
                type: 'POST',
                data: {
                    id: Id,
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