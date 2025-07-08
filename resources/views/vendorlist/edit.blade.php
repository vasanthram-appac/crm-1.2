<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class=" modal-header m-0">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Vendor List</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::model($vendorlist, ['route' => ['vendorlist.update', $vendorlist->id], 'method' => 'PUT']) !!}

            <div class="row m-0">
                <div class="col-lg-6 col-sm-12">
                    <div class=" validate-input m-b-23 mb-2">
                        {!! Form::label('account', 'Company Name*', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('account', $vendorlist->company_name, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('title', $vendorlist->title, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0">
                <div class="col-lg-6 col-sm-12">
                    <div class=" validate-input m-b-23 mb-2">
                        {!! Form::label('firstname', 'First Name*', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('firstname', $vendorlist->firstname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('lastname', 'Last Name*', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('lastname', $vendorlist->lastname, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('gst_number', 'GST Number', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('gst_number', $vendorlist->gst_number, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('stdcode', 'STD Code', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('stdcode', $vendorlist->stdcode, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>

                    </div>
                </div>

            </div>

            <div class="row m-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Phone', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::text('phone', $vendorlist->phone, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternate_phone', 'Alternate Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('alternate_phone', $vendorlist->alternate_phone, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

            </div>

            <div class="row m-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('emailid', 'Email Id', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::email('emailid', $vendorlist->emailid, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('alternateemail', 'Alternate Email Id', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('alternateemail', $vendorlist->alternateemail, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('address', 'Address', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('address', $vendorlist->address, ['class' => 'form-control', 'rows' => 5, 'style' => 'resize:none;']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('city', 'City', ['class' => 'label-color py-2 ']) !!}
                    {!! Form::text('city', $vendorlist->city, ['class' => 'form-control']) !!}
                    <span class="focus-input100"></span>
                </div>
            </div>

            <div class="row m-0 ">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('state', 'State', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::select('state', $state, $vendorlist->state, ['class' => 'form-control', 'placeholder' => 'State']) !!}

                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('pincode', 'Pincode', ['class' => 'label-color py-2 ']) !!}
                    {!! Form::number('pincode', $vendorlist->pincode, ['class' => 'form-control']) !!}
                    <span class="focus-input100"></span>
                </div>
            </div>

            <div class="row m-0 ">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('country', 'Country', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('country', $country->pluck('name', 'name')->toArray(), $country, ['class' => 'form-control']) !!}
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
                        {!! Form::select('shipping_title', ['Mr' => 'Mr', 'Ms' => 'Ms', 'Mrs' => 'Mrs', 'Prof' => 'Prof', 'Dr' => 'Dr'], $vendorlist->shipping_title, ['class' => 'form-control', 'placeholder' => 'Choose a Category']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_firstname', 'Shipping First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_firstname', $vendorlist->shipping_firstname, ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_lastname', 'Shipping Last Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_lastname', $vendorlist->shipping_lastname, ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_phone', 'Shipping Phone*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_phone', $vendorlist->shipping_phone, ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'maxlength' => '10', 'onkeypress' => 'return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))']) !!}

                            </div>
                    </div>
                </div>

                <div class="row m-0 mb-0">

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_address', 'Shipping Address', ['class' => 'label-color py-2']) !!}
                            {!! Form::textarea('shipping_address', $vendorlist->shipping_address, ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter your Address', 'style' => 'resize:none;']) !!}

                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_city', 'Shipping City', ['class' => 'label-color py-2']) !!}
                            {!! Form::text('shipping_city', $vendorlist->shipping_city, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="row m-0 mb-0">

                    <div class="col-lg-6 col-sm-12">
                        <div class="validate-input m-b-23 mb-2">
                            {!! Form::label('shipping_state', 'Shipping State', ['class' => 'label-color py-2']) !!}
                            {!! Form::select('shipping_state', $state, $vendorlist->shipping_state, ['class' => 'form-control', 'placeholder' => 'State']) !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('shipping_pincode', 'Shipping Pincode', ['class' => 'label-color py-2 ']) !!}
                        {!! Form::number('shipping_pincode', $vendorlist->shipping_pincode, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>

                </div>

                <div class="row m-0 ">

                    <div class="col-lg-6 col-sm-12">
                        {!! Form::label('summary', 'Summary*', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('summary', $vendorlist->summary, ['class' => 'form-control', 'rows' => 5, 'style' => 'resize:none;']) !!}
                        <span class="focus-input100"></span>
                    </div>

                  <div class="col-lg-6 col-sm-12">
                    {!! Form::label('status', 'Status*', ['class' => 'label-color py-2']) !!}

                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            {!! Form::radio('status', 'Active', $vendorlist->status == 'Active', ['id' => 'activeRadio1', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('activeRadio1', 'Active', ['class' => 'label-color']) !!}
                        </div>

                        <div class="form-check form-check-inline">
                            {!! Form::radio('status', 'Inactive', $vendorlist->status == 'Inactive', ['id' => 'inactiveRadio2', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('inactiveRadio2', 'Inactive', ['class' => 'label-color']) !!}
                        </div>
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