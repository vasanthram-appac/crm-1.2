<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Required Input</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($requiredinput, ['route' => ['required_input.update', $requiredinput->id], 'method' => 'PUT']) !!}
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
                        {!! Form::hidden('domainname', $requiredinput->domainname, ['class' => 'form-control', 'readonly']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('name', 'Name *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('name', $requiredinput->name, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('file', 'Document * (File Size Maximum: 1MB)', ['class' => 'label-color py-2']) !!}
                        {!! Form::file('file', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                    <a href="{{ $requiredinput->file }}" target="blank" style="text-decoration:none;">View</a>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('type', 'Type *', ['class' => 'label-color py-2']) !!}
                        <select name="type" id="" class="form-select">
                            <option value="">Select Type</option>
                            <option value="Development" @if($requiredinput->type == "Development") selected @endif>Development</option>
                            <option value="Design" @if($requiredinput->type == "Design") selected @endif>Design</option>
                            <option value="Promotion" @if($requiredinput->type == "Promotion") selected @endif>Promotion</option>
                            <option value="Business" @if($requiredinput->type == "Business") selected @endif>Business</option>
                            <option value="Others" @if($requiredinput->type == "Others") selected @endif>Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('worktype', 'Work Type *', ['class' => 'label-color py-2']) !!}
                        <select name="worktype" id="" class="form-select">
                            <option value="">Select Type</option>
                            <option value="Client" @if($requiredinput->worktype == "Client") selected @endif>Client</option>
                            <option value="Appac" @if($requiredinput->worktype == "Appac") selected @endif>Appac</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('description', 'Description *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('description', $requiredinput->description, ['class' => 'form-control']) !!}
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