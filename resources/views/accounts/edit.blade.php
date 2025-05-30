<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Accounts</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::model($accounts, ['route' => ['accounts.update', $accounts->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Account*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('company_name', $accounts->company_name, ['class' => 'form-control']) !!}
                        {!! Form::hidden('comp_title', $accounts->comp_title) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('address', 'Address*', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('address', $accounts->address, ['class' => 'form-control', 'rows' => 5, 'style' => 'resize:none;']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('city', 'City', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('city', $accounts->city, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('state', 'State', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('state', $accounts->state, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('pincode', 'Pincode*', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('pincode', $accounts->pincode, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('title', $accounts->title, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('firstname', $accounts->firstname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('lastname', 'Last Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lastname', $accounts->lastname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('gst_number', 'GST Number', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('gst_number', $accounts->gst_number, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('stdcode', 'STD Code', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('stdcode', $accounts->stdcode, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('phone', $accounts->phone, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('emailid', 'Email Id', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('emailid', $accounts->emailid, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Shipping Address</h5>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_title', 'Shipping Title', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('shipping_title', ['Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Prof' => 'Prof', 'Dr' => 'Dr'], $accounts->shipping_title, ['class' => 'form-control', 'placeholder' => 'Choose a Category']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_firstname', 'Shipping First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_firstname', $accounts->shipping_firstname, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_lastname', 'Shipping Last Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_lastname', $accounts->shipping_lastname, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_phone', 'Shipping Phone*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_phone', $accounts->shipping_phone, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}

                            </div>
                    </div>
                </div>

                <div class="row m-0 mb-0">

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_address', 'Shipping Address', ['class' => 'label-color py-2']) !!}
                            {!! Form::textarea('shipping_address', $accounts->shipping_address, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter your Address', 'style' => 'resize:none;']) !!}

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_city', 'Shipping City', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('shipping_city', $accounts->shipping_city, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="row m-0 mb-0">

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_state', 'Shipping State', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('shipping_state', $accounts->shipping_state, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('shipping_pincode', 'Shipping Pincode', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::number('shipping_pincode', $accounts->shipping_pincode, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>

                </div>

                <div class="row m-0 mb-0">
                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('website', 'Website', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('website', $accounts->website, ['class' => 'form-control']) !!}
                            <span class="focus-input100"></span>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('assignedto', 'Assigned To', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('assignedto', $assignedto, $accounts->assignedto, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="row m-0 mb-0">
                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('accountmanager', 'Managed By', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('accountmanager', $accountmanager, $accounts->accountmanager, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('download_status', 'Download Status', ['class' => 'label-color py-2']) !!}
                        <select name="download_status" id="download_status" class="form-select">
                         <option value="">Select</option>
                         <option value="Download" {{ $accounts->download_status == 'Download' ? 'selected' : '' }}>Download</option>
                         <option value="Not" {{ $accounts->download_status == 'Not' ? 'selected' : '' }}>Not</option>
                        </select>
                        <span class="focus-input100"></span>
                    </div>

                </div>

                <div class="" style="border-bottom: 1px solid #ccc;">
                    <h5 class="title">Client Service (CSM)</h5>
                </div>

                <div class="row m-0 mb-0">
                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('csmname', 'Name', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('csmname', $accounts->csmname, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('csmphone', 'Phone*', ['class' => 'label-color py-2']) !!}
                            {!! Form::number('csmphone', $accounts->csmphone, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}
                                </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('csmemail', 'Email*', ['class' => 'label-color py-2']) !!}
                                {!! Form::email('csmemail', $accounts->csmemail, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="" style="border-bottom: 1px solid #ccc;">
                        <h5 class="title">Client Service1 (CSM1)</h5>
                    </div>

                    <div class="row m-0 mb-0">
                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('csmname1', 'Name', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('csmname1', $accounts->csmname1, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('csmphone1', 'Phone*', ['class' => 'label-color py-2']) !!}
                                {!! Form::number('csmphone1', $accounts->csmphone1, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}
                                    </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('csmemail1', 'Email*', ['class' => 'label-color py-2']) !!}
                                    {!! Form::email('csmemail1', $accounts->csmemail1, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="" style="border-bottom: 1px solid #ccc;">
                            <h5 class="title">Client Service1 (CSM2)</h5>
                        </div>

                        <div class="row m-0 mb-0">
                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('bdmname', 'Name', ['class' => 'label-color py-2']) !!}
                                    {!! Form::text('bdmname', $accounts->bdmname, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('bdmphone', 'Phone*', ['class' => 'label-color py-2']) !!}
                                    {!! Form::number('bdmphone', $accounts->bdmphone, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}
                                        </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="validate-input m-b-23 mb-2">
                                        {!! Form::label('bdmemail', 'Email*', ['class' => 'label-color py-2']) !!}
                                        {!! Form::email('bdmemail', $accounts->bdmemail, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                                    </div>
                                </div>

                            </div>

                            <div class="" style="border-bottom: 1px solid #ccc;">
                                <h5 class="title">Managing Director (MD)</h5>
                            </div>

                            <div class="row m-0 mb-0">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="validate-input m-b-23 mb-2">
                                        {!! Form::label('mdname', 'Name', ['class' => 'label-color py-2']) !!}
                                        {!! Form::text('mdname', $accounts->mdname, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12">
                                    <div class="validate-input m-b-23 mb-2">
                                        {!! Form::label('mdphone', 'Phone*', ['class' => 'label-color py-2']) !!}
                                        {!! Form::number('mdphone', $accounts->mdphone, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}
                                            </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-12">
                                        <div class="validate-input m-b-23 mb-2">
                                            {!! Form::label('mdemail', 'Email*', ['class' => 'label-color py-2']) !!}
                                            {!! Form::email('mdemail', $accounts->mdemail, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                                        </div>
                                    </div>

                                </div>

                                <div class="text-end">
                                    <label class="err_lbl"></label><br>
                                    <div class="btn-g2">
                                        <div></div>
                                        <div></div>
                                        {!! Form::button(' Update', ['type' => 'submit', 'class' => 'frm-btn pri-text-color']) !!}
                                        <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>