<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Task</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['task.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('empid', 'Employee*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('empid', $regis, null, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('task_name', 'Task Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('task_name', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('payamount', 'Priority*', ['class' => 'label-color py-2']) !!}
                        <select name="priority" class="span12 form-control" required>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('task_startdate', 'Task Assign Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('task_startdate', date('Y-m-d', time()), ['class' => 'form-control', 'id'=>'pi']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('task_duedate', 'Due Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('task_duedate', null, ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('task_description', 'Task Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('task_description', null, ['class' => 'form-control', 'rows'=> '2'] ) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mail_cc', 'Mark a CC Mail to', ['class' => 'label-color py-2']) !!} 
                        {!! Form::select('mail_cc[]', $assign, null, ['class' => 'form-select', 'required' => true,'multiple' => true,]) !!}
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
      </script>