<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Document Upload</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['documentupload.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                    {!! Form::label('title', 'Title*', ['class' => 'label-color py-2'] ) !!}
                    {!! Form::text('title', null, ['class' => 'form-control','required' => true, 'placeholder'=>'Title']) !!}
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                    {!! Form::label('documentlink', 'Document Link', ['class' => 'label-color py-2']) !!}
                    {!! Form::file('documentlink', ['class' => 'form-control', 'accept' => '.xlsx,.xls,.doc,.docx']) !!}
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
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Add </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>

<script language="javascript" type="text/javascript">
    $(function() {
        $.configureBoxes();
    });
    $('.select2').select2();
</script>