<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Digital Proposal PDF</title>
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
            background-color: #f4f5f7;
        }

        h1, h2, h3, h4, h5, h6, th {font-family:'inter', sans-serif !important;color:#100C41}

        #pdf_Content {
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .footer,
        .delo {
            opacity: 0 !important;
        }

        .page .container {
            background-image: url('{{ asset('img/coverpdf.jpg') }}') !important;
            background-size: cover !important;
            background-position: 0px 0 !important;
			height:100%;
        }

        .container {
            width: 209mm;
            max-width: 209mm;
            position: relative;
            margin: 0px auto;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .cover_page {
            margin: 0px auto !important;
            height: 100%;
            width: auto;
        }

        .cover_page {
            background-image: url('{{ asset('img/proposal_cover.jpg') }}');
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

        .pdf-body {
            height: 100%;
            margin: auto;
            width: 100%;
        }

        .pdf_page {
            width: 100%;
            height: 100%;
        }

        .cover_div {
            margin: auto;
            width: 100%;
            text-align: center;
            DISPLAY: FLEX;
            FLEX-DIRECTION: column;
            height: 100%;
            justify-content: space-between;
        }

        .cover_div {
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

        .page {
            height: 1115px;
            margin: 3px auto;
            position: relative;
        }

        .pad {
            position: absolute;
            top: 120px;
            padding: 10px 60px;
            top: 120px;
            WIDTH: 85%;
            z-index: 5;
        }

        /* .delo{display:flex;} */
        .logo_div {
            width: 100%;
            padding-right: 45px;
            display: flex;
            justify-content: end;
            margin-bottom: 10px;
            align-items: center;
        }

        .des_div img {
            width: 350px;
            position: relative;
            z-index: 1 !important;
        }

        .title_a h1 {
            color: #031d4e;
            font-size: 50px;
            font-weight: 600 !important;
            font-family: sans-serif !important;
        }

        .title_a h2 {
            color: #021d4d;
            font-weight: 300 !important;
            font-size: 20px;
            font-family: sans-serif;
        }

        .title_a h3 {
            font-size: 20px;
            font-weight: 600 !important;
            margin: -10px 0px -5px 0px;
            color: black !important;
            font-family: sans-serif;
        }

        .title_a P {
            font-size: 20px;
            color: #041e4e !important;
        }

        .title_a .valid {
            font-size: 16px;
        }

        .title_a .date {
            padding-bottom: 0px;
        }

        .title_a .valid {
            font-size: 16px;
        }

        .title_b {
            margin-bottom: 75px;
        }

        .title_b h3 {
            font-size: 20px;
            font-weight: 600 !important;
            margin: 0px;
            color: #042565 !important;
            font-family: sans-serif !important;
        }

        .title_b p {
            font-size: 14px;
            color: #051f50 !important;
        }

        .title_b .split {
            font-size: 14px;
            color: black !important;
        }

        .title_b .rdx {
            color: #021c4d !important;
            font-weight: 600;
            padding: 5px;
            border: 1px solid black;
            width: 60%;
            margin: auto !important;
            border-radius: 15px !important;
        }

        .pdf_page {
            width: 100%;
            height: 100%;
        }



        h3 {
            font-size: 20px !important;
            color: #211d51 !important;
            font-weight: 600 !important;
            font-family: sans-serif !important;
        }

        h4 {
            font-size: 25px !important;
            color: #211d51 !important;
            font-weight: 600 !important;
            font-family: sans-serif !important;
        }

        li {
            list-style: none;
			line-height:20px !important;
            font-size: 13px !important;
            font-weight: 400 !important;
            padding: 5px 0px !important;
            color: black !important;
        }

        p {
            padding: 6px 0px 12px 0px;
            line-height: 25px;
            font-size: 13px;
            color: black !important;
            margin: 0px !important
        }

        .lean {
            font-weight: 300 !important;
        }

        .arrow-ul li svg {
            margin-right: 20px;
        }

        .ht-1 {
            padding: 5px 0px 5px 0px;
        }

        table {
            width: 670px;
        }

        th {
            padding: 3px;
        }

        td {
            font-size: 14px;
            padding: 5px 10px;
            border: 1px solid;
            color: black !important;
        }

        th {
            font-size: 14px;
            margin: 0px;
            margin-bottom: 10px;
        }

        .dig_tab .nb:nth-child(1) {
            border-top: 1px solid #000 !important;
            border-bottom: 0px !important;
        }

        .dig_tab .nb:nth-child(1) td {
            border-top: 1px !important;
            border-bottom: 0px !important;
        }

        .dig_tab .nb {
            border-top: 0px !important;
            border-bottom: 0px !important;
        }

        .dig_tab .nb td {
            border-top: 0px !important;
            border-bottom: 0px !important;
        }

        .dig_tab .nb p {
            padding: 2px 5px !important;
        }

        .dig_tab .nb th {
            text-align: left;
            font-size: 14px;
            padding: 2px 10px;
            color: #000;
        }

        .dig_tab .nb td {
            text-align: left;
            font-size: 14px;
            padding: 2px 10px;
            color: #000;
        }

        .dig_tab .bold {
            font-size: 14px;
            font-weight: 600px;
            color: black !important;
            padding: 15px 0px !important;
        }

        .dig_tab .ht {
            font-size: 14px;
            color: black !important;
            padding: 10px 0px !important;
        }

        .dig_tab P {
            padding: 0px 5px;
            text-align: left;
            font-size: 14px;
            font-weight: 800;
            color: #1f1b55 !important;
            line-height: 20px !important;
        }

        ul,
        ol {
            padding: 0px;
        }

        ol li {
            margin-left: -25px;
        }

        table {
            width: 100%;
            border: 1px;
            outline: 1px;
            border-collapse: collapse;
        }

        table,
        h2,
        p,
        ul {
            page-break-inside: avoid;
            /* Prevent breaking inside these elements */
        }

        .empty,
        tr,
        th {
            height: 16px;
        }

        .error-msg {
            font-size: 14px;
            color: #c15656;
        }

        .footer {
            width: 212mm;
            margin-left: 0px;
        }

        .footer img {
            width: 100%;
            margin-bottom: -10px;
        }

        .thanks_div {
            text-align: center;
            padding: 100px;
        }

        .thanks_div p {
            padding: 0px;
        }

        .thanks_div p strong {
            padding: 8px 0px 20px 0px;
            font-size: 20px;
        }

        .thanks_div a {
            color: #000000;
        }

        tr {
            border-top: 1px solid;
            border-right: 1px solid;
            border-left: 1px solid;
        }

        table tr:last-child {
            border-bottom: 1px solid;
        }

        tr td:nth-child(2) {
            border-left: 1px solid;
        }

        .logo_div {
            width: 100%;
            display: flex;
            justify-content: end;
            margin-bottom: 0px;
        }

        td {
			line-height:20px !important;
            font-size: 14px;
            padding: 0px 10px;
            border: none
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            background-color: #333;
            color: #fff;
        }

        footer a {
            color: #fff;
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }


        .hidden {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            overflow-y: hidden !important;
            visibility: visible !important;
        }

        .hidden::after {
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

        .visible {
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            filter: none;
        }

        .pdf_container {
            display: grid;
            width: 100%;
            margin: auto;
            justify-content: center;
            gap: 2%;
            padding: 50px 0px;
            height: 730px;
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

        #pdf_Content {
            margin-bottom: 30px;
            overflow-y: scroll;
            background:#fff;
            /* box-shadow: 0px 0px 35px 0px rgba(154, 161, 171, 0.15); */
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

        /* #pdf_Content{height: auto;} */
        .sign_div p {
            margin: 0px 0px 50px 0px;
        }

     .container.first{width:80% !important;max-width:80% !important;}
        
        .input_wrp {
            width: auto;
            height: fit-content;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            margin: 30px;
            column-gap: 50px;
            row-gap: 20px;
        }

        .input_wrp div {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .input_wrp label {
            font-size: 14px;
        }

        body {
            transition: 0.3s linear;
        }

        .pBtn,
        .dBtn {
            width: fit-content;
            padding: 10px 20px;
            outline: none;
        }

        .pBtn {
            color: #fff;
            background-color: #298ecd;
            border-color: #298ecd;
        }
        .dBtn{
           border-radius:10px;
           cursor:pointer;
        }
        .dBtn:hover{
            background:#1C69D4 !important;
            color:#fff;
            border:1px solid #1C69D4;
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

        #pdf_Content {
            margin-bottom: 30px;
            overflow-y: scroll;
        }

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

        /* #downloadPdfBtn{display: none;} */

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

        .page .currentDate {
            position: absolute;
            top: 25px;
            left: 60px;
            font-size: 14px;
        }

        .page .currentTime {
            position: absolute;
            top: 25px;
            left: 140px;
            font-size: 14px;
        }

        #pdf_Content .page .pg-no {
            position: absolute;
            bottom: 85px;
            right: 0;
        }

        .dig_tab .pg-no {
            font-size: 14px !important;
            font-weight: 300 !important;
            text-align: end !important;
            padding: 0px 60px !important;
            color: #888888 !important;
        }

        .pg-no {
            font-size: 14px !important;
            text-align: end !important;
            padding: 0px 60px !important;
            color: #888888 !important;
        }

        .wit {
            width: -webkit-fill-available;
        }

        .no-gap {
            gap: 0px !important
        }

        .pl-1 {
            padding-left: 5px;
        }

        /* #pdf_Content .page .pad {position: absolute;top:120px;} 
         tr td {border-right: 0.5 !important;}*/
        /*tr  {border: none !important;}.dig_tab .nb th {padding: 0px 10px;} */

        .empty th {
            border-bottom: none;
        }

        tr td:nth-child(2) {
            border-left: 0px solid;
        }

        tr td:nth-child(1) {
            border-right: 1px solid rgb(0 0 0 / 50%);
        }

        .bnone td {
            border-right: none !important;
            width: 90% !important;
        }

        tr td:nth-child(2) {
            width: 30%;
        }

        tr td:nth-child(1) {
		
            width: 70%;
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

        @media(max-width:1200px){
            #pdf_Content {
            overflow-x: scroll;
        }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .cover_div {
                width: 100%;
            }

            .title_d p {
                font-size: 18px;
            }
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
</head>

<body class="fixed-top">

    <div id="container" class="row-fluid">
        <div class="sidebar-scroll">

        </div>
        <div id="main-content" style="min-height:667px!important;">
            <div class="container  first">

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget appac">

                            <div class="pdf_container">
                                <div class="input_div">
                                <div class="profile-head my-3">
                                <h1 class="ch2">Digital Proposal</h1>
                            </div>

                                    <button class="dBtn" id="downloadPdfBtn">Download PDF</button>
                                </div>

                                <!-- PDF content -->
                                <div id="pdf_Content">

                                    <div class="page cover_page">
                                        <div class="pdf-body">
                                            <div class="pdf_page">
                                                <div class="cover_div">
                                                    <div></div>
                                                    <div class="title_a">
                                                        <h1 class="bgcolor">PROPOSAL FOR</h1>
                                                        <span class="d-flex no-gap">
                                                            <h2>{{$digital->client_name}}</h2>
                                                            <h2>,</h2>
                                                            <h2 class="city pl-1">{{$digital->city}}</h2>
                                                        </span>
                                                        <h3>DIGITAL MARKETING, RETAINERSHIP CONTRACT</h3>
                                                        <p class="date">DATED {{ date('d-m-Y',strtotime($digital->date)) }}</p>
                                                        <p class="valid">( Valid for 30 days )</p>
                                                    </div>
                                                    <div class="title_b">
                                                        <h3>Result Driven Web & Digital Agency</h3>
                                                        <p class="rdx">Proven by Results, Experienced by Customers across the Globe</p>
                                                        <p class="split dwew">Digital Marketing | Web Design & Development | Ecommerce solutions | Web Application</p>
                                                    </div>
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
                                                <h3>ABOUT US</h3>
                                                <p>We, "Appac Mediatech Pvt. Ltd.," are a Web and Digital firm with more than 16 years of experience
                                                    across Industry. We think that digital is all about technology and gives people and companies more
                                                    power. To keep things simple, your task and ours are the same. The idea is to reach the right people
                                                    with the right solution at the right time and through the right channel.
                                                </p>

                                                <h3>SCOPE OF WORK</h3>
                                                <ul class="arrow-ul">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Do Keyword Research, Competitor & Page Speed Analysis</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Build Social Media themes based on the current trends.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Create SEO Impact and do Search Engine Optimization as per web vitals</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Search Engine Marketing & Remarketing</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Conceptual Creative Designs and the adaptation works</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Awareness > Reach > Consideration > Conversion – In All forms</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Online reputation management and Social profiling</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Blog creation and content submissions.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Create call actions, Do GMB optimization and GEO targeting to our relevant TG</li>
                                                </ul>
                                                <h3>ENGAGEMENT:</h3>
                                                <ul class="arrow-ul">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Regular engagement with the TG on all the Social Channels.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Update on current affairs about the Institution by the way of lucrative posts - video/ images</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> To consistently deliver content every alternate week day to ensure there is enough organic
                                                        content to be promoted and spread awareness about the brand to relevant users</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> To create content on did you know facts, Case studies, Problem and the Solution.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Page Engagement - To Create lucrative posts to increase likes, comments, shares.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Create Videos are a great source to win trust, boost credibility, and convert new clients.</li>
                                                </ul>
                                            </div>
                                            <p class="pg-no">Page no 1
                                            <p>
                                                <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
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
                                                <ul class="arrow-ul">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Integrate Social Plugins on your website will give you more advantages on Branding Awareness
                                                        and followers Increase on Socials.</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Social themes based on keyword research for the Target Audience</li>
                                                </ul>
                                                <h3>METHODOLOGY</h3>
                                                <ul class="arrow-ul">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Month 1: Website Audit, Keyword Research, and Content Creation</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Month 2-3: Social Media Setup, Content Calendar, and Ad Campaigns</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Month 4-6: Ongoing Optimization, Reporting, and Strategy Refinement</li>
                                                </ul>
                                                <h3>OUR FUNNEL APPROACH AND ROAD MAP</h3>

                                                <p class="ht-1">Do the Web and Digital Audit > Fix the Bug > Set the Tone > Scale > Create Awareness ></p>
                                                <p>Repurpose > Reach your TG > Bring it to Consideration > Conversion > Repeat Mode</p>

                                                <h3>WHY CHOOSE US</h3>
                                                <ul class="arrow-ul">
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> One of the Leading Agency in South India with 100% Inhouse Production</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Client-centric approach, Better workflow management</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Real-time Performance tracking</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Proven track record - Successful Campaigns for clients across industry</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg> Personalized approach - Dedicated account manager and Customized strategies</li>
                                                </ul>
                                            </div>
                                            <p class="pg-no">Page no 2
                                            <p>
                                                <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                        </div>
                                    </div>

                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>
                                            <!-- <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>                                        -->
                                            <div class="dig_tab">
                                                <div class="pad">
                                                    <h3>QUOTE :</h3>
                                                    <table cellpadding="10" cellspacing="0">
                                                        <tr class="nb">
                                                            <td><b>Package Name</b></td>
                                                            <td><b>Elite</b></td>
                                                        </tr>
                                                        <tr class="nb">
                                                            <td><b>(Monthly Investment)</b></td>
                                                            <td><b>{{$digital->mia}}</b></td>
                                                        </tr>
                                                        <tr class="nb">
                                                            <td><b>Min. Duration</b></td>
                                                            <td>12 months</td>
                                                        </tr>
                                                        <tr class="nb">
                                                            <td>Payment Terms</td>
                                                            <td>100% Advance</td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>DIGITAL ASSET RESEARCH & SETUP/OPTIMIZATION</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>Website Audit</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Social Profile Audit</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Online Reputation Audit</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business & Local Listing Audit</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Competitor Research</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Product/Service Research</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Channel Plan</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>SEARCH ENGINE MARKETING</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>Keyword Research</td>
                                                            <td>All</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Keyword Optimization</td>
                                                            <td>Tier I, II & III</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Search Diagnostics</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Website Optimization</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Local SEO</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paid Ads</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Local Listing</td>
                                                            <td>50</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Classified Ad Posting</td>
                                                            <td>Up to 25</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Listing</td>
                                                            <td>Up to 25</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Blog/ Article Creating & Publishing</td>
                                                            <td>Up to 8</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>SOCIAL MEDIA MARKETING</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>No. of Channels</td>
                                                            <td>Up to 4</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Page & Profile Setup</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Social Media Planning & Publishing</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>No. of Posts & Engagements</td>
                                                            <td>{{$digital->mia_post}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Organic Promotions/Engagements</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Paid Ads</td>
                                                            <td>Up to 3</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>

                                                    </table>
                                                </div>
                                                <p class="pg-no">Page no 3
                                                <p>
                                                    <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                            </div>
                                        </div>
                                    </div>


                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>
                                            <div class="dig_tab">
                                                <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                                <div class="pad">
                                                    <table cellpadding="10" cellspacing="0">
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>ONLINE REPUTATION MANAGEMENT</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>Research & Monitoring</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Managing Ratings & Reviews</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>CONVERSION RATE OPTIMIZATION</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>Chat</td>
                                                            <td>Opt-In</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Customer Journey Optimization & Reporting</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sales Funnel Management</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2">
                                                                <P>BRAND CONSULTING</P>
                                                            </th>
                                                        </tr>
                                                        <tr>
                                                            <td>Business Consulting</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Campaign Consulting</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email Marketing</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>

                                                        <tr>
                                                            <th colspan="2">
                                                                <P>ANALYTICS & REPORTING</P>
                                                            </th>
                                                        </tr>

                                                        <tr>
                                                            <td>Setup</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Digital Analytics & Reporting</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Data Interpretation & Insights Reporting</td>
                                                            <td>Yes</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Audit & Strategy Meeting</td>
                                                            <td>Monthly</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Update & Review</td>
                                                            <td>Monthly</td>
                                                        </tr>
                                                        <tr class="empty">
                                                            <th></th>
                                                            <td></td>
                                                        </tr>


                                                    </table>
                                                    <table style="margin-top: -2px;">
                                                        <tr class="bnone">
                                                            <td>
                                                                <p class="bold">**The Above cost is exclusive of Taxes and Paid Marketing budget. Our Campaign management
                                                                    charges would be Minimum INR 10,000 or 10% of Total Investment</p>
                                                                <p class="bold">**Please note Minimum Contract Period is 6 months.</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <p class="pg-no">Page no 4
                                                <p>
                                                    <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="page">
                                        <div class="container">
                                            <div class="currentDate"></div>
                                            <div class="currentTime"></div>
                                            <!-- <div class="dig_tab"> -->
                                            <div class="delo">
                                                <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                                <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                            </div>
                                            <div class="pad">
                                                <h3>PRIVACY POLICY:</h3>
                                                <p class="ht">We are Glad to associate with you! We have formulated a set of Privacy Policies in the Best interests
                                                    of our collaboration and to ensure seamless operations for Best Results.</p>

                                                <ul>
                                                    <li>1. Appac Media Pvt Ltd will safeguard your log in Credentials and they will be used only by the
                                                        Authorised Personnel and shall not be shared with any Third party.</li>
                                                    <li>2. The information collected from the client in form of Database, Graphic will be used only for the
                                                        Marketing activities and Promotions of the client and will not shared or used for Third party purposes.</li>
                                                    <li>3. All data and resources collected from the Promotional Activities will be shared with the client for
                                                        better results and shall not published or shared for any Third party usage.</li>
                                                    <li>4. The payment details for the running of Campaigns will be highly secured and be only used on
                                                        encrypted site to make sure the payments are carried out safely.</li>
                                                    <li>5. All the content and graphic created for the Promotional Activities shall be owned by the client and
                                                        will no form be used or shared by any Third party clients.</li>
                                                    <li>6. All collected information from the client and through Promotional Activities are subjected to
                                                        utmost Privacy while it is understood that will be revealed in case of Legal intervention.</li>
                                                    <li>7. It is agreed upon that all the activities carried out on the behalf of clients is under approval of the
                                                        client and thus shall be solely responsible for the output.</li>
                                                    <li>8. All subscriptions of application or software made on behalf of the client to aid services shall be used
                                                        solely for the clients and will not be shared or used by any third party.</li>
                                                    <li>9. The data and information of the client shall in some case shared to their party vendors for service
                                                        assistance and assessment under complete privacy security by Appac Media.</li>
                                                </ul>
                                                <h3>CANCELLATION POLICY:</h3>
                                                <p class="ht">The above contract is minimum of 6 – 12 months tenure, in case of cancellation three month’s notice
                                                    should be provided in advance.</p>
                                            </div>
                                            <p class="pg-no">Page no 5
                                            <p>
                                                <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                                <!-- </div> -->
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
                                            <div class="pad wit">
                                                <h3>TERMS AND CONDITIONS:</h3>
                                                <ol>
                                                    <li>1. If scope of work changes, a revised quotation will be provided.</li>
                                                    <li>2. 100% Advance to be released for work to commence.</li>
                                                    <li>3. Purchase of photographs or material for the above said services is extra (if any).</li>
                                                    <li>4. All the basic insights should be provided by the client.</li>
                                                </ol>
                                                <p><b>Please feel free to connect us if any clarity. Assuring you best of our services at all times.</b></p>

                                                <div class="thanks_div">
                                                    <p style="font-size: 20px;">Thanks &amp; Regards</p>
                                                    <h3>{{$digital->created_by}}</h3>
                                                    <p style="padding-bottom: 5px; margin-top: -10px !important;">{{$digital->role}}</p>
                                                    <p> <strong>Appac Mediatech Private Limited</strong> </p>
                                                    <br>
                                                    <p>Ph.No : +91 422 435 4854 | Mobile : +91 93429 02804</p>
                                                    <p>Email : projectsupport@appacmedia.com</p>
                                                    <p>Website :<a href="http://www.appacmedia.com"> www.appacmedia.com</a></p>
                                                </div>
                                            </div>
                                            <p class="pg-no">Page no 6
                                            <p>
                                                <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            // Helper function to format date
            function formatDate(date) {
                const dateObj = new Date(date);
                const day = String(dateObj.getDate()).padStart(2, '0'); // Ensures 2-digit day
                const month = String(dateObj.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1
                const year = dateObj.getFullYear();
                return `${day}-${month}-${year}`; // Returns in DD-MM-YYYY format
            }

            function capitalizeFirstLetter(string) {
                return string
                    .split(' ') // Split the string into words
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalize the first letter of each word
                    .join(' '); // Join the words back into a single string
            }

            // Click handler for Download PDF Button
            $("#downloadPdfBtn").on("click", function(e) {
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
                        filename: `{{ $digital->client_name }}-digital-proposal.pdf`,
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
                        downloadLink.download = `{{ $digital->client_name }}-digital-proposal.pdf`;
                        document.body.appendChild(downloadLink);
                        downloadLink.click();
                        document.body.removeChild(downloadLink);
                        URL.revokeObjectURL(url);

                        // Now, upload the PDF Blob to the server
                        // return uploadPdf(pdfBlob, `{{ $digital->client_name }}-digital-proposal.pdf`);
                    })
                    .then(function(response) {
                        // Handle successful upload
                        if (response.success) {
                            alert('PDF file uploaded successfully');
                            // Redirect to view-digitalpdf-list.php after upload is done
                            window.location.href = 'view-digitalpdf-list.php';
                        }
                    })
                    .finally(function() {
                        // Reset the button state after everything is done
                        $('#downloadPdfBtn').text('Download').attr('disabled', false);
                    });
            });

         
            const now = new Date();

            // Format the date as DD-MM-YYYY
            const day = String(now.getDate()).padStart(2, '0');
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Month is zero-based
            const year = now.getFullYear();

            // Format the time as HH:MM:SS
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const currentDate = `${day}-${month}-${year}`;
            const currentTime = `${hours}:${minutes}:${seconds}`;

            $(".currentDate").html(`${currentDate}`);
            $(".currentTime").html(`${currentTime}`);

            // Log or use the current date and time
            console.log(`Current Date: ${currentDate}`);
            console.log(`Current Time: ${currentTime}`);



        });
    </script>

</body>

</html>