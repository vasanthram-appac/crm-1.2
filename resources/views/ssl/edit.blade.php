<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit SSL</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($ssl, ['route' => ['ssl.update', $ssl->id], 'method' => 'PUT']) !!}
            {!! Form::hidden('companyid', $accounts->id) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('companynameval', 'Client Name*', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('companynameval', $accounts->company_name, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('domainnamevalue', $domainmaster->domainname, ['class' => 'form-control', 'readonly']) !!}
                    {!! Form::hidden('domainname', $ssl->domainname) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofregis', 'SSL Installed On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('dateofregis', $ssl->dateofregis, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofrenewal', 'SSL Last Renewed On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('dateofrenewal', $ssl->dateofrenewal, ['class' => 'form-control', 'readonly']) !!}
                </div>
             
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofexpire', 'SSL Certificate Expires On', ['class' => 'label-color py-2']) !!}
                    {!! Form::text('', $ssl->dateofexpire, ['class' => 'form-control', 'readonly']) !!}
                </div>

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofrenewal', 'SSL Current Renewal', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('dateofrenewal', null, ['class' => 'form-control']) !!}
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12 mb-2">
                    {!! Form::label('dateofexpire', 'SSL Next Expires On', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('dateofexpire', null, ['class' => 'form-control']) !!}
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
