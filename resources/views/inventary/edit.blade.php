<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Asset</h4>
        </div>

        <div class="modal-body mb-0">
            {!! Form::model($asset, ['route' => ['inventary.update', $asset->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('ventor_name', 'Vendor Name*', ['class' => 'label-color py-2 '] ) !!}
                        {!! Form::select('vendor_id', $vendor, $asset->vendor_id, ['class' => 'form-select select2']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('title', $asset->title, ['class' => 'form-control','required' => true, 'placeholder'=>'Title']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('date', 'Date*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::date('date', $asset->date, ['class' => 'form-control','required' => true]) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('taxable_value', 'Taxable Value*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::number('taxable_value', null, ['class' => 'form-control','required' => true, 'placeholder'=>'Taxable Value']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('total_invoice_value', 'Total Invoice Value*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::number('total_invoice_value', $asset->total_invoice_value, ['class' => 'form-control','required' => true, 'placeholder'=>'Total Invoice Value']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('file', 'Document * (File Size Maximum: 1MB)', ['class' => 'label-color py-2']) !!}
                        {!! Form::file('file', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('description', 'Description*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::textarea('description', $asset->description, ['class' => 'form-control','required' => true, 'placeholder'=>'Description', 'id' => 'description']) !!}
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