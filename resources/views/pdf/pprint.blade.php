<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Proforma Invoice</title>
    <style>
        .flex{
            position: absolute;
            width: fit-content;
            left: 625px;
            top: 175px;
            display: flex;
            gap: 25px;
        }

        .border{position:relative;}
        .border::after{position:absolute;bottom:0px;left:-10px;width:102%;height:1px;background:#000;content:''}
        
    </style>
</head>
<body>
    <span style="margin-left:950px;">
        <button onClick="PrintDiv();">
            <i class="fa fa-print fa-2x" aria-hidden="true" style="color:#00B7CE;"></i>
        </button>
    </span>
    <div id="divToPrint" style="position: relative; ">
    <!--<img src="imgs/proforma_cover.jpg" class="cover_img" style=" width: 930px; background-size: cover; background-repeat: no-repeat;position:absolute;"/>-->
	<div class="wid"style="width:930px;">
		<div class="head_grid" style="width: 870px; margin:auto; display: grid; grid-template-columns: 25% 35% 40%; align-items: end;">
			<img src="https://appacmedia.in/oldcrm/imgs/head-logo.png" alt="" style="width: 175px; padding-left: 10px; background-color:#fff;">
			<div class="head_add" style="width: 100%;">
				<b style="font-family: 'Work Sans', sans-serif; font-size: 10px; font-weight: 800; line-height: 25px; color:#221b53;">APPAC MEDIATECH PVT. LTD.</b><br>
				<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">#204, 2nd floor, Aathisree Towers, DB Road, R S Puram,</span><br>
				<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">Coimbatore - 641 002. Tamil Nadu. India.</span><br>
				<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">+91 422 435 4854 | +91 63692 86774</span><br>
				<span style="font-family: 'Inter', sans-serif; font-size: 10px; font-weight: 400; line-height: 15px;">Email: info@appacmedia.com | Web: www.appacmedia.com</span>
			</div>
			<img src="https://appacmedia.in/oldcrm/imgs/head-promo-logo.png" alt="" style="width: 350px; padding-left: 30px; background-color:#fff;">
		</div>
    </div>
    <div class="cover_img" style="position: absolute; width: 930px;">
        
        <div class="flex" style="font-family: 'Inter', sans-serif; font-size: 14px; position: absolute; width: fit-content; left: 625px; top: 25px; display: flex; gap: 25px;"><div>PI No : <b>{{$proforma->invoice_no}}</b></div> <div>Date: <b>{{ date('d-m-Y', strtotime($proforma->invoice_date)) }}</b></div></div>   
            <div style="border: 1px solid black; font-family: 'Inter', sans-serif; width:870px; position: relative; top: 50px; margin: auto" >                       
                <table border="0" frame="box" style="border-collapse: collapse; width: 870px; margin-top: 0px;border-left:0px;border-right:0px;border-top:0px;">
            
                    <colgroup>
                        <col style="width: 50%;">
                        <col style="border-left: 1px solid black; width: 0;">
                        <col style="width: 50%;">
                    </colgroup>
                    
                    <tr>
                        <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 10px; padding-top: 10px;">BILL TO :</th>
                        <th></th>
                        <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 10px; padding-top: 10px;">SHIP TO :</th>
                    </tr>
                    <tr>
                        <td align="left" style="padding: 15px;">
                            <table style="width: 100%; font-size: 13px;">
                                <tr>
                                    <td align="left" style="font-family: 'Inter', sans-serif;width: 35%;"><strong>Company Name</strong></td>
                                    <td align="left" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif;color:#464141 "> {{ $accounts->comp_title.' '.$accounts->company_name }}</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Contact Person</strong></td>
                                    <td align="left" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ $accounts->title.' '.$accounts->firstname.' '.$accounts->lastname}}</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Contact Number</strong></td>
                                    <td align="left" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ $accounts->stdcode.' '.$accounts->phone}}</td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Address</strong></td>
                                    <td align="left" valign="top" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ preg_replace('/(\w)\(/', '$1 (', $accounts->address) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>GST Number</strong></td>
                                    <td align="left" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141"> {{ ($accounts->city != "Dubai") ? $accounts->gst_number : '' }}
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
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ $accounts->comp_title.' '.$accounts->company_name }}</td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-family: 'Inter', sans-serif; width: 35%;"><strong>Contact Person</strong></td>
                                    <td align="left" style="width: 20px;">:</td>
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ ($accounts->shipping_title) ? $accounts->shipping_title : $accounts->title }} {{ ($accounts->shipping_firstname) ? $accounts->shipping_firstname : $accounts->firstname }} {{ ($accounts->shipping_lastname) ? $accounts->shipping_lastname : $accounts->lastname }}
                                    </td>
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
                                    <td align="left" style="font-family: 'Inter', sans-serif; color:#464141">{{ ($accounts->city != "Dubai") ? $accounts->gst_number : '' }}
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
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 16px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid #000000;">S.No</th>
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 16px; padding-bottom: 10px; padding-left: 0px; border-bottom: 1px solid #000000;">Description</th>
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 16px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid #000000;">Quantity<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(Nos)</span></th>
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 16px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid #000000;">Unit price<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(INR)</span></th>
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; font-size: 16px; padding-bottom: 10px; padding-left: 10px; border-bottom: 1px solid #000000;">Total<br><span style="font-size: 12px; color:#464141; font-weight: 400;">(INR)</span></th>
                        </tr>
                    
                         
                        <tbody style="color:#464141">
                            @if(count($pinfo)>0)
                            @foreach($pinfo as $key => $value)
                            <tr style="padding-left: 15px;">
                                <td style="font-family: 'Inter', sans-serif; padding-left: 15px;">{{$value->item_no}}</td>
                                <td style="font-family: 'Inter', sans-serif;">{{$value->description}}</td>
                                <td style="font-family: 'Inter', sans-serif; padding-left: 35px;">{{$value->quantity}}</td>
                                <td style="font-family: 'Inter', sans-serif; padding-left: 10px;"><p style="width:65px;text-align:right;">{{ number_format($value->unit ?? 0, 2) }}</p></td>
                                <td style="font-family: 'Inter', sans-serif; padding-left: 10px;"><p style="width:65px;text-align:right;">{{number_format($value->totalamount ?? 0, 2)}}</p></td>
                            </tr>
                            @endforeach
                            @endif
                        
                        </tbody> 
                            
                    </table>
            
                    <table style="border-collapse: separate; border-spacing: 0 0px; width: 100%; font-size: 13px;">
                        <colgroup>                    
                            <col style="width: 52%;">
                            <col style="width: 22%;">
                            <col style="width: 22%;">
                        </colgroup>
                        <tr>
                            <th style="text-align: left; font-family: 'Work Sans', sans-serif; padding-left: 15px; padding-top: 10px; border-top: 1px solid black; border-right: 1px solid black;">Key Notes: <br><br>
                                <span style="font-family: 'Inter', sans-serif; font-weight: 400;">
									{{$proforma->paymentterms}}
								</span>
							</th>
							<div style="display:flex;align-items:center;justify-content:right;position: absolute;left: 35%;right: 30%;top: 60%;background-color:#fff;    z-index: -2;">
							<img src="https://appacmedia.in/oldcrm/imgs/appac-watermark.svg" class="" style="width:320px;background-color:#fff;" /></div>
								
                            @if($proforma->specialdiscount !='0')
							<th style="text-align: right; border-top: 1px solid black; padding: 10px 0px 0px 0px;font-size:13px">Total Amount Rs. </th>
							@else
							<th style="text-align: right; border-top: 1px solid black; padding: 10px 0px 0px 0px;font-size:13px">Total Netpay Rs. </th>
							@endif

							@if($proforma->specialdiscount !='0')
							<th style="text-align: right; border-top: 1px solid black; padding-right: 35px; padding-top: 10px;font-size:13px">{{number_format($proforma->amount ?? 0,2)}}</th>
                            @else
							<th style="text-align: right; border-top: 1px solid black; padding-right: 35px; padding-top: 10px;font-size:13px">{{number_format($proforma->netpay ?? 0,2)}}</th>
							@endif
                        </tr>
						
                        <tbody>												
							<tr style="padding-left: 10px;">
								<td align="right" style="border-right: 1px solid black;"></td>
							
                                @if($proforma->specialdiscount !='0')
									<td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 0px 0px;"><b>Special Discount Rs.</b></td>
                                @endif
									
                                @if($proforma->specialdiscount !='0')
								<td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px;"><b>{{number_format($proforma->specialdiscount ?? 0,2)}}</td>                       
                                @endif   
                                                          								
							</tr>
							
							<tr style="padding-left: 10px;">
								<td align="right" style="border-right: 1px solid black;"></td>
								@if($proforma->netpay !='0')
									<td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 0px 0px;"><b>Total Netpay Rs.</b></td>
                                @endif
									
								@if($proforma->netpay !='0')
								<td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px;"><b>{{number_format($proforma->netpay ?? 0,2)}}</td>                       
								@endif
							</tr>
																											
                            <tr style="padding-left: 10px;">
                                <td align="right" style="border-right: 1px solid black;"></td>
                              
                                @if($proforma->taxvalue=='sgst')
                                    <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 0px 0px;"><b>CGST- 9%</b></td>
                                @elseif($proforma->taxvalue=='igst')
                                    <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 0px 0px;"><b>IGST-18%</b></td>                                   
                                @else
                                    <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 0px 0px;"></td>
                                @endif

                                @if($proforma->taxvalue=='sgst')
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px;"><b>{{number_format($proforma->cgst ?? 0, 2)}}</b></td>                       
                                @elseif($proforma->taxvalue=='igst')
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px;"><b>{{number_format($proforma->igst ?? 0, 2)}}</b></td>
                                @else
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px;"></td>
                                @endif

                            </tr>
                            <tr>
                                <td align="right" style="border-right: 1px solid black;"></td>
                                @if($proforma->taxvalue=='sgst')
                                <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 15px 0px;"><b>SGST-9%</b></td>
                                @else
                                <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 15px 0px;"></td>
                                @endif
                                @if($proforma->taxvalue=='sgst')
                               
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px;"><b>{{number_format($proforma->sgst ?? 0, 2)}}</b></td>                        
                                @else
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px;"></td>
                                @endif
                            </tr>
                            <?php
                                $number =$proforma->grosspay;
                                $no = round($number);
                                $point = round($number - $no, 2) * 100;
                                $hundred = null;
                                $digits_1 = strlen($no);
                                $i = 0;
                                $str = array();
                                $words = array(
                                '0' => '', '1' => 'One', '2' => 'Two',
                                '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
                                '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
                                '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
                                '13' => 'Thirteen', '14' => 'Fourteen',
                                '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
                                '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
                                '30' => 'Thirty', '40' => 'Fourty', '50' => 'Fifty',
                                '60' => 'Sixty', '70' => 'Seventy',
                                '80' => 'Eighty', '90' => 'Ninety');
                                $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                                while ($i < $digits_1) {
                                $divider = ($i == 2) ? 10 : 100;
                                $number = floor($no % $divider);
                                $no = floor($no / $divider);
                                $i += ($divider == 10) ? 1 : 2;
                                if ($number) {
                                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                $str [] = ($number < 21) ? $words[$number] .
                                " " . $digits[$counter] . $plural . " " . $hundred
                                :
                                $words[floor($number / 10) * 10]
                                . " " . $words[$number % 10] . " "
                                . $digits[$counter] . $plural . " " . $hundred;
                                } else $str[] = null;
                                }
                                $str = array_reverse($str);
                                $result = implode('', $str);
                                $points = ($point) ?"" . $words[$point / 1] . " " .$words[$point = $point % 10] : '';
                            ?> 
                            <tr>
                                <td align="left" style="font-family: 'Work Sans', sans-serif; border-right: 1px solid black; padding-left: 15px; border-top: 1px solid black; padding-top: 10px; padding-bottom: 10px;"><b style="line-height: 24px;">Amount in Words :</b><br>
                                <span style="font-family: 'Inter', sans-serif; color:#464141">{{ $result . ' Rupees Only' }}</span></td>
                                <td align="right" style="font-family: 'Inter', sans-serif; padding: 10px 0px 15px 0px; border-top: 1px solid black;"><b>Grand Total Rs.</b></td>
                                <td align="right" style="font-family: 'Inter', sans-serif; padding-right: 35px; padding-top: 10px; padding-bottom: 15px; border-top: 1px solid black;"><b>{{number_format($proforma->grosspay ?? 0, 2)}}&nbsp;</b></td>                       
                            </tr>                    
                        </tbody>                
                    </table>
                </table>
            </div>
            <div style="font-family: 'Inter', serif; border: 1px solid black; width:870px; position: relative; top: 50px; margin: auto; margin-top: 5px;" >
                <table style="border-collapse: separate; border-spacing: 0 0px; width: 100%;">
                    <colgroup>                    
                        <col style="width: 100%;">                       
                    </colgroup>
                    <tr>
                        <th style="font-family: 'Work Sans', sans-serif; text-align: left; font-size: 12px; padding-left: 15px; padding-top: 10px; padding-bottom: 8px; ">Invoice Terms & Conditions</th>
                    </tr>
                    <tbody style="color:#464141">
                        <tr style="padding-left: 15px;">
                            <td align="left" ><tr><td style="font-family: 'Inter', sans-serif; padding-left: 15px; font-size: 12px;"><li>This is an application for Appac Mediatech Pvt. Ltd. Order confirmation will be done on Phone / Email.</li></td></tr></td> 
                            <td align="left" ><tr><td style="font-family: 'Inter', sans-serif; padding-left: 15px; font-size: 12px;"><li>All information including text & pictures to be provided by the client who should also be the legal copyright owner of the same.</li></td></tr></td>
                            <td align="left" ><tr><td style="font-family: 'Inter', sans-serif; padding-left: 15px; font-size: 12px;"><li>Appac Mediatech Pvt. Ltd. shall not be liable for any claims / damages arising out of content posted on your website.</li></td></tr></td>
                            <td align="left" ><tr><td style="font-family: 'Inter', sans-serif; padding-left: 15px; font-size: 12px;"><li>Work on services shall commence only after clearance cheque / pay order.</li></td></tr></td>
                            <td align="left" ><tr><td style="font-family: 'Inter', sans-serif; padding-left: 15px; padding-bottom: 10px; font-size: 12px;"><li>Payment to us is covered under advertising contract u/s 194C. TDS, if applicable, will be @ 2%.</li></td></tr></td>
                        </tr>                    
                    </tbody>                
                </table>
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
                            <td style="padding-left: 15px; padding-right: 15px;vertical-align: top; border-top: 1px solid black;">
                                <div style="font-family: 'Work Sans', sans-serif; padding-top: 10px; font-size: 12px; padding-bottom: 8px;">
                                    <b>Bank Details:</b>
                                </div>
                                <div style="font-family: 'Inter', sans-serif; font-size: 12px; padding-bottom: 3px; color: #464141;    width: 90%;">
                                    A/C No : <b style="font-family: 'Inter', sans-serif; color: #000;">034205009385</b> IFSC Code : <b style="font-family: 'Inter', sans-serif; color: #000;">ICIC0000342, ICICI Bank, R.S.Puram,</b> Coimbatore, Tamil Nadu, INDIA.
                                </div>
                                <div style="font-family: 'Inter', sans-serif; padding-bottom: 10px; font-size: 12px;position:relative; color: #464141;border-bottom:1px solid #000;">
                                    Mode of Payment Preferred: <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">NEFT/RTGS</b>
                                </div>
                                <div style="font-family: 'Inter', sans-serif;padding-top: 10px; padding-bottom: 3px; font-size: 12px; color: #464141;">
                                    <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">Note</b> : Cheque / Draft to be made in the favour of <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">APPAC MEDIATECH PVT. LTD.</b>
                                </div>
                                <div style="font-family: 'Inter', sans-serif; font-size: 12px; padding-bottom: 3px; color: #464141;">
                                    <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">PAN</b> : AAQCA4617E &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">GST No :</b> 33AAQCA4617E1ZU &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">TAN :</b> CMBA09095C
                                </div>
                                <div style="font-family: 'Inter', sans-serif; padding-bottom: 10px; font-size: 12px; color: #464141;">
                                    <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">SAC CODE</b> : 9983 &nbsp;&nbsp;|&nbsp;&nbsp; <b style="font-family: 'Inter', sans-serif; font-weight: 500; color: #000;">LUT No :</b> AD330419005161L
                                </div>
                            </td>

                            <!-- Right side: SAC CODE -->
                            <td style=" font-family: 'Inter', sans-serif; padding-bottom: 10px; border-left: 1px solid black; border-top: 1px solid black; vertical-align: bottom;">
							<div style="font-family: 'Inter', sans-serif; font-size: 8px;padding-bottom: 65px; text-align:center;">This is a digitally signed invoice.<br> No physical signature is necessary.</div>
                                <div><img src="https://appacmedia.in/oldcrm/imgs/sign.jpg" style="width: 100px; display: block; margin: auto; margin-bottom: -10px; background-color:#fff;" alt="sign"><div style="font-family: 'Inter', sans-serif; font-size: 7px; width: 100px; display: block; margin: auto;">for Appac Mediatech Pvt Ltd</div></div>
                            </td>
                            
                        </tr>
                    </tbody>               
                </table> 
            </div>  
                                
            
        <!-- Footer Content - Ensuring it comes last in the structure -->
        <div style="text-align: center; margin-top: 20px;">
            <div style="margin-bottom:60px;"></div>           
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
    

