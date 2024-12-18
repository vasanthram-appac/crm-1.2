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
            {!! Form::model($digital, ['route' => ['digitalproposal.update', $digital->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('client_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('client_name', $digital->client_name, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('city', 'City*', ['class' => 'label-color py-2'] ) !!}
                    {!! Form::text('city', $digital->city, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('mcost', 'Monthly Investment Cost *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('mcost', $digital->mia, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('mia_post', 'Monthly Post *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('mia_post', $digital->mia_post, ['class' => 'form-control', 'required', 'placeholder'=>'Monthly Post']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

            
            <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                    {!! Form::label('date', 'Date *', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('date', $digital->date, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('admin_name', 'Proposal Sent By *', ['class' => 'label-color py-2']) !!}
                        <select class="admin_name form-select" name="admin_name" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Bala Krishnan" @if($digital->created_by=='Bala Krishnan')selected @endif>Bala Krishnan</option>
                            <option value="Deepak" @if($digital->created_by=='Deepak')selected @endif>Deepak</option>
                            <option value="Melba" @if($digital->created_by=='Melba')selected @endif>Melba</option>
                        </select>
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