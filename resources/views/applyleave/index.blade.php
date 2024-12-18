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
<div class="row m-0 col-wrap appac_hide">
<div class="profile col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Apply Leave </h1>
        </div>
        <div class="justify-content-sm-end d-flex">
                <div class=""></div>
                <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 " data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Applyleave::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Apply Leave</button>
            </div>
    </div>
    
    <div class="span4 col-xl-8">
           
           <div class="widget appac">
               <div class="widget-title">
                   <h4><i class="icon-reorder"></i> Leave Calculation of {{ $currentYear }} </h4>
                   <span class="tools">
                       <a href="javascript:;" class="icon-remove"></a>
                   </span>
               </div>
               <div class=" p-0 table-responsive  h-100  ">
            
                   <table class="dataTable  table table-bordered">
                       <tr class="bg-white py-2">
                           <th class="text-grey sorting">Month</th>
                           <th class="text-grey sorting">Compensate</th>
                           <th class="text-grey sorting">LOP</th>
                           <th class="text-grey sorting">Sick Leave</th>
                           <th class="text-grey sorting">Casual Leave</th>
                           <th class="text-grey sorting">Halfday Leave</th>
                           <th class="text-grey sorting">Total Leave</th>
                       </tr>
                       @foreach ($monthlyLeaves as $leave)
                           <tr>
                           <td>{{ date('F', mktime(0, 0, 0, $leave->month, 1)) }}</td>
                               <td>{{ $leave->compensate }}</td>
                               <td>{{ $leave->lop }}</td>
                               <td>{{ $leave->sick }}</td>
                               <td>{{ $leave->casual }}</td>
                               <td>{{ $leave->halfday }}</td>
                               <td>{{ $leave->compensate + $leave->lop + $leave->sick + $leave->casual + $leave->halfday }}</td>
                           </tr>
                       @endforeach
                   </table>
       
  
       </div>
       
       </div>
       </div>
       
                  
       <div class="col-lg-12 col-xl-4 col-xxl-4 pr-20 h-auto">
       <div class="widget-appac">
       <h4>Total Leaves Taken: {{ $totalLeavesTaken }}</h4>
       </div>
       <div class="bio  rounded-30 bg-white h-auto  client-li">
                      
                   <h6>Note:</h6>
                   <p>1. No of Casual Leaves of the Year: 
                       @if ($remainingCasualLeaves <= 0)
                           No more casual leaves available for this year.
                       @else
                           {{ $remainingCasualLeaves }}
                       @endif
                   </p>
       
                   <p>2. No of Sick Leaves of the Year: 
                       @if ($remainingSickLeaves <= 0)
                           No more sick leaves available for this year.
                       @else
                           {{ $remainingSickLeaves }}
                       @endif
                   </p>
               </div>
               </div>
               </div>
    <div class="col-lg-12 col-sm-12 p-0">
        <div class=" row" id="firstRow">
            <!-- <div class="add-newproduct-tab">
                <div class="gradient-card-header">
                    <h2 class="white-text mx-3">Leads</h2>
                </div>
            </div> comment by vasanth-->


            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            
            

            <div class="p-4 table-responsive">
                <table id="example" class="dataTable  table table-bordered">
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
                            <!-- <th class="text-grey">Action</th> -->
                        </tr>
                    </thead>
                </table>
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
            ajax: "{{ action([App\Http\Controllers\Applyleave::class,'index']) }}",
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
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // },
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





    });
</script>
@endsection