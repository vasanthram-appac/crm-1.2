<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Design</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['design.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name *', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, null, ['class' => 'form-select', 'required' => true]) !!} </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('assignedto', 'Assigned To *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('assignedto', $regis, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('design_type', 'Design Type *', ['class' => 'label-color py-2']) !!}
                        <select class=" form-select " name="design_type" required>
                            <option value="">Select From List</option>
                            <option value="graphic">Graphic Design</option>
                            <option value="ui">UI Design</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('design_status', 'Design Status *', ['class' => 'label-color py-2']) !!}
                        <select class=" form-select " name="design_status" required>
                            <option value="">Select From List</option>
                            <option value="Not yet started">Not yet Started</option>
                            <option value="Started">Started</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('start_date', 'Start Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('start_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('end_date', 'End Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', null, ['class' => 'form-control','rows'=>2]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mail_cc', 'Mark a CC Mail to *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('mail_cc[]', $mail, null, ['class' => 'form-control', 'multiple' => true]) !!}
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