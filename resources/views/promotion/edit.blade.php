<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Promotion</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($promotionWip, ['route' => ['promotion.update', $promotionWip->pid], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $accounts, $promotionWip->client_id, ['class' => 'form-select', 'required' => true]) !!} </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('promotion_person', 'Promotion Person *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('promotion_person', $promotion, $promotionWip->promotion_person, ['class' => 'form-select', 'required' => true]) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('promotion_status', 'Promotion Type *', ['class' => 'label-color py-2']) !!}
                        <select class="form-select" name="promotion_status" required>
                            <option value="">Select From List</option>
                            <option value="Organic" @if($promotionWip->promotion_status == 'Organic') selected @endif>Organic</option>
                            <option value="Paid" @if($promotionWip->promotion_status == 'Paid') selected @endif>Paid</option>
                            <option value="Organic/Paid" @if($promotionWip->promotion_status == 'Organic/Paid') selected @endif>Organic/Paid</option>
                            <option value="Social Media" @if($promotionWip->promotion_status == 'Social Media') selected @endif>Social Media</option>
                            <option value="Retainer" @if($promotionWip->promotion_status == 'Retainer') selected @endif>Retainer</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('start_date', 'Start Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('start_date', date('Y-m-d',strtotime($promotionWip->start_date)), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('end_date', 'End Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('end_date', date('Y-m-d',strtotime($promotionWip->enddate)), ['class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">

                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('client_coordinate', 'Contract Period *', ['class' => 'label-color py-2']) !!}
                        <select class="span6 form-select select2" name="contract" required id="my_select">
                            <option value="">Select</option>
                            <option value="1" @if($promotionWip->contract == 1) selected @endif>1 Month</option>
                            <option value="3" @if($promotionWip->contract == 3) selected @endif>3 Months</option>
                            <option value="6" @if($promotionWip->contract == 6) selected @endif>6 Months</option>
                            <option value="9" @if($promotionWip->contract == 9) selected @endif>9 Months</option>
                            <option value="12" @if($promotionWip->contract == 12) selected @endif>12 Months</option>
                        </select>

                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('files', 'Attachment', ['class' => 'label-color py-2']) !!}
                        {!! Form::file('files[]', ['class' => 'span6', 'accept' => '.xlsx,.xls,.doc,.docx', 'multiple' => 'multiple']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('project_description', 'Project Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('project_description', $promotionWip->project_description, ['class' => 'form-control','rows'=>2]) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">

                    <div class="col-lg-6 col-sm-12">
                        <div class="alidate-input m-b-23 mb-2">
                            {!! Form::label('mail_cc', 'Mark a CC Mail to *', ['class' => 'label-color py-2']) !!}

                            @if(isset($reg) && is_countable($reg) && count($reg) > 0)
                            @foreach($reg as $regi)
                            <div>
                                {{$regi}}
                            </div>
                            @endforeach
                            @endif

                            {!! Form::select('mail_cc[]', $mail, null, ['class' => 'form-select select2', 'multiple' => true]) !!}
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