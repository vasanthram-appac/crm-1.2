<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Email</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($email, ['route' => ['addemail.update', $email->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::hidden('id', $email->id, ['class' => 'form-control']) !!}
                        {!! Form::hidden('eid', $email->eid, ['class' => 'form-control']) !!}
                        {!! Form::label('mailid', 'Email *', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('mailid', $email->mailid, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center ">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                        Update
                    </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                        Cancel
                    </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    <!--/.Content-->
</div>