<style>
    .select2-container {
    z-index: 99999 !important; /* Higher than Bootstrap modal */
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 1px;
    right: 1px;
    width: 20px;
    padding-top: 44px;
}
.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: none !important;
    border-radius: 4px;
    padding-top: 8px;
}
.select2-container .select2-selection--single
 {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 43px !important;
    user-select: none;
    -webkit-user-select: none;
}
</style>
<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add DM Works</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['dmworks.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2 '] ) !!}
                        <select name="company_name" class="form-select select2" id="company_nameid" onchange="categorynameone(this.value)">
                            <option name="company_name" value="">Select</option>
                            @foreach($domainmaster as $master)
                            <option name="company_name" value="{{ $master->company_name }}">{{ $master->company_name_full }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('domainname', 'Domain Name*', ['class' => 'label-color py-2']) !!}
                        <select name="domainname" class="form-control" id="domainnameid" readonly>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('name', 'Name *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('type', 'Type *', ['class' => 'label-color py-2']) !!}
                        <select name="type" class="form-select">
                            <option value="0">Select Type</option>
                            <option value="Promotion Dashboard">Promotion Dashboard</option>
                            <option value="Monthly Report">Monthly Report</option>
                            <option value="Audit Report">Audit Report</option>
                            <option value="MR Report">MR Report</option>
                            <option value="Meta Leads">Meta Leads</option>
                            <option value="LinkedIn Leads">LinkedIn Leads</option>
                            <option value="Minutes of Meeting">Minutes of Meeting</option>  
                            <option value="Others">Others</option>  
                        </select>
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('url', 'URL *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('url', null, ['class' => 'form-control', 'required']) !!}
                        <span class="focus-input100"></span>
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center ">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
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