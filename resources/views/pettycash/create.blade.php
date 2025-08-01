<style>
    .select2-container {
        z-index: 99999 !important;
        /* Higher than Bootstrap modal */
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

    .select2-container .select2-selection--single {
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
            <h4 class="title">Add Petty Cash</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['pettycash.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paidto', 'Paid To *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('paidto', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('amount', 'Amount *', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('amount', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('date', 'Date *', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paymentmode', 'Payment Mode *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('paymentmode', ['' => 'Select', 'Cash' => 'Cash', 'Online' => 'Online'], null, ['class' => 'form-select', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('type', 'Type *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('type', ['' => 'Select', 'Debit' => 'Debit', 'Credit' => 'Credit'], null, ['class' => 'form-select', 'required', 'onchange' => 'toggleCreditBy()']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12" id="showcredit">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('creditby', 'Credit By *', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('creditby', ['' => 'Select', 'AM001' => 'Balakrishnan', 'AM003' => 'Mohan', 'AM045' => 'Rohindh'], null, ['class' => 'form-select']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('description', 'Description *', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('description', null, ['class' => 'form-control', 'required']) !!}
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
<script>
  function toggleCreditBy() {

    if ($('select[name="type"]').val() == 'Credit') {
        $('#showcredit').show();
    } else {
        $('#showcredit').hide();
    }
}

$(document).ready(function () {
    toggleCreditBy();

});

</script>