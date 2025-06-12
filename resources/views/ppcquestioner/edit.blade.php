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
            <h4 class="title">View PPC Questioner</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($ppcquestioner, ['route' => ['ppcquestioner.update', $ppcquestioner->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name ', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->company_name}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('target_products', 'Target Products', ['class' => 'label-color py-2']) !!}
                        <p class="text-block"> {{$ppcquestioner->target_products}}</p>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('target_locations', 'Target Locations', ['class' => 'label-color py-2']) !!}
                        <p class="text-block"> {{$ppcquestioner->target_locations}} </p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('target_audience', 'Target Audience', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->target_audience}}</p>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('target_products', 'Target Products', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->competitors}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('campaign_suggestions', 'Campaign Suggestions', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->campaign_suggestions}}</p>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('campaign_goal', 'Campaign Goal', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->campaign_goal}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('ppc_products', 'PPC Campaign', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->ppc_campaign}}</p>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('website', 'Website', ['class' => 'label-color py-2']) !!}
                        <a class="text-block" href="{{$ppcquestioner->website}}" target="blank">View</a>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('landing_page_URL', 'Landing Page URL', ['class' => 'label-color py-2']) !!}
                        <a class="text-block" href="{{$ppcquestioner->landing_page_URL}}" target="blank">View</a>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('user_name', 'User Name', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->user_name}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('password', 'Password', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->password}}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('customer_id', 'Customer ID', ['class' => 'label-color py-2']) !!}
                        <p class="text-block">{{$ppcquestioner->customer_id}}</p>
                    </div>
                </div>
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