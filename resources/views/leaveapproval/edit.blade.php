<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Leave Approval</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($record, ['route' => ['leaveapproval.update', $record->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('leavestatus', 'Leave Status', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('leavestatus', $leavemaster, $record->leavestatus, ['class' => 'form-select', 'required' => 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('comments', 'Comments', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('comments', null, ['class' => 'form-control', 'rows' => 1]) !!}
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
            {!! Form::button('Update', ['type' => 'submit', 'class' => 'frm-btn pri-text-color', 'data-id' => '8']) !!}
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