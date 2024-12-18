<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Offer Letter</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($offer, ['route' => ['offerletter.update', $offer->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('emp_name', 'Employee Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('emp_name', $offer->emp_name, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('gender', 'Gender*', ['class' => 'label-color py-2']) !!}
                    <div class="validate-input m-b-23 mb-2">
                        <div class="form-check form-check-inline">
                            {!! Form::radio('gender', 'Male', $offer->gender == 'Male', ['id' => 'activeRadio1', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('activeRadio1', 'Male', ['class' => 'form-check-label px-2 primary-text']) !!}
                        </div>
                        <div class="form-check form-check-inline">
                            {!! Form::radio('gender', 'Female', $offer->gender == 'Female', ['id' => 'inactiveRadio2', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('inactiveRadio2', 'Female', ['class' => 'form-check-label px-2 primary-text']) !!}
                        </div>
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('position', 'Position *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('position', $offer->position, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('date_of_join', 'Joining Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('date_of_join', $offer->joining_date, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('salary', 'Salary *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('salary', $offer->salary, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('street', 'Street *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('street', $offer->street, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('town', 'Town *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('town', $offer->town, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('city', 'City *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('city', $offer->city, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('pin', 'PIN Code *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('pin', $offer->pin_code, ['class' => 'form-control', 'required']) !!}
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