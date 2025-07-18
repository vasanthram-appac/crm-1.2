<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Payment</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['vendorpaymententry.store'], 'method' => 'Post']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Vendor Name*', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::select('company_name', $vendor, null, ['class' => 'form-select', 'id' => 'company_name', 'required' => true]) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paydate', 'Date*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('paydate', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('paymentmode', 'Promotion Type*', ['class' => 'label-color py-2'] ) !!}
                        <select class="form-select" name="paymentmode" id="pm" required>
                            <option value="0">select</option>
                            <option value="1">NEFT/RTGS No</option>
                            <option value="2">Cheque</option>
                            <option value="3">Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('payamount', 'Amount*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('payamount', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('porder', 'Purchase Order', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('porder[]', $purchase, null, ['class' => 'select2 input100 custoname border-0', 'onchange' => 'product()', 'multiple' => true, 'id'=>'pi']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0" id="chq" style="display:none;">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('bankname', 'Bank Name', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('bankname', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('chequeno', 'Cheque No', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('chequeno', null, ['class' => 'form-control']) !!}
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
                        {!! Form::text('neftnumber', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('productservice', 'Product/Service', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('productservice', null, ['class' => 'form-control', 'id' > 'productservice']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('comment', 'Comments', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('comment', null, ['class' => 'form-control']) !!}
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            dropdownParent: $('.customer_modal'),
            width: '100%'
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
    $('#pm').on('change', function() {
        //  alert( this.value ); // or $(this).val()
        if (this.value == "1") {
            $('#neft').show();
            $('#chq').hide();
            $("#pi").attr('required', true);
        } else if (this.value == "2") {
            $('#neft').hide();
            $('#chq').show();
            $("#pi").attr('required', true);
        } else {
            $('#neft').hide();
            $('#chq').hide();
            $("#pi").attr('required', false);
        }
    });
</script>