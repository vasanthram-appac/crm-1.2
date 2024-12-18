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
            <h4 class="title">Add Proposal</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['webproposal.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company', 'Company Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::text('company', null, ['class' => 'form-control', 'required', 'placeholder'=>'Enter Company Name']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('city', 'City*', ['class' => 'label-color py-2'] ) !!}
                    {!! Form::text('city', null, ['class' => 'form-control', 'required', 'placeholder'=>'Enter City']) !!}
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('webcost', 'Web Development Cost *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('webcost', null, ['class' => 'form-control', 'required', 'placeholder'=>'Enter Web Development Cost']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('appointmentcost', 'Appointment Dashboard Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('appointmentcost', null, ['class' => 'form-control', 'placeholder'=>'Enter Appointment Dashboard Cost']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('hostcost', 'Website Hosting & Maintenance Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('hostcost', null, ['class' => 'form-control', 'placeholder'=>'Enter Website Hosting & Maintenance Cost']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('portalcost', 'Feedback Portal Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('portalcost', null, ['class' => 'form-control', 'placeholder'=>'Enter Feedback Portal Cost']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('sslcost', 'SSL Certificate Cost', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('sslcost', null, ['class' => 'form-control', 'placeholder'=>'Enter SSL Certificate Cost']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('admin_name', 'Proposal Sent By *', ['class' => 'label-color py-2']) !!}
                        <select class="admin_name form-select" name="admin_name" required>
                            <option value="" disabled selected>Select</option>
                            <option value="Bala Krishnan" >Bala Krishnan</option>
                            <option value="Deepak" >Deepak</option>
                            <option value="Melba" >Melba</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('date', 'Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <div></div>
                    <div></div>
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