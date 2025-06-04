@extends('layouts/app')

@section('title','WIP')

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
                <a class="nav-link active"  href="/wip"><b>WIP</b></a>
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
                <a class="nav-link"  href="/workorder"><b>Work Order View</b></a>
            </li>        
        </ul>
    </div>
<div class="profile  col-12 col-lg-12 col-xl-12 col-xxl-12 d-flex justify-content-between flex-wrap  align-items-center  p-15">
        <div class="profile-head">
            <h1 class="ch2 comp-name">WIP</h1>
        </div>
        <div class="justify-content-sm-end d-flex">
                <div class=""></div>
                <a class="btn bg-primary text-white ft-15 pri-text-color m-0 mx-2" target="_blank" href="http://appacmediatech.in/@develop/demo-wip-url/">WIP Demo</a>
                <button class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 " data-container=".customer_modal" data-href="{{action([App\Http\Controllers\Wip::class,'create'])}}"><i class="fa fa-plus me-1" aria-hidden="true"></i> Add WIP</button>
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
                            <th class="text-grey">Company name</th>
                            <th class="text-grey">Project name</th>
                            <th class="text-grey">Date</th>
                            <th class="text-grey">Project status</th>
                            <th class="text-grey">Total days</th>
                            <!-- <th class="text-grey">Total Hours</th>
                            <th class="text-grey">WIP Hours</th> -->
                            <th class="text-grey">ETA</th>
                            <th class="text-grey">Total Working Hours</th>
                            <th class="text-grey"> URL</th>
                            <th class="text-grey">Action
                                <select class="d-block" name="wip_status">
                                    <option value="">Select</option>
                                    <option value="new" @if(request()->session()->get('wip_status') == 'new') selected @endif>New</option>
                                    <option value="existing" @if(request()->session()->get('wip_status') == 'existing') selected @endif>Existing</option>
                                    <option value="closed" @if(request()->session()->get('wip_status') == 'closed') selected @endif>Closed</option>
                                </select>
                            </th>
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
                    <span aria-hidden="true">x</span>
                </button>
                <h4 class="title ps-3 pt-1">Errors</h4>
                <!--Body-->
                <div class="error-modal px-2 pb-1">

                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>

    <!-- total working hours start-->

    <div class="modal fade" id="showvalues" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content px-4 py-2">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">X</span>
      </button>
      <h4 class="title">Department Wise</h4>
      <div class="dev-modal fw-bold"></div>
      <div class="design-modal fw-bold"></div>
    </div>
  </div>
</div>


    <!-- total working hours end-->
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
            ajax: "{{ action([App\Http\Controllers\Wip::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },

                {
                    data: 'companyname',
                    name: 'companyname'
                },
                {
                    data: 'projectname',
                    name: 'projectname'
                },
                {
                    data: 'startdate',
                    type: 'date-mm-dd', // Use the custom date type
                    orderData: 0
                },
                {
                    data: 'project_status',
                    name: 'project_status'
                },
                {
                    data: 'remainday1',
                    name: 'remainday1'
                },
                // {
                //     data: '',
                //     name: ''
                // },
                // {
                //     data: '',
                //     name: ''
                // },
                {
                    data: 'eta',
                    name: 'eta'
                },
                {
                    data: 'totalhours',
                    name: 'totalhours'
                },
                {
                    data: 'url',
                    name: 'url'
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
                beforeSend: function() {
                $(".wipadd").prop("disabled", true).text("Submitting...");
                },
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
                        $(".wipadd").prop("disabled", false).text("Add");
                    }

                },
                error: function(xhr) {
                    // Handle other types of errors (e.g., server error)
                    $(".wipadd").prop("disabled", false).text("Add");
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

        function Oppourtunity() {

var id = $('select[name="wip_status"]').val();
// alert(id);
$.ajax({
    url: "{{ action([App\Http\Controllers\Wip::class, 'index']) }}",
    type: 'GET',
    data: {
        status: id
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

$('select[name="wip_status"]').on('change', Oppourtunity);

    });

function viewalldetail(element) {
  var $row = $(element).closest('tr');
  var development = $row.find('input[name="development"]').val();
  var design = $row.find('input[name="design"]').val();

  $('#showvalues .dev-modal').html('Development: '+development);
  $('#showvalues .design-modal').html('Design: '+design);

  var offset = $(element).offset();
  $('#showvalues .modal-dialog').css({
    position: 'absolute',
    top: offset.top + $(element).outerHeight() - 100,
    left: offset.left
  });

  $('#showvalues').modal('show');
}

</script>
@endsection