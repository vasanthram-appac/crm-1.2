<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Social Login</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($sociallogin, ['route' => ['sociallogin.update', $sociallogin->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, $sociallogin->clientid, ['class' => 'form-select', 'required' => true]) !!} </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('title', 'Title*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('title', $sociallogin->title, ['class' => 'form-control','required' => true, 'placeholder'=>'Title']) !!}
                    </div>
                </div>


            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('url', 'URL*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('url', $sociallogin->url, ['class' => 'form-control','required' => true, 'placeholder'=>'URL']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('username', 'User Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('username', $sociallogin->username, ['class' => 'form-control','required' => true, 'placeholder'=>'User Name']) !!}
                    </div>
                </div>


            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('password', 'Password*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('password', $sociallogin->password, ['class' => 'form-control','required' => true, 'placeholder'=>'Password']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('managedby', 'Managedby', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('managedby', $sociallogin->managedby, ['class' => 'form-control', 'placeholder'=>'Managedby']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('createdby', 'Createdby', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('createdby', $sociallogin->createdby, ['class' => 'form-control', 'placeholder'=>'Createdby']) !!}
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