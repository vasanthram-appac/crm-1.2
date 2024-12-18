<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
   
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Invoice</title>

    <style>
     
        .border ,.vertical-border{position:relative;}
		.vertical-border::after{position:absolute;width:1px;height:100%;background:#000;top:0px;left:49%;content:'';}
        .border::after{position:absolute;bottom:0px;left: -16px; width: 610px;height:1px;background:#000;content:''}
  
    body {
            font-family: 'Inter', sans-serif;
        }
    </style>

</head>
<body>
    <span style="margin-left:950px;">
        <button onClick="PrintDiv();">
            <i class="fa fa-print fa-2x" aria-hidden="true" style="color:#00B7CE;"></i>
        </button>
    </span>
    <div id="divToPrint" style="position: relative; ">
		<!--<img src="imgs/Invoice.jpg" class="cover_img" style=" width: 930px; background-size: cover; background-repeat: no-repeat;position:absolute; z-index:99;" />-->
		
       <!-- <img src="imgs/invoice_cover.jpg" class="cover_img" style=" width: 930px; background-size: cover; background-repeat: no-repeat;position:absolute;"/>-->
		<div class="wid"style="width:930px;">
			<div class="head_grid" style="width: 870px; margin:auto; display: grid; grid-template-columns: 25% 35% 40%; align-items: end;background-color:#fff;">
				<img src="https://appacmedia.in/imgs/head-logo.png" alt="" style="width: 175px; padding-left: 10px;background-color:#fff;">
				<div class="head_add" style="width: 100%;">
					<b style="font-family: 'Work Sans', sans-serif; font-size: 10px; font-weight: 800; line-height: 25px; color:#221b53;">APPAC MEDIATECH PVT. LTD.</b><br>
					<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">#204, 2nd floor, Aathisree Towers, DB Road, R S Puram,</span><br>
					<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">Coimbatore - 641 002. Tamil Nadu. India.</span><br>
					<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">+91 422 435 4854 | +91 63692 86774</span><br>
					<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">Email: info@appacmedia.com | Web: www.appacmedia.com</span>
				</div>
				<img src="https://appacmedia.in/imgs/head-invoice.png" alt="" style="width: 350px; padding-left: 30px; background-color:#fff;">
			</div>
		</div>
        <div class="cover_img" style="position: absolute; width: 930px;">
           


                    <div class="flex" style="font-family: 'Inter', sans-serif; font-size: 14px; position: absolute; width: fit-content; left: 525px; top: 25px; display: flex; gap: 20px;"><div>Invoice No : <b>{{ $invoice->invoice_no ?? 'N/A' }}
                    </b></div> <div style="font-family: 'Inter', sans-serif;">Date : <b>{{ $invoice->invoice_date ? date('d-m-Y', strtotime($invoice->invoice_date)) : 'N/A' }}
                </b></div></div>   
                    <div style="border: 1px solid black; font-family: 'Inter', serif; width:870px; position: relative; top: 50px; margin: auto" >                       
                        <table border="0" frame="box" style="border-collapse: collapse; width: 870px; margin-top: 0px;border-left:0px;border-right:0px;border-top:0px;">              
                           
                            <colgroup>
                                <col style="width: 50%;">
                                <col style="border-left: 1px solid black; width: 0;">
                                <col style="width: 50%;">
                            </colgroup>
                            <tr>
                                <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 10px; padding-top: 10px;font-size: 15px;">BILL TO :</th>
                                <th></th>
                                <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 10px; padding-top: 10px;font-size: 15px;">SHIP TO :</th>
                            </tr>
                            <tr>
                                <td align="left" style="padding: 15px;">
                                    <table style="width: 100%; font-size: 13px;">
                                        <tr>
                                            <td align="left" style="width: 35%;font-family: 'Inter', sans-serif;"><strong>Company Name</strong></td>
                                            <td align="left" style="width: 20px;">:</td>
                                            <td align="left" style="color:#464141;font-family: 'Inter', sans-serif;">{{ ($accounts->comp_title ?? '') . ' ' . ($accounts->company_name ?? '') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="width: 35%;font-family: 'Inter', sans-serif;"><strong>Contact Person</strong></td>
                                            <td align="left" style="width: 20px;">:</td>
                                            <td align="left" style="color:#464141;font-family: 'Inter', sans-serif;">{{ ($accounts->title ?? '') . ' ' . ($accounts->firstname ?? ''). ' '.($accounts->lastname ?? '') }}</td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="width: 35%;font-family: 'Inter', sans-serif;"><strong>Contact Number</strong></td>
                                            <td align="left" style="width: 20px;">:</td>
                                            <td align="left" style="font-family: 'Inter', sans-serif;color:#464141">{{ ($accounts->stdcode ?? '') . ' ' . ($accounts->phone ?? '') }}</td>
                                        </tr>
                                        <tr>
											<td align="left" valign="top" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Address</strong></td>
											<td align="left" valign="top" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{$accounts->address ?? ''}}</td>
										</tr>
                                        <tr>
                                            <td align="left" style="font-family: 'Inter', sans-serif;width: 35%;"><strong>GST Number</strong></td>
                                            <td align="left" style="width: 20px;">:</td>
                                            <td align="left" style="font-family: 'Inter', sans-serif;color:#464141">{{ ($accounts->city != 'Dubai') ? $accounts->gst_number : '' }}
                                            
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td></td>
                                <td align="left" style="padding: 15px;">
                                    <table style="width: 100%; font-size: 13px;">
										<tr>
											<td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Company Name</strong></td>
											<td align="left" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ ($accounts->comp_title ?? '') . ' ' . ($accounts->company_name ?? '') }}</td>
										</tr>
										<tr>
											<td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Contact Person</strong></td>
											<td align="left" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ ($accounts->shipping_title) ? $accounts->shipping_title : ($accounts->title . ' ' . (($accounts->shipping_firstname) ? $accounts->shipping_firstname : $accounts->firstname) . ' ' . (($accounts->shipping_lastname) ? $accounts->shipping_lastname : $accounts->lastname)) }}</td>
										</tr>
										<tr>
											<td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Contact Number</strong></td>
											<td align="left" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ $accounts->stdcode . ' ' . ($accounts->shipping_phone ? $accounts->shipping_phone : $accounts->phone) }}</td>

										</tr>
										<tr>
											<td align="left" valign="top" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Address</strong></td>
											<td align="left" valign="top" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ preg_replace('/(\w)\(/', '$1 (', $accounts->shipping_address ? $accounts->shipping_address : $accounts->address) }}</td>
										</tr>
										<tr>
											<td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>GST Number</strong></td>
											<td align="left" style="width: 20px;">:</td>
											<td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ ($accounts->city != 'Dubai') ? $accounts->gst_number : '' }}
											</td>
										</tr>
									</table>
                                </td>
                            </tr>
                    
                            <table style="border-collapse: separate; border-spacing: 0 10px; width: 100%; font-size: 13px;">
                                <colgroup>
                                    <col style="width: 8%;">
                                    <col style="width: 40%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                    <col style="width: 20%;">
                                </colgroup>
                                <tr>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 15px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid black;">S.No</th>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 15px; padding-bottom: 10px; padding-left: 0px; border-bottom: 1px solid black;">Description</th>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 15px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid black;">Quantity<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(Nos)</span></th>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 15px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid black;">Unit price<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(INR)</span></th>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 15px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid black;">Total<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(INR)</span></th>
                                </tr>
                          
                                <tbody style="color:#464141">
                                    @if(count($iinfo)>0)
                                    @foreach($iinfo as $info)
                                    <tr style="padding-left: 10px;">
                                        <td style="font-family: 'Inter', sans-serif;padding-left: 10px;">{{$info->item_no}}</td>
                                        <td style="font-family: 'Inter', sans-serif;">{{$info->description}}</td>
                                        <td style="font-family: 'Inter', sans-serif;padding-left: 35px;">&nbsp;{{$info->quantity}}</td>
                                        <td style="font-family: 'Inter', sans-serif;padding-left: 10px;">{{number_format($info->unit ?? 0,2)}}&nbsp;</td>
                                        <td style="font-family: 'Inter', sans-serif;padding-left: 10px;">{{number_format($info->totalamount ?? 0,2)}}</td>
                                    </tr>
                                    @endforeach
                                    @endif 
                                   
                                </tbody>                
                            </table>
                
                            <table style="border-collapse: separate; border-spacing: 0 0px; width: 100%; font-size: 13px;">
                                <colgroup>                    
                                    <col style="width: 52%;font-family: 'Inter', sans-serif;">
                                    <col style="width: 22%;font-family: 'Inter', sans-serif;">
                                    <col style="width: 22%;font-family: 'Inter', sans-serif;">
                                </colgroup>
                                <tr>
                                    <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 10px; padding-top: 10px; border-top: 1px solid black; border-right: 1px solid black;font-size:13px">Key Notes:</th>
									<div style="display:flex;align-items:center;justify-content:right;position: absolute;left: 35%;right: 30%;top: 60%;background-color:#fff;    z-index: -2;">
									<img src="https://appacmedia.in/imgs/appac-watermark.svg" class="" style="width:320px;background-color:#fff;" /></div>
                                    
                                    
                                    @if($invoice->specialdiscount !='0')
                                    <th style="text-align: right; border-top: 1px solid black; padding: 10px 0px 0px 0px;font-size:13px">Total Rs. </th>
                                    @endif
                                    
                                    @if($invoice->gsttype =='in')
                                    <th style="text-align: right; border-top: 1px solid black; padding: 10px 0px 0px 0px;font-size:13px">Total (Including GST) Rs. </th>
                                    @else
                                    <th style="text-align: right; border-top: 1px solid black; padding: 10px 0px 0px 0px;font-size:13px">Total Netpay Rs. </th>
                                    @endif

                                  
                                    @if($invoice->specialdiscount !='0')
                                    <th style="text-align: right; border-top: 1px solid black; padding-right: 35px; padding-top: 10px;font-size:13px">{{ number_format($invoice->specialdiscount?? 0,2) }}</th>
                                    @endif
                                    
                                    @if($invoice->gsttype =='in')
                                    <th style="text-align: right; border-top: 1px solid black; padding-right: 35px; padding-top: 10px;font-size:13px">{{number_format($invoice->amount ?? 0,2)}}</th>
                                     @else
                                    <th style="text-align: right; border-top: 1px solid black; padding-right: 35px; padding-top: 10px;font-size:13px">{{number_format($invoice->netpay ?? 0,2)}}</th>
                                    @endif
                                </tr>
                                <tbody>
								    <tr>
                                        <td align="right" style="border-right: 1px solid black;"></td>

                                        @if($invoice->specialdiscount !='0')
                                            <td align="right" style="padding: 10px 0px 0px 0px;font-size:13px"><b>Discount Amount </b></td>                                       
                                        @endif


                                        @if($invoice->specialdiscount !='0')
                                        <td align="right" style="padding-right: 35px; padding-top: 10px;font-size:13px"><b>{{number_format($invoice->specialdiscount ?? 0,2)}}</b></td>
                                        @endif
                                    </tr>
                                    
                                    <tr style="padding-left: 10px;">
                                        <td align="right" style="border-right: 1px solid black;"></td>
                                      
                                        @if($accounts->city !='Dubai')
                                        @if($invoice->taxvalue =='sgst')
                                        <td align="right" style="padding: 10px 0px 0px 0px;font-size:13px"><b>CGST- 9%</b></td>
                                        @elseif($invoice->taxvalue=='igst')
                                        <td align="right" style="padding: 10px 0px 0px 0px;font-size:13px"><b>IGST-18%</b></td>
                                        @endif
                                        @endif

                                          @if($accounts->city !='Dubai')
                                        @if($invoice->taxvalue =='sgst')
                                        <td align="right" style="padding-right: 35px; padding-top: 10px;font-size:13px"><b>{{number_format($invoice->cgst ?? 0,2)}}</b></td>                       
                                        @elseif($invoice->taxvalue=='igst')
                                        <td align="right" style="padding-right: 35px; padding-top: 10px;font-size:13px"><b>{{number_format($invoice->igst ?? 0,2)}}</b></td>
                                        @endif
                                        @endif

                                    </tr>
									<tr>
									<td align="right" style="border-right: 1px solid black;"></td>
									   @if($accounts->city !='Dubai')
                                        @if($invoice->taxvalue =='sgst')
                                        <td align="right" style="padding: 10px 0px 15px 0px; border-bottom: 1px solid black;font-size:13px"><b>SGST-9%</b></td>
                                        @elseif($invoice->taxvalue=='igst')
                                        <td align="right" style="padding: 10px 0px 15px 0px; border-bottom: 1px solid black;font-size:13px"></td>
                                        @endif
                                        @endif
                                        
                                        @if($accounts->city !='Dubai')
                                        @if($invoice->taxvalue =='sgst')
                                        <td align="right" style="padding-right: 35px; border-bottom: 1px solid black;font-size:13px"><b>{{number_format($invoice->sgst ?? 0,2)}}</b></td>                        
                                        @elseif($invoice->taxvalue=='igst')
                                        <td align="right" style="padding-right: 35px; border-bottom: 1px solid black;font-size:13px"></td>
                                        @endif
                                        @endif
                                       
									</tr>
                                    
                                    <tr>
                                        <td align="left" style="font-family: 'Work Sans', sans-serif; border-right:1px solid #000;"><br>
                                        <span style="color:#464141"></span></td>
                                        <td align="right" style="font-family: 'Inter', sans-serif;padding: 10px 0px 15px 0px;border-left:1px solid #00000;font-size:13px"><b>Grand Total Rs.</b></td>
                                        <td align="right" style="font-family: 'Inter', sans-serif;padding-right: 35px; padding-top: 10px; padding-bottom: 15px;font-size:13px"><b>{{number_format($invoice->grosspay ?? 0,2)}}</b></td>                       
                                    </tr>                    
                                </tbody>                
                            </table>
                        </table>
                    </div>
                    <div style="font-family: 'Inter', serif; border: 1px solid black; width:870px; position: relative; top: 40px; margin: auto; margin-top: 15px;" id="divToPrint">
                        
                        <table style="border-collapse: separate; border-spacing: 0 0px; width: 100%;">
                            <colgroup>                    
                                <col style="width: 70%;">
                                <col style="width: 30%;">              
                            </colgroup>
                            <!-- <tr>
                                <th style="text-align: left; padding-left: 10px; padding-top: 10px; border-top: 2px solid black; font-size: 12px">Bank Details:</th>
                            </tr> -->
                            <tbody>
                                <tr>
                                    <!-- Left side: Bank details and other information -->
                                    <td style=" vertical-align: top;">
                                        <div style="font-family: 'Inter', serif; font-size: 12px; padding:15px">
                                            <table style="border-collapse: separate; border-spacing: 0 0px; width: 120%;">
                                                <colgroup>                    
                                                    <col style="width: 100%;">                       
                                                </colgroup>
                                                <tr>
                                                    <th style="font-family: 'Work Sans', sans-serif; text-align: left; font-size: 12px; padding-left: 10px; padding-bottom: 8px;">Invoice Terms & Conditions</th>
                                                </tr>
                                                <tbody style="color:#464141">
                                                    <tr style="padding-left: 10px;">
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px; "><li>Please be aware that you must communicate any changes to this tax invoice via email within 7 days.</li></td></tr></td> 
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;"><li style="list-style: none; padding-left: 17px;">After 7 days, the invoice will be considered accepted by the customer and not changed.</li></td></tr></td>
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;"><li>Company liability is only up to the value of the invoice.</li></td></tr></td>
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;"><li>Acceptance of the invoice signifies acceptance of the agreed service levels.</li></td></tr></td>
                                                        <td align="left"  ><tr><td  class=""style="font-family: 'Inter', sans-serif; font-size: 12px;"><li>The recipient of this invoice has fully and duly verified all contents, data, input files, and copies.</li></td></tr></td>
                                                        <td align="left"  ><tr><td style="font-family: 'Inter', sans-serif;padding-bottom: 10px; font-size: 12px;"><li>Payment to us is covered under advertising contract u/s 194C. TDS, if applicable, will be @ 2%.</li></td></tr></td>
                                                    </tr>   
                                                    <tr>
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;border-top: 1px solid #000;    padding-top: 12px;"><b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;">Note</b> : Cheque / Draft to be made in the favour of <b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;">APPAC MEDIATECH PVT. LTD.</b></td></tr></td>
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;"><b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;">PAN</b> : AAQCA4617E &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;">GST No</b> : 33AAQCA4617E1ZU &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;"> TAN </b>: CMBA09095C</td></tr></td>
                                                        <td align="left" ><tr><td style="font-family: 'Inter', sans-serif;font-size: 12px;"><b style="font-weight: 500; color: #000;">SAC CODE</b>: 9983 &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif;font-weight: 500; color: #000;"> LUT No</b> : AD330419005161L</td></tr></td>
                                                    </tr>					
                                                </tbody>                
                                            </table>
                                        </div>
                                    </td>

                                    <!-- Right side: SAC CODE -->
                                    <td style="padding: 15px; border-left: 1px solid black; border-top: 0px solid black; vertical-align: bottom;text-align: center;background-color:#fff;">
									<div style="font-family: 'Inter', sans-serif;font-size: 8px;padding-bottom: 65px; text-align:center;">This is a digitally signed invoice. <br> No physical signature is necessary.</div>
                                    <img src="https://appacmedia.in/imgs/signature.png" style="height:60px;background-color:#fff;">
                                    <p style="font-family: 'Inter', sans-serif;margin:0px;font-size:8px;color:#1d1d1d;">for Appac Mediatech Pvt Ltd</p>
                                    </td>
                                </tr>
                            </tbody> 
                              
                        </table> 
                    </div>  
                                       
    
                <!-- Footer Content - Ensuring it comes last in the structure -->
                <div style="text-align: center; margin-top: 20px; font-family: 'Inter', serif;">
                    <div style="margin-bottom: 50px;"></div>
            
                    <div style="font-family: 'Inter', sans-serif; font-size: 12px;"><b>Please email info@appacmedia.com with payment information or for any questions.</b></div>
                </div>
        </div> 
    </div> 

    <script type="text/javascript">     
        function PrintDiv() 
        {    
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=1024,height=762');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
        }
    </script>
          
</body> 
</html>