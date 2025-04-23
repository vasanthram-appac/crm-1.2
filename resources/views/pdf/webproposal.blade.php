

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Web Proposal PDF</title>
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

    body {font-family: Arial, Helvetica, sans-serif;}
    
    h1, h2, h3, h4, h5, h6, th {font-family:'inter', sans-serif !important;color:#100C41}

    #pdf_Content{overflow-y: scroll;background:#fff;}

    .wellness .footer, .wellness .delo {opacity:0 !important;}
    .page .container {background-image:  url('{{ asset('img/coverpdf.jpg') }}') !important; background-size: cover !important; background-position: 0px 0 !important;height:100%;}

    .wellness .cover_page{margin: 0px  auto!important; height: 100%; width:auto; }
    .wellness .cover_page {background-image: url('{{ asset('img/proposal_cover.jpg') }}') !important; background-size: cover; background-position: top right;display: flex;align-items: center; justify-content: center; width: 209mm; height: 1120px; max-width:209mm; margin: 0px 10mm;box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);}
    /* .wellness .cover_page {display: flex; align-items: center; justify-content: center; width: auto !important;} */
    .wellness .pdf-body {height: 100%; margin: auto; width: 100%;}

    .wellness .pdf_page {width: 100%; height: 100%;}

    .wellness .cover_div{margin: auto; width: 100%; text-align: center; DISPLAY: FLEX; FLEX-DIRECTION: column; height: 100%; justify-content: space-between;}
    .wellness .cover_div {padding-top: 0px; margin-left: 0;}
    .d-flex {display: flex; gap: 5px; justify-content: center;}
    .flex {display: flex; gap: 5px;}
    .wellness .page{ height: 1090px;margin:3px auto;}
    .wellness .container{width: 209mm; max-width: 209mm; margin: 0px auto;display:flex;justify-content:space-between;flex-direction:column;}
    .wellness .pad {position: relative; padding: 10px 60px; top: -60px; z-index: 5;}
    .wellness .delo{display:flex;}
    .wellness .logo_div{width: 100%; padding-right: 45px; display: flex; justify-content: end; margin-bottom: 10px; align-items: center;}
    .wellness .des_div img{width: 350px; position: relative; z-index: 1 !important;}

    .wellness .title_a h1{color: #031d4e; font-size: 50px; font-weight: 600 !important; font-family: sans-serif !important;}
    .wellness .title_a h2 {color: #021d4d; font-weight: 300 !important; font-size: 20px; font-family: sans-serif;}
    .wellness .title_a h3 {font-size: 20px; font-weight: 600 !important; margin: -10px 0px -5px 0px; color: black !important; font-family: sans-serif;}
    .wellness .title_a P{font-size: 20px; color: #041e4e !important; }
    .wellness .title_a .date{padding-bottom: 0px;}
    .wellness .title_a .valid{font-size:14px;}

    .wellness .title_b {margin-bottom: 75px;}
    .wellness .title_b h3 {font-size: 20px; font-weight: 600 !important; color: black !important; font-family: sans-serif; color: #042565 !important; margin: 0px;}
    .wellness .title_b p {font-size: 14px; color: #051f50 !important;}
    .wellness .title_b .split {font-size: 14px; color: black !important;}
    .wellness .title_b .rdx{
        color: #021c4d !important;
        font-weight: 600;
        padding: 5px;
        border: 1px solid black;
        width: 60%;
        margin: auto !important;
        border-radius: 15px !important;
    }

    h3{font-size: 20px !important; color:#211d51 !important; font-weight: 600 !important; font-family: sans-serif !important;}
    .wellness h4{font-size: 25px !important; color:#211d51 !important; padding-top: 20px !important; font-weight: 600 !important; font-family: sans-serif !important;}
    .wellness li{list-style: none; font-size: 13px !important; font-weight: 400 !important; padding: 5px 0px !important; color: black !important;}
    .wellness p {padding: 6px 0px 12px 0px; line-height: 25px; font-size: 13px; color: black !important; margin:0px !important}
    .wellness .reduce p {padding: 3px 0px 3px 0px; line-height: 25px; font-size: 13px; color: black !important; margin: 0px !important;}
    .wellness .reduce .strong{ padding-top:15px;}
    .wellness .lean{font-weight: 300 !important;}
    .wellness .footer {width: 212mm; margin-left: 0px;}
    .wellness .footer img{width: 100%; margin-bottom: 40px;}

    .dBtn{
           border-radius:10px;
           border:none;
           cursor:pointer;
        }
        .dBtn:hover{
            background:#1C69D4 !important;
            color:#fff;
            border:1px solid #1C69D4;
        }

    .wellness td{font-size: 14px; padding: 5px 10px; border: 1px solid;}
    .wellness td p{line-height: 20px; padding: 0px 10px !important; }
    .wellness .ti_table .nb:nth-child(1){border-top: 1px solid #000 !important;border-bottom: 0px !important}
    .wellness .ti_table .nb:nth-child(1) td{border-top: 1px!important;border-bottom: 0px !important}
    .wellness .ti_table .nb{border-top: 0px  !important; border-bottom: 0px !important}
    .wellness .ti_table .nb td{border-top: 0px!important; border-bottom: 0px !important}
    .wellness .ti_table .nb p{padding: 0px 10px !important;}
    .wellness .ti_table .val_flex{display: flex; gap: 5px;}
    .wellness .ti_table .val_flex p{padding: 8px 0px 8px 0px !important;}
    .inline-fl {justify-content:start; padding: 0;}


    .wellness .thanks_div p{padding: 0px 0px 3px 0px !important; font-size: 13px;}
    .wellness .thanks_div h3{margin:0px;}
    .wellness .thanks_div{padding: 50px;}

    .wellness .container.first{width:80% !important;max-width:80% !important;}
    /* page-break-before: always; Force each .page div to start on a new page */

    .wellness .coverpage{height: 100%; max-width:760px; width:auto; margin: 0px; background-color: #4bacc6; display: flex;align-items: end;align-content: end;}
    .wellness ul, ol{padding: 0px;}
	.wellness ul ul{padding-left:20px !important;}
    .wellness table, h2, p, ul {page-break-inside: avoid; /* Prevent breaking inside these elements */}
    .wellness .italic{font-style: italic; font-weight: 100; padding: 3px 10px 1px 10px;}
    .wellness .empty {height: 16px;}

    .wellness .line {background-color: #f8f8f8;height: 2px;width: 100%;display: block;margin: 10px 0px;}

    .wellness .thanks_div {text-align: center;}
    .wellness .empty ,tr, th {height: 16px;}
    .wellness table {width: 100%;border: 1px;outline: 1px;border-collapse: collapse;}
    .wellness tr{border-top: 1px solid;border-right: 1px solid;border-left: 1px solid;}
    .wellness table tr:last-child{border-bottom: 1px solid;}
    /* .wellness_table tr td:nth-child(2){border-left: 1px solid;} */


    .wellness footer {text-align: center;padding: 20px;margin-top: 40px;background-color: #333;color: #fff;}
    .wellness footer a {color: #fff;text-decoration: underline;}

    .wellness .hidden {position:relative;display: block;width: 100%;height: 100%;overflow-y:hidden !important; visibility:visible !important;}
    .wellness .hidden::after {position: absolute;content: '';top: 0;left: 0;height: auto;right: 0;bottom: 0;background: rgba(255, 255, 255, 0.2);backdrop-filter: blur(2px);-webkit-backdrop-filter: blur(10px);border-radius: 10px;z-index: 1;}
    .wellness .visible {
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
    filter: none; /* Ensure no blur effect when visible */
    }

    .internalUL li{padding-left: 20px;}
    .wellness .spc{margin-top: -35px;}
    .wellness .arrow-ul{ padding-left: 15px;}
	p strong{font-size:15px;}
    .lstyle{padding-left: 20px;}
    .lstyle li{list-style: disc;}
    .wellness .wellnesss_head{background-color: #00b7ce; color: #fff; border: 1px solid black;}
    .wellness_table tr td{border: 1px solid #00b7ce;}
    .wellness_table tr td:first-child{border-left: 1px solid #000;}
    .wellness_table tr td:last-child{border-right: 1px solid #000;}
    .wellnesss_head.noborder th{border-bottom: 1px solid #00b7ce !important;}
    .wellnesss_head.noborder{border-bottom: none !important;}
    .notopborder{border-top:none !important;border-bottom:none !important;}
    .wellness_table tr:last-child td{border-bottom: 1px solid #000;}

    .wellness .tc p{text-align: center; }
    .wellness .tc{text-align: center;}
    .cos_tab tr td{border: 1px solid #43cadb; color: black !important;}
    .cos_tab tr td:last-child {border-left: 1px solid #43cadb;}
    .wellness .thanks_div a{text-decoration: none; color: #000000; }
    .wellness .arrow-ul .gap{display: flex; gap: 3px;}
    .wellness .arrow-ul li svg{margin-right: 20px;}
    .wellness .lstyle {padding-left: 50px;}
    .wellness .sp{margin-top: -8px;}
    .wellness .reduce{padding: 0px;}

    /* input css */
    body{background-color: #f4f5f7;}
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


    .offer p ,.offer li {font-size: 15px;line-height: 22px;}
    .com_add p{margin: 0px;text-align: end;}
    .emp_add p{margin: 0px;}
    input {outline: none; border: 1px solid #cdd3d9;border-radius:3px;height: 30px !important;}
    .com_add p a{text-decoration: none;color:#000;}
    .com_add p:last-child a{color:#0000EE ;}
    .sign_div{margin-top: 30px;display: flex;flex-direction: column;gap: 30px;}
    .sign_div p{margin: 0px 0px 50px 0px;}
    .input_wrp{width: auto;height: fit-content;   display: grid;grid-template-columns:repeat(2,1fr);margin:30px;column-gap: 20px; row-gap: 20px;}
    .input_wrp div{display: flex;flex-direction: column;gap: 5px;}
    .input_wrp label{font-size:13px;}
    .pBtn ,.dBtn {width:fit-content;padding: 10px 20px;outline: none;border: 1px solid   }
    .pBtn {color: #fff;background-color: #298ecd;border-color: #298ecd;}
    .dBtn {color: #000;background-color: #ffffff00;border: 1px solid ;border-color: #000;}
    .button_wrp{flex-direction: row;margin: 30px;}
    .page.last_page{height: 771px !important;}
    .error-msg{font-size: 12px;color: #c15656;}
    /* #downloadPdfBtn{display: none;} */

    input{width:auto;padding: 0px 10px;}
    .button_wrp {display: flex;flex-direction: row;gap:15px;}
    ::placeholder {padding: 5px  8px ; /* Firefox */}
    .wellness .hidden::after {display:block;}
    .title_a{text-align:center;}

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
        display: none; /* Initially hidden */
    }

    .widget-title > h4 {
        color: #fff !important;
        float: left !important;
        font-size: 14px !important;
        font-weight: normal !important;
        padding: 10px 11px 10px 15px !important;
        line-height: 12px !important;
        margin: 0 !important;
        font-family: 'MyriadPro-Regular' !important;
    }

    .btn a{color:white; text-decoration: none;}
    .btn{margin-left: 15px;}

    .page-title{
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
    #pdf_Content .page {position: relative;}
    #pdf_Content .page .pg-no {    position: absolute;
    bottom: 85px;
    right: 0;}
    #pdf_Content .page .pad {position: absolute;top:120px;}

    .page .currentDate {
        position: absolute;
        top: 25px;
        left: 60px;
        font-size: 14px;
    }

    .page .currentTime{
        position: absolute;
        top: 25px;
        left: 140px;
        font-size: 14px;
    }

    .val_flex{text-wrap: nowrap;}

    .input_wrp select{margin-top: 5px;}
	
	.ti_table tbody tr.nb:nth-child(9)  td {border-bottom: 1px solid !important;}
    
	.no-gap{gap:0px !important}
    .pl-1{padding-left:5px;}

    
    @media(max-width:1500px){
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
    }.button_wrp{
        display: flex;
        flex-direction: row;
        margin: 25px;
        gap:10px;
    }    .pdf_container {
        width: 100%;
        overflow-x:hidden;
        justify-content: center;
        gap: 3%;
        overflow-y: scroll;
    }

    .wellness .container {
            max-width: 100%;  }
    }
    body{transition:0.3s linear;}

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
    #pdf_Content .page {width:100%;    display: flex;
        align-items: center;
        justify-content: center;
        width: 209mm;
        height: 1120px;
        max-width: 209mm;
    }
    .view-btn{
        padding: 15px;
        background-color: black;
        width: 55px;
        color: white;
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
                                <h1 class="ch2">Web Proposal</h1>
                            </div>
                                <button type="button" class="dBtn" id="downloadPdfBtn">Download  PDF</button>
                            </div>

                            <!-- PDF content -->
                            <div id="pdf_Content">
                                <div class = "page cover_page" >
                                    <div class="pdf-body">
                                        <div class="pdf_page" >
                                            <div class="cover_div">
                                                <div></div>
                                                <div class="title_a">                                                   
                                                    <!-- <p class="pr_id">PR 1254</p> -->
                                                    <h1 class="bgcolor">PROPOSAL FOR</h1>
													<span class="d-flex no-gap"><h2>{{$web->company}}</h2><h2>,</h2><h2 class="city pl-1">{{$web->city}}</h2></span>
                                                    <h3>CORPORATE WEB DESIGN &amp; DEVELOPMENT</h3>
                                                    <p class="date">DATED {{date('d-m-Y',strtotime($web->date))}}</p>
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

                                <div class = "page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">

                                            <h3>TABLE OF CONTENTS</h3>
                                            <ul>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Overview</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Discovery &amp; Consulting</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Initial Planning &amp; UI/UX</li>
                                                <ul class="internalUL">
                                                    <li>✔&nbsp;&nbsp; Content Architecture</li>
                                                    <li>✔&nbsp;&nbsp; User Journey Mapping </li>
                                                    <li>✔&nbsp;&nbsp; High Fidelity Designs</li>
                                                </ul>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; CMS Web Development</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Analytics &amp; Measurements</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; SEO Optimization</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Technical Standards</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Copywriting &amp; Photography</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Testing, Approval &amp; Change Requests</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg> Hosting</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Support &amp; Maintenance Time</li>
                                                <ul>
                                                    <li>✔&nbsp;&nbsp; Scope of work</li>
                                                    <li>✔&nbsp;&nbsp; Core Objectives</li>
                                                    <li>✔&nbsp;&nbsp; Key Features</li>
                                                    <li>✔&nbsp;&nbsp; Design Elements</li>
                                                    <li>✔&nbsp;&nbsp; Functional Elements</li>
                                                    <li>✔&nbsp;&nbsp; Deliverables</li>
                                                    <li>✔&nbsp;&nbsp; Style Guide</li>
                                                </ul>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Time Estimate</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Total Investment</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Investment Summary</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"></path>
                                                        </svg>&nbsp;&nbsp; Payment Terms</li>
                                            </ul>
                                        </div>                                                                
                                            <p class="pg-no">Page no 1<p>
                                        <!-- <div class="footer"></p><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container" >
                                    <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <h3>OVERVIEW</h3>
                                            <p>This is a proposal for the design and development of the website for <strong>{{$web->company}},</strong> Coimbatore (henceforth referred to as ‘<strong>{{$web->company}}</strong>’). The entire proposal is based on the communicated actual requirements, our discussions with the <strong >{{$web->company}}</strong> team, and our website audit.</p>

                                            <h3>DISCOVERY &amp; CONSULTING</h3>
                                            <p>Initial discovery and consulting would happen over a couple of direct meeting with <strong>
                                            {{$web->company}} </strong> team where Appac would analyze the requirements and suggest / provide initial
                                                recommendation.</p>
                                            <p>In this phase, Appac would establish the key messages that <strong> {{$web->company}} </strong>
                                            wants to communicate to their target audience, with a view to then creating an overall theme for the whole campaign.</p>

                                            <h4>INITIAL PLANNING &amp; UI/UX</h4>
                                            <h3>Content Architecture</h3>
                                            <p>Appac to research and rationalize the current website structure to create a couple of new Web tree
                                                menu structures. The finalized web tree will visualize the architecture of the website and will clearly
                                                outline the navigational structure.</p>

                                            <h3>User Journey Mapping</h3>
                                            <p>Appac would take discussion findings from Discovery phase and map the user journey for the specified
                                            target audience. We will ensure smooth navigation throughout the website and interactive as well.</p>

                                        </div>
                                        <p class="pg-no">Page no 2<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                    <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <h3>High Fidelity Designs</h3>

                                            <p>Appac would create wireframes based on the approved content architecture and user journey
                                                mapping. This will later be transformed into high fidelity designs. High fidelity design will be created for
                                                the main pages and other pages will follow one of these layouts.</p>

                                            <p>All our designs follow ‘Mobile First’ approach and other device designs will be created eventually. A
                                                vast majority of the website visitors are using via mobile devices (60%), so we strongly feel that the
                                                Mobile First designs would be apt.</p>

                                            <h3>CMS - WEB DEVELOPMENT</h3>
                                            <p>Appac will develop the dynamic and responsive website using PHP CMS OR HTML which is the most
                                                popular and easy to use interface for <strong> {{$web->company}}</strong> team. Other technologies
                                                include PHP, Bootstrap, jQuery, HTML, CSS and mySQL (whichever is required). This website will enable
                                                the <strong> {{$web->company}} </strong> IT staff to easily add/edit/modify the content and images on a
                                                daily basis. </p>
                                            <p>Appac to rework on the complete layout of the website for multiple reasons like better user interface &
                                                user experience, to address navigational issues, to improve brand authority, to stay on top of other
                                                competitor websites, and so on.</p>

                                            <h3>ANALYTICS & MEASUREMENTS</h3>

                                            <p>Appac will make a provision to setup site analytics as mentioned below:</p>
                                            <ul class="arrow-ul">
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg>Appac will utilize Google Analytics for tracking visitors to the site.</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg>All form open and submission events will be tracked in the events section of Google Analytics.</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg>All pages will have unique URLs hence allowing page tracking in Google Analytics.</li>
                                            </ul>

                                        </div>
                                        <p class="pg-no">Page no 3<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <h3>SEO OPTIMIZATION</h3>

                                            <p>Natural Search Optimization – The site design, content architecture will be set-up from a
                                                ‘best practice’ usability perspective and also with the proposed SEO program in mind. This will
                                                allow Appac to work closely with our SEO team and have all the best practice in place to perform
                                                a successful SEO program. Appac will set up site maps according to Google’s site indexing
                                                procedure and create the following SEO tasks as part of this project.</p>
                                            <ul class="arrow-ul">
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Optimization based on web vitals.</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Optimization of Associated Metadata / Descriptions / H1's</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Alt Tag (Image naming / descriptions) & Hyperlink Optimization</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Robots.txt creation</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Keyword Position / Rank Check of the existing website as a Baseline measure.</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> XML Sitemap Creation & Submission</li>
                                            </ul>
                                            <h3>Technical Standards</h3>
                                            <p>Appac will develop using the following technologies:</p>
                                            <ul class="arrow-ul">
                                                

                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> HTML 5</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> CSS 3 / Bootstrap</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Javascript / Jquery</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> React JS</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Node JS</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> AJAX</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> PHP 8.1</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Laravel</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> MySQL Database</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Linux Server & W3C Standard</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg> Minified code</li>
                                            </ul>
                                        </div>
                                        <p class="pg-no">Page no 4<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                        <h3 style="margin-top: 30px;">Web Technology</h3>
                                        <table border="1" style="border-collapse: separate; border-spacing: 10px; padding-top: 40px;">
                                                  
                                                  <tbody>
                                                      <tr>
                                                          <td>
                                                          <h3> <span class="title" style="color:#000;">Frontend: </span>React.js</h3>
                                                              <ul>
                                                                  <li><strong>Component-Based Architecture</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Makes UI development modular and reusable.</li>
                                                                  <li><strong>Virtual DOM</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Boosts performance by updating only necessary 
                                                                  </br>&nbsp;&nbsp;&nbsp;parts of the UI.</li>
                                                                  <li><strong>Fast Rendering</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– React uses efficient diffing algorithms for smooth 
                                                                  </br>&nbsp;&nbsp;&nbsp;updates.</li>
                                                                  <li><strong>Strong Ecosystem</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Large community, libraries, and tools like Next.js.</li>
                                                                  <li><strong>SEO-Friendly</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– With SSR (Server-Side Rendering) using 
                                                                  </br>&nbsp;&nbsp;&nbsp;frameworks like Next.js.</li>
                                                              </ul>
                                                          </td>
                                                          <td>
                                                          <h3><span class="title" style="color:#000;">Backend: </span>Node.js</h3>
                                                                <ul>
                                                                    <li><strong>Non-Blocking I/O</strong><br>&nbsp;&nbsp;&nbsp;– Handles multiple requests efficiently, great for </br>&nbsp;&nbsp;&nbsp;real-time apps.</li>
                                                                    <li><strong>Fast Performance</strong><br>&nbsp;&nbsp;&nbsp;– Uses the V8 engine, making it super quick.</li>
                                                                    <li><strong>JavaScript Everywhere</strong><br>&nbsp;&nbsp;&nbsp;– Same language for both frontend and </br>&nbsp;&nbsp;&nbsp;backend.</li>
                                                                    <li><strong>Large Package Ecosystem</strong><br>&nbsp;&nbsp;&nbsp;– NPM provides tons of libraries to speed up </br>&nbsp;&nbsp;&nbsp;development.</li>
                                                                    <li><strong>Microservices-Friendly</strong><br>&nbsp;&nbsp;&nbsp;– Easily scalable with APIs and microservices.</li>
                                                                </ul>
                                                          </td>
                                                      </tr>
                                                      <tr>
                                                          <td>
                                                              <h3><span class="title" style="color:#000;">Database: </span>MySQL</h3>
                                                              <ul>
                                                                  <li><strong>Structured & Reliable</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Ideal for applications that need ACID </br>&nbsp;&nbsp;&nbsp;compliance.</li>
                                                                  <li><strong>Scalability</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Can handle large amounts of data with indexing </br>&nbsp;&nbsp;&nbsp;& optimization.</li>
                                                                  <li><strong>Open-Source & Cost-Effective</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Free to use and widely supported.</li>
                                                                  <li><strong>Strong Security Features</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– With user privilege management and encryption.</li>
                                                                  <li><strong>Good Performance</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Optimized for read-heavy operations with </br>&nbsp;&nbsp;&nbsp;caching.</li>
                                                              </ul>
                                                          </td>
                                                          <td>
                                                              <h3><span class="title" style="color:#000;">Server: </span>Ubuntu (Linux)</h3>
                                                              <ul>
                                                                  <li><strong>Stable & Secure</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Frequent updates and a strong security </br>&nbsp;&nbsp;&nbsp;model.</li>
                                                                  <li><strong>Lightweight & Fast</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Uses fewer system resources than other OSs.</li>
                                                                  <li><strong>Great for Hosting</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Popular choice for web servers, cloud </br>&nbsp;&nbsp;&nbsp;computing, & DevOps.</li>
                                                                  <li><strong>Command-Line Power</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Full control with terminal commands.</li>
                                                                  <li><strong>Extensive Community Support</strong> 
                                                                  </br>&nbsp;&nbsp;&nbsp;– Lots of documentation and forums for </br>&nbsp;&nbsp;&nbsp;troubleshooting.</li>
                                                              </ul>
                                                          </td>
                                                      </tr>
                                                  </tbody>
                                              </table>
                                        </div>
                                        <p class="pg-no">Page no 5<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>


                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <h3> COPYWRITING & PHOTOGRAPHY </h3>
                                            <p>All copy & images required for the website is to be supplied by <strong> {{$web->company}} </strong> and
                                                Appac can help tweak them for SEO purposes. Any new copy written by Appac is chargeable on a word
                                                basis and image sourcing will be quoted separately</p>

                                            <p>Appac will source and post-produce all the stock images required for this website via one of the stock
                                                websites upon request from <strong>{{$web->company}}</strong>. Any paid stock photos is to be paid by
                                                <strong >{{$web->company}}</strong>. Photos of the team and others if required is to be supplied by <strong>{{$web->company}}</strong></p>

                                            <h3>TESTING, APPROVAL & CHANGE REQUESTS</h3>

                                            <p>Appac will create all functionality as described in this proposal document. Any additional features that
                                                are requested after the sign off will be costed separately and built upon approval of the extra cost.
                                                Upon completion of the beta website, Appac to conduct multiple levels of testing including cross
                                                browser, device testing, usability testing, system testing, etc to ensure the quality before client
                                                <strong >{{$web->company}}</strong> ease.</p>

                                            <h3>HOSTING</h3>

                                            <p>The development of the new website will take place on a cloud server setup. The website will be made
                                                live from that particular Cloud server allowing for suitable testing prior to Go Live. In addition to the
                                                above Appac will also host a development server for testing new features before transferring to the
                                                live server.</p>

                                            <h3>SUPPORT & MAINTENANCE</h3>

                                            <p>Any further support / maintenance / consulting requests is to be quoted separately. For Instance we
                                                can sign Annual Maintenance fees to address basic requirements.</p>
                                        </div>
                                        <p class="pg-no">Page no 6<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <div class="reduce">
                                                <p>To Summarize. The new design will aim to improve user experience, increase engagement,
                                                    and drive conversions.
                                                </p>
                                                <p class='strong'><strong>Scope of Work</strong></p>
                                                <p>- Website design (UX/UI, visual design, and responsive design)</p>
                                                <p>- Website development (front-end and back-end development, CMS integration)</p>
                                                <p>- Content creation (writing, editing, and optimization)</p>
                                                <p>- Testing and quality assurance</p>
                                                <p>- Launch and deployment</p>

                                                <p class='strong'><strong>Core Objectives:</strong></p>
                                                <p>- Showcase our brand's unique value proposition</p>
                                                <p>- Improve navigation and information architecture</p>
                                                <p>- Enhance visual appeal and consistency with our brand identity</p>
                                                <p>- Increase engagement and conversion rates</p>
                                                <p>- Ensure mobile-friendliness and accessibility</p>
                                                <p>- A visually stunning and user-friendly website that meets <strong>{{$web->company}}</strong> goals and objectives</p>

                                                <p class='strong'><strong>Key Features:</strong></p>
                                                <p>- Each section with impactful imagery and clear messaging</p>
                                                <p>- Prominent call-to-action (CTA) buttons</p>
                                                <p>- Featured products/services section</p>
                                                <p>- Testimonials and social Icons</p>
                                                <p>- Clear and simple navigation</p>
                                                <p>- Responsive design for all the devices</p>

                                                <p class='strong'><strong>Design Elements:</strong></p>
                                                <p>- Modern and minimalist design approach</p>
                                                <p>- Consistent branding throughout</p>
                                                <p>- High-quality imagery and icons</p>
                                                <p>- Clear typography and hierarchy</p>
                                                <p>- Mobile-friendly and accessible design</p>
                                            </div>

                                        </div>
                                        <p class="pg-no">Page no 7<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <div class="reduce">
                                                <p class='strong'><strong>Functional Elements:</strong></p>
                                                <p>- Easy-to-use content management system (CMS)</p>
                                                <p>- Integration with social media platforms</p>
                                                <p>- Contact form and Blog Page</p>
                                                <p>- SEO optimization</p>

                                                <p class='strong'><strong>Deliverables:</strong></p>
                                                <p>- A visually appealing and user-friendly web design and development</p>
                                                <p>- A functional and responsive website</p>
                                                <p>- A content management system (CMS) </p>
                                                <p>- Hosting will be done in our AWS Server</p>

                                                <p class='strong'><strong>Style Guide:</strong></p>
                                                <p>We guarantee that the design elements and overall visual identity are consistent and aligned
                                                    with the brand's vision, making it easier to maintain and evolve the design over time.</p>

                                            <h3>WHY CHOOSE US</h3>
											
											  <ul class="arrow-ul" Style="margin-bottom: 0px;">
											  <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg>One of the Leading Agency in South India with 100% Inhouse Production</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg>Client-centric approach, Better workflow management, Real-time Performance tracking</li>
                                                    <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg>Proven track record - Successful Casestudies for clients across industry</li>
                                                <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg>Our Client Retention rate is more than 90%. Out of 10 clients, we retain 9.</li>
                                                <li Style="line-height:20px;"><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20"><path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045"/></svg>Strong Domain knowledge in Industries we serve like Manufacturing, Healthcare, Education and Real <span Style="padding-left:30px;"> Estate. </span></li>
                                            <li><svg xmlns="http://www.w3.org/2000/svg" width="10px" height="10px" viewBox="0 0 20 20">
                                                            <path fill="currentColor" fill-rule="evenodd" d="m2.542 2.154l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.448-.475 0-.98l7.08-6.918l-6.754-6.763q-.356-.514.066-.935q.422-.42.951-.045m9 0l7.254 7.26q.204.21.204.483a.73.73 0 0 1-.204.5l-7.575 7.398q-.575.476-1.022 0q-.449-.475 0-.98l7.08-6.918l-6.754-6.763q-.355-.514.066-.935q.422-.42.951-.045" />
                                                        </svg>Personalized approach - Dedicated account manager and Customized strategies</li>
										   </ul>

                                                <span class="flex inline-fl"><h3>TIME ESTIMATE - TENTATIVELY 45-60 WORKING DAYS</h3></span>
                                                <p>- Week 1-2: Discovery and planning</p>
                                                <p>- Week 3-4: Design concepting and revisions</p>
                                                <p>- Week 5-8: Development and testing</p>
                                                <p>- Week 9: Launch and deployment</p>
                                            </div>

                                        </div>
                                        <p class="pg-no">Page no 8<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <h3>TOTAL INVESTMENT :</h3>
                                            <table class="ti_table">
                                                <tbody>
                                                    <tr class="nb">
                                                        <td><p>1.</p></td>
                                                        <td><p>Brand discovery, Project documentation and specification</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>2.</p></td>
                                                        <td><p>Concept Wireframe Creations and Information Architecture</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>3.</p></td>
                                                        <td><p>Custom UI / UX Design and Development of various sections
                                                        and subsections.</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>4.</p></td>
                                                        <td><p>Web Tree Creation and Deployment</p></td>
                                                        <td></td>
                                                    </tr>
                                                    @if(!empty($web->webcost))
                                                    <tr class="nb">
                                                        <td><p>5.</p></td>
                                                        <td><p>Technical platform implementation and Development</p></td>
                                                        <td class="val_flex"><b>{{$web->webcost}} INR </br> (One Time Cost)</b></td>
                                                    </tr>
                                                    @endif
                                                    <tr class="nb">
                                                        <td><p>6.</p></td>
                                                        <td><p>Mobile first design, Social URL & Blog Integration</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>7.</p></td>
                                                        <td><p>W3C validation, XML Site Map, Google map Integration &
                                                        Google Analytics Setup</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>8.</p></td>
                                                        <td><p>Download option (Product / Institution catalogue),
                                                        (Image & AV Gallery) & Chat Option.</p></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr class="nb">
                                                        <td><p>9.</p></td>
                                                        <td><p>Support Management System (FAQ’s, Support No. Email id
                                                        & Support Form)</p></td>
                                                        <td></td>
                                                    </tr>
                                                    @if(!empty($web->hostcost))
                                                    <tr id="row10">
                                                        <td><p>10.</p></td>
                                                        <td><p>Website Hosting (AWS server) & Maintenance for one year</p></td>
                                                        <td class="val_flex"><b>{{$web->hostcost}} INR </br> per annum</b></td>
                                                    </tr>
                                                    @endif
                                                    @if(!empty($web->sslcost))
                                                    <tr id="row11">
                                                        <td><p>11.</p></td>
                                                        <td><p>SSL certificate for one year</p></td>
                                                        <td class="val_flex"><b>{{$web->sslcost}} INR </br> per annum</b></td>
                                                    </tr>
                                                    @endif
                                                    @if(!empty($web->appointmentcost))
                                                    <tr id="row12">
                                                        <td><p>12.</p></td>
                                                        <td><p>Appointment Dashboard Creation</p></td>
                                                        <td class="val_flex"><b>{{$web->appointmentcost}} INR </br> (One Time Cost)</b></td>
                                                    </tr>
                                                    @endif
                                                    @if(!empty($web->portalcost))
                                                    <tr id="row13">
                                                        <td><p>13.</p></td>
                                                        <td><p>Feedback Portal Creation</p></td>
                                                        <td class="val_flex"><b>{{$web->portalcost}} INR </br> (One Time Cost)</b></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <p class="pg-no">Page no 9</p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div> -->
                                    </div>
                                </div>

                                <div class="page">
                                    <div class="container">
                                        <div class="currentDate"></div><div class="currentTime"></div>

                                        <div class="delo">
                                            <div class="des_div"><img src="{{asset('img/side-design-proposal.jpg')}}" alt=""></div>
                                            <div class="logo_div"><img src="{{asset('img/appac-logo.png')}}" alt="" width="180px"></div>
                                        </div>
                                        <div class="pad">
                                            <div class="reduce">
                                                <h3>INVESTMENT SUMMARY:</h3>
                                                <p>** The above rates are exclusive of GST 18%, VAT and other corporate taxes.</p>
                                                <p>** Please note Annual Maintenance cost tentatively 20hours excluding testing period is given as value
                                                    addition along with above costing.</p>
                                                <p>** This document is an estimate and also represents a binding agreement between the APPAC Media
                                                    (Agency) and <strong>{{$web->company}}</strong> (Client).</p>
                                                <p>** Additional services or alterations outside the scope of the contract will be quoted as needed at a
                                                    base rate of INR.2000 / hour, with a 1 hour minimum</p>

                                                <h3>PAYMENT TERMS:</h3>

                                                <p>Payment to be made as mentioned below:</p>
                                                <p>Phase 1 - 50% of payment in advance to kick start the project.</p>
                                                <p>Phase 2 - 30% of payment on home page approval and proceed for development.</p>
                                                <p>Phase 3 - 20% before Website Go Live</p>

                                            </div>

                                                <p>If the website Go-live is delayed by the Client, then Appac will charge a nominal figure of INR.2000 /
                                                    month to cover the unplanned Project Management and additional costs.</p>

                                            <div class="thanks_div">
                                                <p>Thank & Regards,</p>
                                                <h3>{{$web->created_by}}</h3>
                                                <p>{{$web->role}}</p>
                                                <p> <strong>Appac Mediatech Private Limited</strong></p>
                                                <p>Ph.No : +91 422 435 4854 | Mobile : +91 93429 02804</p>
                                                <p>Email : projectsupport@appacmedia.com</p>
                                                <p>Website : <a href="http://www.appacmedia.com"> www.appacmedia.com</a></p>
                                            </div>
                                        </div>
                                        <p class="pg-no">Page no 10<p>
                                        <!-- <div class="footer"><img src="./img/proposal-footer.jpg" alt="footer"></div>                                  -->
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
        function formatValue(first_value, second_value, third_value, fourth_value, fifth_value) {
            // Function to format a single value
            function formatSingleValue(value) {
                // Remove any non-numeric characters (commas)
                value = value.replace(/[^0-9]/g, '');
                // If the number is a single digit, just return it with INR
                if (value.length <= 3) {
                    return `${value} INR`;
                }
                // Format the number in Indian numbering system
                let otherNumbers = value.substring(0, value.length - 3); // All but the last three digits
                let lastThree = value.substring(value.length - 3); // The last three digits

                // Add commas to the other part of the number
                otherNumbers = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",");

                // Combine the formatted parts and return
                return `${otherNumbers},${lastThree} INR`;
            }

            return {
                first: formatSingleValue(first_value),
                second: formatSingleValue(second_value),
                third: formatSingleValue(third_value),
                fourth: formatSingleValue(fourth_value),
                fifth: formatSingleValue(fifth_value)
            };
        }

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
            filename: `{{ $web->company }}-web-proposal.pdf`,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true, dpi: 190, letterRendering: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
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
    .then(function (pdfBlob) {
        // Trigger the download for the user
        const downloadLink = document.createElement('a');
            const url = URL.createObjectURL(pdfBlob);
            downloadLink.href = url;
            downloadLink.download = `{{ $web->company }}-web-proposal.pdf`;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            URL.revokeObjectURL(url);
        
        // Now, upload the PDF Blob to the server
        // return uploadPdf(pdfBlob, `{{ $web->company }}-web-proposal.pdf`); // Use companyName instead of clientName
    })
    .then(function(response) {
        console.log(response);
        // Handle successful upload
        if (response.success) {
            
            alert('PDF file uploaded successfully');
            // Redirect to view-webpdf-list.php after upload is done
            window.location.href = 'view-webpdf-list.php';
       
        }
    })
    .finally(function() {
        // Reset the button state after everything is done
        $('#downloadPdfBtn').text('Download').attr('disabled', false);
    });
        });

        // $("#previewBtn").on("click", function() {
            // Get current date and time
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

            // You can now use `currentDate` and `currentTime` as needed
        // });


    });
</script>

</body>
</html>