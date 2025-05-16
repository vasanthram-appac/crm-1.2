<style>
    .select2-container {
        z-index: 99999 !important;
        /* Higher than Bootstrap modal */
    }

    .select2-container--default .select2-selection--multiple {
        border: 0 !important;
        padding-bottom: 0.6rem !important;
        padding-top: 0.25rem !important;
    }
</style>

<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit New NBD</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($newnbd, ['route' => ['newnbd.update', $newnbd->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('name', 'Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('name', $newnbd->name, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('email', 'Email ID*', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('email', $newnbd->email, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mobile', 'Mobile*', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('mobile', $newnbd->mobile, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('company_name', $newnbd->company_name, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('source', 'Source*', ['class' => 'label-color py-2']) !!}
                        <select name="source" class="span12 form-control" required>
                            <option value="Meta" @if($newnbd->source == "Meta") selected @endif>Meta</option>
                            <option value="Google" @if($newnbd->source == "Google") selected @endif>Google</option>
                            <option value="Incoming" @if($newnbd->source == "Incoming") selected @endif>Incoming</option>
                            <option value="Walkin" @if($newnbd->source == "Walkin") selected @endif>Walkin</option>
                            <option value="Referral" @if($newnbd->source == "Referral") selected @endif>Referral</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('url', 'URL ', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('url', $newnbd->url, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('description', 'Description ', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('description', $newnbd->description, ['class' => 'form-control']) !!}
                        <span class="focus-input100"></span>
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


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('.customer_modal'), // Ensures dropdown stays inside the modal
            width: '100%' // Makes the select box full width
        });
    });
</script>