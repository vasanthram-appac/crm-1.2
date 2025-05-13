@extends('layouts/app')

@section('title','Apply Leave')

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
        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link active" href="/profile"><b>Profile</b></a>
            </li>
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link" href="/user"><b>Employee</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/leaveapprovel"><b>Leave Approvel</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/pasyslip"><b>Payslip</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/applyleave"><b>Employee Leave</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/celebration"><b>Celebration</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/resignation"><b>Resignation</b></a>
            </li>
         
        </ul>
    </div>
<div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Leave Approval</h1>
        </div>
    </div>
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
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Employee Id</th>
                            <th class="text-grey">Employee Name</th>
                            <th class="text-grey">Leave Applied Date</th>
                            <th class="text-grey">Leave From</th>
                            <th class="text-grey">Leave Till</th>
                            <th class="text-grey">Leave</th>
                            <th class="text-grey">Authorized By</th>
                            <th class="text-grey">Authorized On</th>
                            <th class="text-grey">Status</th>
                            <th class="text-grey">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            </div>
            </div>
            </div>


            <div class="row  col-wrap mt-3">
            <div class="col-lg-12 col-xl-6 col-xxl-8 ">
                <div class="widget appac ">
                    <div class="widget-title ">
                        <h4><i class="icon-reorder"></i> Leave Calculation of {{ $year }}</h4>
  
                    </div>
                    <div class="widget-body p-0">
                        <div>
                            <div class="tab-over-y-hid">
                            <table class="dataTable mt-3 table table-bordered p-0" id="editable-sample">
                                <thead>
                                    <tr class="bg-white">
                                        <th class="thcenter">S.no</th>
                                        <th class="thcenter">Name</th>
                                        <th class="thcenter">Total </th>
                                        <th class="thcenter">Casual</th>
                                        <th class="thcenter">Sick</th>
                                        <th class="thcenter">Half day</th>
                                        <th class="thcenter">Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaveData as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a href="{{ url('employee_profile', ['empid' => $leave['id'], 'loaddetails' => 1]) }}">
                                                {{ $leave['name'] }}
                                            </a>
                                        </td>
                                        <td>{{ $leave['total'] }}</td>
                                        <td>{{ $leave['casual'] ?: '0' }}</td>
                                        <td>{{ $leave['sick'] ?: '0' }}</td>
                                        <td>{{ $leave['half_day'] ?: '0' }}</td>
                                        <td>{{ $leave['available'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>                    </div>

                    
             
                  

              
                
        <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20"><div class="widget-appac">
        <h4>Note:</h4>
</div>
        <div class="bio  rounded-30 bg-white h-auto  client-li">
                
                <p>1. No of Sick Leaves of the Year: 6</p>
                <p>2. No of Casual Leaves of the Year: 6</p>
                </div>

                
                 </div>
                 </div>
                 </div>
                 </div>
               
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
            ajax: "{{ action([App\Http\Controllers\Leaveapproval::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'empid',
                    name: 'empid'
                },
                {
                    data: 'employee',
                    name: 'employee'
                },
                {
                    data: 'dateofapplication',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'leavedate',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'leavedatetill',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'leavetype',
                    name: 'leavetype'
                },
                {
                    data: 'approvedby',
                    name: 'approvedby'
                },
                {
                    data: 'approvaldate',
                    name: 'approvaldate'
                },
                {
                    data: 'leavestatus',
                    name: 'leavestatus'
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
                    text: "Are you sure you want to delete the Leave Detail?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,

                    // timer: 4000,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '/leaveapproval/' + Id, // Change this to your endpoint
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
                        window.location.href = '/leaveapproval';
                    }
                });
            });

    });
</script>
@endsection