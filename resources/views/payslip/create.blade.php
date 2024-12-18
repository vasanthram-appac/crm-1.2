<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Send Payslip</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['payslip.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('empid', 'Employee*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('empid', $emp, null, ['class' => 'form-select', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('monthyear', 'Month & Year*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select(
                        'monthyear',
                        collect(range(6, 0))->mapWithKeys(function ($x) {
                        $dateKey = date('m-Y', strtotime(date('Y-m') . " -$x month"));
                        $dateValue = date('M-Y', strtotime(date('Y-m') . " -$x month"));
                        return [$dateKey => $dateValue];
                        }),
                        null,
                        ['class' => 'form-select', 'required' => true]
                        ) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('incentive', 'Incentive', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('incentive', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('lop', 'Lop', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lop', null, ['class' => 'form-control']) !!}

                    </div>
                </div>

            </div>


            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('other', 'Other Deductions', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('other', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('totalleave', 'Total Leaves', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('totalleave', null, ['class' => 'form-control']) !!}

                    </div>
                </div>

            </div>



            <!-- Add a submit button -->
            <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Submit </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"><i class="fa fa-times"></i> Cancel </button>
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