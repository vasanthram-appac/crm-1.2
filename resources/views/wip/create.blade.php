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
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Wip</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['wip.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('wiptype', 'WIP Type*', ['class' => 'label-color py-2'] ) !!}
                        <select class="form-control" name="wiptype" required>
                            <option value="1">New</option>
                            <option value="2">Existing</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, null, ['class' => 'form-select', 'required' => true]) !!} </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('projectname', 'Project Name *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('projectname', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('marketing_person', 'Marketing Person *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('marketing_person', $marketing, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('promotion_person', 'Promotion Person *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('promotion_person', $promotion, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('client_coordinate', 'Client Co-ordinate *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('client_coordinate', $Client, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_status', 'Project Status', ['class' => 'label-color py-2']) !!}
                        <select class="span6 form-control " name="project_status" required>
                            <option value="">Select From List</option>
                            <option value="On Board">On Board</option>
                            <option value="Discovery">Discovery</option>
                            <option value="Design">Design</option>
                            <option value="Development">Development</option>
                            <option value="Content">Content</option>
                            <option value="Hosted">Hosted</option>
                            <option value="Others">Others</option>
                            <option value="Not yet started">Not yet started</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('start_date', 'Start Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('start_date', date('Y-m-d'), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('end_date', 'End Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('end_date', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('eta', 'Total ETA (Hours)', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('eta', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('temp_url', 'Temp URL', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('temp_url', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Project Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', null, ['class' => 'form-control','rows'=>2]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mail_cc', 'Mark a CC Mail to *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('mail_cc[]', $mail, null, ['class' => 'form-select select2', 'multiple' => true]) !!}
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
<script language="javascript" type="text/javascript">
         $(function() {
             $.configureBoxes();
         });
		//  $('.select2').select2(); 
      </script>