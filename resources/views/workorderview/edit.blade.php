<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Work Order</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($work_order, ['route' => ['workorderview.update', $work_order->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('id', $accounts, $work_order->company_id, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('department', 'Department*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('department', $department, $work_order->dept_id, ['class' => 'form-select', 'required' => true, 'id' => 'department', 'onchange' => 'getworkerid(this.value)']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('assigned_to', 'Assigned To', ['class' => 'label-color py-2']) !!}

                        @if(count($reg)>0)
                        @foreach($reg as $regi)
                        <div>
                            {{$regi}}
                        </div>
                        @endforeach
                        @endif

                        (OR)
                        <div id=work_id></div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('working_hours', 'Working Hours', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('working_hours', $work_order->working_hours, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dead_line', 'End Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dead_line', date('Y-m-d', strtotime($work_order->dead_line)), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('working_day', 'Number of Working days', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('working_day', $work_order->working_day, ['class' => 'form-control','readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Project Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', $work_order->project_description, ['class' => 'form-control', 'rows'=> '2'] ) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('comments', 'Comments', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('comments', $work_order->comments, ['class' => 'form-control', 'rows'=> '2'] ) !!}
                    </div>
                </div>
            </div>

            @if(request()->session()->get('role')=='superadmin')
            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('status', 'Approval Status', ['class' => 'label-color py-2']) !!}
                        <select class="form-select" name="status">
                            <option value="0">Approve</option>
                            <option value="2">Reject</option>
                        </select>
                    </div>
                </div>
            </div>
            @endif




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