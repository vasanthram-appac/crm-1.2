<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Opportunity</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::model($opportunity, ['route' => ['opportunity.update', $opportunity->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('opportunitydate', 'Opportunity Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('opportunitydate', now()->format('d-m-Y'), ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('company_name', $opportunity->company_name, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>


            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Today Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('opportunityupdate', now()->format('F j, Y, g:i a T'), ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'Account*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('company_name', $opportunity->company_name, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('title', $opportunity->title, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('firstname', $opportunity->firstname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('lastname', 'Last Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lastname', $opportunity->lastname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('summary', 'Summary*', ['class' => 'label-color py-2']) !!}
                    {!! Form::textarea('summary', $opportunity->summary, ['class' => 'form-control', 'rows' => 5, 'style' => 'resize:none;']) !!}
                    <span class="focus-input100"></span>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('stdcode', 'STD Code', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('stdcode', $opportunity->stdcode, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('phone', $opportunity->phone, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternate_phone', 'Alternate Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('alternate_phone', $opportunity->alternate_phone, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('emailid', 'Email Id', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('emailid', $opportunity->emailid, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternateemail', 'Alternate Email Id', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('alternateemail', $opportunity->alternateemail, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('assignedto', 'Assigned To', ['class' => 'label-color py-2']) !!}
                    {!! Form::select('assignedto', $assignedto, $opportunity->assignedto, ['class' => 'form-control']) !!}
                    <span class="focus-input100"></span>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('oppourtunitystage', 'Opportunity Stage', ['class' => 'label-color py-2']) !!}
                    {!! Form::select('oppourtunitystage', $opportunitymaster, $opportunity->opportunitystage, ['class' => 'form-control']) !!}
                    <span class="focus-input100"></span>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('oppourtunitysource', 'Opportunity Source', ['class' => 'label-color py-2']) !!}
                    {!! Form::select('oppourtunitysource', $source, $opportunity->opportunitysource, ['class' => 'form-control']) !!}
                    <span class="focus-input100"></span>
                </div>

            </div>

            <div class="text-end">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                <div></div> <div></div>
                {!! Form::button(' Update', ['type' => 'submit', 'class' => 'frm-btn pri-text-color']) !!}
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>