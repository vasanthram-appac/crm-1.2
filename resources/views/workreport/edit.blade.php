<style>
    .select2-container {
    z-index: 99999 !important; /* Higher than Bootstrap modal */
}
.select2-container--default .select2-selection--multiple {
    border: 0 !important;
    padding-bottom: 0.6rem !important;
    padding-top: 0.25rem !important;
}
</style>
<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Report</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
     
            {!! Form::model($workreport, ['route' => ['workreport.update', $workreport->id], 'method' => 'PUT']) !!}

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('report_date', 'Date*', ['class' => 'form-label']) !!}
                        {!! Form::date('report_date', $workreport->report_date1, ['class' => 'form-control', 'id' => 'txtDate', 'required']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('client', 'Client Name*', ['class' => 'form-label']) !!}
                        {!! Form::select('client', $accounts, $workreport->client, ['class' => 'form-select select2', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('worktype', 'Work Type*', ['class' => 'label-color py-2']) !!}

                    <div class="mt-2">
                        @foreach ($work_types as $work_type)
                        <div class="form-check form-check-inline">
                            {!! Form::radio('worktype', $work_type->id, $workreport->worktype, ['id' => 'worktype_' . $work_type->id, 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('worktype_' . $work_type->id, $work_type->wtype, ['class' => 'label-color']) !!}
                        </div>
                        @endforeach

                        
                    </div>
                </div>


                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <div id="type-1">
                            {!! Form::label('wipid', 'WIP List', ['class' => 'form-label']) !!}
                            {!! Form::select('wipid', $wip_list, $workreport->wipid, ['class' => 'form-select select2']) !!}
                        </div>
                        @if (in_array(request()->session()->get('dept_id'), [1, 6, 7]))
                        <label class="form-label mt-3">(OR) Leads Name</label>
                        {!! Form::select('leadid', $leads_list, $workreport->leadid, ['class' => 'form-select select2']) !!}
                        @endif
                    </div>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('start_time', 'Start Time*', ['class' => 'form-label']) !!}
                        {!! Form::time('start_time', $workreport->start, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('end_time', 'End Time*', ['class' => 'form-label']) !!}
                        {!! Form::time('end_time', $workreport->end, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('project_name', 'Project Short Description', ['class' => 'form-label']) !!}
                        {!! Form::text('project_name', $workreport->project_name, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        {!! Form::label('status', 'Description*', ['class' => 'form-label']) !!}
                        {!! Form::textarea('status', $workreport->status, ['class' => 'form-control', 'required', 'rows' => 1]) !!}
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> Update
                </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                    <i class="fa fa-times"></i> Cancel
                </button>
            </div>
            <br>

            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({
        dropdownParent: $('.customer_modal'), // Ensures dropdown stays inside the modal
        width: '100%' // Makes the select box full width
    });
});

</script>

<script>
    $(function() {
        var dtToday = new Date();
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        //  alert(maxDate);
        $('#txtDate').attr('max', maxDate);
        var yesterday1 = new Date(new Date().setDate(new Date().getDate() - 120));
        var month = yesterday1.getMonth() + 1;
        var day = yesterday1.getDate();
        var year = yesterday1.getFullYear();
        if (month < 10)
            month = '0' + month.toString();
        if (day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;
        // alert(maxDate);
        $('#txtDate').attr('min', maxDate);

    });

    $(document).ready(function() {
        // $("div div").hide();

        $("#type-1").hide();
        $("input[type='radio']").click(function() {
            var test = $(this).val();
            if ($(this).val() == '1') {
                $("#type-" + test).show();
            } else {
                $("#type-1").hide();
            }
            //alert($(this).val());
            //$("div div").hide();

        });
    });
</script>