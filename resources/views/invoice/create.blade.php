<style>
    .wrap-input100 {
        position: relative;
    }
</style>
<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Add Invoice</h4>
        </div>
        <!--Body-->

        <div class="modal-body mb-0">
            {!! Form::open(['route' => ['invoice.store'], 'method' => 'Post']) !!}

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Billing Address</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::hidden('company_id', $accounts->id , ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::text('company_name', $accounts->company_name , ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('address', 'Address', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('address', $accounts->address , ['class' => 'form-control', 'readonly', 'rows'=>4]) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('phone', 'Contact Person', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('phone', $accounts->phone, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('pincode', 'Pincode', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('pincode', $accounts->pincode, ['class' => 'form-control', 'readonly']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('contact_person', 'Contact Person', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('contact_person', $accounts->firstname . ' ' . $accounts->lastname, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                @if($accounts->city!='Dubai')
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('gst_number', 'GST Number', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('gst_number', $accounts->gst_number, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>
                @endif
            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Shipping Address</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('company_name', 'Company Name', ['class' => 'label-color py-2'] ) !!}
                        {!! Form::hidden('company_id', $accounts->id , ['class' => 'form-control', 'readonly']) !!}
                        {!! Form::text('company_name', $accounts->company_name , ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_address', 'Address', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('shipping_address', $accounts->shipping_address ?? $accounts->address , ['class' => 'form-control', 'readonly', 'rows'=>4]) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_phone', 'Shipping Phone', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_phone', $accounts->shipping_phone ?? $accounts->phone , ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('shipping_pincode', 'Shipping Pincode', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('shipping_pincode', $accounts->shipping_pincode ?? $accounts->pincode , ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Invoice Details</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('invoice_date', 'Key Notes', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('invoice_date', now()->format('d-m-Y'), ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('invoice_no', 'Reference No', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('invoice_no', $in_number, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>
            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Invoice Description</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover invoice-input">
                    <thead>
                        <tr>
                            <th class="thcenter">Item</th>
                            <th class="thcenter">Description</th>
                            <th class="thcenter">Quantity</th>
                            <th class="thcenter">Unit Price</th>
                            <th class="thcenter">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input id="item_no_one" type="text" name="item_no_one" value="01" class="input-mini"></td>
                            <td><input id="description_one" type="text" name="description_one" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_one" type="text" name="quantity_one" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_one" type="text" name="unit_one" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_one" type="text" name="totalamount_one" class="input-mini" readonly></td>
                        </tr>
                        <tr>
                            <td><input onkeyup="sum();" id="item_no_two" type="text" name="item_no_two" value="02" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="description_two" type="text" name="description_two" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_two" type="text" name="quantity_two" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_two" type="text" name="unit_two" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_two" type="text" name="totalamount_two" class="input-mini" readonly></td>
                        </tr>
                        <tr>
                            <td><input onkeyup="sum();" id="item_no_three" type="text" name="item_no_three" value="03" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="description_three" type="text" name="description_three" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_three" type="text" name="quantity_three" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_three" type="text" name="unit_three" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_three" type="text" name="totalamount_three" class="input-mini" readonly></td>
                        </tr>
                        <tr>
                            <td><input onkeyup="sum();" id="item_no_four" type="text" name="item_no_four" value="04" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="description_four" type="text" name="description_four" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_four" type="text" name="quantity_four" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_four" type="text" name="unit_four" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_four" type="text" name="totalamount_four" class="input-mini" readonly></td>
                        </tr>
                        <tr>
                            <td><input onkeyup="sum();" id="item_no_five" type="text" name="item_no_five" value="05" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="description_five" type="text" name="description_five" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_five" type="text" name="quantity_five" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_five" type="text" name="unit_five" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_five" type="text" name="totalamount_five" class="input-mini" readonly></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <table class="table table-hover invoice-input">
                <thead>

                    <tr>
                        <th>

                            <input type="radio" name="gsttype" onclick="show4()" value="in"> Include GST
                            <input type="radio" name="gsttype" onclick="show5()" value="ex"> Exclude GST
                        </th>

                    </tr>

                    <tr>
                        <th class="d-flex flex-wrap">
                            Total Net Pay
                            <input type="text" id="pro_netpay" name="netpay" class="input-xlarge" readonly>
                        </th>
                    </tr>
            </table>


            <div class="table table-hover invoice-input" id="ingst" style="display:none;">
                <b>Principle Amount</b>
                <input type="text" id="totalamount" name="principle" class="input-xlarge" readonly><br><br>

                <div id="sgst1" style="display:none;overflow:hidden;">
                    CGST {{ $gst->cgst }}%
                    <input type="hidden" id="cgstvalue1" name="cgst1" value="{{ $gst->cgst }}">
                    <input type="text" id="pro_cgst1" name="cgst1" class="input-xlarge" readonly><br><br>
                    SGST {{ $gst->sgst }}%
                    <input type="hidden" id="sgstvalue1" name="sgst1" value="{{ $gst->sgst }}">
                    <input type="text" id="pro_sgst1" name="sgst1" class="input-xlarge" readonly><br><br>
                </div>

                <div class="mb-3" id="igst1" style="display:none;">
                    <!--code-->
                    IGST {{ $gst->igst }}%
                    <input type="hidden" id="igstvalue1" name="igst1" value="{{ $gst->igst }}">
                    <input type="text" id="pro_igst1" name="igst1" class="input-xlarge" readonly>
                    <!--code-->
                </div>

                GST Type
                <input class="input-xlarge" type="radio" value="sgst" name="taxvalue1" onclick="show6()">SGST/CGST
                <input class="input-xlarge" type="radio" value="igst" name="taxvalue1" onclick="show7()">IGST<br><br>

                <th>
                    Gross Pay
                    <input type="text" id="pro_grosspay1" name="grosspay1" class="input-xlarge" readonly>
                </th>
                <br>
                <input class="btn btn-warning mt-3" style="display:none;" type="button" onclick="add3();showButton();" value="Calculate" id="calculatei"><br>
                <!-- <input style="display:none;" type="submit" value="Generate Invoice" class="btn btn-submit btn-large hidden-print showbuttton" name="submitproforma" id="submitproformaid1"> -->
                <div class="text-center" id="submitproformaid1" style="display:none;">
                    <label class="err_lbl"></label><br>
                    <div class="btn-g2">
                        <div></div>
                        <div></div>
                        <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Invoice </button>
                        <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                    </div>
                </div>

            </div>

            <div style="display:none;" id="outgst">
                <table class="table table-hover invoice-input">
                    <tr>
                        <th>
                            GST Type
                            @if($accounts->city != "Dubai")
                            <input class="input-xlarge" type="radio" onclick="show1()" value="sgst" name="taxvalue" id="sgst"> SGST/CGST
                            <input class="input-xlarge" type="radio" onclick="show2()" value="igst" name="taxvalue" id="igst"> IGST
                            @else
                            <input class="input-xlarge" type="radio" onclick="show3()" value="export" name="taxvalue"> EXPORT
                            @endif
                        </th>
                    </tr>
                    <br>
                    <div id="sgst" style="display:none;overflow:hidden;">
                        <!--code-->
                        CGST {{ $gst->cgst }}%
                        <input type="hidden" id="cgstvalue" name="cgst" value="{{ $gst->cgst }}">
                        <input type="text" id="pro_cgst" name="cgst" class="input-xlarge" readonly><br><br>
                        SGST {{ $gst->sgst }}%
                        <input type="hidden" id="sgstvalue" name="sgst" value="{{ $gst->sgst }}">
                        <input type="text" id="pro_sgst" name="sgst" class="input-xlarge" readonly>
                        <!--code-->
                    </div>
                    <br>
                    <div id="igst" style="display:none;">
                        <!--code-->
                        IGST {{ $gst->igst }}%
                        <input type="hidden" id="igstvalue" name="igst" value="{{ $gst->igst }}">
                        <input type="text" id="pro_igst" name="igst" class="input-xlarge" readonly>
                        <!--code-->
                    </div>
                    <br>
                    <tr>
                        <th>
                            Gross Pay
                            <input type="text" id="pro_grosspay" name="grosspay" class="input-xlarge" readonly>
                        </th>
                    </tr>
                    </thead>
                </table>

                <!--code-->
                <div class="row-fluid">
                    <br>

                    @if($accounts->city == "Dubai")

                    <input class="btn btn-warning" style="display:none;" type="button" id="calculate" onclick="add1();showButton();" value="Calculate"><br>
                    <!-- <input style="display:none;" type="submit" value="Generate Proforma Invoice" class="btn btn-submit btn-large hidden-print showbuttton" name="submitproforma" id="submitproformaid"> -->
                    <div class="text-center" id="submitproformaid" style="display:none;">
                        <label class="err_lbl"></label><br>
                        <div class="btn-g2">
                            <div></div>
                            <div></div>
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Invoice </button>
                            <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                        </div>
                    </div>
                    @else

                    <input class="btn btn-warning" style="display:none;" type="button" id="calculate" onclick="add();showButton();" value="Calculate"><br>
                    <!-- <input style="display:none;" type="submit" value="Generate Proforma Invoice" class="btn btn-submit btn-large hidden-print showbuttton" name="submitproforma" id="submitproformaid"> -->
                    <div class="text-center" id="submitproformaid" style="display:none;">
                        <label class="err_lbl"></label><br>
                        <div class="btn-g2">
                            <div></div>
                            <div></div>
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Invoice </button>
                            <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                        </div>
                    </div>
                    @endif

                </div>


            </div>


            <!-- Add a submit button -->
            <!-- <br>
            <div class="text-center">
                <label class="err_lbl"></label><br>
                <div class="btn-g2">
                    <div></div>
                    <div></div>
                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Add </button>
                    <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                </div>
            </div>
            <br> -->
            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>
<script type="text/javascript">
    function show6() {
        document.getElementById('sgst1').style.display = 'block';
        document.getElementById('igst1').style.display = 'none';
        //document.getElementById("submitproformaid").style.display='block';
        document.getElementById("calculatei").style.display = 'block';
        document.getElementById('igstvalue1').style.display = 'none';
    }

    function show7() {
        document.getElementById('igst1').style.display = 'block';
        document.getElementById('sgst1').style.display = 'none';
        //document.getElementById("submitproformaid").style.display='block';
        document.getElementById("calculatei").style.display = 'block';
        document.getElementById('cgstvalue1').style.display = 'none';
        document.getElementById('sgstvalue1').style.display = 'none';
    }


    function show4() {
        document.getElementById('ingst').style.display = 'block';
        document.getElementById('outgst').style.display = 'none';
    }

    function show5() {
        document.getElementById('ingst').style.display = 'none';
        document.getElementById('outgst').style.display = 'block';
    }

    function show1() {
        document.getElementById('sgst').style.display = 'block';
        document.getElementById('igst').style.display = 'none';
        //document.getElementById("submitproformaid").style.display='block';
        document.getElementById("calculate").style.display = 'block';
        document.getElementById('igstvalue').style.display = 'none';
    }

    function show2() {
        document.getElementById('igst').style.display = 'block';
        document.getElementById('sgst').style.display = 'none';
        //document.getElementById("submitproformaid").style.display='block';
        document.getElementById("calculate").style.display = 'block';
        document.getElementById('cgstvalue').style.display = 'none';
        document.getElementById('sgstvalue').style.display = 'none';
    }

    function show3() {
        document.getElementById('igst').style.display = 'none';
        document.getElementById('sgst').style.display = 'none';
        document.getElementById("calculate").style.display = 'block';
        document.getElementById('cgstvalue').style.display = 'none';
        document.getElementById('sgstvalue').style.display = 'none';
    }
</script>
<script type="text/javascript">
    function add() {
        $("#pro_cgst").val((+$("#pro_netpay").val()) * (+$("#cgstvalue").val()) / 100);
        $("#pro_sgst").val((+$("#pro_netpay").val()) * (+$("#sgstvalue").val()) / 100);
        $("#pro_igst").val((+$("#pro_netpay").val()) * (+$("#igstvalue").val()) / 100);
        $("#pro_grosspay").val(((+$("#pro_netpay").val()) + ((+$("#pro_netpay").val()) * (18 / 100))).toFixed(0));

    }

    function add1() {
        $("#pro_netpay").val((+$("#totalamount_one").val()) + (+$("#totalamount_two").val()) + (+$("#totalamount_three").val()) + (+$("#totalamount_four").val()) + (+$("#totalamount_five").val()));
        $("#pro_grosspay").val((+$("#pro_netpay").val()));
    }

    function add3() {
        $("#pro_netpay").val((+$("#totalamount_one").val()) + (+$("#totalamount_two").val()) + (+$("#totalamount_three").val()) + (+$("#totalamount_four").val()) + (+$("#totalamount_five").val()));

        $("#pro_grosspay1").val((+$("#pro_netpay").val()));
        //alert($("#totalamount_one").val());
        $("#totalamount").val(parseFloat((+$("#pro_netpay").val()) * (84.75 / 100)).toFixed(0));
        $("#pro_cgst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())) / 2);
        $("#pro_sgst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())) / 2);
        $("#pro_igst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())));

    }


    window.onload = function() {
        document.getElementById("submitproformaid").style.display = 'none';
        document.getElementById("submitproformaid1").style.display = 'none';
    }

    function showButton() {
        document.getElementById("submitproformaid").style.display = 'block';
        document.getElementById("submitproformaid1").style.display = 'block';
    }

    function sum() {
        $("#totalamount_one").val(((+$("#quantity_one").val()) * (+$("#unit_one").val())).toFixed(0));
        $("#totalamount_two").val(((+$("#quantity_two").val()) * (+$("#unit_two").val())).toFixed(0));
        $("#totalamount_three").val(((+$("#quantity_three").val()) * (+$("#unit_three").val())).toFixed(0));
        $("#totalamount_four").val(((+$("#quantity_four").val()) * (+$("#unit_four").val())).toFixed(0));
        $("#totalamount_five").val(((+$("#quantity_five").val()) * (+$("#unit_five").val())).toFixed(0));

        $("#pro_netpay").val((+$("#totalamount_one").val()) + (+$("#totalamount_two").val()) + (+$("#totalamount_three").val()) + (+$("#totalamount_four").val()) + (+$("#totalamount_five").val()));
    }
</script>