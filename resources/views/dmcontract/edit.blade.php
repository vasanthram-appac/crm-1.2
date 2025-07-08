<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit DM Contract</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($dmcontract, ['route' => ['dmcontract.update', $dmcontract->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('companyid', $accounts->id) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('companynameval', 'Client Name*', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('companynameval', $accounts->company_name, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('domainnamevalue', $domainmaster->domainname, ['class' => 'form-control', 'readonly']) !!}
                    {!! Form::hidden('domainname', $dmcontract->domainname) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('numberofmonth', 'Number of Month *', ['class' => 'label-color py-2']) !!}
                    {!! Form::select('numberofmonth', [
                    '' => 'Select Month',
                    '1 Month' => '1 Month',
                    '3 Month' => '3 Month',
                    '6 Month' => '6 Month',
                    '9 Month' => '9 Month',
                    '12 Month' => '12 Month'
                    ], $dmcontract->numberofmonth, ['class' => 'form-select', 'required' => true]) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('promotion_status', 'Promotion Type*', ['class' => 'label-color py-2'] ) !!}

                    {!! Form::select('promotion_status', [
                    '' => 'Select From List',
                    'Organic' => 'Organic',
                    'Paid' => 'Paid',
                    'Social Media' => 'Social Media',
                    'Organic/paid' => 'Organic/paid',
                    'Retainer' => 'Retainer'
                    ], $dmcontract->promotion_status, ['class' => 'form-select', 'required' => true])
                    !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofregis', 'SEO Started On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('dateofregis', $dmcontract->dateofregis, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofrenewal', 'SEO Last Renewed On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('', $dmcontract->dateofrenewal, ['class' => 'form-control', 'readonly']) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofexpire', 'SEO Expires On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('', $dmcontract->dateofexpire, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofrenewal', 'SEO Current Renewal', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('dateofrenewal', null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofexpire', 'SEO Next Expires On', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('dateofexpire', null, ['class' => 'form-control']) !!}
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('managed_by', 'Managed By*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('managed_by', $names, $dmcontract->managed_by, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

            </div>


            <div class="text-center">
                <label class="err_lbl"></label><br>
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> Update
                </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                    <i class="fa fa-times"></i> Cancel
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>