@extends('layouts/app')

@section('title','Resignation')

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
                <a class="nav-link" href="/profile"><b>Profile</b></a>
            </li>
           @if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1')
            <li class="nav-item">
                <a class="nav-link" href="/leaveapproval"><b>Leave Approvel</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/applyleave"><b>Employee Leave</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/celebration"><b>Celebration</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/resignation"><b>Resignation</b></a>
            </li>
         
        </ul>
    </div>
<div class="profile my-3 col-12 col-lg-12 col-xl-8 col-xxl-12">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Resignation</h1>
        </div>
    </div>

<div class="row  col-wrap">
        <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
<div class="bio  rounded-30 bg-white h-100  border-0  client-li">

       
            <!-- <div class="add-newproduct-tab">
                <div class="gradient-card-header">
                    <h2 class="white-text mx-3">Leads</h2>
                </div>
            </div> comment by vasanth-->

           
            <div class="border-0 alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            {!! Form::open(['route' => ['resignation.store'], 'method' => 'Post']) !!}

         
                    <div class="alidate-input m-b-23 mb-2  p-0  border-0">
                        {!! Form::label('subject', 'Subject *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('subject', null, ['class' => 'form-control', 'required']) !!}

                    </div>
             
                    <div class="alidate-input m-b-23 mb-2   border-0 p-0">
                        {!! Form::label('resignationdate', 'Resignation Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('resignationdate', null, ['class' => 'form-control', 'required']) !!}

                    </div>
                
           

     
                    <div class="alidate-input m-b-23     border-0 p-0">
                        {!! Form::label('description', 'Description *', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('description', null, ['class' => 'no-resize h20 form-control', 'required']) !!}
                    </div>
              

            <!-- Add a submit button -->
            <br>
            <div class="text-end  p-0">
                                <label class="err_lbl"></label><br>
                                <div class="p-0">
                                    <div></div>
                                    <div></div>
                                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">Submit </button>
                                </div>
                            </div>
            <br>
            {!! Form::close() !!}
</div>
</div>


<div class="col-lg-12 col-xl-6 col-xxl-8 pr-20">
            <div class="pt-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered p-0">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Subject</th>
                            <th class="text-grey">Resignation Date</th>
                            <th class="text-grey">Comments</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>


<!-- Dummy Starts -->


    <div class="row  col-wrap dum opacity-0">
        <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
<div class="bio  rounded-30 bg-white h-100  border-0  client-li">

       
            <!-- <div class="add-newproduct-tab">
                <div class="gradient-card-header">
                    <h2 class="white-text mx-3">Leads</h2>
                </div>
            </div> comment by vasanth-->

           
            <div class="border-0 alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
            </div>

            {!! Form::open(['route' => ['resignation.store'], 'method' => 'Post']) !!}

         
                    <div class="alidate-input m-b-23 mb-2  p-0  border-0">
                        {!! Form::label('subject', 'Subject *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('subject', null, ['class' => 'form-control', 'required']) !!}

                    </div>
             
                    <div class="alidate-input m-b-23 mb-2   border-0 p-0">
                        {!! Form::label('resignationdate', 'Resignation Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('resignationdate', null, ['class' => 'form-control', 'required']) !!}

                    </div>
                
           

     
                    <div class="alidate-input m-b-23     border-0 p-0">
                        {!! Form::label('description', 'Description *', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('description', null, ['class' => 'no-resize h20 form-control', 'required']) !!}
                    </div>
              

            <!-- Add a submit button -->
            <br>
            <div class="text-end  p-0">
                                <label class="err_lbl"></label><br>
                                <div class="p-0">
                                    <div></div>
                                    <div></div>
                                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">Submit </button>
                                </div>
                            </div>
            <br>
            {!! Form::close() !!}
</div>
</div>


<div class="col-lg-12 col-xl-6 col-xxl-8 pr-20">
            <div class="pt-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered p-0">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Subject</th>
                            <th class="text-grey">Resignation Date</th>
                            <th class="text-grey">Comments</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>


<!-- Dummy End -->

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
            ajax: "{{ action([App\Http\Controllers\Resignation::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'subject',
                    name: 'subject'
                },
                {
                    data: 'resignationdate',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'description',
                    name: 'description'
                }

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
                        window.location.reload();
                    }, 2000);
                    if (typeof response.reload !== 'undefined') {
                        $('.appac_show').hide();
                        $('.appac_hide').show();

                        setTimeout(function() {
                            
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