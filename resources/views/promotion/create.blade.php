<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Promotion</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['promotion.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, null, ['class' => 'form-select', 'required' => true]) !!} </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('promotion_person', 'Promotion Person *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('promotion_person', $promotion, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('promotion_status', 'Promotion Type *', ['class' => 'label-color py-2']) !!}
                        <select class=" form-select " name="promotion_status" required>
                            <option value="">Select From List</option>
                            <option value="Organic">Organic</option>
                            <option value="Paid">Paid</option>
                            <option value="Organic/Paid">Organic/Paid</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Retainer">Retainer</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('start_date', 'Start Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('start_date', date('d-m-Y'), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <!-- <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('end_date', 'End Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div> -->

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('client_coordinate', 'Contract Period *', ['class' => 'label-color py-2']) !!}
                        <select class="span6 form-select select2" name="contract" required id="my_select">
                            <option>Select</option>
                            <option value="1">1 Month</option>
                            <option value="3">3 Months</option>
                            <option value="6">6 Months</option>
                            <option value="9">9 Months</option>
                            <option value="12">12 Months</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('files', 'Attachment', ['class' => 'label-color py-2']) !!}
                        {!! Form::file('files[]', ['class' => 'span6', 'accept' => '.xlsx,.xls,.doc,.docx', 'multiple' => 'multiple']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">
                
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Project Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', null, ['class' => 'form-control','rows'=>2]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mail_cc', 'Mark a CC Mail to *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('mail_cc[]', $mail, null, ['class' => 'form-select', 'multiple' => true]) !!}
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