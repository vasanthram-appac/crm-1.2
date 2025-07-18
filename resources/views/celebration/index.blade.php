@extends('layouts/app')

@section('title','Celebration')

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
       @include('layouts/partials/usermodulemenu')
    </div>
<div class="profile-head my-2">
            <h1 class="ch2 comp-name">Celebration</h1>
        </div>
<div class="col-lg-12">
<iframe src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FKolkata&showPrint=0&src=YXBwYWNjcm1AZ21haWwuY29t&src=ZW4uaW5kaWFuI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29nbGUuY29t&color=%23039BE5&color=%230B8043" style="border-width:0" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
</div>
    <div class="col-lg-6 col-sm-12 p-0">
        <div class="panel row" id="firstRow">
       
            <div class="p-4 table-responsive">
          
                <table id="example" class="dataTable mt-6 table table-bordered ">
                    <thead>
                        <tr class="bg-white">
                            <th class="text-grey">S.no</th>
                            <th class="text-grey">Date List</th>
                            <th class="text-grey">Reason for </th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
    <div class="col-lg-6 col-sm-12 p-0">
    <div class="p-4 table-responsive ">
    <div class="widget-body ">
    <h4 class="">Birthday's</h4>
</div>
<div class="tab-over-y-hid">
    <table class="dataTable mt-4 table table-bordered responsive " id="editable-sample">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Birthday</th>
        </tr>
        @foreach ($birthdayResults as $key=>$data)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $data['fname'] }}</td>
            <td>
                {{ $data['dob'] }}
                {!! $data['status'] !!}
            </td>
        </tr>
        @endforeach
    </table>
    </div>
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
            ajax: "{{ action([App\Http\Controllers\Celebration::class,'index']) }}",
            columns: [{
                    data: 'sno',
                    name: 'sno'
                },
                {
                    data: 'datelist_one',
                    type: 'date-mm-dd',
                    orderData: 0
                },
                {
                    data: 'reason',
                    name: 'reason'
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

    });
</script>
@endsection