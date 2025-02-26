<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Work Order</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['workorderview.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('id', $accounts, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('department', 'Department*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('department', $department, null, ['class' => 'form-select', 'required' => true, 'id' => 'department', 'onchange' => 'getworkerid(this.value)']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('assigned_to', 'Assigned To', ['class' => 'label-color py-2']) !!}
                        <div id=work_id></div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('working_hours', 'Working Hours*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('working_hours', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

            <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('startdate', 'Start Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('startdate', date('d-m-Y', time()), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>

            

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dead_line', 'End Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dead_line', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Project Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', null, ['class' => 'form-control', 'rows'=> '2'] ) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                    {!! Form::label('comments', 'Comments', ['class' => 'label-color py-2']) !!}
                    {!! Form::textarea('comments', null, ['class' => 'form-control', 'rows'=> '2'] ) !!}
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

<script language="javascript" type="text/javascript">
         $(function() {
             $.configureBoxes();
         });
		 $('.select2').select2(); 
   
    function getworkerid(val) {
        var a = val;
        var sel_text = $("#company_nameid option:selected").text();

        $.ajax({
            type: "POST",
            cache: false,
            url: "/getempid",
            data: {
                avalue: a,
                names: sel_text,
                type:'emp',
                _token: "{{ csrf_token() }}" // CSRF token for Laravel
            },
            success: function(data) {
                // Populate the 'domainnameid' dropdown with the received options
                $("#work_id").html(data);
            }
        });
    }
</script>