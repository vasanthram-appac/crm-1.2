<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Payment</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($payment, ['route' => ['vendorpaymententry.update', $payment->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Client Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $vendorlist, $payment->cname, ['class' => 'form-select', 'id' => 'company_name', 'required' => true]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paydate', 'Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('paydate', $payment->paydate, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paymentmode', 'Promotion Type*', ['class' => 'label-color py-2'] ) !!}
                        <select class="form-select" name="paymentmode" id="pm" required>
                            <option value="0" @if($payment->paymentmode==0) selected @endif>select</option>
                            <option value="1" @if($payment->paymentmode==1) selected @endif>NEFT/RTGS No</option>
                            <option value="2" @if($payment->paymentmode==2) selected @endif>Cheque</option>
                            <option value="3" @if($payment->paymentmode==3) selected @endif>Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('payamount', 'Amount*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('payamount', $payment->payamount, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('porder', 'Purchase Order', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('porder[]', $purchase->toArray(), $pii, ['class' => 'select2 input100 custoname border-0', 'onchange' => 'product()', 'multiple' => true, 'id'=>'pi']) !!}
                    </div> 
                </div>
            </div>

            <div class="row m-0 mb-0" id="chq" style="display:none;">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('bankname', 'Bank Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('bankname', $payment->bankname, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('chequeno', 'Cheque No', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('chequeno', $payment->chequeno, ['class' => 'form-control']) !!}
                    </div>
                </div>

                 <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('document_upload', 'document', ['class' => 'label-color py-2']) !!}
                        {!! Form::file('document_upload', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0" id="neft" style="display:none;">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('neftnumber', 'NEFT/RTGS No', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('neftnumber', $payment->neftnumber, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="row m-0 mb-0">
                
            <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('productservice', 'Product/Service', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('productservice', $payment->productservice, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('comment', 'Comments', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('comment', $payment->comment, ['class' => 'form-control']) !!}
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({
        dropdownParent: $('.customer_modal'), // Ensures dropdown stays inside the modal
        width: '100%' // Makes the select box full width
    });
});

  $('#company_name').on('change', function() {
        var clientId = $(this).val();

        if (clientId != 0) {
            $.ajax({
                type: "POST",
                url: "{{ route('getpurchase') }}",
                data: {
                    company_id: clientId,
                    _token: "{{ csrf_token() }}"
                },
                success: function(data) {
                    // Corrected from data.purchase to data.porder
                    var $purchase = $("select[name='porder[]']");
                    $purchase.empty();

                    $.each(data.porder, function(key, value) {
                        $purchase.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });

                    // Re-initialize Select2
                    $purchase.trigger('change.select2');
                },
                error: function(xhr) {
                    console.error("Purchase fetch failed:", xhr.responseText);
                }
            });
        } else {
            $("select[name='porder[]']").empty().trigger('change.select2');
        }
    });

    function product() {

        pid = $("select[name='porder[]']").val();

        $.ajax({
            type: "POST",
            url: "/vendorpaymentproduct",
            data: {
                pid: pid,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {

                $("#productservice").val(data.paymentterms);
            },
            error: function(xhr) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    }

</script>

<script>
    const serverPaymentMode = "<?= $payment->paymentmode ?>";

$(document).ready(function() {
 
    if(serverPaymentMode == 1) {
    $('#neft').show();
    $('#chq').hide();
	$("#pi").attr('required', true);
  } else if(serverPaymentMode == 2) {
    $('#neft').hide();
    $('#chq').show();
	$("#pi").attr('required', true);
  }
  else{
	  $('#neft').hide();
    $('#chq').hide();
     $("#pi").attr('required', false);
  }
});

$('#pm').on('change', function() {
  //  alert( this.value ); // or $(this).val()
  if(this.value == "1") {
    $('#neft').show();
    $('#chq').hide();
	$("#pi").attr('required', true);
  } else if(this.value == "2") {
    $('#neft').hide();
    $('#chq').show();
	$("#pi").attr('required', true);
  }
  else{
	  $('#neft').hide();
    $('#chq').hide();
     $("#pi").attr('required', false);
  }
});
</script>