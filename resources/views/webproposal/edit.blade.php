<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Proposal</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($web, ['route' => ['webproposal.update', $web->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company', 'Company Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('company', $web->company, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('city', 'City*', ['class' => 'label-color py-2'] ) !!}
                    {!! Form::text('city', $web->city, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('webcost', 'Web Development Cost *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('webcost', $web->webcost, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('appointmentcost', 'Appointment Dashboard Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('appointmentcost', $web->appointmentcost, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('hostcost', 'Website Hosting & Maintenance Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('hostcost', $web->hostcost, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('portalcost', 'Feedback Portal Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('portalcost', $web->portalcost, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('sslcost', 'SSL Certificate Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('sslcost', $web->sslcost, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('admin_name', 'Proposal Sent By *', ['class' => 'label-color py-2']) !!}
                        <select class="admin_name form-select" name="admin_name" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Bala Krishnan" @if($web->created_by=='Bala Krishnan')selected @endif>Bala Krishnan</option>
                            <option value="Deepak" @if($web->created_by=='Deepak')selected @endif>Deepak</option>
                            <option value="Melba" @if($web->created_by=='Melba')selected @endif>Melba</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('date', 'Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('date', $web->date, ['class' => 'form-control', 'required']) !!}
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