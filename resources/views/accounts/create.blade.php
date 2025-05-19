<style>
    #preback {
        display: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
        padding-top: 8px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 10px !important;
        right: 1px;
        width: 20px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 43px !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        vertical-align: middle;
        width: 75% !important;
    }

    #acchistory td {
        padding: 12px 18px;
    }

    .dataTables_filter,
    .dataTables_length {
        margin-bottom: 20px
    }

    .odd {
        background-color: #fff !important;
    }
</style>

<div class="row">

    <!-- <a href="javascript:history.back()">Back</a> -->
    <a href="javascript:window.location.reload()">Back</a>
    <!-- Profile Portlet -->
    <div class="profile span12">
        <div class="span6 profile-side-box col-12 my-3 col-lg-12 col-xl-12 col-xxl-12">
            <div class="profile-head ps-3">
                <h1 style="ch2 comp-name">
                    {{ $accounts->company_name }}
                </h1>

            </div>
        </div>

    </div>

    <div class="col-12">
        <div class="row  col-wrap">

        @if(!empty($accounts->csmname) || !empty($accounts->csmphone) || !empty($accounts->csmemail) || !empty($accounts->csmname1) || !empty($accounts->csmphone1) || !empty($accounts->csmemail1) || !empty($accounts->bdmname) || !empty($accounts->bdmphone) || !empty($accounts->bdmemail))
            <div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100 u-dash">

                <div class="bio  rounded-30  @if(!empty($accounts->csmname1) || !empty($accounts->csmphone1) || !empty($accounts->csmemail1)) server-det-wrap  two @else d-flex @endif bg-white h-100  client-li  profile-div client-div">
                        @if(!empty($accounts->csmname) || !empty($accounts->csmphone) || !empty($accounts->csmemail))
                        <div class="bg-white    client-li">
                            <div class="widget-body">
                                <h4>Marketing Person 1</h4>
                            </div>
                            <div class="row experience client-li-d">
                                @if($accounts->csmname) <p class="client-label">Name<span>:</span><span>{{ $accounts->csmname }}</span></p> @endif
                                @if($accounts->csmphone) <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">+91 {{ $accounts->csmphone }}</a></span></p> @endif
                                @if($accounts->csmemail) <p class="client-label">Email<span>:</span><span class="text-truncate"> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->csmemail }}</a></span></p> @endif
                            </div>

                           @if(!empty($accounts->csmname1) || !empty($accounts->csmphone1) || !empty($accounts->csmemail1))
                            <div class="widget-body">
                                <h4>Marketing Person 2</h4>
                            </div>
                            <div class="row experience client-li-d">
                             @if($accounts->csmname1) <p class="client-label">Name<span>:</span><span>{{ $accounts->csmname1 }}</span></p> @endif
                                @if($accounts->csmphone1) <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">+91 {{ $accounts->csmphone1 }}</a></span></p> @endif
                                @if($accounts->csmemail1) <p class="client-label">Email<span>:</span><span class="text-truncate"> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->csmemail1 }}</a></span></p> @endif
                           </div>
                            @endif

                        </div>
                        @endif

                        @if(!empty($accounts->bdmname) || !empty($accounts->bdmphone) || !empty($accounts->bdmemail))
                        <div class="bg-white    client-li">
                            <div class="widget-body">
                                <h4>Marketing Person 3</h4>
                            </div>
                            <div class="row experience client-li-d">
                                @if($accounts->bdmname) <p class="client-label">Name<span>:</span><span>{{ $accounts->bdmname }}</span></p> @endif
                                @if($accounts->bdmphone) <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">+91 {{ $accounts->bdmphone }}</a></span></p> @endif
                                @if($accounts->bdmemail) <p class="client-label">Email<span>:</span><span class="text-truncate"> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->bdmemail }}</a></span></p> @endif
                            </div>
                        </div>
                        @endif
</div>
</div>
@endif
<div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100 u-dash">

<div class="bio  rounded-30 bg-white h-100  @if(!empty($accounts->mdname) || !empty($accounts->mdphone) || !empty($accounts->mdphone)) server-det-wrap  two @else d-flex @endif   client-li  profile-div client-div">
                        <div class="bg-white    client-li">
                            <div class="widget-body">
                                <h4>Accounts</h4>
                            </div>
                            <div class="row experience client-li-d">
                                <p class="client-label">Name<span>:</span><span>{{ $accounts->title }} {{ $accounts->firstname }} {{ $accounts->lastname }}</span></p>
                                <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">{{ $accounts->stdcode }} {{ $accounts->phone }}</a></span></p>
                                <p class="client-label">Email<span>:</span><span class="text-truncate"> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->emailid }}</a></span></p>
                                <p class="client-label">Website<span>:</span><span> <a target="_blank" href="http://{{ $accounts->website }}">{{ $accounts->website }}</a></span></p>
                                @if(!empty($accounts->gst_number))
                                <p class="client-label">GST Number<span>:</span><span>{{ $accounts->gst_number }}</span></p>
                                @endif
                                <p class="client-label">Address<span>:</span><span>{!! $accounts->address !!}</span></p>
                            </div>
                        </div>

                        

                        @if(!empty($accounts->mdname) || !empty($accounts->mdphone) || !empty($accounts->mdphone))
                        <div class=" bg-white    client-li">
                            <div class="widget-body">
                                <h4>Management </h4>
                            </div>
                            <div class="row experience client-li-d">
                                @if($accounts->mdname) <p class="client-label">Name<span>:</span><span>{{ $accounts->mdname }}</span></p> @endif
                                @if($accounts->mdphone) <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">+91 {{ $accounts->mdphone }}</a></span></p> @endif
                                @if($accounts->mdemail) <p class="client-label">Email<span>:</span><span class="text-truncate"> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->mdemail }}</a></span></p> @endif
                            </div>
                        </div>
                        @endif

                    
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-xxl-12 pr-20 h-100 u-dash">
                <div class="bio  rounded-30 bg-white h-100 row col-wrap client-li col-12 profile-div  acc-domain">
                <div class="col-lg-12 col-xl-6 col-xxl-6">
                    <div class="server-det-wrap  two">
                        <div class="server-d">
                            <img src="asset/image/domain.png" alt="">
                            <h4 class="m-0"><strong>Domain</strong> {{(count($domain) > 0) ? $domain[0]->dateofexpire : ""}}</h4>
                            <span class="d-flex gap-3 align-items-center">
                                <p class="ser-type m-0">
                                    @if(count($domain) > 0)
                                    {{ $domain[0]->domain_manager }}
                                    @else
                                    Domain Manager
                                    @endif
                                </p>|
                                <p class="ser-val m-0">
                                    @if(count($domain) > 0)
                                    {{ $domain[0]->domain_source }}
                                    @else
                                    Source
                                    @endif
                                </p>
                            </span>
                        </div>
                        <div class="server-d">
                            <img src="asset/image/hoisiting.png" alt="">
                            <h4 class="m-0"><strong>Web Hosting</strong> {{($hosting) ? $hosting->dateofexpire : ""}}</h4>
                            <span class="d-flex gap-3 align-items-center">
                                <p class="ser-type m-0">{{($hosting) ? $hosting->hosting_manager : "Server"}}</p>|<p class="ser-val m-0">{{($hosting) ? $hosting->hosting_source : "Host"}}</p>
                            </span>
                        </div>
                        <div class="server-d">
                            <img src="asset/image/email.png" alt="">
                            <h4 class="m-0"><strong>Email</strong> {{($email) ? $email->dateofexpire : ""}}</h4>
                            <span class="d-flex gap-3 align-items-center">
                                <p class="ser-type m-0">{{($email) ? $email->vendorname : "Server"}}</p>|<p class="ser-val m-0">{{($email)?$email->noofemailid:0}}</p>
                            </span>
                        </div>
                        <div class="server-d">
                            <img src="asset/image/domain.png" alt="">
                            <h4 class="m-0"><strong>SSL</strong> {{(count($ssl) > 0) ? $ssl[0]->dateofexpire : ""}}</h4>
                            <span class="d-flex gap-3 align-items-center">
                                <p class="ser-type m-0">
                                    @if(count($ssl) > 0)
                                    {{ $ssl[0]->Source }}
                                    @else
                                    Source
                                    @endif
                                </p>|
                                <p class="ser-val m-0">
                                    @if(count($ssl) > 0)
                                    {{ $ssl[0]->D_month }}
                                    @else
                                    Month
                                    @endif
                                </p>
                            </span>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-12 col-xl-6 col-xxl-6">
                <div class="profile-side-box green  bg-white">
                    <div class="widget-body">
                        <h4>Notes</h4>

                        {!! Form::open(['route' => ['accounts.store'], 'method' => 'POST']) !!}
                        @csrf

                        <input type="hidden" class="span3" id="datetimestamp" name="datetimestamp" value="{{ now()->format('M d, Y - G:i') }}" readonly>
                        <input type="hidden" class="span3" id="employee" name="employee" value="{{ session('empid') }}" readonly>
                        @if(!empty($accountmanager))
                        <input type="hidden" class="span3" id="aemail" name="aemail" value="{{ $accountmanager->emailid }}" />
                        @endif
                        <input type="hidden" class="span3" id="company_name" name="company_name" value="{{ $accounts->id }}" readonly>


                        <div class=" validate-input m-b-23 mb-2">
                            {!! Form::label('subject', 'Subject', ['class' => 'label-color py-2 ']) !!}
                            {!! Form::text('subject', null, ['class' => 'form-control', 'maxlength' => '50', 'placeholder' => 'Enter Subject']) !!}

                        </div>


                        <!-- Summary Field -->

                        <div class=" validate-input m-b-23 mb-2">
                            {!! Form::label('summary', 'Brief Description', ['class' => 'label-color py-2']) !!}
                            {!! Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '5', 'style' => 'resize:none;', 'placeholder' => 'Brief Description', 'required']) !!}

                        </div>




                        <div class=" validate-input m-b-23 mb-2">
                            {!! Form::label('mail_cc', 'Mail to CC', ['class' => 'label-color py-2 ']) !!}
                            {!! Form::select('mail_cc[]', $results->pluck('fname', 'emailid')->toArray(), null, ['class' => 'select2 input100 custoname border-0', 'multiple' => true, 'placeholder' => 'Select Employee']) !!}

                        </div>


                        <div class="text-end">
                            <label class="err_lbl"></label><br>
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                                Update Info
                            </button>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
                </div>
            </div>
            <!-- 
            <div class="col-lg-12 col-xl-2 col-xxl-2 pr-20 h-100   u-dash">

                <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
                    <h4 class="text-center">Revenue</h4>
                    <div class="rev-d h-100 mb-3">
                        <div class="rev-val">

                            <p class="rev mb-0">{{$formattedNumber}}</p>
                            <p class="rev mb-0">{{$scale}}</p>
                        </div>
                    </div> -->

            <!-- <div class="col-lg-7 ">
        <div class="rev-wrap">
            <div class="rev-ty-d d-flex justify-content-between align-items-center py-2 px-2 seo">
                <div class="d-flex align-items-center p-0 gap-3">
                    <div class="dot-d p-0"></div>
                    <p>Organic SEO</p>
                </div>
                <div class="rev-price p-0">
                    <p class="rev-p">Rs.50k</p> 
                </div>
            </div>
            <div class="rev-ty-d d-flex justify-content-between align-items-center py-2 px-2 ads">
                <div class="d-flex align-items-center p-0 gap-3">
                    <div class="dot-d p-0"></div>
                    <p>Paid Ads</p>
                </div>
                <div class="rev-price p-0">
                    <p class="rev-p">Rs.50k</p> 
                </div>
            </div>
            <div class="rev-ty-d d-flex justify-content-between align-items-center py-2 px-2 montoring">
                <div class="d-flex align-items-center p-0 gap-3">
                    <div class="dot-d p-0"></div>
                    <p>Paid Monitoring</p>
                </div>
                <div class="rev-price p-0">
                    <p class="rev-p">Rs.50k</p> 
                </div>
            </div>
            <div class="rev-ty-d d-flex justify-content-between align-items-center  py-2 px-2  amc">
                <div class="d-flex align-items-center p-0 gap-3">
                    <div class="dot-d p-0"></div>
                    <p>Server & AMC</p>
                </div>
                <div class="rev-price p-0">
                    <p class="rev-p">Rs.50k</p> 
                </div>
            </div>
        </div>
        
        </div> -->
            <!-- </div>
            </div> -->

        </div>
    </div>
</div>
</div>

<!-- Tabbed Content for History, Reports, Payments -->
<div class="row pt-4">
    <!-- <h2 class="ch2 fw-600">History Details</h2> -->
    <ul class="nav nav-tabs px-4" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" href="#acchistory"><b>Accounts History</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" href="#wiphistory"><b>WIP History</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" href="#scope"><b>Scope</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#report"><b>Daily Work report</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#dmworks"><b>DM Works</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#assetlibrary"><b>Asset Library</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#requiredinput"><b>Input Required</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#payment"><b>Payment Details</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#proforma"><b>Proforma</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#invoice"><b>Invoice</b></a></li>
        @if(request()->session()->get('empid') == "AM001" || request()->session()->get('empid') == "AM090" || request()->session()->get('empid') == "admin")
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#revenue"><b>Revenue</b></a></li>
        @endif
        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#social"><b>Social Media login</b></a></li> -->
    </ul>

    <div class="tab-content">

        <!-- DataTables CSS -->
        <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
        <link href="assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">

        <!-- Accounts History Tab -->
        <div id="acchistory" class="tab-pane fade show active" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <div class="widget-body"  style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable1" class="table table-bordered dataTable table-responsive" style="width:100%">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>Date of Notes Created</th>
                                        <th>Employee Name</th>
                                        <th>Subject</th>
                                        <th>Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($notes) > 0)
                                    @foreach($notes as $note)
                                    <tr class="bg-white">
                                        <td>{{ $note->datetimestamp }}</td>
                                        <td>{{ $note->fname }}</td>
                                        <td>{{ $note->subject }}</td>
                                        <td>{{ $note->summary }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- WIP History Tab -->
        <div id="wiphistory" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> WIP History</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable2" class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>Date of Notes Created</th>
                                        <th>Employee Name</th>
                                        <th>Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($history)>0)
                                    @foreach($history as $record)
                                    <tr>
                                        <td>{{ $record->submitdate }}</td>
                                        <td>{{ $record->fname }} {{ $record->lname }}</td>
                                        <td>{{ $record->comments }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Work Report Tab -->
        <div id="report" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable3" class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Date of Report</th>
                                        <th>Employee Name</th>
                                        <th>Project Name</th>
                                        <th>Total Working Time</th>
                                        <th>Status</th>
                                        <th>Submit Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($reports)>0)
                                    @foreach($reports as $index => $report)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $report->report_date }}</td>
                                        <td>{{ $report->fname }} {{ $report->lname }}</td>
                                        <td>{{ $report->project_name }}</td>
                                        <td>{{ $report->total_time }}</td>
                                        <td>{{ $report->status }}</td>
                                        <td>{{ $report->submit_time }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Details Tab -->
        <div id="payment" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Payment Details</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table class="table table-bordered datatable4">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Date</th>
                                        <th>Create By</th>
                                        <th>Product/Service</th>
                                        <th>Proforma / Invoice</th>
                                        <th>Amount</th>
                                        <th>Bank Name</th>
                                        <th>Cheque No</th>
                                        <th>NEFT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($payments)>0)
                                    @foreach($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $payment->paydate }}</td>
                                        <td>{{ $payment->fname }}</td>
                                        <td>{{ $payment->productservice }}</td>
                                        <td>
                                            @php
                                            $inno = base64_encode($payment->invoiceno);
                                            $pno = base64_encode($payment->pinvoice);
                                            @endphp
                                            @if($payment->pinvoice && $payment->invoiceno)
                                            <b>PI:</b> <a href="{{ url('pprint/' . $pno) }}" target="_blank">{{ $payment->pinvoice }}</a><br>
                                            <b>Ino:</b> <a href="{{ url('iprint/' . $inno) }}" target="_blank">{{ $payment->invoiceno }}</a><br>
                                            @elseif($payment->pinvoice)
                                            <b>PI:</b> <a href="{{ url('pprint/' . $pno) }}" target="_blank">{{ $payment->pinvoice }}</a><br>
                                            @elseif($payment->invoiceno)
                                            <b>Ino:</b> <a href="{{ url('iprint/' . $inno) }}" target="_blank">{{ $payment->invoiceno }}</a><br>
                                            @endif

                                        <td>{{ $payment->payamount }}</td>
                                        <td>{{ $payment->bankname }}</td>
                                        <td>{{ $payment->chequeno }}</td>
                                        <td>{{ $payment->neftnumber }}</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="9" align="right"><b>Total Amount: Rs: {{ $totalPay }}</b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DM Works Report Tab -->
        <div id="dmworks" class="tab-pane fade show " role="tabpanel">
            <div class="row">

                <div class="col-lg-5 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dmtypea', 'Type*', ['class' => 'label-color py-2 '] ) !!}
                        <select name="dmtypea" class="tab-sel form-select" id="dmtypea">
                            <option value="All" @if(request()->session()->get('dmtypea') == 'All') selected @endif>All</option>
                            <option value="Promotion Dashboard" @if(request()->session()->get('dmtypea') == 'Promotion Dashboard') selected @endif>Promotion Dashboard</option>
                            <option value="Monthly Report" @if(request()->session()->get('dmtypea') == 'Monthly Report') selected @endif>Monthly Report</option>
                            <option value="Audit Report" @if(request()->session()->get('dmtypea') == 'Audit Report') selected @endif>Audit Report</option>
                            <option value="MR Report" @if(request()->session()->get('dmtypea') == 'MR Report') selected @endif>MR Report</option>
                            <option value="Minutes of Meeting" @if(request()->session()->get('dmtypea') == 'Minutes of Meeting') selected @endif>Minutes of Meeting</option>
                            <option value="Others" @if(request()->session()->get('dmtypea') == 'Others') selected @endif>Others</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-5 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dmname', 'Name*', ['class' => 'label-color py-2 d-block'] ) !!}
                        <select name="dmname" class="tab-sel form-select select2" id="dmname">
                            <option value="All" @if(request()->session()->get('dmname') == 'All') selected @endif>All</option>
                            @if(count($dmworks)>0)
                            @foreach($dmworks as $dmwork)
                            <option value="{{ $dmwork->name }}" @if(request()->session()->get('dmname') == $dmwork->name) selected @endif>{{ $dmwork->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12">
                    <button type="submit" class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 mt-5" onclick="Status()">Submit</button>
                </div>

                <div class="col-12" id="tabledm" style="display: none;">
                    <div class="widget appac">
                        <div class="widget-body" style="height: 500px; overflow: auto; margin: 20px 0px">
                            <table class="table table-bordered" id="tabledmworks">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Invoice Tab -->
        <div id="invoice" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable6" class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th class="text-grey">Created By</th>
                                        <th class="text-grey">Invoice No</th>
                                        <th class="text-grey">Invoice Date</th>
                                        <th class="text-grey">Amount</th>
                                        <th class="text-grey">View</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($invoice) > 0)
                                    @foreach($invoice as $index => $invoices)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $invoices->fname }}</td>
                                        <td>{{ $invoices->invoice_no }}</td>
                                        <td>{{ $invoices->invoice_date }}</td>
                                        <td>{{ $invoices->grosspay }}</td>
                                        <td>
                                            <a class="btn" href="{{ route('iprint', ['id' => base64_encode($invoices->invoice_no)]) }}" target="_blank">
                                                <i class="fi fi-ts-user-check"></i>
                                                <span class="tooltiptext">view</span>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proforma Tab -->
        <div id="proforma" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable7" class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th class="text-grey">Created By</th>
                                        <th class="text-grey">Invoice No</th>
                                        <th class="text-grey">Invoice Date</th>
                                        <th class="text-grey">Amount</th>
                                        <th class="text-grey">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($proforma)>0)
                                    @foreach($proforma as $index => $proformas)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $proformas->fname }}</td>
                                        <td>{{ $proformas->invoice_no }}</td>
                                        <td>{{ $proformas->invoice_date }}</td>
                                        <td>{{ $proformas->grosspay }}</td>
                                        <td>
                                            <a class="btn" href="{{ route('pprint', ['id' => base64_encode($proformas->invoice_no)]) }}" target="_blank">
                                                <i class="fi fi-ts-user-check"></i>
                                                <span class="tooltiptext">view</span>
                                            </a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Asset Library Tab -->
        <div id="assetlibrary" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table id="datatable8" class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th class="text-grey">Name</th>
                                        <th class="text-grey">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($asset)>0)
                                    @foreach($asset as $index => $assets)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $assets->name }}</td>
                                        <td><a class="btn" href="{{$assets->file}}" target="blank">view</a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       

        <!-- required input Tab -->
        <div id="requiredinput" class="tab-pane fade show " role="tabpanel">
            <div class="row">

                <div class="col-lg-5 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('requiredtype', 'Type*', ['class' => 'label-color py-2 '] ) !!}
                        <select name="requiredtype" class="tab-sel form-select" id="requiredtype">
                            <option value="All" @if(request()->session()->get('requiredinput') == 'All') selected @endif>All</option>
                            <option value="Client" @if(request()->session()->get('requiredinput') == 'Client') selected @endif>Client</option>
                            <option value="Appac" @if(request()->session()->get('requiredinput') == 'Appac') selected @endif>Appac</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-sm-12">
                    <button type="submit" class="btn bg-primary text-white ft-15 btn-modal pri-text-color m-0 mt-5" onclick="requiredinput()">Submit</button>
                </div>

                <div class="col-12">
                    <div class="widget appac">
                        <div class="col-12" id="tableri" style="display: none;">
                            <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                                <table class="table table-bordered" id="tableriworks">
                                    <thead>
                                        <tr class="bg-white border-0">
                                            <th>S.no</th>
                                            <th class="text-grey">Name</th>
                                            <th class="text-grey">Description</th>
                                            <th class="text-grey">View</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- revenue Tab -->
        <div id="revenue" class="tab-pane fade show " role="tabpanel">
            <div class="row col-wrap  mt-4">
            <div class="col-lg-12  col-xl-5 col-xxl-3 pr-20 h-100   u-dash">
                <div class="bio  rounded-30 bg-white h-100  client-li ">
                    <div class="pl-sts-wordwrap p-0">
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d start">
                                    <img src="asset/image/plan-start.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Plan Started</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->dateofregis : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d current">
                                    <img src="asset/image/current-sts.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Current Status</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->plansmonth : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d upcom">
                                    <img src="asset/image/renewal.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Plan Renewal</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->dateofexpire : ""}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12  col-xl-5 col-xxl-3 pr-20 h-100   u-dash">
                <div class="bio  rounded-30 bg-white h-100  client-li ">
                    <div class="pl-sts-wordwrap p-0">
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d start">
                                    <img src="asset/image/plan-start.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Plan Started</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->dateofregis : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d current">
                                    <img src="asset/image/current-sts.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Current Status</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->plansmonth : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d upcom">
                                    <img src="asset/image/renewal.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Plan Renewal</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->dateofexpire : ""}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-2 col-xxl-2 pr-20 h-100   u-dash">

<div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
    <h4 class="text-center">Revenue</h4>
    <div class="rev-d h-100 mb-3">
        <div class="rev-val">

            <p class="rev mb-0">{{$formattedNumber}}</p>
            <p class="rev mb-0">{{$scale}}</p>
        </div>
    </div>

                 
                    </div>
                </div>
            </div>
        </div>

        <!-- scope Tab -->
        <div id="scope" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Login Details Tab -->
        <div id="social" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Title</th>
                                        <th>URL</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Remark</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($viewquery)>0)
                                    @foreach($viewquery as $index => $social)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $social->title }}</td>
                                        <td><a href="{{ $social->url }}" target="_blank">{{ $social->url }}</a></td>
                                        <td>{{ $social->username }}</td>
                                        <td>{{ $social->password }}</td>
                                        <td>{{ $social->remarks }}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DataTables JS -->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- DataTable Initialization -->
        <script>
            $(document).ready(function() {
                const tableIDs = [
                    '#datatable1', '#datatable2', '#datatable3'
                ];

                tableIDs.forEach(function(id) {
                    if ($(id).length) { // Check if the table exists
                        $(id).DataTable({
                            ordering: false,
                            responsive: true,
                            pageLength: 10,
                            lengthMenu: [
                                [10, 25, 50, -1],
                                [10, 25, 50, "All"]
                            ],
                            language: {
                                search: "_INPUT_",
                                searchPlaceholder: "Search records"
                            }
                        });
                    }
                });



                $('#datatable5').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('#datatable6').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('#datatable7').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('#datatable8').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('#datatable9').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('#datatable10').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

                $('.datatable4').each(function() {
                    $(this).DataTable({
                        ordering: false,
                        responsive: true,
                        pageLength: 10,
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ],
                        language: {
                            search: "_INPUT_",
                            searchPlaceholder: "Search records"
                        }
                    });
                });

            });
        </script>
    </div>
</div>

<!--<div class="row">
    <div class="col-12">


        <div class="row  col-wrap">
            <div class="col-lg-12  col-xl-5 col-xxl-3 pr-20 h-100   u-dash">
                <div class="bio  rounded-30 bg-white h-100  client-li ">
                    <div class="pl-sts-wordwrap p-0">
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d start">
                                    <img src="asset/image/plan-start.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Plan Started</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->dateofregis : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d current">
                                    <img src="asset/image/current-sts.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Current Status</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->plansmonth : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d upcom">
                                    <img src="asset/image/renewal.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>SEO Plan Renewal</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plans) ? number_format($plans->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plans) ? $plans->dateofexpire : ""}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12  col-xl-5 col-xxl-3 pr-20 h-100   u-dash">
                <div class="bio  rounded-30 bg-white h-100  client-li ">
                    <div class="pl-sts-wordwrap p-0">
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d start">
                                    <img src="asset/image/plan-start.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Plan Started</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->dateofregis : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d current">
                                    <img src="asset/image/current-sts.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Current Status</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->plansmonth : ""}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="plan-status">
                            <div class="pl-icon">
                                <div class="ic-d upcom">
                                    <img src="asset/image/renewal.png" alt="">
                                </div>
                            </div>
                            <div class="pln-sts">
                                <h5>AMC Plan Renewal</h5>
                                <div class="d-flex gap-3 flex-wrap  p-0">
                                    <span class="d-flex gap-1 ">
                                        <p class="pl-p-h">Price</p> : <p class="pl-p">{{ ($plan) ? number_format($plan->amount ?? 0,2) : ""}}</p>
                                    </span> |
                                    <p class="pl-date">{{ ($plan) ? $plan->dateofexpire : ""}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           // <div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100   u-dash">

                <div class="bio  rounded-30 bg-white h-100 pb-0 client-li  profile-div">
                    <div class="table-responsive">
                        <div id="combo_chart_div" style="width: 100%;min-width:400px; height: 300px;"></div>
                    </div>

                </div>
            </div> //

           
           // <div class="col-lg-12 col-xl-6 col-xxl-4">
                <div class="profile-side-box green bio rounded-30 bg-white">
                    <div class="widget-body">
                        <h4> Account Details</h4>
                        <span class="tools"><a href="javascript:;" class="icon-remove"></a></span>
                    </div>
                    <div class="row experience client-li-d ">
                        @if(!empty($accountmanager))
                        <p class="client-label">Account Manager<span>:</span><span>{{ $accountmanager->fname }} {{ $accountmanager->lname }}</span></p>


                        @endif
                        @if(!empty($managedby))
                        <p class="client-label">SEO managed By<span>:</span><span> {{ $managedby->fname }}</span></p>
                        <hr>
                        @endif
                    </div>
                </div>
            </div> //
          
        </div>
    </div>
</div>-->

</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var company_name = $('[name="company_name"]').val();
        Status("All", "All", company_name);
        requiredinput("All", company_name);
    });

    function Status(dmtypea = null, dmname = null, company_name = null) {
        dmname = dmname ?? $('select[name="dmname"]').val();
        dmtypea = dmtypea ?? $('select[name="dmtypea"]').val();
        company_name = company_name ?? $('[name="company_name"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/dmaccountsearch/" + dmtypea + "/" + dmname + "/" + company_name,
            type: 'POST',
            success: function(response) {
                var tableBody = '';

                if (response.length > 0) {
                    $.each(response, function(index, item) {
                        tableBody += '<tr>';
                        tableBody += '<td>' + (index + 1) + '</td>';
                        tableBody += '<td>' + item.name + '</td>';
                        tableBody += '<td>' + item.type + '</td>';
                        tableBody += '<td><a href="' + item.url + '" target="blank" style="text-decoration:none;">View</a></td>';
                        tableBody += '</tr>';
                    });
                } else {
                    tableBody = '<tr><td colspan="4" class="text-center">No records found.</td></tr>';
                }

                $("#tabledm").show();

                $("#tabledmworks tbody").html(tableBody);
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorString = '';

                for (var key in errors) {
                    errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                }

                $('#errorModal .error-modal').html(errorString);
                $('#errorModal').modal('show');
            }
        });
    }

    function requiredinput(dmtypea = null, company_name = null) {
        dmtypea = dmtypea ?? $('select[name="requiredtype"]').val();
        company_name = company_name ?? $('[name="company_name"]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "/requiredinputsearch/" + dmtypea + "/" + company_name,
            type: 'POST',
            success: function(response) {
                var tableBody = '';

                if (response.length > 0) {
                    $.each(response, function(index, item) {
                        tableBody += '<tr>';
                        tableBody += '<td>' + (index + 1) + '</td>';
                        tableBody += '<td>' + item.name + '</td>';
                        tableBody += '<td>' + item.description + '</td>';
                        if (item.file) {
                            tableBody += '<td><a href="' + item.file + '" target="blank" style="text-decoration:none;">View</a></td>';
                        }
                        tableBody += '</tr>';
                    });
                } else {
                    tableBody = '<tr><td colspan="4" class="text-center">No records found.</td></tr>';
                }

                $("#tableri").show();

                $("#tableriworks tbody").html(tableBody);
            },
            error: function(xhr) {
                var errors = xhr.responseJSON.errors;
                var errorString = '';

                for (var key in errors) {
                    errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                }

                $('#errorModal .error-modal').html(errorString);
                $('#errorModal').modal('show');
            }
        });
    }

    $(document).ready(function() {
        $('.select2').select2(); // Initialize select2
    });
</script>


<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawComboChart);

    function drawComboChart() {
        var data = google.visualization.arrayToDataTable([
            ['Date', 'Bar Value', 'Line Value'],
            ['12/1', 0, 35],
            ['12/3', 0, 25],
            ['12/5', 0, 40],
            ['12/7', 0, 35],
            ['12/9', 70, 0],
            ['12/11', 0, 0],
            ['12/13', 0, 0],
            ['12/15', 0, 0]
        ]);
        var options = {
            hAxis: {
                maxValue: 100,
                textStyle: {
                    color: '#666'
                },
                baselineColor: 'transparent',
                gridlines: {
                    color: 'transparent'
                }
            },
            vAxis: {
                minValue: 0,
                textStyle: {
                    color: '#666'
                },
                baselineColor: 'transparent',
                gridlines: {
                    color: '#ddd'
                }
            },
            seriesType: 'bars',
            series: {
                1: {
                    //   type: 'area', // Area chart for a filled line graph
                    type: 'area',
                    color: '#a5bbda',
                    lineWidth: 3,
                    //   curveType: 'function', // Ensures smooth curve
                    areaOpacity: 0.3 // Adjust as needed
                }
            },
            curveType: 'function', // Applies to the entire chart for a smooth line
            colors: ['#a5bbda'], // Color for bars
            backgroundColor: {
                fill: 'transparent'
            },
            chartArea: {
                width: '80%',
                height: '75%'
            },
            legend: {
                position: 'top',
                textStyle: {
                    color: '#666',
                    fontSize: 12
                }
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            chartArea: {
                width: '80%',
                height: '50%',
            },
        };
        var chart = new google.visualization.ComboChart(document.getElementById('combo_chart_div'));
        chart.draw(data, options);
    }
</script>