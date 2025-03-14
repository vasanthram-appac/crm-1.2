<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Apply Leave</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['applyleave.store'], 'method' => 'post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('employee', 'Employee Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('employee', request()->session()->get('fname'), ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dateofapplication', 'Date of Apply', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('dateofapplication', now()->format('F j, Y, g:i a T'), ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-12 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('leavetype', 'Leave Type', ['class' => 'label-color py-2']) !!}

                        <div class="mt-2">
                            @if($casual < 6)
                                <div class="form-check form-check-inline">
                                {!! Form::radio('leavetype', '5', true, ['id' => 'casualRadio', 'class' => 'form-check-input']) !!}
                                {!! Form::label('casualRadio', 'Casual', ['class' => 'label-color']) !!}
                        </div>
                        @endif
                        @if($sick < 6)
                            <div class="form-check form-check-inline">
                            {!! Form::radio('leavetype', '6', false, ['id' => 'sickRadio', 'class' => 'form-check-input']) !!}
                            {!! Form::label('sickRadio', 'Sick', ['class' => 'label-color']) !!}
                    </div>
                    @endif
                    <div class="form-check form-check-inline">
                        {!! Form::radio('leavetype', '0', false, ['id' => 'permissionRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('permissionRadio', 'Permission', ['class' => 'label-color']) !!}
                    </div>

                    <div class="form-check form-check-inline">
                        {!! Form::radio('leavetype', '1', false, ['id' => 'compensateRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('compensateRadio', 'Compensate', ['class' => 'label-color']) !!}
                    </div>

                    <div class="form-check form-check-inline">
                        {!! Form::radio('leavetype', '2', false, ['id' => 'wfhRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('wfhRadio', 'WFH', ['class' => 'label-color']) !!}
                    </div>

                    <div class="form-check form-check-inline">
                        {!! Form::radio('leavetype', '3', false, ['id' => 'halfDayRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('halfDayRadio', 'Half Day', ['class' => 'label-color']) !!}
                    </div>

                    <div class="form-check form-check-inline">
                        {!! Form::radio('leavetype', '4', false, ['id' => 'unpaidRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('unpaidRadio', 'Unpaid', ['class' => 'label-color']) !!}
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="row m-0 mb-0" id="combo" style="display: none">
        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('cleavedate', 'Compensate From*', ['class' => 'label-color py-2']) !!}
                {!! Form::date('cleavedate', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('cleavedatetill', 'TO*', ['class' => 'label-color py-2']) !!}
                {!! Form::date('cleavedatetill', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row m-0 mb-0" id="leave">
        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('leavedate', 'Leave From*', ['class' => 'label-color py-2']) !!}
                {!! Form::date('leavedate', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('leavedatetill', 'Leave Till*', ['class' => 'label-color py-2']) !!}
                {!! Form::date('leavedatetill', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row m-0 mb-0" id="permission" style="display: none">
        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('leavedatetill', 'Leave Date & Time', ['class' => 'label-color py-2']) !!}
                {!! Form::date('pleavedate', null, ['class' => 'form-control']) !!}
                {!! Form::time('fromtime', null, ['class' => 'form-control']) !!}
                {!! Form::time('totime', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="row m-0 mb-0" id="half" style="display: none">
        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('hleavedate', 'Date', ['class' => 'label-color py-2']) !!}
                {!! Form::date('hleavedate', null, ['class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                 {!! Form::label('type', 'Type', ['class' => 'label-color py-2']) !!}
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        {!! Form::radio('half', '1', true, ['id' => 'firstHalfRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('firstHalfRadio', 'First Half', ['class' => 'label-color']) !!}
                    </div>

                    <div class="form-check form-check-inline">
                        {!! Form::radio('half', '2', false, ['id' => 'secondHalfRadio', 'class' => 'form-check-input']) !!}
                        {!! Form::label('secondHalfRadio', 'Second Half', ['class' => 'label-color']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 mb-0">
        <div class="col-lg-6 col-sm-12">
            <div class="alidate-input m-b-23 mb-2">
                {!! Form::label('employee', 'Reason*', ['class' => 'label-color py-2']) !!}
                {!! Form::textarea('reason', null, ['class' => 'form-control', 'required', 'maxlength' => 300, 'rows' => 1]) !!}
            </div>
        </div>
    </div>

    <!-- Add a submit button -->
    <br>
    <div class="text-center">
        <label class="err_lbl"></label><br>
        <div class="btn-g2">
            <div></div>
            <div></div>
            {!! Form::button('Add', ['type' => 'submit', 'class' => 'frm-btn pri-text-color', 'data-id' => '8']) !!}
            <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">Cancel</button>
        </div>
    </div>
    <br>
    {!! Form::close() !!}


</div>
</div>
<!--/.Content-->
</div>

<script>
    $(document).ready(function() {
        $(function() {
            $('input[name="leavetype"]').on('click', function() {
                if ($(this).val() == '1') {
                    $('#combo').show();
                    $('#leave').hide();
                    $('#half').hide();
                    $('#permission').hide();
                } else if ($(this).val() == '3') {
                    $('#combo').hide();
                    $('#leave').hide();
                    $('#permission').hide();
                    $('#half').show();
                } else if ($(this).val() == '0') {
                    $('#combo').hide();
                    $('#leave').hide();
                    $('#half').hide();
                    $('#permission').show();
                } else {
                    $('#combo').hide();
                    $('#leave').show();
                    $('#half').hide();
                    $('#permission').hide();
                }
            });
        });
    });
</script>