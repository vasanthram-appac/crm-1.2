<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Petty Cash</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::model($pettycash, ['route' => ['pettycash.update', $pettycash->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paidto', 'Paid To *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('paidto', $pettycash->paidto, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('amount', 'Amount *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('amount', $pettycash->amount, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('date', 'Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('date', $pettycash->date, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                 <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paymentmode', 'Payment Mode *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('paymentmode', ['' => 'Select', 'Cash' => 'Cash', 'Online' => 'Online'], $pettycash->paymentmode, ['class' => 'form-select', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('type', 'Type *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('type', ['' => 'Select', 'Debit' => 'Debit', 'Credit' => 'Credit'], $pettycash->type, ['class' => 'form-select', 'required', 'onchange' => 'toggleCreditBy()']) !!}
                    </div>
                </div>

                 <div class="col-lg-6 col-sm-12" id="showcredit">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('creditby', 'Credit By *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('creditby', ['' => 'Select', 'AM001' => 'Balakrishnan', 'AM003' => 'Mohan', 'AM045' => 'Rohindh'], $pettycash->creditby, ['class' => 'form-select']) !!}
                    </div>
                </div>


                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('description', 'Description', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('description', $pettycash->description, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
            </div>

            <!-- Add a submit button -->
            <br>
            <div class="text-center ">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                        Update
                    </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                        Cancel
                    </button>
                </div>
            </div>
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    <!--/.Content-->
</div>

<script>
let pettyType = @json($pettycash->type ?? '');

function toggleCreditBy() {
    if ($('select[name="type"]').val() == 'Credit') {
        $('#showcredit').show();
    } else {
        $('#showcredit').hide();
    }
}

$(document).ready(function () {   
  

     if (pettyType == 'Credit') {
        $('#showcredit').show();
    }else {
        $('#showcredit').hide();
    }

});
</script>