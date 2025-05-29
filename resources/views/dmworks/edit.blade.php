<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit DM Works</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($dmworks, ['route' => ['dmworks.update', $dmworks->id], 'method' => 'PUT']) !!}
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
                        {!! Form::hidden('domainname', $dmworks->domainname, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('name', 'Name *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('name', $dmworks->name, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('type', 'Type *', ['class' => 'label-color py-2']) !!}
                        <select name="type" class="form-select">
                            <option value="0" {{ $dmworks->type == '0' ? 'selected' : '' }}>Select Type</option>
                            <option value="Promotion Dashboard" {{ $dmworks->type == 'Promotion Dashboard' ? 'selected' : '' }}>Promotion Dashboard</option>
                            <option value="Monthly Report" {{ $dmworks->type == 'Monthly Report' ? 'selected' : '' }}>Monthly Report</option>
                            <option value="Audit Report" {{ $dmworks->type == 'Audit Report' ? 'selected' : '' }}>Audit Report</option>
                            <option value="MR Report" {{ $dmworks->type == 'MR Report' ? 'selected' : '' }}>MR Report</option>
                            <option value="Meta Leads" {{ $dmworks->type == 'Meta Leads' ? 'selected' : '' }}>Meta Leads</option>
                            <option value="LinkedIn Leads" {{ $dmworks->type == 'LinkedIn Leads' ? 'selected' : '' }}>LinkedIn Leads</option>
                            <option value="Minutes of Meeting" {{ $dmworks->type == 'Minutes of Meeting' ? 'selected' : '' }}>Minutes of Meeting</option>
                            <option value="Others" {{ $dmworks->type == 'Others' ? 'selected' : '' }}>Others</option>
                        </select>
                    </div>
                </div>
                
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('url', 'URL *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('url', $dmworks->url, ['class' => 'form-control', 'required']) !!}
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