<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Google Sheet</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($googlesheet, ['route' => ['googlesheet.update', $googlesheet->id], 'method' => 'PUT']) !!}


            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('title', $googlesheet->title, ['class' => 'form-control','required' => true, 'placeholder'=>'Title']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('sharedlink', 'Share Link', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('sharedlink', $googlesheet->sharedlink, ['class' => 'form-control','required' => true, 'placeholder'=>'Link']) !!}
                    </div>
                </div>

            </div>


            <!-- Repeat the above block for other fields like email, password, mobile, etc. -->

            <!-- Add a submit button -->
            <br>
            <div class="text-end">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <div></div>
                    <div></div>
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Update </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>