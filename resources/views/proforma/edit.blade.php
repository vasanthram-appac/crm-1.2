<div class="modal-dialog cascading-modal" role="document">
    <!--Content-->
    <div class="modal-content">
        <!--Header-->
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit Proforma</h4>
        </div>
        <!--Body-->
        <div class="modal-body mb-0">

            {!! Form::model($proformadetails, ['route' => ['proforma.update', $proformadetails->id], 'method' => 'PUT']) !!}
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

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('paymentterms', 'State *', ['class' => 'label-color py-2']) !!}
                        <select class="form-select" name="statename_disable" id="">
                            <option value="">Select</option>
                            @if(count($statename)>0)
                            @foreach($statename as $state)
                            <option value="{{$state->name}}"  @if(isset($proformadetails->statename) && $state->name == $proformadetails->statename) selected 
                                @elseif(isset($accounts->state) && $state->name == $accounts->state) selected @endif>{{$state->name}}</option>
                            @endforeach
                            @endif
                        </select>
                         <input type="hidden" name="statename" value="{{$proformadetails->statename}}">
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('paymentterms', 'Key Notes *', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('paymentterms', null, ['class' => 'form-control', 'placeholder' => 'Key notes', 'required', 'rows'=>4]) !!}
                    </div>
                </div>

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
                <h5 class="title">Proforma Invoice Details</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('invoice_date', 'Key Notes', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('invoice_date', $proformadetails->invoice_date, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="validate-input m-b-23 mb-2">
                        {!! Form::label('invoice_no', 'Reference No', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('invoice_no', $proformadetails->invoice_no, ['class' => 'form-control', 'readonly']) !!}

                    </div>
                </div>
            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Proforma Invoice Details</h5>
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



                        @if(count($proforma)>0)
                        @foreach($proforma as $key=>$proforma1)
                        <tr>
                            <td><input id="item_no_{{$key+1}}" type="text" name="item_no_{{$key+1}}" value="{{$proforma1->item_no}}" class="input-mini"></td>
                            <td><input id="description_{{$key+1}}" type="text" name="description_{{$key+1}}" value="{{$proforma1->description}}" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_{{$key+1}}" type="text" name="quantity_{{$key+1}}" value="{{$proforma1->quantity}}" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_{{$key+1}}" type="text" name="unit_{{$key+1}}" value="{{$proforma1->unit}}" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_{{$key+1}}" type="text" name="totalamount_{{$key+1}}" value="{{$proforma1->totalamount}}" class="input-mini" readonly></td>
                            <input type="hidden" name="updateid_{{$key+1}}" value="{{$proforma1->id}}">
                            <td><button class="btn btn-modal conformdelete" data-id="{{$proforma1->id}}" data-inid="{{$proforma1->invoice_no}}"><i class="fi fi-ts-trash-xmark"></i></button></td>

                        </tr>
                        @endforeach
                        @endif

                        @for($i = count($proforma) + 1; $i <= 5; $i++)
                            <tr>
                            <td><input onkeyup="sum();" id="item_no_{{$i}}" type="text" name="item_no_{{$i}}" value="0{{$i}}" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="description_{{$i}}" type="text" name="description_{{$i}}" class="input-xlarge"></td>
                            <td><input onkeyup="sum();" id="quantity_{{$i}}" type="text" name="quantity_{{$i}}" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="unit_{{$i}}" type="text" name="unit_{{$i}}" class="input-mini"></td>
                            <td><input onkeyup="sum();" id="totalamount_{{$i}}" type="text" name="totalamount_{{$i}}" class="input-mini" readonly></td>
                            </tr>
                            @endfor



                    </tbody>
                </table>
            </div>

            <table class="table table-hover invoice-input">
                <thead>

                    <tr>
                        <th class="d-flex flex-wrap gap-2">
                            Total Amount
                            <input type="text" id="amount_pay" name="amount" class="input-xlarge" value="{{$proforma->sum('totalamount')}}" readonly>

                            <span><input type="radio" name="gsttype" onclick="show4()" value="in"> Include GST</span>
                            <span><input type="radio" name="gsttype" onclick="show5()" value="ex"> Exclude GST</span>
                        </th>

                    </tr>

                    <tr>
                        <th class="d-flex flex-wrap gap-2">
                            Special Discount
                            <input type="text" id="discount_pay" name="specialdiscount" class="input-xlarge" value="0">
                        </th>
                    </tr>
                    <tr>
                        <th class="d-flex flex-wrap gap-2">
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
                <span id="spansgst1" style="display: none;"> <input class="input-xlarge" type="radio" value="sgst" onclick="show6()" name="taxvalue1" id="sgst1"> SGST/CGST </span>
                <span id="spanigst1" style="display: none;"> <input class="input-xlarge" type="radio" value="igst" onclick="show7()" name="taxvalue1" id="igst1"> IGST </span><br><br> 

                <th>
                    Gross Pay
                    <input type="text" id="pro_grosspay1" name="grosspay1" class="input-xlarge" readonly>
                </th>
                <br><br>
                <input class="btn btn-warning mt-3" type="button" style="display:none;" id="calculatei" onclick="add3();showButton();" value="Calculate"><br>
                <!-- <input style="display:none;" type="submit" value="Generate Proforma Invoice" class="btn btn-submit btn-large hidden-print showbuttton" name="submitproforma" id="submitproformaid1"> -->

                <div class="text-center" id="submitproformaid1" style="display:none;">
                    <label class="err_lbl"></label><br>
                    <div class="btn-g2">
                        <div></div>
                        <div></div>
                        <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Proforma </button>
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
                            <span id="spansgst" style="display: none;"> <input class="input-xlarge" type="radio" onclick="show1()" value="sgst" name="taxvalue" id="sgst"> SGST/CGST </span>
                            <span id="spanigst" style="display: none;"> <input class="input-xlarge" type="radio" onclick="show2()" value="igst" name="taxvalue" id="igst"> IGST </span>
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
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Proforma </button>
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
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button"> Generate Proforma </button>
                            <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button"> Cancel </button>
                        </div>
                    </div>
                    @endif

                </div>

            </div>

            {!! Form::close() !!}

        </div>
    </div>
    <!--/.Content-->
</div>

<script type="text/javascript">
    function show4() {

        var state = $("select[name=statename_disable]").val();
        if (state == "") {
            alert('Please Select State Name!');
            $("[name=gsttype]").prop("checked", false);
            return false;
        } else {
             $("[name=statename]").val(state);
            $("select[name=statename_disable]").prop("disabled", true);
        }

        if (state == "Tamil Nadu") {

            $('#spanigst').hide();
            $('#spanigst1').hide();
            $('#spansgst').show();
            $('#spansgst1').show();
            show6();
            add3();
            showButton();
            $("#sgst1").prop("checked", true);
        } else {

            $('#spanigst').show();
            $('#spanigst1').show();
            $('#spansgst').hide();
            $('igst1').hide();
            show7();
            add3();
            showButton();
            $("#igst1").prop("checked", true);
        }

        document.getElementById('ingst').style.display = 'block';
        document.getElementById('outgst').style.display = 'none';
    }

    function show5() {

        var state = $("select[name=statename_disable]").val();
        if (state == "") {
            alert('Please Select State Name!');
            $("[name=gsttype]").prop("checked", false);
            return false;
        } else {
             $("[name=statename]").val(state);
            $("select[name=statename_disable]").prop("disabled", true);
        }

        if (state == "Tamil Nadu") {
            $('#spanigst').hide();
            $('#spanigst1').hide();
            $('#spansgst').show();
            $('#spansgst1').show();
            show1();
            add();
            showButton();
            $("#sgst").prop("checked", true);
        } else {
            $('#spanigst').show();
            $('#spanigst1').show();
            $('#spansgst').hide();
            $('#spansgst1').hide();
            show2();
            add();
            showButton();
            $("#igst").prop("checked", true);
        }

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
</script>
<script type="text/javascript">
    function add() {
        $("#pro_netpay").val((+$("#totalamount_1").val()) + (+$("#totalamount_2").val()) + (+$("#totalamount_3").val()) + (+$("#totalamount_4").val()) + (+$("#totalamount_5").val()) - ((+$("#discount_pay").val())));
        $("#pro_cgst").val((+$("#pro_netpay").val()) * (+$("#cgstvalue").val()) / 100);
        $("#pro_sgst").val((+$("#pro_netpay").val()) * (+$("#sgstvalue").val()) / 100);
        $("#pro_igst").val((+$("#pro_netpay").val()) * (+$("#igstvalue").val()) / 100);
        $("#pro_grosspay").val(parseFloat((+$("#pro_netpay").val()) + ((+$("#pro_netpay").val()) * (18 / 100))).toFixed(0));
    }

    function add1() {
        $("#pro_netpay").val((+$("#totalamount_1").val()) + (+$("#totalamount_2").val()) + (+$("#totalamount_3").val()) + (+$("#totalamount_4").val()) + (+$("#totalamount_5").val()) - ((+$("#discount_pay").val())));
        $("#pro_grosspay").val((+$("#pro_netpay").val()));
    }



    function add3() {
        $("#pro_netpay").val((+$("#totalamount_1").val()) + (+$("#totalamount_2").val()) + (+$("#totalamount_3").val()) + (+$("#totalamount_4").val()) + (+$("#totalamount_5").val()) - ((+$("#discount_pay").val())));

        $("#pro_grosspay1").val((+$("#pro_netpay").val()));

        $("#totalamount").val(parseFloat((+$("#pro_netpay").val()) * (84.75 / 100)).toFixed(0));
        $("#pro_cgst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())) / 2);
        $("#pro_sgst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())) / 2);
        $("#pro_igst1").val(((+$("#pro_netpay").val()) - (+$("#totalamount").val())));
        //alert($("#totalamount").val());
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
        $("#totalamount_1").val(parseFloat((+$("#quantity_1").val()) * (+$("#unit_1").val())).toFixed(0));
        $("#totalamount_2").val(parseFloat((+$("#quantity_2").val()) * (+$("#unit_2").val())).toFixed(0));
        $("#totalamount_3").val(parseFloat((+$("#quantity_3").val()) * (+$("#unit_3").val())).toFixed(0));
        $("#totalamount_4").val(parseFloat((+$("#quantity_4").val()) * (+$("#unit_4").val())).toFixed(0));
        $("#totalamount_5").val(parseFloat((+$("#quantity_5").val()) * (+$("#unit_5").val())).toFixed(0));

        $("#amount_pay").val((+$("#totalamount_1").val()) + (+$("#totalamount_2").val()) + (+$("#totalamount_3").val()) + (+$("#totalamount_4").val()) + (+$("#totalamount_5").val()));

    }
</script>