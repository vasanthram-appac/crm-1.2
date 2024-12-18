<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Hosting</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($hosting, ['route' => ['hosting.update', $hosting->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('companyid', $accounts->id, ['class' => 'form-control']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('companynameval', 'Client Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('companynameval', $accounts->company_name, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('domainnamevalue', $domainmaster->domainname, ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::hidden('domainname', $hosting->domainname, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dateofregis', 'Website Hosted on', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('', $hosting->dateofregis, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dateofexpire', 'Website Hosting Expires on', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('', $hosting->dateofexpire, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('renewaldate', 'Current Renewal Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('renewaldate', null, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('domain_source', 'Domain Source *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_source', [
                            '' => 'Select From List',
                            '1' => '1 Month',
                            '3' => '3 Months',
                            '6' => '6 Months',
                            '9' => '9 Months',
                            '12' => '12 Months',
                            '15' => '15 Months',
                            '18' => '18 Months',
                            '24' => '24 Months',
                            '36' => '36 Months'
                        ], $hosting->hostingperiod, ['class' => 'form-select', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center ">
                <label class="err_lbl"></label><br>
				<div class="btn-g2">
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                     Update
                </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                     Cancel
                </button>
				</div>
            </div>
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    <!--/.Content-->
</div>
