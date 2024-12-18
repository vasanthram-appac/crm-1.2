<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Opportunity</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::model($lead, ['route' => ['opportunityupdate', $lead->id], 'method' => 'POST']) !!}
            <!-- Hidden Fields -->
            {!! Form::hidden('address', $lead->address) !!}
            {!! Form::hidden('city', $lead->city) !!}
            {!! Form::hidden('state', $lead->state) !!}
            {!! Form::hidden('pincode', $lead->pincode) !!}
            {!! Form::hidden('country', $lead->country) !!}
            {!! Form::hidden('gst_number', $lead->gst_number) !!}
            {!! Form::hidden('website', $lead->website) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('opportunitydate', 'Opportunity Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('opportunitydate', now()->format('d-m-Y'), ['class' => 'form-control', 'id' => 'opportunitydate', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('opportunityupdate', 'Today\'s Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('opportunityupdate', now()->format('F j, Y, g:i a T'), ['class' => 'form-control', 'id' => 'opportunityupdate', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Account*', ['class' => 'label-color py-2']) !!}
                        {!! Form::hidden('comp_title', 'M/s.') !!}
                        {!! Form::text('company_name', $lead->company_name, ['class' => 'form-control', 'id' => 'company_name', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title', ['class' => 'label-color py-2']) !!}
                        {!! Form::hidden('id', $lead->id) !!}
                        {!! Form::text('title', $lead->title, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'First Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('firstname', $lead->firstname, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('lastname', 'Last Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lastname', $lead->lastname, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('summary', 'Summary', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('summary', $lead->summary, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Brief Description', 'style' => 'resize:none;', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('stdcode', 'Std Code', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('stdcode', $lead->stdcode, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('phone', $lead->phone, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternate_phone', 'Alternate Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('alternate_phone', $lead->alternate_phone, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('emailid', 'Email ID', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('emailid', $lead->emailid, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternateemail', 'Alternate Email', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('alternateemail', $lead->alternateemail, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('assignedto', 'Assigned To', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('text', $assignedto->fname, ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::hidden('assignedto', $assignedto->empid) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('opportunitystage', 'Opportunity Stage', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('opportunitystage', $opportunitymaster, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('opportunitysource', 'Opportunity Source', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('opportunitysource', $source, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('accountmanager', 'Account Manager', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('text', $assignedto->fname, ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::hidden('accountmanager', $assignedto->empid) !!}
                    </div>
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
