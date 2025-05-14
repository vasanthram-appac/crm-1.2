<link rel="icon" href="{{ asset('asset/images/bmqr.png') }}">

<link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" /> -->


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-thin-straight/css/uicons-thin-straight.css'>

<style>

  #app{background-color: #f5f5f5;height:100vh}
    .bm-primary-color {
        background-color: #00abed;
    }

    .bm-secondary-color {
        background:url(/asset/image/bg-1.jpg);
		background-size:cover !important;
		
    }
    .bm-secondary-color.bg1 {
        background:url(/asset/image/bg-1.jpg);
		background-position:left !important;
    }
	.bm-secondary-color.bg2 {
        background:url(/asset/image/bg-2.jpg);
		background-position:right !important;
    }
	.bm-secondary-color.bg3 {
        background:url(/asset/image/bg-3.jpg);
    }
	.bm-secondary-color.bg4 {
        background:url(/asset/image/bg-1.jpg);
    }
	.bm-secondary-color.bg5 {
        background:url(/asset/image/bg-1.jpg);
    }
	.bm-secondary-color.bg6 {
        background:url(/asset/image/bg-1.jpg);
    }
	.bm-secondary-color.bg7 {
        background:url(/asset/image/bg-1.jpg);
    }


.login-form-div{border-radius:30px;border:1px solid #1990d9;background: #ffffff2e;
  backdrop-filter: blur(5px);}
.login-form-row{margin:auto;}
/* .gap-bt-frm{gap:120px;} */
.h-70{height:70%;}

.logo-div.align-left{justify-content:start !important;}
.logo-div.align-right{justify-content:end !important;}

.loginform-btn{
    width: 100% !important;
    display: flex !important;
    margin: auto !important;
    border-radius:30px;
    padding: 9px 0px;
    justify-self: center;
	background-color:#f4a71b !important;
    text-align: center !important;
    justify-content: center !important;
}
.loginform-btn.pri-text-color{background-color:#e39d1e !important;}
.loginform-btn.pri-text-color:hover{background-color:#f4a71b!important;}

.login-logo2,.login-logo1{display:none;margin:20px 30px}

    .user-dash .svg-d{margin:0px auto 15px auto;}
    .user-dash .dash-pie-chart .piechart-leads h4{text-align:center !important;}
.lgrey-bg{
background-color:#f5f5f5;
padding-top: 20px;
}
.d-block-800{display:none !important;}
.form-flex form{display:flex;align-items:center;gap:15px;flex-wrap:wrap;}
.form-flex form select{width:350px}
#bar_chart{transform: scale(0.9);}
.text-grey {
color:#100c41 !important;
}
.bg-white .text-grey{
font-weight:600!important;
}
.alert-danger{width:auto;}
.rate-link p{color:#484848 !important}
.rate-link:hover p{color:var(--lblue)!important}
.no-border{display:flex;}
.ch4{font-size:18px !important;}
.p-15{padding:0px 15px;}
.text-lblue {
color:#298ECD !important;
}
.dataTable{width:100% !important;}
.dataTables_length{font-size:12px;color: #858585 !important;}
.dataTables_wrapper .dataTables_length select{padding-right:5px;}
    :root{
--dblue:#242731;
--lblue:#298ECD;
--lwhite:#FFFAF7;

    }

h1, h2, h3, h4, h5, h6, th {font-family:'inter', sans-serif !important;color:#100C41}
p{font-family:'inter', sans-serif !important}
    .btn-check:focus+.btn,
  .btn:focus {
    outline: 0;
    box-shadow: none !important;
  }


  

.rounded-30.piechart-leads{
  	position:relative;
    border-radius:30px;
    border-top: 1px solid transparent; 
  
    
}
.menus span {
    position: relative;
    width: fit-content;
}
.rounded-30.piechart-leads  .svg-d,.rounded-30.piechart-leads  h3.text-center,.rounded-30.piechart-leads  h4{	position:relative; z-index:3;}
.sidemenu{display:none;}
/* .rounded-30.piechart-leads::before {
    content: '';
    position: absolute;
    top: -1px;
    left: -1px;
    right: -1px;
    bottom: -1px;
    background: rgb(255, 255, 255);
    background: linear-gradient(180deg, rgba(255, 255, 255, 0.9108018207282913) 49%, rgba(109, 188, 255, 0.9836309523809523) 100%);
    z-index: 0;
    border-radius: inherit;
    pointer-events: none;
}
.rounded-30.piechart-leads::after {
     content: '';
    position: absolute;
    top: 0px;
    height: 99%;
    width: 99%;
    left: 1px;
    right: 0px;
    bottom: 0px;
    background: #fff;
    z-index: 0;
    border-radius: inherit;
    pointer-events: none;
}
.rounded-30.piechart-leads:hover::after{
       content: '';
    position: absolute;
    top: 3px;
    height: 99%;
    width: 100%;
    left: 0px;
    right: 0px;
    bottom: 0px;
    background: #fff;
    z-index: 0;
    border-radius: 29px;
    pointer-events: none;
} */

  body {
    font-family: "Inter", sans-serif !important;
    font-size: 14px !important;
    color:#484848 !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current,
  .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #000 !important;
    border: 1px solid #f5f5f5 !important;
    background: #fff !important;
    margin-left: 4px;
  }
  #example_filter input{border:1px solid #d3d3d3;}
  #example_filter input:hover{border:1px solid  #898989a6;}
  #example_filter input:focus{border:1px solid #108dd761;}
  #example .odd , tr{transition:0s linear;}
  tr:hover, #example .odd:hover {background-color: #f7f9fb !important;border-color: #f5f6f9;}
  .dataTable.table-bordered {
    border: 0px solid #dee2e6 !important;
  }
.modal-content .title.ps-3.pt-1{
    color: #cc5454;
    padding: 10px 20px 0px 20px !important;
}
  .focus-input100::before {
    content: "";
    display: block;
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #00abed !important;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
  }

#errorModal .modal-content{
  padding:20px 5px;
  right: 30px;
  width: 400px;
}
#errorModal .modal-content .close {
    position: absolute;
    right: 25px;
}
 .pass-hider{ position: absolute;
    right: 33px;
    top: 34%;
}
.fa-eye:before ,.fa-eye-slash:before {
  color:#0b0a0a66 ;transform: scale(.8);}
.fa-eye:hover:before ,.fa-eye-slash:hover:before {
    color: #5d8ecf;
}

/* Tool tip */
.btn {
  position: relative;
 /* If you want dots under the hoverable text */
}
.task.hed{
    font-size: 24px;
    font-weight: 600;
}
/* Tooltip text */
.btn .tooltiptext {
  visibility: hidden;
  width: auto;
  background-color: #ddebff !important;
    color: #000;
    text-align: center;
    padding: 3px 10px;
  border-radius: 6px;
  font-size: 11px;
  font-weight:400;
  /* Position the tooltip text */
  position: absolute;
  z-index: 1;
  bottom:110%;
  left: 140%;
  margin-left: -60px;

  /* Fade in tooltip */
  opacity: 0;
  transition: opacity 0.3s;
}

.btn .tooltiptext.last {
    position: absolute;
    z-index: 1;
    bottom: 115%;
    left: -12px;
    margin-left: 0px;
}
.btn .tooltiptext.last.quer {
    position: absolute;
    z-index: 1;
    bottom:113%;
    left: -35px;
    margin-left: 0px;
}
.btn .tooltiptext.last.quer::after {
    /* content: ""; */
    position: absolute;
    top: 100%;
    left: -5%;
    margin-left: 36px;
}
.btn .tooltiptext.last::after {
    /* content: ""; */
    position: absolute;
    top: 100%;
    left: -30%;
    margin-left: 36px;
}
/* Tooltip arrow */
.btn .tooltiptext::after {
  /* content: ""; */
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #383b3d5e transparent transparent transparent;
}
.dataTables_wrapper .dataTables_processing{top: 89%;background:none !important;}
/* Show the tooltip text when you mouse over the tooltip container */
.btn:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
.lgrey-bg >.container{padding-bottom:50px;}

.swal-button.swal-button--cancel{
    border: 1px solid #288ece !important;
    background: #fff !important;
    color:#000 !important;
    font-weight:500;
    transition: .3s linear !important;

}
.swal-button.swal-button--cancel:hover{
    border: 1px solid #288ece !important;
    color: #fff !important;
    background-color: #1C69D4 !important;
    font-weight:500;
    transition: .3s linear !important;

}
.swal-icon{ width: 50px !important;
  height: 50px !important;margin:0px auto;}
.swal-button:not([disabled]):hover{
  background-color: #1C69D4 !important;
}.swal-button.swal-button--confirm.confirmdanger
{margin-top:20px;}
.swal-icon--warning__body {
    width: 5px;
    height: 22px !important;}
.swal-footer{margin-top:0px;text-align:center;padding-top:0px;}
.swal-button.swal-button--confirm.confirmdanger ,.swal-button.swal-button--confirm.swal-button--danger{
    color: #fff !important;
    background-color: #0077ED !important;
    transition: .3s linear;
    width: auto;
    font-weight:500;
    margin-top: 25px;
    border: 1px solid  #0077ED !important;
}
.swal-button.swal-button--confirm.confirmdanger:hover  ,.swal-button.swal-button--confirm.swal-button--danger:hover{
    color: #fff !important;
    background-color: #1C69D4 !important;
    
}

.error-modal{padding:0px 20px 10px!important}
  .error-modal .text-danger{color:#484848 !important};
  .pri-border-color {
    border: 3px solid #00abed !important;
  }

  .pri-border-color:hover,
  .pri-border-color:focus {
    border: 3px solid #00abed !important;
    background-color: #00abed !important;
    color: #fff !important;
  }

  /* CSS */
  .button-77 {
    align-items: center;
    appearance: none;
    background-clip: padding-box;
    background-color: initial;
    background-image: none;
    border-style: none;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    flex-direction: row;
    flex-shrink: 0;
    font-family: Eina01, sans-serif;
    font-size: 16px;
    font-weight: 800;
    justify-content: center;
    line-height: 24px;
    margin: 0;
    min-height: 64px;
    outline: none;
    overflow: visible;
    padding: 19px 26px;
    pointer-events: auto;
    position: relative;
    text-align: center;
    text-decoration: none;
    text-transform: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    vertical-align: middle;
    width: auto;
    word-break: keep-all;
    z-index: 0;
  }

  @media (min-width: 768px) {
    .button-77 {
      padding: 19px 32px;
    }
  }

  .button-77:before,
  .button-77:after {
    border-radius: 80px;
  }

  .button-77:before {
    background-color: #cef1ff;
    content: "";
    display: block;
    height: 100%;
    left: 0;
    overflow: hidden;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: -2;
  }

  .button-77:after {
    background-color: initial;
    background-image: linear-gradient(92.83deg, #00abed, #01152b 100%);
    bottom: 4px;
    content: "";
    display: block;
    left: 4px;
    overflow: hidden;
    position: absolute;
    right: 4px;
    top: 4px;
    transition: all 100ms ease-out;
    z-index: -1;
  }
.pg-clr{font-size:12px;color:var(--lblue);margin-right:8px}
.bh{font-size:30px;}
.g-data .piechart-leads{
  padding-top:30px !important;
  padding-bottom:30px!important;
}

  .button-77:hover:not(:disabled):after {
    bottom: 0;
    left: 0;
    right: 0;
    top: 0;
    transition-timing-function: ease-in;
  }

  .svg-d{height:50px;width:50px;display:flex;align-items:center;border-radius:50%;padding:0px !important}
  .svg-d img {width: 20px;height: 20px;}
  .dash-pie-chart .piechart-leads h4{margin:0px; color:#1b3e82 !important;}
  .button-77:active:not(:disabled) {
    color: #ccc;
  }
  .round-br{border-radius:30px;}

  .button-77:active:not(:disabled):after {
    background-image: linear-gradient(0deg, #00abed, #00abed), linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
    bottom: 4px;
    left: 4px;
    right: 4px;
    top: 4px;
  }

  .button-77:disabled {
    cursor: default;
    opacity: .24;
  }

  .modal-dialog.cascading-modal {
    margin-top: 5% !important;
  }

  .primary-text {
    color: #01152b;
  }

  @media (min-width: 1200px) {
    .container-xl,
    .container-lg,
    .container-md,
    .container-sm,
    .container {
      max-width: 1650px !important;
    }
  }
  .dash-pie-chart .piechart-leads:hover .task{color:#100C41 !important;}



  button.dt-button:focus:not(.disabled) {
    border: none !important;
    outline: none;
    background-color: none;
    background: none;
  }

  div.dt-button-collection button.dt-button:active:not(.disabled),
  div.dt-button-collection button.dt-button.active:not(.disabled),
  div.dt-button-collection div.dt-button:active:not(.disabled),
  div.dt-button-collection div.dt-button.active:not(.disabled),
  div.dt-button-collection a.dt-button:active:not(.disabled),
  div.dt-button-collection a.dt-button.active:not(.disabled) {
    background-color: #01152b !important;
    background: #f5f5f5 !important;
    background:  #f5f5f5 !important;
    color: #100C41 !important;
    padding: 6px 30px;
    margin: 0;
  }
  div.dt-button-collection{width: auto;padding:0;border-radius: 8px;box-shadow:none;border:1px solid #ccc;}
  button.dt-button:active:not(.disabled),
  button.dt-button.active:not(.disabled),
  div.dt-button:active:not(.disabled),
  div.dt-button.active:not(.disabled),
  a.dt-button:active:not(.disabled),
  a.dt-button.active:not(.disabled),
  input.dt-button:active:not(.disabled),
  input.dt-button.active:not(.disabled) {
    background-color: #01152b !important;
    background: -webkit-linear-gradient(top, #fff 0%, #fff 100%) !important;
    background: linear-gradient(to bottom, #00abed 0%, #00abed 100%) !important;
    box-shadow: 0px 0px 1px #a5a5a5 !important;
  }
  .d-gird-3{
    display:grid;grid-template-columns:repeat(2,1fr)
  }

  /* bar css starts */
  .lead-grp #bar_chart{position: relative;
    top: -60px;
    width: 100%;
    height: 312px;
    overflow: hidden;}
    /* #bar_charts {
    width: 100%;
    height: 500px; /* Default height */
    /* max-width: 100%; Ensure container does not exceed screen size */
/* } */
/* .menu-list-group.menu-list-group-flush.gap-2.menus{
  overflow-y:scroll;
} */
.side-menu-hed  ::-webkit-scrollbar {
  display:none;

}
.progress-bars.report{
  display:grid;grid-template-columns:repeat(2,1fr);
}
.dash-pie-chart  .piechart-leads h3 ,.month-report h3{font-size: 22px;}
 /* .month-report h4 {
    color:#0077ED !important;
} */

.dash-pie-chart .piechart-leads.dash-1{background:#bdebf2 !important;color:#1b3e82;}
/* .dash-pie-chart .piechart-leads.dash-1:hover{background:#bfecf266 !important} */
.dash-pie-chart .piechart-leads.dash-1:hover{background:#fff !important}
.dash-pie-chart .piechart-leads.dash-2{background:#ffe4a9 !important;}
/* .dash-pie-chart .piechart-leads.dash-2:hover{background:#ffe4a866 !important} */
.dash-pie-chart .piechart-leads.dash-2:hover{background:#fff !important}
.dash-pie-chart .piechart-leads.dash-3{background:#95deff !important;}
/* .dash-pie-chart .piechart-leads.dash-3:hover{background:#94ddff66 !important} */
.dash-pie-chart .piechart-leads.dash-3:hover{background:#fff !important}
.dash-pie-chart .piechart-leads.dash-8{background:#90b7ff !important;}
/* .dash-pie-chart .piechart-leads.dash-8:hover{background:#8fb6ff66!important} */
.dash-pie-chart .piechart-leads.dash-8:hover{background:#fff!important}
.dash-pie-chart .piechart-leads.dash-10{background:#f6a98d !important }
/* .dash-pie-chart .piechart-leads.dash-10:hover{background:#ffd39e66!important} */
.dash-pie-chart .piechart-leads.dash-10:hover{background:#fff!important}
.dash-pie-chart .piechart-leads.dash-6{background:#cbe7ff !important;}
.dash-pie-chart .piechart-leads.dash-6:hover{background:#fff!important}
/* .dash-pie-chart .piechart-leads.dash-6:hover{background:#cce7ff66!important} */
.dash-pie-chart .piechart-leads.dash-7{background:#aedad7 !important;}
.dash-pie-chart .piechart-leads.dash-7:hover{background:#fff!important}
/* .dash-pie-chart .piechart-leads.dash-7:hover{background:#afdad766!important} */
.dash-pie-chart .piechart-leads.dash-4{background:#d9d9d9 !important;}
/* .dash-pie-chart .piechart-leads.dash-4:hover{background:#d9d9d980!important} */
.dash-pie-chart .piechart-leads.dash-4:hover{background:#fff!important}
.dash-pie-chart .piechart-leads.dash-9{background:#c6e8c1 !important;}
/* .dash-pie-chart .piechart-leads.dash-9:hover{background:#c5e8c066!important} */
.dash-pie-chart .piechart-leads.dash-9:hover{background:#fff!important}
.dash-pie-chart .piechart-leads.dash-5{background:#C1C9E8 !important;}
/* .dash-pie-chart .piechart-leads.dash-5:hover{background:#c0c8e866!important} */
.dash-pie-chart .piechart-leads.dash-5:hover{background:#fff!important}


.dash-pie-chart .g-data{padding:0px 30px;}
.inside-nav{border-bottom:1px solid #9b9b9b;}
.inside-nav  .nav-tabs{border-bottom:0px }
.inside-nav  .nav-tabs .nav-item  a:hover{background:#fff;}
#preback{height:fit-content;padding: 10px 20px;margin: 0px 10px 0px 0px;}




@media(max-width:1500px){
  .dash-pie-chart .g-data{padding:0px 10px;}

  .admin.dash-pie-chart{
    display: grid
;
    grid-template-columns: repeat(5, 1fr);
row-gap: 30px !important;}
}


.dash-pie-chart  .piechart-leads h4 {text-align:start !important}
.dash-pie-chart  .piechart-leads h4 ,.month-report h4{
    width: 100%;
    text-align: center;
    font-size: 44px;
}.sidebar-heading{width:fit-content !important;}
.inactive .sidebar-heading{width:fit-content;}
textarea{height:123px;resize:none;}

.dash-pie-chart  .piechart-leads{
  background-color:#fff !important;
}
.dash-pie-chart  .piechart-leads:hover{
  background-color:#fff !important;
}
.dash-pie-chart  .piechart-leads:hover h3, .dash-pie-chart  .piechart-leads:hover h4 , .dash-pie-chart  .piechart-leads:hover h5{
  color:#100C41 !important;
}
.dash-pie-chart  .piechart-leads .svg-d svg path{
  fill:#1b3e82 !important;
}
/* .dash-pie-chart  .piechart-leads:hover .svg-d{
  background:#eaf1fb !important;
} */
  /* .dash-pie-chart  .piechart-leads h3, .dash-pie-chart  .piechart-leads h4 , .dash-pie-chart  .piechart-leads h5{
    color:#fff !important;
  } */
 /* #bar_chart{ 
    width: 100%;
    height: auto;
    overflow: hidden;} */
#bar_chart svg g text {fill: #808191;font-family: inter;font-size: 15px;}

.lead-grap .table-responsive{
    height: 260px;
    overflow: hidden;
}

.pieChart > div{top:-30px;}

.#bar_chart {border-radius: 30px;padding: 0px !important;background-color: #fff;}
#bar_chart div{padding:0px !important;}
#bar_chart .tooltip{padding:8px 10px;}
#bar_chart text[x="48"][y="33.2"] {
    fill: #100C41;font-family:'Work Sans', sans-serif;font-size:30px;line-height:36px;padding-bottom:15px;
  }
.bg-bactive{background:#f6f8fc !important}
.pad-rig-30{padding-right:30px !important}
  .chart-container {
    width:100%;
    display: flex;
    /* grid-template-columns: repeat(2, 1fr); */
    position: relative;
    top:-10px;
  justify-content: center;
  align-items: center;
  flex-wrap:wrap;
}
.status{height: 30px;;}
.chart {
  position: relative;
  width: 200px;
  height: 200px;
}

.chart-label {
  position: absolute;
  top: 70%;
  display: flex;
  height: 100px;
  left: 50%;
  padding:0px !important;
  transform: translate(-50%, -50%);
  text-align: center;
  font-size: 24px;
  font-weight: bold;
  font-family: 'Inter';
  width: 100%;
  color: #333;
  flex-direction: column;
}
.chart-container div{padding:0px !important;}

.chart-label div {
  font-size: 18px;
  color: #242732;
}
.pr-30 {padding-right:30px !important;}#wrapper {overflow-x: hidden;transition:0.4s linear;}
.chart-label div:nth-child(2){font-size: 12px;margin-top: 23px;color: #92afd2;}
.chart-label div:last-child{margin-top: 10px;color: #120f43;}
.piechart-leads {    background-color: #fff;
    height: 100%;
    border-radius: 30px;}
    .acc-clr .chart-label::after{
      background-color:#8caacf;}

      .dash-pie-chart .chart-label::after {
    left: 22px;
    top: -103px;
}
.rate-d{border-top:1px solid #f4f4f4;}
.rate-btn{border:none;padding:8px 20px;border-radius:5px;background:#0077ED !important;color:#fff;}
.rate-btn:hover{ background-color: #1C69D4 !important;}

.bl .legend-controls {

    display: flex;
    gap: 10px;
}

.bl .legend-button {
    padding: 8px 12px;
    border: none;
    background-color:transparent ;
    color: #100c41;
    font-weight:500;
    border-radius: 20px;
    cursor: pointer;
    font-size: 14px;
}


.bl .legend-button:hover {
  color:#fff;
    background-color: #5884c1;
}
.bl .legend-button.active{
  color:#fff;
    background-color: #5884c1;
}


.yl-wrp{background:#f5f5f5;border-radius:20px;padding:0px !important;}
.yl .legend-controls {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.yl  .legend-button {
    padding: 8px 12px;
    border: none;
    background-color:transparent ;
    color: #100c41;
    font-weight:500;
    border-radius: 20px;
    cursor: pointer;
    font-size: 14px;
}

.yl  .legend-button:hover {
  color:#fff;
    background-color: #f8a723ba;}
.yl  .legend-button.active{
  color:#fff;
    background-color: #f8a723ba;
}


.admin.dash-pie-chart{
    display: grid
;
    grid-template-columns: repeat(5, 1fr);
row-gap: 50px;padding:0px;justify-content: center;}
/* .dash-pie-chart .g-data{width:300px;} */
 .dash-pie-chart .g-data  h3{color:#1b3e82 !important;text-align:start !important;margin:0px 0px 25px;}
 .dash-pie-chart .piechart-leads:hover h3{color:#1b3e82 !important;}
 .dash-pie-chart .piechart-leads:hover h4{color:#1b3e82 !important;}
.dash-pie-chart .chart {

  margin: auto 60px 0px auto;}

  .dash-pie-chart  .chart-label div:last-child {
    margin-top: -3px;
    color: #120f43;
}
.modal-body {
  
    padding: 20px 30px;
}
.modal {z-index:99999;}
 .modal-backdrop{z-index:9999;} 

.dash-pie-chart #chart1 .chart-label div:last-child{color:#fff;}
 
.dash-pie-chart .chart-label {
    position: absolute;
    top: 70%;
    display: flex
;
    height: 100px;
    left: 60%;
    padding: 0px !important;
    transform: translate(-50%, -50%);
    text-align: center;
    font-size: 24px;
    font-weight: bold;
    font-family: 'Inter';
    width: 240px;
    color: #333;
    flex-direction: column;
}

.chart-label::after{
  position: absolute;
  content: '';
  bottom: -47px;
  width: 202px;
  z-index: -6;
  height: 248px;
  left: 0px;
  background-color: #ffffff;
  clip-path: polygon(48% 43%, 0 85%, 100% 85%);}
/* bar css ends */

#session_message {
    position: fixed;
    border:2px solid  #0077ed !important;
    background:transparent !important;
    border-radius:20px;
    padding:10px 25px;
    width: fit-content;
    color: #0077ed;
    font-weight:500;
    margin: auto;
    top: 20px;
    left: 0;
    right: 0;
    text-align: center;
    z-index: 9999;
    transform: translateY(-70px); /* Initial position off-screen */
    opacity: 0; /* Initially hidden */
    animation:slideDown 2s linear; /* Trigger animation */
}

/* Define the slide-down animation */
@keyframes slideDown {
    0% {
        transform: translateY(-70px); /* Start off-screen */
        opacity: 0;
    }50%{
      transform: translateY(0) ; 
      opacity: 1;
    }
    100% {
        transform: translateY(-70px); /* End at the desired position */
        opacity: 0; /* Make it fully visible */
    }
}



  div.dt-button-collection button.dt-button,
  div.dt-button-collection div.dt-button,
  div.dt-button-collection a.dt-button {
    position: relative;
    left: 0;
    right: 0;
    width: 100%;
    display: block;
    float: none;
    margin-bottom: 4px;
    margin-right: 0;
    border: 0px;
    background: #fff;
    padding: 0px;
  }


  button.dt-button:hover:not(.disabled),
  div.dt-button:hover:not(.disabled),
  a.dt-button:hover:not(.disabled),
  input.dt-button:hover:not(.disabled) {
    border: 1px solid #666;
    background-color: rgba(0, 0, 0, 0.1);
    background: -webkit-linear-gradient(top, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
    background: linear-gradient(to bottom, rgba(153, 153, 153, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);

  }

  div.dt-button-background {
    background: none;
  }

  .dt-button-collection>button.dt-button:hover:not(.disabled) {
    border: none !important;
  }

  .swal-button--danger {
    background-color: #01152b ;
  }
  .swal-button--cancel {
    color: #fff;
    background-color: #01152b ;
    border: none;
}


.bg-primary-head {
    --bs-bg-opacity: 1;
    background-color: #fff !important;
    box-shadow: 4px 1px 6px #00000017;
}


.bg-primary {
  background-color: #01152b !important;
}

.bg-secondary{
  background-color: #00abed !important;
}

.icon-primary-color{
  background-color: #cef1ff !important;
}

.bg-gradient{
  --bs-bg-opacity: 1;
    /* background-color: #00abed !important; */
    background: linear-gradient(to right , #00abed -280%, #01152b 100%) !important;
}

.antialiased{
    background-color: #00abed !important;
}

.bg-boxshadow{
  box-shadow: 0px 0px 15px 5px rgb(226, 226, 226) !important;
}
.client-label {margin-top: 10px;
    color: #9d9ca3;
    font-size: 15px;
    font-weight: 400;}
.pri-text-color{
  color:  #fff !important;background-color:#0077ED !important;transition:.3s linear;width: auto;
  margin-top: 25px;
}
.client-label label, .client-label span {    color: #606060 !important;
  font-weight: 400;text-wrap: nowrap;}
.rounded-30 {
    border-radius: 30px;
    transition:0.3s linear;
}
.fi{font-size:18px;}
.rounded-30:hover {box-shadow:2px 4px 12px #00000014;}
.login-column {  
padding:35px;}

.btn-check:focus+.btn, .btn:focus {
  outline: 0;
  box-shadow: none !important;
}


.dataTables_wrapper .dataTables_paginate .paginate_button.current,
.dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    color: #000 !important;
    border: 1px solid #f6f6f6 !important;
    background: #fff !important;
    border-radius: 50%;

}
.dataTables_paginate{font-size:12px;}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover{background: #fff !important;
border-radius: 50%;border:1px solid #f6f6f6;color:#000 !important;}

@media (min-width: 992px){
.navbar-expand-lg .navbar-collapse {
    display: flex !important;
    flex-basis: auto;
    flex-direction: row-reverse;
}
}


.outline-btn {    border: 1px solid #288ece !important;
  background: #fff;transition:.3s linear;}.outline-btn:hover {background: #0077ed !important;color:#fff;}
a:hover {
  text-decoration: none;
}
.btn-g2 {display:inline-flex;gap:25px;margin: 0 15px 15px;}
.label-color{
  color: #9898a6 !important;    font-size: 13px;
}
.nav-boxshadow{
  box-shadow: 3px 1px 6px 1px rgb(0 0 0 / 4%);
}
.side-menu-hed{
  box-shadow: 3px 1px 6px 1px rgb(0 0 0 / 4%);
}
.frm-btn {padding: 9px 40px;
    border: none;
    border-radius: 0.375rem;margin-top:0;}
.panel {
  border-radius: 0px;
  border: 0;
}
.form-control {    font-size: 13px !important;}
.panel {
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
  -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
  box-shadow: 0 1px 1px rgba(0,0,0,.05);
}

.gradient-card-header {
  background: -webkit-linear-gradient(50deg,#00abed,#01152b)!important;
  color: #fff !important;
  /* background: linear-gradient(40deg,#45cafc,#303f9f)!important; */
}

.gradient-card-header {
  box-shadow: 0 5px 11px 0 rgba(0,0,0,.18), 0 4px 15px 0 rgba(0,0,0,.15);
  margin-top: -1.7rem;
  border-radius: 0.125rem;
  margin-bottom: 1em;
  padding: 0.3rem 1rem;
  text-align: center;
}

#firstRow {
  margin-top: 8px;
}

 /* MODAL STYLE */

 .modal-dialog.cascading-modal .modal-header {
  text-align: center;
  margin: -2rem 1rem 1rem;
  /* padding: 1.5rem; */
  border: none;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -webkit-flex-direction: column;
  -ms-flex-direction: column;
  flex-direction: column;
  border-radius: 0.175em;
}

.modal-dialog.cascading-modal .modal-header {
  /* webkit-box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15);
  box-shadow: 0 5px 11px 0 rgba(0, 0, 0, .18), 0 4px 15px 0 rgba(0, 0, 0, .15); */
  border-bottom: 1px solid #ccc;
  margin: 0 30px !important;
}

.modal-dialog.cascading-modal .modal-header.white-text .close {
  color: #fff;
  opacity: 1;
}

.modal-content .close {
  position: absolute;
  right: 15px;
}

.modal-dialog.cascading-modal .modal-header .close {
  margin-right: 1rem;
}
.modal-header {padding-left:0;}
.modal-header .close {
  margin-top: -2px;
}
.modal-header .title {    color: #100C41;
    font-size: 30px;
    line-height: 36px;
    padding-bottom: 0;
    font-weight: 600;margin: 3px 0;width: 100%;text-align: left;}
button.close {
  padding: 0;
  cursor: pointer;
  background: 0 0;
  border: 0;
}

.modal-dialog.cascading-modal {
  margin-top: 14%;
}

.modal{padding:0px 1rem;}

.modal-dialog {
  max-width: 910px !important;
  margin: 30px auto;
}
#combo_chart_div  svg{
    position: relative;
    overflow: hidden;
    left: -15px;
}
.sp_edit {
  background: #484343a6;
}
.pl-sts-wordwrap {
  display: flex;
  flex-direction: column;
  gap: 29px;
  padding: 20px 0px !important;
}
.ic-d{width:50px;height:50px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#f3f6fb;position:relative;}
.ic-d.start::after{position:absolute;content:'';bottom: -33px;height: 28px;width:3px;padding:0px;border-radius:2px;background:#8caacf;}
.ic-d.current{background:#eaf4fb;}
.ic-d.current::after{position:absolute;content:'';bottom: -33px;height: 28px;width:3px;padding:0px;border-radius:2px;background:#0f8dd7;}
.ic-d.upcom{background:#ecf0f2;}
.plan-status{
    display: flex;
    gap:10px;
    align-items: center;
}
.plan-status h6{margin:0px;}
.plan-status p{font-size:17px;margin:0px;}
.pl-p-h{color:#27262c;}
.pl-p{color:#4791c4;font-weight:500;}
.pl-date{color:#8b8b8b;}
.left-col {
  text-align: center;
  background-size: cover;
  background-position: center;
  background-image: url('/images/login/left.webp');
}
.rev-d{height:150px;width:150px;border-radius:50%;padding:20px;display:flex;justify-content: center;align-items:center;margin:auto;}
.rev-val {
  display: flex;
  height: 130px;
  margin-bottom:30px;
  width: 130px;
  border-radius: 50%;
  padding: 13px !important;
  background: #f6f6f6;
  text-align: center;
  flex-direction: column;
  justify-content: center;
}
.rev-val p{color:#979797;text-wrap:wrap;margin:0px;}
.rev-val p.rev{color:#328abb !important;font-weight:600;font-size:17px;}
.dot-d {
    height: 25px;
    border-radius: 50%;
    width: 25px;
}
.seo  .dot-d {background: #a6a6a8;}
.ads .dot-d {background: #8aacd2;}
.montoring .dot-d {background:#248fcf;}
.amc .dot-d {background: #2b8ecd;}

.rev-p{padding:5px 12px;border-radius:5px;background: #f3f4f6;font-size:14px !important;font-weight:600;}
.seo  .rev-p {color: #ecaa29;}
.ads .rev-p {color: #ecaa29;}
.montoring .rev-p {color: #2f82ab;}
.amc .rev-p {color: #2f82ab;}
.rev-ty-d {
    background: #fff;
    padding: 15px 30px !important;
    border-radius: 12px;
}
.rev-ty-d p{margin:0px;font-size:18px;}
.rev-wrap{display:grid;gap:10px;}
.pln-sts.monr {color:#a4a4a6;margin:15px 0px;}
.pln-sts.monr h6{color:#282830;margin-bottom:8px;}
.pln-sts.monr div p{color:#a4a4a6 !important;margin:7px 0px !important;font-size:14px;}
.server-det-wrap{display:grid;grid-template-columns:repeat(4,1fr);}
.server-d{display:grid;gap:15px;margin:20px 10px}
.server-d h4 strong{font-size:25px !important;}
.server-d p{font-size:18px !important;}
.server-d .ser-type{color:#6097b9 !important;font-weight:500;text-transform:capitalize;}
.server-d h4{font-size:15px !important;}










.left-img {
  margin-top: 40%;
}

.right-col{
  background-color: #00abed;
height: 100%;
min-height: 100vh;

}
.btn-check:focus+.btn, .btn:focus {
outline: 0;
box-shadow: none !important;
}
.form-control:focus {
color: #212529;
background-color: #fff;
border-color: #86b7fe;
outline: 0;
box-shadow: none !important;
}

.btn-primary {
color: #fff;
background-color: #01152b !important;
border-color: #01152b !important;
}


/* input STYLE css start*/

.wrap-input100 {
  width: 100%;
  position: relative;
  border-bottom: 2px solid #d9d9d9;
}


.wrap-input100 {
  width: 100%;
  position: relative;
  border-bottom: 2px solid #d9d9d9;
}

.label-input100 {
  /* font-family: Poppins-Regular !important; */
  /* font-size: 16px; */
  color: #333333;
  line-height: 1.5;
  /* padding-left: 7px; */
}

.input100 {
  /* font-family: Poppins-Medium; */
  font-size: 16px;
  color: #333333;
  line-height: 1.2;

  display: block;
  width: 100%;
  height: 35px;
  background: transparent;
  padding: 0 0px 0 10px;
}


/*---------------------------------------------*/
.focus-input100 {
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
}

.focus-input100::after {
  content: attr(data-symbol);
  font-family: Material-Design-Iconic-Font;
  color: #adadad;
  font-size: 22px;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  height: calc(100% - 20px);
  bottom: 0;
  left: 0;
  padding-left: 13px;
  padding-top: 3px;
}

.focus-input100::before {
  content: "";
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: #00abed !important;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.form-control:focus~.AxOyFc,
.form-control.has-value~.AxOyFc {
    transform: scale(0.75) translateY(-32px) translateX(-8px);
    background-color: #fff;
    font-size: 15px;
    color: var(--lblue);
}
.input100:focus+.focus-input100::before {
  width: 100%;
}

.has-val.input100+.focus-input100::before {
  width: 100%;
}

.input100:focus+.focus-input100::after {
  color: #a64bf4;
}

.has-val.input100+.focus-input100::after {
  color: #a64bf4;
}

.iti--separate-dial-code .iti__selected-flag {
  background-color: #fff !important;
}

.iti {
  position: static !important;
  display: table !important;
}

:focus-visible {
  outline: none !important;
}
.form-control:focus~.AxOyFc {transform: scale(0.75) translateY(-32px) translatex(-8px);    background-color: #fff;
    font-size: 15px;
    color: var(--lblue);}
    .snByac {
    position: absolute;
    background-color: transparent;
    bottom: 25px; 
    left: 35px; 
    color: #777E90;
    font-size: 16px;
    font-weight: 400;
    max-width: calc(100% - 32px); 
    overflow: hidden;
    visibility: visible;
    padding: 0 4px;
    text-overflow: ellipsis;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1), 
                opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1), 
                background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    z-index: 1;
    pointer-events: none;
}
    .pri-text-color:hover {background-color:#1C69D4 !important;}
input::placeholder {
    /* Default placeholder style */
    opacity: 1;
    transition: opacity 0.2s ease; /* Smooth transition when focused */
}
.form-check-label{    margin-left: 8px;color: #777E90;}a{color: var(--lblue);}
input:focus::placeholder {
    /* Make placeholder invisible when input is focused */
    opacity: 0;
}
.input-fld {overflow: hidden;    padding:15px 30px 15px;}
.form-control {padding: 0.75rem;}
.sidebar-heading {padding:10px 0px;padding-left:0px}
.sidebar-hedtwo div{ transition: all 0.3s linear;width:90%;}
.sidebar-hedtwo::after {
    content: '';

    z-index: -1;

    height: 100%;
    top: 0;
    left: 0;
    transition: all 0.5s ease-in-out;
  background-color: #ECF0F2 !important;
}
.dataTables_info{font-size:12px;color:#858585 !important;margin-top:20px !important}
.ft-15{font-size:14px;}.ft-15 .fa-plus::before {height:10px;}
.menus span div{  display:flex;gap:1rem;  padding: 8px 35px !important;cursor:pointer;border-top-right-radius: 15px !important;}
.menus svg{transition:0.2s linear;}
.tab-over-y-hid{height:400px;overflow:hidden;overflow-y:scroll;}
.tab-over-y-hid::-webkit-scrollbar {
  width: 8px;
}

/* Track */
.tab-over-y-hid::-webkit-scrollbar-track {
  background: #f5f5f5; 

}
 
/* Handle */
.tab-over-y-hid::-webkit-scrollbar-thumb {
  background:  #a7a4a4c7; 
  border-radius:15px;
}

/* Handle on hover */
.tab-over-y-hid::-webkit-scrollbar-thumb:hover {
  background: #a7a4a4c7; 
}

.org-btn {color: #D68A00;
    background-color: #FFF3DD;
    padding: 5px 15px 6px;
    margin-bottom: 0;
    border: 1px solid #F4A71B;
    border-radius: 5px;}.domain-btn {text-decoration:underline;color:#484848;}
.email-btn {text-decoration:none;color:#484848;}
/* #wrapper.active  .sub-menu.active{display:none;} */
.sorting_1{padding-left:25px !important;}
table tbody tr td:first-child {
  padding-left: 25px !important;
}
td svg{height:20px;}
td svg g{stroke-width:1;}
.table-responsive button span{  font-family: 'Inter', sans-serif;}
.sidebar-hedtwo {
    font-family: 'Inter', sans-serif;
    font-size: 15px;
    line-height: 24px;
    font-weight: 500;
    padding:8px 20px !important;
  }
  th{color:#191648 !important}
  .profile-div p{margin-bottom:10px;color: #484848 !important;}
  .pro-img{overflow:hidden;align-items:center;display:flex;width:100px !important;height:100px !important;margin: 33px auto ;border-radius:50%;transition:0.3s linear;padding:0px !important;margin-bottom:10px}
  .pro-img h4{margin-bottom:0px !important;}
  .ud{text-transform:capitalize;text-align:center;}
  .d-grid-2{display:grid;grid-template-columns:repeat(2,1fr);gap: 0% 5%;}
  #app #wrapper.active{grid-template-columns:100% !important;}
  .client-li-d2 p{display:grid;grid-template-columns: 51% 3% 46%;align-items:center;margin:20px 0px 0px}
  /* .ad-btn{border-radius:10px;background:#f5f5f5;border:1px solid #f5f5f5;font-size:15px;padding:5px 10px;transition:0.3s linear;}
  .ad-btn.active{background:#288ece;color:#fff}
  .ad-btn:hover{background:#288ece;color:#fff} */
  .bd-table{height:500px;overflow:hidden;overflow-y:scroll;}
  .modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    padding: var(--bs-modal-header-padding) !important;}
  .pro-d{
    border: none;
    width:50px;
    height:50px;
    padding:0px;
    display: flex;
    border-radius: 50%;
    overflow:hidden;
    justify-content: center;
}
.nav-tabs .nav-link.active{border:none;border-bottom:3px solid  #0077ED!important;}
.nav-tabs .nav-link {
    border: none !important;
    padding: 10px 20px;
    margin: 0px 10px 0px 0px;
}
.nav-tabs .nav-link:hover{
  background: #f5f5f5}
.pro-d img{width:100%;height:auto}
  .pro-div{
    opacity: 0;
    right: -0px;
    z-index: 45;
    visibility:hidden;
    width: 250px;
    transition:0.2s linear;
    box-shadow: 2px 4px 12px #00000014;
    position: absolute;
    transform:translateY(-30px) ;
    top:70px;
  }
  #wrapper{overflow:unset;}
  .navbar ,.left-side-bar{
    position: sticky;
    top: 0;
    z-index: 9999;
}
  /* .chart >div{
    position: relative;
    margin: auto;
    left: 15%;
    right: 15%;
} */
  .pro-div.active{
    opacity:1;
    visibility:visible;
    transform:translateY(0) ;
  
  }

  .active .menus span .pro-p{display:block !important;}
  .client-li-d2 label{margin-top:0px;}
  .profile-val  div{padding:0px !important;}
  .profile-val .label{font-size:14px;color:#9d9ca3;margin-bottom:0px;}
  .profile-val .val{border:none;border-bottom: 1px solid var(--bs-border-color);border-radius:0px;
    padding: 10px 0px 0px;
    height: 38px;}
    .pro-img:hover img{transform:scale(1.1)}
    th select{border:1px solid #d5d5d5;}
    .tab-sel{display:grid;}
    .accounts-tab tbody tr td:nth-child(6) ,.accounts-tab tbody tr td:nth-child(5) ,.accounts-tab tbody tr td:nth-child(4) ,.accounts-tab thead tr th:nth-child(4)  ,.accounts-tab thead tr th:nth-child(5) ,.domain-tb tbody tr td:nth-child(7){
    text-align: center;
}

  .pro-img img{transition:0.3s linear;}
.profile-input{
  border:none;
  border-bottom:1px solid var(--bs-border-color);
  border-radius:none;
}
td, td a, td button, .text-lblue {font-size:14px !important;}

/* input STYLE css end*/

/*header css starts*/
#searchInput {
    width: 100%;
    border-radius: 10px;
    font-size: 14px;
    background-color: #f5f5f7;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='25' height='25' viewBox='0 0 24 24'%3E%3Cpath fill='%237d7c8c' d='M10.77 18.3a7.53 7.53 0 1 1 7.53-7.53a7.53 7.53 0 0 1-7.53 7.53m0-13.55a6 6 0 1 0 6 6a6 6 0 0 0-6-6'/%3E%3Cpath fill='%237d7c8c' d='M20 20.75a.74.74 0 0 1-.53-.22l-4.13-4.13a.75.75 0 0 1 1.06-1.06l4.13 4.13a.75.75 0 0 1 0 1.06a.74.74 0 0 1-.53.22'/%3E%3C/svg%3E");
    background-position: 10px 7px;
    background-repeat: no-repeat;
    padding: 8px 20px 8px 40px;
    -webkit-transition: width 0.8s ease-in-out;
    transition: width 0.8s ease-in-out;
    outline: none;
    opacity: 0.9;
    border: none;
}
.menus span img{display:none;}
#submitsearch {
    margin-left: -82px;
    padding: 5px;
    border-radius: 19px;
    cursor: pointer;
    padding-left: 10px;
    padding-right: 8px;
    padding-top: 4px;
    display: none;
    margin-right: 110px;
}
.bell{
  position: static;
  width: 30px;
  overflow:visible;
  cursor:default;
}
.bell.active{cursor:pointer;}
#totalcount{
  position:absolute;
  right:-7px;
  top:0px;
}
.bell.active::after {
  position: absolute;
    content: '';
    display: block;
    top: 5px;
    right: 5px;
    border-radius: 50%;
    overflow: hidden;
    width: 7px;
    height: 7px;
    background: #108dd7;
}
.pro-div.notify-div{
  width:400px;
  right:15px;
  top:85px;
  background:#fff;

padding-left:15px;
padding-right:15px;
}
.pro-div.notify-div div{width:100%; box-shadow: 0px 0px;}
#appenttoday{display:flex;
flex-direction:column;
gap:10px;}
#app #wrapper.active .side-menu-hed #appenttoday  p{display:block;}
.pro-div div{width:100%;}
.pro-div.notify-div #appenttoday div {
    width: 100%;
    box-shadow: 0px 0px;
    border-bottom: 1px solid #d9d9d9 !important;}
    .pro-div.notify-div #appenttoday div:last-child {
      border-bottom: none !important;}
/*header css ends*/


/* Scrollbar Styling
::-webkit-scrollbar {
    width: 5px;height:5px;top:15px;
}

::-webkit-scrollbar-track {
    background-color: #ebebeb;
    -webkit-border-radius: 10px;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    -webkit-border-radius: 10px;
    border-radius: 10px;
    background: #298ECD;
}

/* Scrollbar Styling ends*/
button.dt-button, div.dt-button, a.dt-button, input.dt-button{    font-family: 'Work Sans', sans-serif;}
.dt-buttons .buttons-csv, .dt-buttons .buttons-excel, .dt-buttons .buttons-collection {    background: #f5f5f7 !important;
    color: #100C41 !important;
    font-family: 'work sans', sans-serif;    padding: 6px 30px;
    border: 1px solid #ccc;
    border-radius: 8px;}
    table.dataTable thead th, table.dataTable tfoot th{font-weight: 600 !important;}
.bg-white th {border:none;}
.table thead th, .table thead td{padding: 20px 18px !important;border-bottom: 1px solid #B1B5C3 !important;text-wrap: nowrap;}
td{border-style: none !important;}
.menu-list-group {
  z-index: 45;
  background:#fff;
  display: flex;
  flex-wrap:wrap;
  justify-content: center;
  margin-bottom: 0;
  border-radius: 0.25rem;
  padding: 10px  0px;    width: 260px;
}

.opertunity::after{
content:'';
background:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='25' height='25' viewBox='0 0 20 20'%3E%3Cpath fill='%237d7c8c' d='M9 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8M6 6a3 3 0 1 1 6 0a3 3 0 0 1-6 0m-1.991 5A2 2 0 0 0 2 13c0 1.691.833 2.966 2.135 3.797C5.417 17.614 7.145 18 9 18q.617 0 1.21-.057a5.5 5.5 0 0 1-.618-.958Q9.301 17 9 17c-1.735 0-3.257-.364-4.327-1.047C3.623 15.283 3 14.31 3 13c0-.553.448-1 1.009-1h5.59q.277-.538.658-1zM19 14.5a4.5 4.5 0 1 1-9 0a4.5 4.5 0 0 1 9 0m-2.147.354l.003-.003a.5.5 0 0 0 .144-.348v-.006a.5.5 0 0 0-.146-.35l-2-2a.5.5 0 0 0-.708.707L15.293 14H12.5a.5.5 0 0 0 0 1h2.793l-1.147 1.146a.5.5 0 0 0 .708.708z'/%3E%3C/svg%3E");
width:25px;
height:25px;
display:block;
}
.menu-list-group-numbered {
  list-style-type: none;
  counter-reset: section;
}
.side-menu-btm {    position: relative;
  bottom: 120px;}
.menu-list-group-numbered > li::before {
  content: counters(section, ".") ". ";
  counter-increment: section;
}
.side-menu-hed{    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100vh;}
.menu-list-group-item-action {
  width: 100%;
  color: #495057;
  text-align: inherit;
}
.menu-list-group-item-action:hover, .menu-list-group-item-action:focus {
  z-index: 1;
  color: #495057;
  text-decoration: none;
  background-color: #f8f9fa;
}

.menu-list-group-item {
    position: relative;
    display: block;
    padding: 0.5rem 1rem;
    color: #212529;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid white;
}
.nav-second-level .menu-list-group-item{
    border: none;padding: 1rem;
}
.nav-second-level .collapse .menu-list-group-item {
    border: 1px solid #9b9595;
    padding-left: 30px !important;
    border-left:0px;
    border-right:0px;
    background-color: #454646;
}
.nav-second-level{
    border-bottom: solid 1px white;
}
.menu-list-group-item-action:active{
  color: #212529;
  background-color: #e9ecef;
}


.menu-list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}
.menu-list-group-item:last-child {
    border-bottom-right-radius: inherit;
  border-bottom-left-radius: inherit;
}
.menu-list-group-item.disabled, .menu-list-group-item:disabled {
    color: #6c757d;
  pointer-events: none;
  background-color: #fff;
}
.menu-list-group-item.active, .nav-second-level .collapse .menu-list-group-item.active  {
  z-index: 2;
  color: gold;
  /* background-color: gold; */
  /* border-color: #0d6efd; */
}
.menu-list-group-item + .menu-list-group-item {
  border-top-width: 0;
}
.menu-list-group-item + .menu-list-group-item.active {
  margin-top: -1px;
  border-top-width: 1px;
}

.menu-list-group-horizontal {
  flex-direction: row;
}
.menu-list-group-horizontal > .menu-list-group-item:first-child {
  border-bottom-left-radius: 0.25rem;
  border-top-right-radius: 0;
}
.menu-list-group-horizontal > .menu-list-group-item:last-child {
  border-top-right-radius: 0.25rem;
  border-bottom-left-radius: 0;
}
.menu-list-group-horizontal > .menu-list-group-item.active {
  margin-top: 0;
}
.menu-list-group-horizontal > .menu-list-group-item + .menu-list-group-item {
  border-top-width: 1px;
  border-left-width: 0;
}
.menu-list-group-horizontal > .menu-list-group-item + .menu-list-group-item.active {
  margin-left: -1px;
  border-left-width: 1px;
}
#example .odd, tr {
    background-color: #fff !important;
}
table {    border-radius: 20px;
  overflow: hidden;}
  .table td {padding: 12px 18px;color: #484848;vertical-align: middle;}.mt-6 {margin-top:60px !important;}
.act-name {text-transform:capitalize;font-size: 14px;line-height: 24px;padding: 0;text-align: left;}

table.dataTable {    border-collapse: collapse;}.dataTables_wrapper .dataTables_filter input {    border: 0px solid #aaa;
    border-radius: 10px;
    padding: 8px 20px 8px 40px;
    background-color: #ffffff;}
div.dt-button:hover:not(.disabled), a.dt-button:hover:not(.disabled), input.dt-button:hover:not(.disabled) {background:#fff !important;border: 1px solid #ccc;}
.menu button.dt-button:hover:not(.disabled) {background-color: #fff !important;border:0px solid transparent !important;}.ch2 {letter-spacing:-1px;color: #100C41;font-weight: 600;
    font-family: 'Work Sans', sans-serif;
    font-size: 30px;
    line-height: 36px;
    padding-bottom: 0px;}





@media (min-width: 576px) {
  .menu-list-group-horizontal-sm {
    flex-direction: row;
  }
  .menu-list-group-horizontal-sm > .menu-list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
  }
  .menu-list-group-horizontal-sm > .menu-list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
  }
  .menu-list-group-horizontal-sm > .menu-list-group-item.active {
    margin-top: 0;
  }
  .menu-list-group-horizontal-sm > .menu-list-group-item + .menu-list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
  }
  .menu-list-group-horizontal-sm > .menu-list-group-item + .menu-list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
  }
}
@media (min-width: 768px) {
  .menu-list-group-horizontal-md {
    flex-direction: row;
  }
  .menu-list-group-horizontal-md > .menu-list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
  }
  .menu-list-group-horizontal-md > .menu-list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
  }
  .menu-list-group-horizontal-md > .menu-list-group-item.active {
    margin-top: 0;
  }
  .menu-list-group-horizontal-md > .menu-list-group-item + .menu-list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
  }
  .menu-list-group-horizontal-md > .menu-list-group-item + .menu-list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
  }
}
@media (min-width: 992px) {
  .menu-list-group-horizontal-lg {
    flex-direction: row;
  }
  .menu-list-group-horizontal-lg > .menu-list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
  }
  .menu-list-group-horizontal-lg > .menu-list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
  }
  .menu-list-group-horizontal-lg > .menu-list-group-item.active {
    margin-top: 0;
  }
  .menu-list-group-horizontal-lg > .menu-list-group-item + .menu-list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
  }
  .menu-list-group-horizontal-lg > .menu-list-group-item + .menu-list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
  }
}
@media (min-width: 1200px) {
  .menu-list-group-horizontal-xl {
    flex-direction: row;
  }
  .menu-list-group-horizontal-xl > .menu-list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
  }
  .menu-list-group-horizontal-xl > .menu-list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
  }
  .menu-list-group-horizontal-xl > .menu-list-group-item.active {
    margin-top: 0;
  }
  .menu-list-group-horizontal-xl > .menu-list-group-item + .menu-list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
  }
  .menu-list-group-horizontal-xl > .menu-list-group-item + .menu-list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
  }
}
@media (min-width: 1400px) {
  .menu-list-group-horizontal-xxl {
    flex-direction: row;
  }
  .menu-list-group-horizontal-xxl > .menu-list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
  }
  .menu-list-group-horizontal-xxl > .menu-list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
  }
  .menu-list-group-horizontal-xxl > .menu-list-group-item.active {
    margin-top: 0;
  }
  .menu-list-group-horizontal-xxl > .menu-list-group-item + .menu-list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
  }
  .menu-list-group-horizontal-xxl > .menu-list-group-item + .menu-list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
  }
}
.menu-list-group-flush {
  border-radius: 0;
}
.menu-list-group-flush > .menu-list-group-item {
  border-width: 0 0 1px;
}
.menu-list-group-flush > .menu-list-group-item:last-child {
  border-bottom-width: 0;
}

.menu-list-group-item-primary {
  color: #084298;
  background-color: #cfe2ff;
}
.menu-list-group-item-primary.menu-list-group-item-action:hover, .menu-list-group-item-primary.menu-list-group-item-action:focus {
  color: #084298;
  background-color: #bacbe6;
}
.menu-list-group-item-primary.menu-list-group-item-action.active {
  color: #fff;
  background-color: #084298;
  border-color: #084298;
}

.menu-list-group-item-secondary {
  color: #41464b;
  background-color: #e2e3e5;
}
.menu-list-group-item-secondary.menu-list-group-item-action:hover, .menu-list-group-item-secondary.menu-list-group-item-action:focus {
  color: #41464b;
  background-color: #cbccce;
}
.menu-list-group-item-secondary.menu-list-group-item-action.active {
  color: #fff;
  background-color: #41464b;
  border-color: #41464b;
}

.menu-list-group-item-success {
  color: #0f5132;
  background-color: #d1e7dd;
}
.menu-list-group-item-success.menu-list-group-item-action:hover, .menu-list-group-item-success.menu-list-group-item-action:focus {
  color: #0f5132;
  background-color: #bcd0c7;
}
.menu-list-group-item-success.menu-list-group-item-action.active {
  color: #fff;
  background-color: #0f5132;
  border-color: #0f5132;
}

.menu-list-group-item-info {
  color: #055160;
  background-color: #cff4fc;
}
.menu-list-group-item-info.menu-list-group-item-action:hover, .menu-list-group-item-info.menu-list-group-item-action:focus {
  color: #055160;
  background-color: #badce3;
}
.menu-list-group-item-info.menu-list-group-item-action.active {
  color: #fff;
  background-color: #055160;
  border-color: #055160;
}

.menu-list-group-item-warning {
  color: #664d03;
  background-color: #fff3cd;
}
.menu-list-group-item-warning.menu-list-group-item-action:hover, .menu-list-group-item-warning.menu-list-group-item-action:focus {
  color: #664d03;
  background-color: #e6dbb9;
}
.menu-list-group-item-warning.menu-list-group-item-action.active {
  color: #fff;
  background-color: #664d03;
  border-color: #664d03;
}

.menu-list-group-item-danger {
  color: #842029;
  background-color: #f8d7da;
}
.menu-list-group-item-danger.menu-list-group-item-action:hover, .menu-list-group-item-danger.menu-list-group-item-action:focus {
  color: #842029;
  background-color: #dfc2c4;
}
.menu-list-group-item-danger.menu-list-group-item-action.active {
  color: #fff;
  background-color: #842029;
  border-color: #842029;
}

.menu-list-group-item-light {
  color: #636464;
  background-color: #fefefe;
}
.menu-list-group-item-light.menu-list-group-item-action:hover, .menu-list-group-item-light.menu-list-group-item-action:focus {
  color: #636464;
  background-color: #e5e5e5;
}
.menu-list-group-item-light.menu-list-group-item-action.active {
  color: #fff;
  background-color: #636464;
  border-color: #636464;
}

.menu-list-group-item-dark {
  background-color: #212529;
  color: #d3d3d4;
}
.menu-list-group-item-dark.menu-list-group-item-action:hover, .menu-list-group-item-dark.menu-list-group-item-action:focus {
  color: #141619 !important;
  background-color:rgb(234 235 239) !important;
}

.menu-list-group-item-dark.menu-list-group-item-action.active {
  color: #fff;
  /* background-color: #141619; */
  /* border-color: #141619; */
}

/* .swal-button:not([disabled]):hover {
    background-color: #01152b !important;
} */
.dataTables_filter {
    position: relative;
}
.fas.fa-search.position-absolute{
    left:30px !important;
}
.form-select {font-size:13px !important;padding: 12px !important;;}
.dataTables_filter i {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    pointer-events: none; /* Prevent clicks on the icon */
}

.dataTables_filter input {
    padding-left: 30px; /* Adjust based on icon size */
}
#tt {
      font-size: 20px;
      margin: auto;
      right: 0;
      /*  width: 22%; */
      height: 30px;
      color: #f6921e;
      border-radius: 4px;
      /* text-align: center; */
      font-weight: 800;
      font-size: 27px;
    }
     /* surya */
     .no-resize{resize:none;}
     .h20{height:160px;}
     a{text-decoration:none;}
     .profile-head{margin:0px 0px 0px 0px}
    .widget{padding:20px 10px;}
    .toggle_open{display:none !important;}.toggle_close{display:block !important;}
    .nav_btn{text-decoration:none;}.d-grid2{display:grid;grid-template-columns:repeat(2,1fr);row-gap: 30px;}
    /* .client-li a{text-decoration:none;} */
    .cl-ad-li{margin:20px 0px;}
    .cl-ad-li p{display: grid;grid-template-columns: 21% 1% 78%;align-items: baseline;justify-content: space-between;}
    .client-li-d p{display: grid;grid-template-columns: 35% 3% 62%;align-items: baseline;justify-content: space-between;font-family:'Work sans'}
    .client-li-d label{margin:0;}
    .client-label span{text-wrap:auto;}
    .modal-content{background:#f5f5f5 !important;}
    .sidebar-heading{height:80px;top: 0px;z-index: 9999;background-color:#fff;}
    .comp-name{font-size:34px;}
    .doc .form-control{border:none;}
    .hamburger {
      display:none;
  width: 30px;
  cursor: pointer;
  transition:0.4s linear
}
.hamburger .bar {
  width: 100%;
  height: 2px;
  background-color: #333;
  margin: 5px 0;
  transition: 0.4s;
} #wrapper{transition:0.4s linear}
/* #app #wrapper.active{display:grid !important;grid-template-columns:8% 92%;}#app #wrapper.active .side-menu-hed a{width:fit-content;transition:0.4s linear;margin: auto;padding:8px 0px !important;}#app #wrapper.active .side-menu-hed p{display:none;}
      #app #wrapper.active .toggle_open{display:block !important;transition:0.4s linear}#app #wrapper.active .toggle_close{display:none !important;transition:0.4s linear} #app #wrapper.active .left-side-bar{width:auto;} #app #wrapper.active .menu-list-group {width:auto;}
      #app #wrapper.active  .sidebar-heading {
    padding: 10px 10px;
} */
.mbl_fav{display:none;}
div[dir="ltr"][style*="position: relative;"][style*="width: 450px;"][style*="height: 327px;"] {
 
    background-color: lightblue; 
}
.rate-link:hover svg g{stroke:#298ecd}

.hamburger.active .bar:nth-child(1) {
  transform: rotate(45deg) translate(5px, 5px);
}
.hamburger.active .bar:nth-child(2) {
  opacity: 0;
}
.active .nav-boxshadow{box-shadow:none;}
.hamburger.active .bar:nth-child(3) {
  transform: rotate(-45deg) translate(5px, -5px);
}
.bg-white th{align-content:center;}

.bg-white-clr ,.menu-list-group {
  width: 100% !important;}
.col-wrap div{padding:0px 10px;}
.col-wrap div .bio {
    padding: 30px;
}
.menus span{position:relative;width:fit-content;}
/* .menus span svg{position:absolute;right:10px;} */

.nav-link b{color: #7a7a7a;
  font-weight: 500;}
  .bg-white-clr{width:260px;background:#fff;z-index:45;position:relative;}
  #wrapper.active .bg-white-clr{width:auto;background:#fff;z-index:45;position:relative;}

.nav-link.active b{color:var(--lblue)}
.dash.col-wrap{row-gap:40px;}
.col-wrap{row-gap:1.5rem;}
.d-grid{display:grid;grid-template-columns:16% 84%}
#wrapper ,#wrapper .menu-list-group ,#wrapper .left-side-bar{transition:0.4s linear}

.sub-menu{padding-left:40px;display:none;margin-top: 1px;border-top:1px solid rgb(206 206 207)}
.sub-menu.active{padding-left:50px;display:block;}

.ma{
    padding: 8px 35px !important;
    border-top-right-radius:15px !important;
}
.u-dash{position:relative;}
.u-dash .stretched-link{position:absolute;top:0px;left:0px;width:100%;height:auto;}
.u-dash .stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: "";
}
.active .ma.menu-list-group-item-dark.menu-list-group-item-action.anchor:hover{
  color: #141619 !important;
  background:rgb(234 235 239) !important;
}

.ch3{color:red;}
.menus span p{margin:0px;}



.sub-menu li{list-style:none;transition:0s linear !important;    border-radius: 20px;}
.sub-menu li a{background:transparent !important;}

.active .menu-list-group-item-dark.menu-list-group-item-action.anchor {background:transparent !important;}
.active .menu-list-group-item-dark.menu-list-group-item-action.anchor:hover{background:#d3e3fd !important;}
.active .menu-list-group-item-dark.menu-list-group-item-action.anchor.bg-active{background:#c2e7ff !important;color:#115883 !important;}
.active .menu-list-group-item-dark.menu-list-group-item-action.anchor.bg-bactive{background:#eaf5ff!important;}
.bg-active{background:#c2e7ff !important;color:#115883 !important;}

.sub-menu a{display:none !important;color:#100c41 !important}

.sub-menu li a{display:block !important;}

@media(max-width:1700px){
  .d-grid-2 {
    gap: 0% 3%;}
}


@media(max-width:1550px){
  .col-wrap div .bio {
    padding: 30px 20px;
}.dash-pie-chart  .piechart-leads h4 ,.month-report h4{
    width: 100%;
    text-align: center;
    font-size: 35px;
}
.dash-pie-chart .piechart-leads h3, .month-report h3 {
    font-size: 18px;
}
.g-data .piechart-leads {
    padding-top: 25px !important;
    padding-bottom: 25px !important;
}
.client-label {font-size:14px;}
.d-grid {
    display: grid;
    grid-template-columns: 18% 82%;
}
.prof-div{height:auto !important;}
.prof-div .nav-tabs .nav-link {margin:0px;}
.profile-col{flex-direction:column}
.profile-col .col-xxl-4{width:40%;}
.profile-col .col-xxl-8{width:100%;}
    @media(max-width:1500px){.client-li-d p {
    display: grid;
    grid-template-columns: 38% 2% 60%;}
    .col-wrap div .bio {
        padding: 30px 15px;
    }
    .menus span div ,.ma{    padding: 8px 16px !important;}
    .sub-menu.active {
      padding-left: 35px;}
      .sidebar-hedtwo {padding:6px 20px;}
      .admin.report-d{height:auto !important;}
      .svg-d svg{height:15px;width:15px;}
      .svg-d img{height:15px;width:15px;}
     .monthly-rep-grp div div div{
      position:relative;
      left:-65px;

     }
.u-name{
    font-size: 20px;
}.profile-val .val {height:60px;}
  }


  @media(max-width:1400px){
    .profile-col{flex-direction:row}
    .profile-col .col-xxl-4{width:25%;}
.profile-col .col-xxl-8{width:66.66666667%;}

  }

  @media(max-width:1350px){
    .admin.dash-pie-chart {
    display: grid
;
    grid-template-columns: repeat(3, 1fr);}

    .server-d {
    display: grid
;
    gap: 10px;
    margin: 10px 10px;
}.server-d h4 {
    font-size: 13px !important;
}.server-d h4 strong {
    font-size: 20px !important;
} .server-d p {
    font-size: 16px !important;
}
  }
    @media(max-width:1200px){
      .d-grid {
    display: grid;
    grid-template-columns: 23% 77%;
}
.sidebar-heading{width:120px;}
.rev-ty-d {
    background: #fff;
    padding: 15px 20px !important;
    border-radius: 12px;
}
.dash-pie-chart  .piechart-leads h4 ,.month-report h4{
    width: 100%;
    text-align: center;
    font-size: 35px;
}.dot-d {
    height: 20px;
    border-radius: 50%;
    width: 20px;
}
.server-det-wrap {
    grid-template-columns: repeat(3, 1fr);
}
.admin.dash-pie-chart{row-gap: 20px;padding:0px;justify-content: center;}
.dash-pie-chart .g-data{   padding: 0px 15px;
  padding-left: 15px !important;}
.dash-pie-chart .g-data h3{font-size:18px;}
.dash-pie-chart .g-data h4{font-size:45px;}
.pad-rig-30{padding-right:0px !important}
.active .menus span p{display:none !important;}
.active  .menus span svg{display:none;}
#app #wrapper.active .side-menu-hed .menus span  .ma {
            padding: 8px 16px !important;
        }
#wrapper.active  .sub-menu.active {
    padding-left: 50px;
    display: none;
}
.dum{display:none;}

  .menus span svg{display:block;}
#app #wrapper.active .side-menu-hed .menus span a{width:100%;margin:0px;padding: 8px 35px !important;}
      #app #wrapper.active{display:grid !important;grid-template-columns:10% 90%;}#app #wrapper.active .side-menu-hed a{width:fit-content;transition:0.4s linear;margin: auto;padding:8px 0px !important;}#app #wrapper.active .side-menu-hed p{display:none;}
      #app #wrapper.active .toggle_open{display:block !important;transition:0.4s linear;margin: auto;}#app #wrapper.active .toggle_close{display:none !important;transition:0.4s linear} #app #wrapper.active .left-side-bar{width:auto;} #app #wrapper.active .menu-list-group {width:auto;transition:0.4s linear;}
      .hamburger {display:block;}
      .active .menu-list-group-item-dark.menu-list-group-item-action{background:transparent !important;}
      .active .menu-list-group-item-dark.menu-list-group-item-action.bg-active{background:#eaf1fb !important;}
      #app #wrapper.active .side-menu-hed .menus  .sub-menu li a{display:none !important}
      .menu-list-group{display:none;}
      .toggle_close {
    display: none !important;
}.inactive .sidebar-heading{width: 120px;}
.sidebar-heading{justify-content:center !important;}
.toggle_open {
    display: block !important;
}
.sidemenu{position:fixed;top: 95px;height:100vh;transform:translateX(-300px);transition:0.3s linear;box-shadow: 2px 6px 6px #00000017;width:250px;background:#fff;overflow: scroll;}
.menu-list-group{height:auto;flex-wrap:nowrap;}
.inactive   .sidemenu{transform:translateX(0)}
.sidemenu .menu-list-group{display: flex;flex-direction: column;}
.sidemenu .menus span p {
            display: block !important;
        }
        .sidemenu ,.side-menu-hed .menu-list-group{display:block;}
        .pro-div{right:0px;}
  }
    @media(max-width:1100px){
      .mainPAge{padding:1rem 10px !important}
      .bg-white-clr ,.menu-list-group {
        width: 240px }
        .prof{flex-direction:column;gap:15px}
        .prof .profile-head{text-align:start;width:100%;}
        .prof .search-bar{    justify-content: flex-start !important;}
        .form-flex form select {
    width: 100%;
}


        
.admin.dash-pie-chart {
    display: grid
;
    grid-template-columns: repeat(2, 1fr);}
     .sidebar-heading , .inactive .sidebar-heading {
            width: 70px;
        }
       
  }
.form-flex form {gap:10px;}
    }

@media(max-width:901px){

  .server-det-wrap {
            grid-template-columns: repeat(2, 1fr);
            row-gap:20px;
        }

    .server-d {
    display: grid
;
    gap: 8px;
    margin: 8px 10px;
}.server-d h4 {
    font-size: 13px !important;
}.server-d h4 strong {
    font-size: 18px !important;
} .server-d p {
    font-size: 14px !important;
}
.rev-ty-d {
    background: #fff;
    padding: 15px 15px !important;
    border-radius: 12px;
}
.dot-d {
    height: 15px;
    border-radius: 50%;
    width: 15px;
}
.sidebar-heading {
    padding: 10px 20px;
}
}

    @media(max-width:900px){
      .bg-white-clr{position:fixed;top:80px;z-index: 45;transform:translateX(0%);transition:0.4s linear;}
      #wrapper.active .bg-white-clr,#app #wrapper.active .left-side-bar  {width:60px;left: -60px;position: relative;}
      #wrapper.active .bg-white-clr{position:fixed;top:80px;z-index: 45;transform:translateX(-300px)}
      #app #wrapper.active .side-menu-hed a {margin:0px 30px;}
      #app #wrapper.active{display:grid !important;grid-template-columns:0% 100%;}
      #app #wrapper{grid-template-columns:0% 100%;}
      .bg-white-clr ,.menu-list-group {
        width:270px !important;}
        .lgrey-bg .container{
          padding:0px 15px !important;
        }
        .pln-sts .d-flex.flex-wrap{gap:5px !important;}
        .plan-status p {
    font-size: 14px;
    margin: 0px;
}.plan-status {
    display: flex
;padding:0px !important;
    gap: 0px;
    align-items: center;
}
.rev-ty-d{gap:10px;}
.rev-ty-d p{line-height:20px;}
        .container{
    max-width: 95% !important;
}
.dash-pie-chart{row-gap:25px;}
        #app #wrapper.active .side-menu-hed p{display:block;}
        .mbl_fav{display:block;}

        .active .menu-list-group-item-dark.menu-list-group-item-action.anchor.bg-active {
    background: #eaf1fb !important;
}
.active .menu-list-group-item-dark.menu-list-group-item-action{ background: transparent !important;}

.menu-list-group {
    padding-top: 15px;
}
	

.login-column {  
padding:30px;}
.inside-nav{flex-wrap:wrap;}
.inside-nav .nav-tabs{flex-wrap:wrap;justify-content:start !important;}  
}

@media(max-width:820px){
  .profile-col {
            flex-direction: column;
        }
        #piechart_3d{
          transform:scale(0.8)
        }
        .dash-pie-chart .g-data h4 {
            font-size: 35px;
        }
        .profile-col .col-xxl-4{width:40%;}
.profile-col .col-xxl-8{width:100%;}
.lgrey-bg .container {
            padding: 0px 5px !important;
        }
        /* .chart-container{
          grid-template-columns:repeat(1,1fr)
        } */
      .d-none-800{display:none !important;}
      .d-block-800{display:flex !important;}
}

@media(max-width:640px){
 #searchInput{display:none;}
 .nav-div{padding:0px 30px !important;}
 .client-label {font-size:14px;}
 .profile-col .col-xxl-4{width:100%;}
 .pro-img{width:60%;}
 .dash-pie-chart .g-data {
            padding: 0px 5px;
            padding-left: 5px !important;
        }

        .server-det-wrap {
            grid-template-columns: repeat(1, 1fr);
            row-gap:20px;
        }
 .progress-bars.report {
    display: grid;
    padding:0px;
    grid-template-columns: repeat(1, 1fr);
}.dash-pie-chart{row-gap:10px;}
.lead-charthed{display:block !important;}
 .profile-col img{margin:auto;}
 .d-grid-2 {
    display: grid;
    grid-template-columns: repeat(1, 1fr);gap:0px;}

    #piechart_3d >div{
    position: relative;
    width: 400px;
   
    left: -9%;
    height: 365px;
}

/* vasanth css */
.dataTable.table-bordered {margin-top: 30px !important;}
/* vasanth css */

.email-label{display:flex !important;flex-wrap:wrap;}
.sidemenu{transform:translateX(-100%);flex-wrap:nowrap;height:100vh;background:#fff;}
.menus span {width:100%;border-bottom:1px solid #cccccc;}
.sidemenu .menu-list-group{gap:0px !important}
.menu-list-group{flex-wrap:nowrap;height:100%;overflow:scroll;height: 70vh;} 
.sidebar-heading{padding:0px  0px 0px 5px;}
.sidebar-heading, .inactive .sidebar-heading{width: fit-content;}
.menus span div {
            padding: 10px 16px !important;
            border-top-right-radius: 0px !important;
        }
        .side-menu-hed .menu-list-group{height:auto;}
        .pro-div { width: 220px;}
        #app #wrapper.active .side-menu-hed .menus span a{padding:8px 15px !important}
}

@media(max-width:580px){
	.login-logo2, .login-logo1 {
           margin: 20px 10px;
        width: 140px;
}
.nav-div {
        padding: 0px 20px !important;
    }
    .sidemenu{width:100%;}
    .menu-list-group{width:100% !important;}
}
@media(max-width:540px){
  .status-wrp
    {
    flex-direction: column-reverse;
    align-items: baseline;
  }
  .dash-pie-chart .g-data{width:100%;}
  
.login-column {  
padding:20px;}
}



@media (max-width: 480px) {.mb-5 {margin-bottom: 2rem !important;}.mbpad {padding-bottom:0 !important;}.input-fld {padding: 15px 20px 15px;}#logo img {width:135px;}
    #piechart_3d >div {
            position: relative;
            width: 400px;
            left: -19%;
            height: 365px;
        }
        .bg-white-clr ,.menu-list-group {width:100%!important;}
          #wrapper.active .bg-white-clr {transform: translateX(-406px);}
		  
		  /* vasanth css */
          .dash-pie-chart .g-data h3 {font-size: 13px;font-weight: 500;}.svg-d svg {width: 20px;height: 20px;}
          .svg-d img {width: 20px;height: 20px;}
          .g-data .piechart-leads {padding-top: 20px !important;padding-bottom: 20px !important;}.svg-d {margin-top: 0px;}
#example_filter input {width:100%;}.dataTables_wrapper .dataTables_filter input {padding: 8px 20px;}
form .text-end br {display:none;}.client-li.profile-div .nav-tabs .nav-link {
    border: none !important;
    padding: 10px 10px;
    margin: 0px 0px 0px 0px;
    text-align: center;
    width: 100%;
}.client-li.profile-div .nav-tabs {display:grid;grid-template-columns:repeat(2, 1fr);}.mp-0 {padding:0 !important;}
/* vasanth css */

 .bm-secondary-color.bg2 {
     
        background-position: -780px !important;
    }
	.bm-secondary-color.bg3 {
    background: url(/asset/image/bg-3.jpg);
    background-position: -172px !important;
}

  }


  @media(max-width:450px){
    .pro-div.notify-div{
  width:90%;right: 5%;
  left: 5%;}
  #app #wrapper.active .side-menu-hed #appenttoday a {
        margin: 0px 0px;
    }
  }
  
  
  
  /*from surya*/
  
  
  /*from Vasanth*/
  @media (max-width: 380px) {.btn-g2{display:block;}.btn-g2 .frm-btn.outline-btn {margin-top:5px}}
  
  
  #bar_charts {max-width: 100%;} #bar_charts >div, #bar_charts >div >div, #area_chart_div >div, #area_chart_div >div >div  {padding: 0 !important;}
.dataTables_length {margin-bottom:5px;}.dataTables_wrapper .dataTables_filter {margin-top: 0;}
.dataTables_wrapper .dataTables_paginate {background-color: #f1f1f1;border-radius: 10px;padding: 5px 0;}
div.dt-button-collection button.dt-button, div.dt-button-collection div.dt-button, div.dt-button-collection a.dt-button {background: #eaf5ff;padding: 10px 30px;border-bottom: 1px solid #ccc;margin-bottom: 0;}div.dt-button-collection button.dt-button:active:not(.disabled), div.dt-button-collection button.dt-button.active:not(.disabled), div.dt-button-collection div.dt-button:active:not(.disabled), div.dt-button-collection div.dt-button.active:not(.disabled), div.dt-button-collection a.dt-button:active:not(.disabled), div.dt-button-collection a.dt-button.active:not(.disabled){background-color: #fff !important;}.profile-val .label {color: #9d9ca3 !important;}.row.col-wrap {margin-left:0;padding:0;}[type="button"]:not(:disabled), [type="reset"]:not(:disabled), [type="submit"]:not(:disabled), button:not(:disabled){text-align:left;}
select {border-radius: 15px;border: 1px solid #d3d3d3;}button.dt-button:active:not(.disabled), button.dt-button.active:not(.disabled), div.dt-button:active:not(.disabled), div.dt-button.active:not(.disabled), a.dt-button:active:not(.disabled), a.dt-button.active:not(.disabled), input.dt-button:active:not(.disabled), input.dt-button.active:not(.disabled){background:#0077ed;   color: #fff !important;}button.dt-button, div.dt-button, a.dt-button, input.dt-button {transition: .3s linear;}.widget-body {padding:0 !important;}

div.dt-button-collection, div.dt-button-collection>div {padding:0 !important;}.lead-charthed {margin-left: 0 !important;}
.lead-charthed .pad-rig-30 {margin-bottom: 15px !important;}



@media(max-width:370px){
  .admin.dash-pie-chart {
            display: grid
;
            grid-template-columns: repeat(1, 1fr);
        }
}


</style>