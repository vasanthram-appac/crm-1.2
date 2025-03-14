<?php

$empidvalue = request()->session()->get('empid');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Offer Proposal PDF</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="shortcut icon" href="imgs/favicon.png">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" href="imgs/favicon.png">
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />

    <link rel="stylesheet" href="assets/bootstrap-toggle-buttons/static/stylesheets/bootstrap-toggle-buttons.css" />
    <link rel="stylesheet" type="text/css" href="assets/bootstrap-daterangepicker/daterangepicker.css" />
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!--script src="https://cdn.tiny.cloud/1/xh7r7dcuoa96ua983bqxc32eplvv2uw7ecs24gs5w23mxgfu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        h1, h2, h3, h4, h5, h6, th {font-family:'inter', sans-serif !important;color:#100C41}

        #pdf_Content {
            overflow-y: scroll;
            background: #fff;
        }

        .wellness .container.first{width:80% !important;max-width:80% !important;}

        .wellness .footer,
        .wellness .delo {
            opacity: 0 !important;
        }

        .page .container {

            background-image: url('{{ asset('img/coverpdf.jpg') }}') !important;
            background-size: cover !important;
            background-position: 0px 0 !important;
        }

        .wellness .cover_page {
            margin: 0px auto !important;
            height: 100%;
            width: auto;
        }

        .wellness .cover_page {
            background-image: url('{{ asset('img/proposal_cover.jpg') }}') !important;
            background-size: cover;
            background-position: top right;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 209mm;
            height: 1120px;
            max-width: 209mm;
            margin: 0px 10mm;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* .wellness .cover_page {display: flex; align-items: center; justify-content: center; width: auto !important;} */
        .wellness .pdf-body {
            height: 100%;
            margin: auto;
            width: 100%;
        }

        .wellness .pdf_page {
            /* width: 100%; */
            height: 100%;
            /* position: relative; */
            padding: 10px 60px;
            top: -60px;
            z-index: 5;
        }

        .wellness .cover_div {
            margin: auto;
            width: 100%;
            text-align: center;
            DISPLAY: FLEX;
            FLEX-DIRECTION: column;
            height: 100%;
            justify-content: space-between;
        }

        .wellness .cover_div {
            padding-top: 0px;
            margin-left: 0;
        }

        .d-flex {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .flex {
            display: flex;
            gap: 5px;
        }

        .wellness .page {
            height: 1090px;
            margin: 3px auto;
        }

        .wellness .container {
            width: 209mm;
            height: 1120px;
            max-width: 209mm;
            margin: 0px auto;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .wellness .pad {
            position: relative;
            padding: 10px 60px;
            top: -60px;
            z-index: 5;
        }

        .wellness .delo {
            display: flex;
        }

        .wellness .logo_div {
            width: 100%;
            padding-right: 45px;
            display: flex;
            justify-content: end;
            margin-bottom: 10px;
            align-items: center;
        }

        .wellness .des_div img {
            width: 350px;
            position: relative;
            z-index: 1 !important;
        }

        .wellness .title_a h1 {
            color: #031d4e;
            font-size: 50px;
            font-weight: 600 !important;
            font-family: sans-serif !important;
        }

        .wellness .title_a h2 {
            color: #021d4d;
            font-weight: 300 !important;
            font-size: 20px;
            font-family: sans-serif;
        }

        .wellness .title_a h3 {
            font-size: 20px;
            font-weight: 600 !important;
            margin: -10px 0px -5px 0px;
            color: black !important;
            font-family: sans-serif;
        }

        .wellness .title_a P {
            font-size: 20px;
            color: #041e4e !important;
        }

        .wellness .title_a .date {
            padding-bottom: 0px;
        }

        .wellness .title_a .valid {
            font-size: 16px;
        }

        .wellness .title_b {
            margin-bottom: 75px;
        }

        .wellness .title_b h3 {
            font-size: 20px;
            font-weight: 600 !important;
            color: black !important;
            font-family: sans-serif;
            color: #042565 !important;
            margin: 0px;
        }

        .wellness .title_b p {
            font-size: 14px;
            color: #051f50 !important;
        }

        .wellness .title_b .split {
            font-size: 14px;
            color: black !important;
        }

        .wellness .title_b .rdx {
            color: #021c4d !important;
            font-weight: 600;
            padding: 5px;
            border: 1px solid black;
            width: 60%;
            margin: auto !important;
            border-radius: 15px !important;
        }



        .wellness h4 {
            font-size: 25px !important;
            color: #211d51 !important;
            padding-top: 20px !important;
            font-weight: 600 !important;
            font-family: sans-serif !important;
        }

        .wellness h5 {
            font-size: 15px !important;
            color: #211d51 !important;
            padding-top: 0px !important;
            font-weight: 800 !important;
            font-family: sans-serif !important;
            margin-bottom: 0px;
        }

        .wellness li {
            list-style: none;
            font-size: 13px !important;
            font-weight: 400 !important;
            padding: 5px 0px !important;
            color: black !important;
        }

        .wellness p {
            padding: 5px 0px 10px 0px;
            line-height: 21px;
            font-size: 13px;
            color: black !important;
            margin: 0px !important
        }

        .wellness .reduce p {
            padding: 3px 0px 3px 0px;
            line-height: 25px;
            font-size: 13px;
            color: black !important;
            margin: 0px !important;
        }

        .wellness .reduce .strong {
            padding-top: 15px;
        }

        .wellness .lean {
            font-weight: 300 !important;
        }

        .wellness .footer {
            width: 212mm;
            margin-left: 0px;
        }

        .wellness .footer img {
            width: 100%;
            margin-bottom: 40px;
        }

        .wellness td {
            font-size: 14px;
            padding: 5px 10px;
            border: 1px solid;
        }

        .wellness td p {
            line-height: 20px;
            padding: 0px 10px !important;
        }

        .wellness .ti_table .nb:nth-child(1) {
            border-top: 1px solid #000 !important;
            border-bottom: 0px !important
        }

        .wellness .ti_table .nb:nth-child(1) td {
            border-top: 1px !important;
            border-bottom: 0px !important
        }

        .wellness .ti_table .nb {
            border-top: 0px !important;
            border-bottom: 0px !important
        }

        .wellness .ti_table .nb td {
            border-top: 0px !important;
            border-bottom: 0px !important
        }

        .wellness .ti_table .nb p {
            padding: 0px 10px !important;
        }

        .wellness .ti_table .val_flex {
            display: flex;
            gap: 5px;
        }

        .wellness .ti_table .val_flex p {
            padding: 8px 0px 8px 0px !important;
        }

        .inline-fl {
            justify-content: start;
            padding: 0;
        }


        .wellness .thanks_div p {
            padding: 0px 0px 3px 0px !important;
            font-size: 13px;
        }

        .wellness .thanks_div h3 {
            margin: 0px;
        }

        .wellness .thanks_div {
            padding: 50px;
        }


        /* page-break-before: always; Force each .page div to start on a new page */

        .wellness .coverpage {
            height: 100%;
            max-width: 760px;
            width: auto;
            margin: 0px;
            background-color: #4bacc6;
            display: flex;
            align-items: end;
            align-content: end;
        }

        .wellness ul,
        ol {
            padding: 0px;
        }

        .wellness table,
        h2,
        p,
        ul {
            page-break-inside: avoid;
            /* Prevent breaking inside these elements */
        }

        .wellness .italic {
            font-style: italic;
            font-weight: 100;
            padding: 3px 10px 1px 10px;
        }

        .wellness .empty {
            height: 16px;
        }

        .wellness .line {
            background-color: #f8f8f8;
            height: 2px;
            width: 100%;
            display: block;
            margin: 10px 0px;
        }

        .wellness .thanks_div {
            text-align: center;
        }

        .wellness .empty,
        tr,
        th {
            height: 16px;
        }

        .wellness table {
            width: 100%;
            border: 1px;
            outline: 1px;
            border-collapse: collapse;
        }

        .wellness tr {
            border-top: 1px solid;
            border-right: 1px solid;
            border-left: 1px solid;
        }

        .wellness table tr:last-child {
            border-bottom: 1px solid;
        }

        /* .wellness_table tr td:nth-child(2){border-left: 1px solid;} */


        .wellness footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background-color: #333;
            color: #fff;
        }

        .wellness footer a {
            color: #fff;
            text-decoration: underline;
        }

        .wellness .hidden {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            overflow-y: hidden !important;
            visibility: visible !important;
        }

        .wellness .hidden::after {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            height: auto;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 10px;
            z-index: 1;
        }

        .wellness .visible {
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            filter: none;
            /* Ensure no blur effect when visible */
        }

        .internalUL li {
            padding-left: 20px;
        }

        .wellness .spc {
            margin-top: -35px;
        }

        .wellness .arrow-ul {
            padding-left: 0px;
        }

        .lstyle {
            padding-left: 20px;
        }

        .lstyle li {
            list-style: disc;
        }

        .wellness .wellnesss_head {
            background-color: #00b7ce;
            color: #fff;
            border: 1px solid black;
        }

        .wellness_table tr td {
            border: 1px solid #00b7ce;
        }

        .wellness_table tr td:first-child {
            border-left: 1px solid #000;
        }

        .wellness_table tr td:last-child {
            border-right: 1px solid #000;
        }

        .wellnesss_head.noborder th {
            border-bottom: 1px solid #00b7ce !important;
        }

        .wellnesss_head.noborder {
            border-bottom: none !important;
        }

        .notopborder {
            border-top: none !important;
            border-bottom: none !important;
        }

        .wellness_table tr:last-child td {
            border-bottom: 1px solid #000;
        }

        .wellness .tc p {
            text-align: center;
        }

        .wellness .tc {
            text-align: center;
        }

        .cos_tab tr td {
            border: 1px solid #43cadb;
            color: black !important;
        }

        .cos_tab tr td:last-child {
            border-left: 1px solid #43cadb;
        }

        .wellness .thanks_div a {
            text-decoration: none;
            color: #000000;
        }

        .wellness .arrow-ul .gap {
            display: flex;
            gap: 3px;
        }

        .wellness .arrow-ul li svg {
            margin-right: 20px;
        }

        .wellness .lstyle {
            padding-left: 50px;
        }

        .wellness .sp {
            margin-top: -8px;
        }

        .wellness .reduce {
            padding: 0px;
        }

        /* input css */
        body {
            background-color: #f4f5f7;
        }
        .dBtn{
           border-radius:10px;
           border:none;
        }
        .dBtn:hover{
            background:#1C69D4 !important;
            color:#fff;
            border:1px solid #1C69D4;
        }
        .pdf_container {
            display: grid;
            width: 100%;
            margin: auto;
            justify-content: center;
            justify-content: center;
            gap: 2%;
            padding: 50px 0px;
            height:730px;
            overflow: hidden;
        }

        .input_div {
            display:flex;
            justify-content:space-between;
            background: transparent;
            height: fit-content;
            flex-wrap:wrap;
            align-items: center;
        }


        .offer p,
        .offer li {
            font-size: 15px;
            line-height: 22px;
        }

        .com_add p {
            margin: 0px;
            text-align: end;
        }

        .emp_add p {
            margin: 0px;
        }

        input {
            outline: none;
            border: 1px solid #cdd3d9;
            border-radius: 3px;
            height: 30px !important;
        }

        .com_add p a {
            text-decoration: none;
            color: #000;
        }

        .com_add p:last-child a {
            color: #0000EE;
        }

        .sign_div {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .sign_div p {
            margin: 0px 0px 50px 0px;
        }

        .input_wrp {
            width: auto;
            height: fit-content;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            margin: 30px;
            column-gap: 20px;
            row-gap: 20px;
        }

        .input_wrp div {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .input_wrp label {
            font-size: 13px;
        }

        .pBtn,
        .dBtn {
            width: fit-content;
            padding: 10px 20px;
            outline: none;
            border: 1px solid
        }

        .pBtn {
            color: #fff;
            background-color: #298ecd;
            border-color: #298ecd;
        }

        .dBtn {
            color: #000;
            background-color: #ffffff00;
            border: 1px solid;
            border-color: #000;
        }

        .button_wrp {
            flex-direction: row;
            margin: 30px;
        }

        .page.last_page {
            height: 771px !important;
        }

        .error-msg {
            font-size: 12px;
            color: #c15656;
        }

        /* #downloadPdfBtn {
            display: none;
        } */

        input {
            width: auto;
            padding: 0px 10px;
        }

        .button_wrp {
            display: flex;
            flex-direction: row;
            gap: 15px;
        }

        ::placeholder {
            padding: 5px 8px;
            /* Firefox */
        }

        .wellness .hidden::after {
            display: block;
        }

        .title_a {
            text-align: center;
        }

        #notification {
            position: fixed;
            bottom: 75px;
            right: 45%;
            background-color: #858383;
            color: white;
            padding: 13px;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            /* Initially hidden */
        }

        .widget-title>h4 {
            color: #fff !important;
            float: left !important;
            font-size: 14px !important;
            font-weight: normal !important;
            padding: 10px 11px 10px 15px !important;
            line-height: 12px !important;
            margin: 0 !important;
            font-family: 'MyriadPro-Regular' !important;
        }

        .btn a {
            color: white;
            text-decoration: none;
        }

        .btn {
            margin-left: 15px;
        }

        .page-title {
            font-size: 28px !important;
            display: block !important;
            font-weight: normal !important;
            margin: 13px 0px 8px 0px !important;
            font-family: 'MyriadPro-Light' !important;
            color: inherit !important;
        }

        .wellness .pg-no {
            text-align: end;
            padding: 0px 60px;
            color: #888888 !important;
        }

        .check-flex {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap;
            justify-content: space-around;
            align-items: center;
        }

        #pdf_Content .page {
            position: relative;
        }

        #pdf_Content .page .pg-no {
            position: absolute;
            bottom: 85px;
            right: 0;
        }

        #pdf_Content .page .pad {
            position: absolute;
            top: 100px;
        }

        .page .currentDate {
            position: absolute;
            top: 25px;
            left: 60px;
        }

        .page .currentTime {
            position: absolute;
            top: 25px;
            left: 138px;
        }




        @media(max-width:1500px) {

            /* .pdf_page {    display: flex;
    align-items: center;
    justify-content: center;} */
            .input_wrp {
                width: auto;
                height: fit-content;
                display: grid;
                grid-template-columns: repeat(1, 1fr);
                margin: 25px;
                column-gap: 20px;
                row-gap: 5px;
            }

            .button_wrp {
                display: flex;
                flex-direction: row;
                margin: 25px;
                gap: 10px;
            }

            .pdf_container {
                width: 100%;
                overflow-x: hidden;
                justify-content: center;
                gap: 3%;
                overflow-y: scroll;
            }

            .wellness .container {
                max-width: 100%;
            }
        }

        body {
            transition: 0.3s linear;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .cover_div {
                width: 100%;
            }

            .title_a p {
                font-size: 18px;
            }
        }

        #pdf_Content .page {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 209mm;
            height: 1120px;
            max-width: 209mm;
        }

        .view-btn {
            padding: 15px;
            background-color: black;
            width: 55px;
            color: white;
        }

        .vertical-line {
            width: 1px;
            height: 80px;
            background-color: #525252;
            margin: 0 10px;
            position: absolute;
            right: 0;
            margin-right: 200px;
            top: 20px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body class="wellness fixed-top">

    <div id="container" class="row-fluid">
        <div class="sidebar-scroll">

        </div>
        <div id="main-content" style="min-height:667px!important;">
            <div class="container first">


                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget appac">


                            <div class="pdf_container">
                                <!-- Input fields -->
                                <div class="input_div">
                                <div class="profile-head my-3">
                                    <h1 class="ch2">Offer Letter</h1>
                                </div>
                                    <!-- <form id="inputForm">
                                        <div class="input_wrp">
                                            <div>
                                                <label>Employee Name*</label>
                                                <input type="text" id="emp_name_input" name="emp_name" placeholder="Enter Employee Name" required>
                                                <span id="emp_nameError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label>Gender*</label>
                                                <div style="flex-direction: row;">

                                                    <input type="radio" id="male" name="gender" value="male" required checked>
                                                    <label for="male" style="padding-right: 20px; padding-top: 10px;"> Male </label>
                                                    <input type="radio" id="female" name="gender" value="female" required>
                                                    <label for="female" style="padding-top: 10px;"> Female </label>

                                                </div>
                                            </div>
                                            <div>
                                                <label for="position">Position*</label>
                                                <input type="text" id="position_input" name="position" placeholder="Enter Position" required>
                                                <span id="positionError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label for="join date">Joining Date*</label>
                                                <input type="date" id="date_of_join_input" name="date_of_join" required>
                                                <span id="date_of_joinError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label for="salary">Salary*</label>
                                                <input type="text" id="salary_input" name="salary" placeholder="Enter Salary" required>
                                                <span id="salaryError" class="error-msg"></span>
                                            </div>

                                            <div>
                                                <label for="empstreet">Street*</label>
                                                <input type="text" id="emp_street_input" name="emp_street" placeholder="Enter Street" required>
                                                <span id="emp_streetError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label for="emptown">Town*</label>
                                                <input type="text" id="town_input" name="town" placeholder="Enter Town" required>
                                                <span id="townError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label for="city">City*</label>
                                                <input type="text" id="city_input" name="city" placeholder="Enter City" required>
                                                <span id="cityError" class="error-msg"></span>
                                            </div>
                                            <div>
                                                <label for="pin_code">PIN Code*</label>
                                                <input type="number" id="pin_input" name="pin" placeholder="Enter PIN Code" maxlength="6" required>
                                                <span id="pinError" class="error-msg"></span>
                                            </div>
                                            
                                        </div>
                                        <div class="button_wrp">
                                            <button type='button' class="pBtn" id="previewBtn">Submit</button>
                                            <button class="dBtn" id="downloadPdfBtn">Download PDF</button>
                                        </div>
                                    </form> -->
                                    <button class="dBtn" id="downloadPdfBtn">Download PDF</button>
                                </div>

                                <!-- PDF content -->
                                <div id="pdf_Content" >

                                    <div class="page ">
                                        <div class="container">

                                            <div class="" style="position: absolute; right:0; padding-right: 220px; top:10px;">
                                                <ul>
                                                    <li style="font-size: 9px !important; padding: 0px !important; line-height: 16px; font-size:15px;"><b> APPAC MEDIATECH PVT. LTD.</b></li>
                                                    <li style="font-size: 9px !important; padding: 0px !important; line-height: 14px;">#204, 2nd floor, Aathisree Towers, DB Road, R S Puram,</li>
                                                    <li style="font-size: 9px !important; padding: 0px !important; line-height: 14px;">Coimbatore - 641 002. Tamil Nadu. India.</li>
                                                    <li style="font-size: 9px !important; padding: 0px !important; line-height: 14px;"> +91 422 435 4854 | +91 63692 86774</li>
                                                    <li style="font-size: 9px !important; padding: 0px !important; line-height: 14px;">Email: info@appacmedia.com | Web: www.appacmedia.com</li>

                                                </ul>
                                            </div>
                                            <div class="vertical-line"></div>


                                            <div class="" style="margin-top: 150px;">
                                                <div class="pdf_page ">

                                                    <h5 style="line-height: 30px;">To, </h5>


                                                    <p style="line-height: 7px;"> {{$offer->gender}}. {{$offer->emp_name}},</p>
                                                    <p style="line-height: 7px;">{{$offer->street}},</p>
                                                    <p style="line-height: 7px;">{{$offer->town}},</p>
                                                    <p style="line-height: 7px;">{{$offer->city}} - {{$offer->pin_code}}.</p>


                                                    </br>

                                                    <h5>Dear {{$offer->emp_name}},</h5>
                                                    <p style="padding: 10px 0px 10px 0px;">This refers to discussions on your interest in employment opportunity at Appac Mediatech Pvt. Ltd.
                                                        We are pleased to make an offer as <strong>{{$offer->position}} </strong> based at <strong>Coimbatore. </strong> Your cost to the
                                                        company will be <strong>INR </strong><strong> {{$offer->salary}} </strong><strong> per annum</strong> ({{$offer->words}}) Inclusive of all benefits.</p>
                                                    <p style="padding: 10px 0px 10px 0px;">We would be keen to have you join our services on <strong>{{date('d-M-Y',strtotime($offer->joining_date))}}</strong> . Please communicate your acceptance
                                                        through email and send a signed hard copy of this letter to us at the earliest.</p>
                                                    <p style="padding: 10px 0px 10px 0px;">Regular letter of appointment will be issued soon after you report for duty and submit documents and
                                                        information as detailed in the attached list.</p>
                                                    <p style="padding: 10px 0px 10px 0px;">We once again thank you for your interest in Appac Media and looking forward to your joining our
                                                        young and vibrant team.</p>
                                                    <p style="padding: 10px 0px 10px 0px;">Yours faithfully,</p>
                                                    <p style="padding: 10px 0px 10px 0px;">For Appac Mediatech Pvt. Ltd</p>
                                                    <br> <br> <br>
                                                    <img src="{{asset('imgs/sign.jpg')}}" style="width: 150px; display: block;  margin-bottom: -10px;" alt="sign">
                                                    <p style="padding: 10px 0px 10px 0px;">AUTHORIZED SIGNATORY</p>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">

                                                <h5>Dear {{$offer->emp_name}},</h5>
                                                <p style="padding: 10px 0px 25px 0px;">The following details are mandatory and important at the time of joining-:</p>

                                                <p style="padding:0px;">1) Proof of Age - Photo copy of Passport or Adhaar card or Driver’s License</p>
                                                <p style="padding:0px;">2) 2 Passport size photographs of self</p>
                                                <p style="padding:0px;">3) Emergency contact numbers</p>
                                                <p style="padding:0px;">4) Blood Group</p>
                                                <p style="padding:0px;">5) Photocopy of PAN card</p>
                                                <p style="padding:0px;">6) Photocopy of Education Certificates</p>
                                                <p style="padding:0px;">7) Photocopy of Relieving Letter from your previous organization</p>
                                                <p style="padding:0px;">8) 2 Official References</p>
                                                <p style="padding:0px;">9) Bank Account details</p>

                                                <p style="padding: 35px 0px 10px 0px;">Kindly arrange for all the above-mentioned, before/on your joining day.</p>
                                            </div>
                                            <p class="pg-no">Page no 1
                                            <p>
                                                <!-- <div class="footer"></p><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">
                                                <h5>General Terms & Conditions of Employment</h5>

                                                <h5>Appointment</h5>

                                                <p>An appointment to the service of the company is only effective when the successful applicant has
                                                    confirmed acceptance of our offer of employment by returning the offer duly singed, and Certified, by
                                                    having singed on our Personal information Form, that the information provided to the company there-
                                                    in, is true and correct.</p>

                                                <h5>1) Variation to Terms of Employment</h5>
                                                <p>The company reserves the right to alter an employee’s terms and conditions of employment including
                                                    duties and responsibilities, and to transfer or second them to other department, divisions or locations.
                                                    Any such transfer or secondments will not break their period of continuous employment. All employ-
                                                    ees must be prepared at any time to undertake duties (other than or in addition to those for which
                                                    you were specially engaged) at any such location which the company may require from time to time.</p>

                                                <h5>2) Working Hours</h5>

                                                <p>The working hours are 9:00 a.m. to 6:00 p.m. Monday through to Friday and 9:00 a.m. to 5:00 p.m. on
                                                    alternative Saturday (with one-hour for lunch). However, depending on the nature of operation of their
                                                    department, an employee may be assigned a work schedule other than the above. In which case, they
                                                    should follow the office hours specified in their letter of employment or the instruction from their
                                                    Manager.</p>

                                                <p>In the course of performing their duties, if an employee is unable to meet his/her work commitments
                                                    in the above stipulated office times, they are expected to work different or longer hours, to ensure
                                                    proper performance of their duties in line with business expectations.</p>

                                                <h5>3) Salary Payments</h5>
                                                <p>Salary & other allowances are paid by the end of each month or on the 1st working day of the next
                                                    month. An employee's pay is automatically credited to their nominated bank account. All taxes as
                                                    applicable in any fiscal year will be deducted at source before crediting their bank account.</p>

                                                <p>During employment, the Company is entitled to deduct from an employee's salary and emoluments or
                                                    awards arising from your employment such as:</p>

                                                <ul>
                                                    <li>Any overpayment of remuneration or benefits made to them</li>
                                                    <li>Any deductions required by the government at any time in the future</li>


                                                </ul>


                                            </div>
                                            <p class="pg-no">Page no 2
                                            <p>
                                                <!-- <div class="footer"><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">


                                                <ul>
                                                    <li>Any unaccounted expenditure of company funds that you have not settled within 30 days; or</li>
                                                    <li>Any other sums which they owe to the Company</li>
                                                </ul>


                                                <h5>4) Notice Periods</h5>

                                                <p>The company employs people with the view that they will have a long-term career with us. However if
                                                    it becomes necessary for an employee to leave the employment or the Company, either party will have
                                                    to give notice in writing or the equivalent salary in-lieu, in accordance with the prevailing
                                                    notice requirement.</p>

                                                <p>Unless an employee has been notified in writing of a different entitlement in their letter of offer of
                                                    employment, the following applies.</p>

                                                <h5>5) Duration To Be Given By Employee Or The OrganisatioN IS ONE MONTH.</h5>
                                                <p>Important: In such matters, management’s decision is final.</p>

                                                <h5>6) Salary Reviews</h5>

                                                <p>The first salary review for an employee is normally done at the end of 6 months of his continuous
                                                    employment with the company. Thereafter, individual salaries will be normally reviewed after every
                                                    nine 9 months of continuous & success employment. Any increase is determined primarily on merit,
                                                    but the general level of pay increases within the industry, and will also take into consideration the
                                                    performance of the company.</p>
                                                <p>Any increase is entirely within the Company's discretion. You should note that the annual review does
                                                    not guarantee an increase in salary, as this depends very much on the circumstances of each in terms
                                                    of your level, position within the organization, future career development within the Company / Firm
                                                    and the performance of the company at large.</p>
                                                <h5>7) Confidentiality</h5>
                                                <p>It is the policy of the Company that all information pertaining to the compensation package of every
                                                    employee shall remain confidential. Employees are not permitted to discuss with or disclose to
                                                    colleagues or anybody else outside, such information e.g., salary, increments and benefits
                                                    entitlements.</p>

                                                <h5>8) Public Holidays</h5>

                                                <p>The Company will select 10 festival holidays from the published list of annual holidays and will allow 2
                                                    additional discretionary (Restricted / RH) holiday that can be selected on an individual basis based on
                                                    their choice. The company will review the list of selected holidays annually, and inform employees of
                                                    any changes.</p>


                                            </div>
                                            <p class="pg-no">Page no 3
                                            <p>
                                                <!-- <div class="footer"><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">



                                                <h5>9) Annual Leave</h5>
                                                <p>In addition to the statutory holidays, employees are also entitled to an annual leave of 12 days after
                                                    completion of one full year.</p>

                                                <p>In order to maintain sufficient resources and to minimize interference with daily operations, an
                                                    employee should inform their manager in advance of their planned annual leave schedule.</p>
                                                <h5>10) Unused Leave Balance</h5>
                                                <p>Employees are encouraged to take all their annual leave entitlement by the Completion of one year as
                                                    per his / her joining of each year. In exceptional cases, with the prior approval of the Department Head,
                                                    this can be carried forward to no more than one more year.</p>
                                                <h5>11) Obligations after Termination of Employment</h5>
                                                <p>For the protection by the company of its business interests, and in particular, Its confidential
                                                    information, customer and client connections and the maintenance of a stable work force, all
                                                    employees must agree and covenant with the Company collectively that:</p>
                                                <p>1. They shall during the 12-month period after the date of termination of their employment either on
                                                    their own account or in conjunction with, or on behalf of, any other person solicit or entice away or
                                                    endeavour to solicit or entice away or assist any other person whether by means of the supply of
                                                    names or expressing views on suitability or otherwise howsoever to solicit or entice way from the
                                                    Company any individual:</p>
                                                <p>Who is an employee or director of any member of the Company?</p>
                                                <p>Or</p>
                                                <p>Who is contracted to render services to the Company and / or any member of the Company</p>
                                                <p>and in either case with whom the employee have had business dealings during the twelve month
                                                    period immediately preceding the termination of their employment with the Company, whether or not
                                                    any such person would commit a breach of contract by reason of his/her leaving service;</p>

                                                <p>All employees shall not during the six-month period after the date of termination of their employment
                                                    either on their own account or in conjunction with, or on behalf of, any person solicit, interfere with or
                                                    entice away or attempt to solicit, interfere with or entice away any person who is a Restricted Client;
                                                    and All employees shall not during the six-month period after the date of termination of their
                                                    employment either on their own account or in conjunction with, or on behalf of, any other person
                                                    have business dealings, directly or indirectly, with any person who is a Restricted Client.</p>


                                            </div>
                                            <p class="pg-no">Page no 4
                                            <p>
                                                <!-- <div class="footer"><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">


                                                <p>However they are not prohibited by any of these restrictions from seeking or doing business with a
                                                    Restricted Client that is not in direct or indirect competition with the Restricted Business.</p>

                                                <p>If any provision of these obligations after employment are determined to be illegal or unenforceable by
                                                    any court of law or any competent governmental or other authority, the remaining obligations and the
                                                    remainder of the contract of employment shall be severable and enforceable in accordance with their
                                                    terms so long as their contract of employment without such terms or provisions does not fail of its
                                                    essential purpose. The employee and the Company shall negotiate in good faith to replace any such
                                                    illegal or unenforceable provisions with suitable substitute provisions which will maintain as far as
                                                    possible their purposes and the effect. If so required by the Company, an employee should also agree
                                                    to enter into separate covenants with any member of the Company to which they are assigned and to
                                                    which they provide their services in a form identical to the covenants set out in this section in order to
                                                    protect the legitimate business interests of the Company.</p>

                                                <p>For these purposes,
                                                </p>
                                                <p>Restricted Business means the activities of the operating division or company of the Company to
                                                    which an employee is assigned and to whom he/she provide his/her services.</p>
                                                <p>Restricted Client means any person, firm or company who or which on the date of termination of their
                                                    employment or at any time during the 12-month period immediately prior to the date of termination
                                                    was a client or customer of the Company in respect of the Restricted Business and with whom or with
                                                    which during the period the employee had business dealings.</p>
                                                <p>For the purpose of this section, the Company is entering into these restrictions with an employee on
                                                    its own behalf and as agent for and/or as trustee of the business of the relevant member of the
                                                    Company to which he/she is assigned and to whom he/she provide his/her services.</p>

                                                <h5>12) Changes to Personal Data</h5>
                                                <p>To ensure that an employee's personal files are kept up-to-date for statutory requirements, emergen-
                                                    cies and for administration of benefit plans, they should notify the Human Resource Department
                                                    immediately of any changes in personal data such as</p>

                                                <p>Addresses, residence telephone numbers, mobile telephone numbers Qualifications
                                                    Changes in lifestyle (e.g., marital. status, addition to family etc,) Nomination of beneficiaries and so on,
                                                </p>





                                            </div>
                                            <p class="pg-no">Page no 5
                                            <p>
                                                <!-- <div class="footer"><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>

                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">
                                                <h5>13) Compliance</h5>
                                                <p>As a result of their duties, an employee may have access to confidential, sensitive or inside informa-
                                                    tion as defined in relevant legislation and/or be in a position that might give the appearance of being,
                                                    in conflict of interests of customers, or clients of the Company or the Company itself.</p>

                                                <p>In addition, as a member of each respective working company employees are bound by confidentiality
                                                    clauses with regards to client specific issues and work carried out. If they work on a dedicated basis
                                                    for a particular client of the Company they are expected to keep all sensitive information to
                                                    themselves and not share with fellow colleagues who may be part of another "client service silo”
                                                    within the Company or any entity within the Company.
                                                </p>
                                                <p>If you have any doubts you should contact the designated compliance officer or account manager for
                                                    relevant advice.</p>

                                                <h5>14) Gross Misconduct & Summary Dismissal</h5>
                                                <p>Gross misconduct is misconduct which, in the opinion of the Company, is serious enough to prejudice
                                                    the business or reputation of the Company or which irreparably damages the working relationship and
                                                    trust between an employee and the Company. It constitutes a fundamental breach of contract and
                                                    may, therefore, lead to summary dismissal, i.e. dismissal without notice or payment in lieu of notice.
                                                    The following are only examples of behaviour which are normally regarded as gross misconduct. The
                                                    examples below are no means exhaustive, but provide some idea on the nature of abuse.</p>
                                                <p>Theft, fraud, providing false and misleading information or any act of dishonesty</p>
                                                <p>Any act or attempted act of violence or abusive behaviour towards people and property</p>
                                                <p>Serious act of insubordination</p>
                                                <p>Serious neglect of duties, or a serious breach of your Conditions of Employment</p>
                                                <p>A deliberate breach of the Employment Policy or designated operating procedures</p>
                                                <p>Unauthorized use or disclosure of confidential information</p>


                                                <p>Gained or attempted to gain unauthorized access to confidential or proprietary information pertaining
                                                    to the Company, its clients or those of other employees of the Company</p>
                                                <p>Failure to disclose any of the information required by the employment rules and compliance
                                                    regulations or any other information which may have a bearing on the performance of your duties</p>
                                                <br> <br>
                                                <table class="" style="border: none !important;">
                                                    <tbody style="border: none !important;">
                                                        <tr class="" style="border: none !important;">
                                                            <td style="border: none !important;">
                                                                <p>Date:</p>
                                                            </td>
                                                            <td style="border: none !important;">
                                                                <p>Accepted By:</p>
                                                            </td>
                                                            <td style="border: none !important;">
                                                                <p>Signature:</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <p class="pg-no">Page no 6
                                            <p>
                                                <!-- <div class="footer"><img src="img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                </div>
                                <div id="notification" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Ensure you include jQuery and html2pdf libraries in your HTML -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // Helper function to format salary with commas
            function formatSalary(salary) {
                // Remove any commas from the input and parse it to an integer
                const numericSalary = parseInt(salary.replace(/,/g, ''), 10);
                return numericSalary.toLocaleString('en-IN');
            }

            // Helper function to convert numbers to words
            function numberToWords(amount) {

                let num = parseInt(amount.replace(/,/g, ''), 10);

                const words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten",
                    "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen",
                    "Seventeen", "Eighteen", "Nineteen"
                ];
                const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

                if (num === 0) return "Zero rupees only";

                let result = "";

                const crore = Math.floor(num / 10000000);
                num %= 10000000;
                const lakh = Math.floor(num / 100000);
                num %= 100000;
                const thousand = Math.floor(num / 1000);
                num %= 1000;
                const hundred = Math.floor(num / 100);
                num %= 100;
                const ten = Math.floor(num / 10);
                const unit = num % 10;

                if (crore > 0) result += `${convertPart(crore)} Crore `;
                if (lakh > 0) result += `${convertPart(lakh)} Lakh `;
                if (thousand > 0) result += `${convertPart(thousand)} Thousand `;
                if (hundred > 0) result += `${convertPart(hundred)} Hundred `;
                if (ten > 1) {
                    result += `${tens[ten]} ${words[unit]} `;
                } else if (num > 0) {
                    result += `${words[num]} `;
                }

                return result.trim() + " rupees only";
            }

            function convertPart(num) {
                const words = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten",
                    "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen",
                    "Seventeen", "Eighteen", "Nineteen"
                ];
                const tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

                if (num < 20) {
                    return words[num];
                } else {
                    const ten = Math.floor(num / 10);
                    const unit = num % 10;
                    return tens[ten] + (unit > 0 ? " " + words[unit] : "");
                }
            }

            // Format the date
            function formatDate(date) {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return new Date(date).toLocaleDateString('en-IN', options);
            }

            function capitalizeFirstLetter(string) {
                return string
                    .split(' ') // Split the string into words
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize the first letter of each word
                    .join(' '); // Join the words back into a single string
            }
            // Function to update PDF preview
            function updatePdfContent() {


                const empName = capitalizeFirstLetter($("#emp_name_input").val().trim());
                const gender = capitalizeFirstLetter($("[name=gender]:checked").val().trim());
                const empStreet = capitalizeFirstLetter($("#emp_street_input").val().trim());
                const town = capitalizeFirstLetter($("#town_input").val().trim());
                const city = capitalizeFirstLetter($("#city_input").val().trim());
                const position = capitalizeFirstLetter($("#position_input").val().trim());
                const pin = $("#pin_input").val().trim();
                const joiningDate = $("#date_of_join_input").val();
                const salary = $("#salary_input").val().trim();

                const salaryInWords = numberToWords(salary);

                // Set values in the PDF content
                $(".emp_name").text(empName);

                if (gender == 'male') {
                    $("#gender").text('Mr');
                } else {
                    $("#gender").text('Ms');
                }

                $("#emp_street").text(empStreet);
                $("#town").text(town);
                $("#city").text(city);
                $("#pin").text(pin);
                $("#position").text(position);
                $("#joining_date").text(formatDate(joiningDate));
                $("#salary").html(`<b>${formatSalary(salary)}</b>`);
                $("#salary_in_words").text(salaryInWords);

                return true;
            }


            // Function to download PDF
            $("#downloadPdfBtn").on("click", function(e) {

                // e.preventDefault(); // Prevent default action

                $('#downloadPdfBtn').text('Downloading...').attr('disabled', true); // Show loading

                const originalElement = document.getElementById('pdf_Content');
    if (!originalElement) {
        alert("Error: 'pdf_Content' element not found!");
        $('#downloadPdfBtn').text('Download').attr('disabled', false);
        return;
    }

    const clonedElement = originalElement.cloneNode(true);
               

                // Generate the PDF as a Blob
                html2pdf()
                    .set({
                        margin: [0, 0, 0, 0],

                        filename: `{{ $offer->emp_name }}-offer-proposal.pdf`,
                        image: {
                            type: 'jpeg',
                            quality: 0.98
                        },
                        html2canvas: {
                            scale: 2,
                            logging: true,
                            dpi: 192,
                            letterRendering: true
                        },
                        jsPDF: {
                            unit: 'in',
                            format: 'a4',
                            orientation: 'portrait'
                        }
                    })
                    .from(clonedElement)
        .toPdf()
        .get('pdf')
        .then(function (pdf) {
            let pageCount = pdf.internal.getNumberOfPages();
            if (pageCount > 1) {
                pdf.deletePage(pageCount); // Remove the last generated page
            }
        })
                    .outputPdf('blob') // Get the PDF as a Blob
                    .then(function(pdfBlob) {
                        // Trigger the download for the user
                        const downloadLink = document.createElement('a');
                        const url = URL.createObjectURL(pdfBlob);
                        downloadLink.href = url;
                        downloadLink.download = `{{ $offer->emp_name }}-offer-proposal.pdf`;
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                        URL.revokeObjectURL(url);

                        // Now, upload the PDF Blob to the server

                        // const formData = new FormData();
                        // formData.append('pdf', pdfBlob, `${employeeName}-offer-proposal.pdf`);
                        // formData.append('employee', $("#emp_name_input").val().trim() || "Company");
                        // formData.append('street', $("#emp_street_input").val().trim());
                        // formData.append('town', $("#town_input").val().trim());
                        // formData.append('city', $("#city_input").val().trim());
                        // formData.append('pin_code', $("#pin_input").val().trim());
                        // formData.append('position', $("#position_input").val().trim());
                        // formData.append('joining_date', $("#date_of_join_input").val().trim());
                        // formData.append('salary', $("#salary_input").val().trim());

                        // $.ajax({
                        //     url: 'data.php?action=upload_offer_pdf', // The PHP script to handle the upload
                        //     type: 'POST',
                        //     data: formData,
                        //     processData: false, // Important for file upload
                        //     contentType: false, // Important for file upload
                        //     success: function(response) {

                        //         if (response.status == 'success') {
                        //             alert(response.message);
                        //             window.location.href = 'view-offerpdf-list'; // Redirect on success
                        //         } else {
                        //             alert(response.message); // Show error message
                        //         }

                        //     },
                        //     error: function(jqXHR, textStatus, errorThrown) {
                        //         console.error('AJAX Error:', textStatus, errorThrown);
                        //         reject(errorThrown); // Reject on AJAX error
                        //     }
                        // });

                    })
                    .then(function(response) {
                        // Handle successful upload
                        if (response.success) {
                            $('#notification').text('PDF upload completed').fadeIn(300); // Change message to indicate upload success

                            // Hide the notification after 2 seconds
                            setTimeout(() => {
                                $('#notification').fadeOut(300);
                            }, 2000);
                        }
                    })

                    .finally(function() {
                        // Reset the button state after everything is done
                        $('#downloadPdfBtn').text('Download PDF').attr('disabled', false);
                    });
            });

            // Function to upload the PDF to the server
            function uploadPdf(pdfBlob, fileName) {

                return new Promise((resolve, reject) => {

                });
            }

            // insert validation kavin
            // $("#previewBtn").on("click", function(e) {
            //     e.preventDefault(); // Prevent form submission

            //     // Initialize validation flag
            //     let isValid = true;

            //     // Check required fields
            //     $('select[required], input[required]').each(function() {
            //         if ($(this).val() === "") {
            //             isValid = false;
            //             $(this).css('border', '1px solid red'); // Highlight empty fields
            //         } else {
            //             $(this).css('border', ''); // Remove highlight if filled
            //         }
            //     });

            //     // If the form is not valid, show alert and return
            //     if (!isValid) {
            //         alert("Please fill out all required fields.");
            //         return; // Stop the function
            //     }

            //     let form = $('#inputForm')[0];

            //     // Clear previous error messages
            //     $('.error-msg').text('');

            //     // Client-side validation
            //     if (!form.checkValidity()) {
            //         form.reportValidity();
            //         return;
            //     }

            //     // Update PDF Content
            //     if (!updatePdfContent()) {
            //         return;
            //     }

            //     // Prepare form data
            //     let formData = new FormData(form);

            //     // Perform AJAX validation


            //                 // Hide the preview button and show the download button
            //                 $('#previewBtn').hide();
            //                 $('#downloadPdfBtn').show();

            //                 // Disable all input fields to prevent further changes
            //                 $('#inputForm input').attr('disabled', true);

            //                 // Get current date and time
            //                 const now = new Date();

            //                 // Format the date as DD-MM-YYYY
            //                 const day = String(now.getDate()).padStart(2, '0');
            //                 const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            //                 const year = now.getFullYear();

            //                 // Format the time as HH:MM:SS
            //                 const hours = String(now.getHours()).padStart(2, '0');
            //                 const minutes = String(now.getMinutes()).padStart(2, '0');
            //                 const seconds = String(now.getSeconds()).padStart(2, '0');

            //                 const currentDate = `${day}-${month}-${year}`;
            //                 const currentTime = `${hours}:${minutes}:${seconds}`;

            //                 $(".currentDate").html(`<b>${currentDate}</b>`);
            //                 $(".currentTime").html(`<b>${currentTime}</b>`);

            //                 // Log or use the current date and time
            //                 console.log(`Current Date: ${currentDate}`);
            //                 console.log(`Current Time: ${currentTime}`);
            //                 // Show the PDF content by removing 'hidden' and adding 'visible'  

            //                 $('#pdf_Content').removeClass('hidden').addClass('visible').css('overflow', 'auto');




            // });


        });
    </script>



</body>

</html>