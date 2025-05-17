<style>
    .wrap-input100 {
        position: relative;
    }
</style>
<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Domain</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['domain.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        <select name="company_name" class="form-select" id="company_nameid" onchange="categorynameone(this.value)">
                            <option name="company_name" value="">Select</option>
                            @foreach($domainmaster as $master)
                            <option name="company_name" value="{{ $master->company_name }}">{{ $master->company_name_full }}</option>
                            @endforeach
                        </select>
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                        <select name="domainname" class="form-select" id="domainnameid" readonly>
                        </select>
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofregis', 'Date of Creation *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dateofregis', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofrenewal', 'Date of Renewal *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dateofrenewal', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('dateofexpire', 'Date of Expiry *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dateofexpire', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_source', 'Domain Source *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_source', ['' => 'Select From List', 'aws' => 'AWS', 'quadra' => 'Quadra', 'godaddy' => 'Godaddy', 'godaddyreseller' => 'Godaddy Reseller', 'bluehost' => 'Blue Host', 'other' => 'Other', 'reseller' => 'Reseller'], null, ['class' => 'form-select', 'required']) !!}
                       <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_manager', 'Domain Managed by *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_manager', ['' => 'Select From List', 'own' => 'Appac', 'client' => 'Client', 'thirdparty' => 'Third Party'], null, ['class' => 'form-select', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('domain_privacy', 'Domain Privacy Occured *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('domain_privacy', ['' => 'Select From List', 'yes' => 'Yes', 'no' => 'No'], null, ['class' => 'form-select', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                <div></div> <div></div>
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Add </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>


<script>
    function categorynameone(val) {
        var a = val;
        var sel_text = $("#company_nameid option:selected").text();

        $.ajax({
            type: "POST",
            cache: false,
            url: "/websitelistload",
            data: {
                avalue: a,
                names: sel_text,
                _token: "{{ csrf_token() }}" // CSRF token for Laravel
            },
            success: function(data) {
                // Populate the 'domainnameid' dropdown with the received options
                $("#domainnameid").html(data);
            }
        });
    }
</script>