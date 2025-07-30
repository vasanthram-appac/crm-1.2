<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add lead</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['lead.store'], 'method' => 'POST']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Company Name']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('title', ['Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Prof' => 'Prof', 'Dr' => 'Dr'], null, ['class' => 'form-control', 'placeholder' => 'Choose a Category']) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('lastname', 'Last Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Phone*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}

                            </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('alternate_phone', 'Alternate Phone', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('alternate_phone', null, ['class' => 'form-control', 'placeholder' => 'Alternate Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}
                                </div>
                        </div>
                    </div>

                    <div class="row m-0 mb-0">
                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('designation', 'Designation*', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('designation', null, ['class' => 'form-control', 'placeholder' => 'Designation']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('department', 'Department', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('department', null, ['class' => 'form-control', 'placeholder' => 'Department']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 mb-0">
                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('emailid', 'Email Id*', ['class' => 'label-color py-2']) !!}
                                {!! Form::email('emailid', null, ['class' => 'form-control', 'placeholder' => 'Primary Email']) !!}

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('alternateemail', 'Alternate Email Id', ['class' => 'label-color py-2']) !!}
                                {!! Form::email('alternateemail', null, ['class' => 'form-control', 'placeholder' => 'Alternate Email']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 mb-0">
                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('website', 'Website', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('website', null, ['class' => 'form-control', 'placeholder' => 'Enter Your Website Address']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('address', 'Address Details*', ['class' => 'label-color py-2']) !!}
                                {!! Form::textarea('address', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter your Address', 'style' => 'resize:none;']) !!}

                            </div>
                        </div>
                    </div>

                    <div class="row m-0 mb-0">

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('city', 'City*', ['class' => 'label-color py-2']) !!}
                                <!-- {!! Form::select('city', $city, null, ['class' => 'form-control', 'placeholder' => 'City']) !!} -->
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('state', 'State', ['class' => 'label-color py-2']) !!}
                                {!! Form::select('state', $state, null, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row m-0 mb-0">

                            <div class="col-lg-6 col-sm-12">
                                {!! Form::label('pincode', 'Pincode', ['class' => 'label-color py-2 ']) !!}
                                {!! Form::number('pincode', null, ['class' => 'form-control']) !!}
                                <span class="focus-input100"></span>
                            </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('country', 'Country*', ['class' => 'label-color py-2']) !!}
                                {!! Form::select('country', $country, null, ['class' => 'form-control', 'placeholder' => 'Country']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('summary', 'Summary', ['class' => 'label-color py-2']) !!}
                                {!! Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Brief Description', 'style' => 'resize:none;']) !!}
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
                                {!! Form::select('shipping_title', ['Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Prof' => 'Prof', 'Dr' => 'Dr'], null, ['class' => 'form-control', 'placeholder' => 'Choose a Category']) !!}

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('shipping_firstname', 'Shipping First Name*', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('shipping_firstname', null, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 mb-0">
                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('shipping_lastname', 'Shipping Last Name', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('shipping_lastname', null, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('shipping_phone', 'Shipping Phone*', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('shipping_phone', null, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}

                                    </div>
                            </div>
                        </div>

                        <div class="row m-0 mb-0">

                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('shipping_address', 'Shipping Address', ['class' => 'label-color py-2']) !!}
                                    {!! Form::textarea('shipping_address', null, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter your Address', 'style' => 'resize:none;']) !!}

                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('shipping_city', 'Shipping City', ['class' => 'label-color py-2']) !!}
                                    {!! Form::text('shipping_city', null, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row m-0 mb-0">

                            <div class="col-lg-6 col-sm-12">
                                <div class="validate-input m-b-23 mb-2">
                                    {!! Form::label('shipping_state', 'Shipping State', ['class' => 'label-color py-2']) !!}
                                    {!! Form::select('shipping_state', $state, null, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                {!! Form::label('shipping_pincode', 'Shipping Pincode', ['class' => 'label-color py-2 ']) !!}
                                {!! Form::number('shipping_pincode', null, ['class' => 'form-control']) !!}
                                <span class="focus-input100"></span>
                            </div>

                        </div>

                    <div class="row m-0 mb-0">

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('source', 'Lead Source*', ['class' => 'label-color py-2']) !!}
                                {!! Form::select('leadsource', $source, null, ['class' => 'form-control']) !!}
                                <span class="focus-input100"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('status', 'Status*', ['class' => 'label-color py-2']) !!}
                                {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
                                <span class="focus-input100"></span>
                            </div>
                        </div>

                    </div>

                    <div class="row m-0 mb-0">

                    <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('gst_number', 'GST Number', ['class' => 'label-color py-2']) !!}
                                {!! Form::text('gst_number', null, ['class' => 'form-control', 'placeholder' => 'Enter Your gst number']) !!}
                                <span class="focus-input100"></span>
                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="validate-input m-b-23 mb-2">
                                {!! Form::label('regis', 'Assign To*', ['class' => 'label-color py-2']) !!}
                                {!! Form::select('assignedto', $regis, null, ['class' => 'form-control']) !!}
                                <span class="focus-input100"></span>
                            </div>
                        </div>
                    </div>


                    <div class="text-end">
                    <label class="err_lbl"></label><br>
                    <div class="btn-g2">
                    <div></div> <div></div>
                        <button type="submit" class="frm-btn pri-text-color" role="button"> Add </button>
                        <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>