<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Domain</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($domain, ['route' => ['domain.update', $domain->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('companyid', $accounts->id, ['class' => 'input100 custoname border-0']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('companynameval', 'Client Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('companynameval', $accounts->company_name, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('domainnamevalue', $domainmaster->domainname, ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::hidden('domainname', $domain->domainname, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofregis', 'Domain Created On', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('', $domain->dateofregis, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofrenewal', 'Domain Last Renewed On', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('', $domain->dateofrenewal, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofexpirevalue', 'Domain Expires On', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('', $domain->dateofexpire, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofrenewal', 'Domain Current Renewal', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dateofrenewal', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofexpire', 'Domain Next Expires On', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dateofexpire', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_source', 'Domain Source *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_source', ['' => 'Select From List', 'aws' => 'AWS', 'quadra' => 'Quadra', 'godaddy' => 'Godaddy', 'godaddyreseller' => 'Godaddy Reseller', 'bluehost' => 'Blue Host', 'other' => 'Other', 'reseller' => 'Reseller'], $domain->domain_source, ['class' => 'form-select', 'required']) !!}
                       
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_manager', 'Domain Managed by *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_manager', [
                        '' => 'Select From List',
                        'own' => 'Appac',
                        'client' => 'Client',
                        'thirdparty' => 'Third Party'
                        ], $domain->domain_manager, ['class' => 'form-select', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_privacy', 'Domain Privacy Occured *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_privacy', [
                        '' => 'Select From List',
                        'yes' => 'Yes',
                        'no' => 'No'
                        ], $domain->domain_privacy, ['class' => 'form-select', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>



            <!-- Repeat the above block for other fields like email, password, mobile, etc. -->

            <!-- Add a submit button -->
            <br>
            <div class="text-end">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                <div></div> <div></div>
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