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
            <h4 class="title">Task Check And Complete</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($task, ['route' => ['taskview.update', $task->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('design_checking',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('design_checking', 'Design Checking', ['class' => 'label-color py-2'] ) !!}
                        
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('spelling_check',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('spelling_check', 'Spelling Check', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('space_symbols_checking',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('space_symbols_checking', 'Space Symbols Checking', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('overall_content_checking',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;'] ) !!}
                        {!! Form::label('overall_content_checking', 'Overall Content Checking', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('cta_checking',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('cta_checking', 'CTA Checking', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('overall_letter_alighment',  'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;'] ) !!}
                        {!! Form::label('overall_letter_alighment', 'Overall Letter Alighment', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('logo_checking', 'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('logo_checking', 'Logo Checking', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>

                  <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::checkbox('title_case', 'OK', false, ['class' => 'form-check-input mx-2', 'style' => 'margin-top: 0.75rem !important;']) !!}
                        {!! Form::label('title_case', 'Title Case', ['class' => 'label-color py-2']) !!}
                    </div>
                </div>
            </div>

               <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('remark', 'Remarks', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('remark', null, ['class' => 'form-control', 'rows' => 2]) !!}
                    </div>
                </div>

                @if($task->empid == $empid)
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('status', 'Status *', ['class' => 'label-color py-2']) !!}
                        <select class="form-select" name="status">
                            <option value="">Select</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                @endif
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('.customer_modal'), // Ensures dropdown stays inside the modal
            width: '100%' // Makes the select box full width
        });
    });