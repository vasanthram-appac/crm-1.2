<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Payslip</title>

    <style>
        .flex {
            position: absolute;
            width: fit-content;
            left: 625px;
            top: 175px;
            display: flex;
            gap: 25px;
        }

        .border {
            position: relative;
        }

        .border::after {
            position: absolute;
            bottom: 0px;
            left: -10px;
            width: 102%;
            height: 1px;
            background: #000;
            content: ''
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
    <div style=" font-family: 'Inter', sans-serif; width:870px; position: relative; top: 50px; margin: auto">
        <table border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;font-family: Noto Sans TC, sans-serif;">
            <tbody>

                <tr style="border-right: 1px solid #000;">
                    <td colspan="4" align="left" style="border-right: 0px solid #fff;">
                        <!-- <img src="/img/head-logo.png" style="width:175px;float: left;padding-top: 15px;"> -->
                        <!-- <h3 style="    text-align: center; padding-top: 15px;">APPAC MEDIATECH PRIVATE LIMITED</h3>
                        <p style="font-family: Noto Sans TC, sans-serif;font-size:13px;text-align: center; padding-bottom: 15px;">No : 204, 2nd Floor, Aathisree towers, D.B Road,<br> R.S.Puram, Coimbatore, Tamil
                            Nadu,India - 641002.<br><span style="font-style:normal;font-size:13px;">Ph: + 91 422-4354854 | +91 636 928 6774</span>
                            <br>
                            <span style="font-style:normal;font-size:13px;">Mail: info@appacmedia.com | www.appacmedia.com</span>
                            <br>
                            <span style="font-style:normal;font-size:13px;">PAN : AAQCA4617E / TAN : CMBA09095C</span>
                        </p> -->

                        <div class="wid" style="padding-top: 12px; padding-bottom: 12px;">
                            <div class="head_grid" style="width: 870px; margin:auto; display: grid; grid-template-columns: 30% 70%; align-items: end;background-color:#fff;">
                                <img src="/img/head-logo.png" alt="" style="width: 198px; padding-left: 10px;background-color:#fff; padding-bottom:35px;">
                                <div class="head_add" style="width: 100%; padding-bottom: 9px; padding-left: 100px;">
                                    <b style="font-family: 'Work Sans', sans-serif; font-size: 20px; font-weight: 800; line-height: 35px; color:#221b53;">APPAC MEDIATECH PVT. LTD.</b><br>
                                    <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">#204, 2nd floor, Aathisree Towers, DB Road, R S Puram,</span><br>
                                    <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">Coimbatore - 641 002. Tamil Nadu. India.</span><br>
                                    <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">+91 422 435 4854 | +91 63692 86774</span><br>
                                    <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">Email: info@appacmedia.com</span><br>
                                    <span style="font-family: 'Inter', sans-serif; font-size: 14px; font-weight: 400; line-height: 25px;">Web: www.appacmedia.com</span>
                                </div>

                            </div>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td colspan="4" align="center" style="padding: 8px 0px 8px 0px;"><b>Payslip for the month of {{ $monthName }} - {{ $monthName1 }}</b></td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Employee Name</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $fname . $lname }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Emp Id</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $empid }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Date of Joining</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $doj }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Bank Name</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $bankname }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Department</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $department }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Account Number</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $acno }}</td>
                </tr>
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;justify-content:right;position: absolute;left: 300px; background-color:#fff;    z-index: -2;">
                            <img src="/asset/image/appac-logo.png" class="" style="width:320px;background-color:#fff; opacity: 0.2;" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Designation</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $designation }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">PAN No</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $panno }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Total Working Days</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $days }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">PF No</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Worked Days </td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $tot_lop }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">ESI No</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
                </tr>

                <tr>
                    <td colspan="4" align="center" style="height:20px">

                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center" style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Earnings</b></td>
                    <td colspan="2" align="center" style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Deductions</b></td>
                </tr>
                <tr>
                    <td style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Particulars</b></td>
                    <td style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Amount</b></td>
                    <td style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Particulars</b></td>
                    <td style="padding: 8px 5px 8px 8px; font-size: 14px;font-weight:500;color: #000;"><b>Amount</b></td>
                </tr>

                <tr>
                    
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;"></td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">PF</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $pf }}</td>
                </tr>
                 <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Basic Salary</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $basic }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">ESI</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $esi }}</td>
                </tr>

                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Conveyance allowance</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $conveyance }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Professional Tax</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $pt }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">HRA</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $hra }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">TDS</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $tds }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Special allowance</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $special }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Others</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $other }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Performance Incentive</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $specl_amt }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">LOP</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $lop }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Total Rs.</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $total }}</td>
                    <td style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">Total Rs.</td>
                    <td align="right" style="padding: 5px 5px 5px 8px; font-size: 12px;font-weight:400;color: #000;">{{ $totaldect }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="height:20px"> </td>
                </tr>
                <?php
                $number = $netsalary;
                $no = round($number);
                $point = round($number - $no, 2) * 100;
                $hundred = null;
                $digits_1 = strlen($no);
                $i = 0;
                $str = array();
                $words = array(
                    '0' => '',
                    '1' => 'One',
                    '2' => 'Two',
                    '3' => 'Three',
                    '4' => 'Four',
                    '5' => 'Five',
                    '6' => 'Six',
                    '7' => 'Seven',
                    '8' => 'Eight',
                    '9' => 'Nine',
                    '10' => 'Ten',
                    '11' => 'Eleven',
                    '12' => 'Twelve',
                    '13' => 'Thirteen',
                    '14' => 'Fourteen',
                    '15' => 'Fifteen',
                    '16' => 'Sixteen',
                    '17' => 'Seventeen',
                    '18' => 'Eighteen',
                    '19' => 'Nineteen',
                    '20' => 'Twenty',
                    '30' => 'Thirty',
                    '40' => 'Fourty',
                    '50' => 'Fifty',
                    '60' => 'Sixty',
                    '70' => 'Seventy',
                    '80' => 'Eighty',
                    '90' => 'Ninety'
                );
                $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
                while ($i < $digits_1) {
                    $divider = ($i == 2) ? 10 : 100;
                    $number = floor($no % $divider);
                    $no = floor($no / $divider);
                    $i += ($divider == 10) ? 1 : 2;
                    if ($number) {
                        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                        $str[] = ($number < 21) ? $words[$number] .
                            " " . $digits[$counter] . $plural . " " . $hundred
                            :
                            $words[floor($number / 10) * 10]
                            . " " . $words[$number % 10] . " "
                            . $digits[$counter] . $plural . " " . $hundred;
                    } else $str[] = null;
                }
                $str = array_reverse($str);
                $result = implode('', $str);
                $points = ($point) ? "" . $words[$point / 1] . " " . $words[$point = $point % 10] : '';
                ?>

                <tr>
                    <td colspan="2" style="padding: 8px 5px 8px 8px; font-size: 14px; width:100px;"> <b>Amount in Words : </b> {{ $result . ' Rupees Only' }}</td>
                    <td style="padding: 8px 5px 8px 8px; font-size: 16px;font-weight:500;color: #000;"><b>Net Salary Rs.</b></td>
                    <td align="right" style="padding: 8px 5px 8px 8px; font-size: 16px;font-weight:800;color: #000;">{{ $netsalary }}</td>
                </tr>
                <tr>
                    <td colspan="4" style="height:40px"> </td>
                </tr>
                <tr>
                    <td colspan="4" align="center" style="border-top: 1px solid #fff;font-size:12px;height:20px">
                        <p>This is a computer generated payslip and does not require a signature</p>
                    </td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    </div>

    <script type="text/javascript">
        function PrintDiv() {
            var divToPrint = document.getElementById('divToPrint');
            var popupWin = window.open('', '_blank', 'width=1024,height=762');
            popupWin.document.open();
            popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
        }
    </script>

</body>

</html>