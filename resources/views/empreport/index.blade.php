@extends('layouts.app')

@section('title', 'Employee Report')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv,
    .buttons-excel,
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
                <a class="nav-link  com ad-btn" href="/workreport"><b>Work Report</b></a>
            </li>
            @if(request()->session()->get('role') != 'user')
            <li class="nav-item">
                <a class="nav-link active" href="/employeereport"><b>Employee Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/monthlyreport"><b>Monthly Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/enquiryreport"><b>Enquiry Report</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/leadhistory"><b>Account History</b></a>
            </li>
            @php
            $empid = request()->session()->get('empid');
            @endphp
            @if(in_array($empid, ['AM001', 'AM090']))
            
            <li class="nav-item">
                <a class="nav-link" href="/fiscal"><b>Fiscal</b></a>
            </li>
            @endif
            @endif        
        </ul>
    </div>
<div class="profile my-3 col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">Employee Report</h1>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 p-0">
    <div class="row  col-wrap">
        <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
        <div class="bio  rounded-30 bg-white  client-li">
        <div class=" row" id="firstRow">
            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>
                        <div class="widget-body">
                            <h4>Client Comments</h4>

                            {!! Form::open(['route' => ['ereport'], 'method' => 'POST']) !!}
                            @csrf

                            <div class="control-group mb-2">
                                {!! Form::label('reportdate', 'Date', ['class' => 'label-color control-label mb-2']) !!}
                                @if(session()->has('aireportdate') && !empty(session()->has('aireportdate')))
                                {!! Form::date('reportdate', session()->get('aireportdate'), ['class' => 'span6 form-control', 'required']) !!}
                                @else
                                {!! Form::date('reportdate', null, ['class' => 'span6 form-control', 'required']) !!}
                                @endif

                            </div>

                            <div class="control-group validate-input mb-2">
                                {!! Form::label('employee', 'Employee', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('empid[]', $user->pluck('fname', 'empid')->prepend('All', 'all'), null, ['class' => 'js-select2 input100 select2', 'multiple' => true]) !!}
                            </div>

                            <b class="text-center w-100 d-block my-2  mt-3" style="color:#2c86ba;">(OR)</b>

                            <div class="control-group mb-2">
                                {!! Form::label('dept_id', 'Department', ['class' => 'label-color control-label mb-2']) !!}
                                {!! Form::select('dept_id', $department_master->prepend('Select', ''), null, ['class' => 'form-select']) !!}
                            </div>

                            <div class="text-end">
                                <label class="err_lbl"></label><br>
                                <div class="p-0">
                                    <div></div>
                                    <div></div>
                                    <button type="submit" class="frm-btn pri-text-color" role="button"> Submit </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                </div>
               
                



         <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
        <div class="bio  p-0   client-li">
        <div class=" row mt-0 gap-2" id="firstRow">
         <div class="col-lg-12 col-xl-12 col-xxl-12 pr-20 ">
        <div class="bio  rounded-30 bg-white  client-li  ">
        <div class="d-flex p-0 justify-content-between gap-1 status-wrp flex-wrap   flex-xxl-row flex-xl-row flex-lg-row">
                   
                   @if(session()->has('aireport') && count(session('aireport')->active) >= 0)
                   <div><h5>Active Users: <span class="fst-italic fw-bold text-info">{{ count(session('aireport')->active) }}</span></h5></div>
                   @if(session()->has('aireportdate') && !empty(session()->has('aireportdate')))
                   <div><h6 class="text-end">{{ date('d-m-Y', strtotime(session()->get('aireportdate'))) }}</h6></div>
                   @else
                   <div><h6 class="text-end">{{ date('d-m-Y', strtotime('-1 day')) }}</h6></div>
                   @endif

                   <div class=" d-gird-3  flex-wrap  gap-1 w-100  pb-3  p-0" >
                   @foreach(session('aireport')->active as $activeuser)
                   <div class="d-flex align-items-center mt-1 gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="15px"  height="15px" viewBox="0 0 15 15">
   <path fill="#2c86ba" fill-rule="evenodd" d="M2.146 11.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 1 0-.708.708L5.793 7.5zm6 0a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 1 0-.708.708L11.793 7.5z" clip-rule="evenodd" />
</svg><span>{{ $activeuser->fname }}</div>
                   @endforeach
                   @endif
                   </div>

                    </div>
</div>
</div>
</div>
</div>
</div>


<div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
        <div class="bio  p-0   client-li">
        <div class=" row mt-0 gap-2" id="firstRow">
         <div class="col-lg-12 col-xl-12 col-xxl-12 pr-20 ">
        <div class="bio  rounded-30 bg-white  client-li  ">
        <div class="p-0 justify-content-between gap-1 status-wrp flex-wrap   flex-xxl-row flex-xl-row flex-lg-row">
            <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;"></div>
                        <div class="widget-body">
                     
                    <div class="d-flex p-0 justify-content-between gap-1 status-wrp flex-wrap   flex-xxl-row flex-xl-row flex-lg-row">
                         @if(session()->has('aireport') && count(session('aireport')->inactive) >= 0)
                    <div class="p-0"><h5>Inactive Users:<span class="fst-italic fw-bold text-info"> {{ count(session('aireport')->inactive) }}</span></h5></div>
                  @if(session()->has('aireportdate') && !empty(session()->has('aireportdate')))
                   <div><h6 class="text-end">{{ date('d-m-Y', strtotime(session()->get('aireportdate'))) }}</h6></div>
                   @else
                   <div><h6 class="text-end">{{ date('d-m-Y', strtotime('-1 day')) }}</h6></div>
                   @endif
                    </div>
                    <div class=" d-gird-3  flex-wrap mt-2  gap-1  pb-3  p-0">
                    @foreach(session('aireport')->inactive as $inactiveuser)
                  
                    <div class="d-flex align-items-center gap-1"><svg xmlns="http://www.w3.org/2000/svg" width="15px"  height="15px" viewBox="0 0 15 15">
	<path fill="#2c86ba" fill-rule="evenodd" d="M2.146 11.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 1 0-.708.708L5.793 7.5zm6 0a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 1 0-.708.708L11.793 7.5z" clip-rule="evenodd" />
</svg>{{ $inactiveuser->fname }}</div>
                    @endforeach
                    @endif
</div>
                </div>
</div>
</div>

             

            </div>
            </div>
            </div>
            </div>
        



            <div class="p-4 table-responsive">
                <table id="example" class="dataTable mt-6 table table-bordered">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Date of Report</th>
                            <th class="text-grey">Employee Name</th>
                            <th class="text-grey">Client Name</th>
                            <th class="text-grey">Project Name</th>
                            <th class="text-grey">Start Time</th>
                            <th class="text-grey">End Time</th>
                            <th class="text-grey">Total Working Time</th>
                            <th class="text-grey">Status</th>
                            <th class="text-grey">Submit Time</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="errorModal" role="dialog">
        <div class="modal-dialog cascading-modal float-end me-3" role="document">
            <div class="modal-content">
                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <div class="error-modal px-2 pb-1"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
      $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select a Employee", // Optional placeholder
            allowClear: true               // Optional clear button
        });
    });
</script>
<script>
    $(document).ready(function() {
        var cat_table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            ajax: "{{ action([App\Http\Controllers\Employeereport::class, 'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'report_date',
                    type: 'date-mm-dd',
                    orderData: 0
                },
                {
                    data: 'empname',
                    name: 'empname'
                },
                {
                    data: 'company_name_account',
                    name: 'company_name_account'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    data: 'start_time',
                    name: 'start_time'
                },
                {
                    data: 'end_time',
                    name: 'end_time'
                },
                {
                    data: 'total_time',
                    name: 'total_time'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'submit_time',
                    name: 'submit_time'
                }
            ],
            drawCallback: function(settings) {
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
            dom: 'lBfrtip',
            buttons: [{
                    extend: 'csv',
                    text: 'Export CSV'
                },
                {
                    extend: 'excel',
                    text: 'Export Excel'
                },
                'colvis'
            ]
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

        
                            window.location.reload();
                       


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


 if (sessionStorage.getItem('sessionvariable') == null || sessionStorage.getItem('sessionvariable') == 'false') {
            setTimeout(function() {
                window.location.reload();
            }, 1000);
            sessionStorage.setItem('sessionvariable', 'true');
        }

        $(".js-select2").select2({
            closeOnSelect: false,
            placeholder: "Select",
            allowClear: true,
            tags: true
        });
    });
</script>
@endsection