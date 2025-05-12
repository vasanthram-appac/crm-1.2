<style>
    #preback {
        display: none;
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


            <div class="col-lg-12 col-xl-12 col-xxl-12 pr-20 h-100 u-dash">

                <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
                    <div class="server-det-wrap">
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
            </div>
            <div class="col-lg-12 col-xl-7 col-xxl-2 pr-20 h-100   u-dash">

                <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
                    <h4 class="text-center">Revenue</h4>
                    <div class="rev-d h-100 mb-3">
                        <div class="rev-val">

                            <p class="rev mb-0">{{$formattedNumber}}</p>
                            <p class="rev mb-0">{{$scale}}</p>
                        </div>
                    </div>

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
                </div>
            </div>



            <div class="col-lg-12  col-xl-5 col-xxl-4 pr-20 h-100   u-dash">
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

            <div class="col-lg-12  col-xl-5 col-xxl-4 pr-20 h-100   u-dash">
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

            <!-- <div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100   u-dash">

                <div class="bio  rounded-30 bg-white h-100 pb-0 client-li  profile-div">
                    <div class="table-responsive">
                        <div id="combo_chart_div" style="width: 100%;min-width:400px; height: 300px;"></div>
                    </div>

                </div>
            </div> -->

            <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
                <div class=" bio rounded-30 bg-white    client-li">
                    <div class="widget-body">
                        <h4> Client Details</h4>
                    </div>
                    <div class="row experience client-li-d">
                        <p class="client-label">Name<span>:</span><span>{{ $accounts->title }} {{ $accounts->firstname }} {{ $accounts->lastname }}</span></p>
                        <p class="client-label">Phone<span>:</span><span><a href="mailto:{{ $accounts->phone }}">{{ $accounts->stdcode }} {{ $accounts->phone }}</a></span></p>
                        <p class="client-label">Email<span>:</span><span> <a href="mailto:{{ $accounts->emailid }}">{{ $accounts->emailid }}</a></span></p>
                        <p class="client-label">Website<span>:</span><span> <a target="_blank" href="http://{{ $accounts->website }}">{{ $accounts->website }}</a></span></p>
                        @if(!empty($accounts->gst_number))
                        <p class="client-label">GST Number<span>:</span><span>{{ $accounts->gst_number }}</span></p>
                        @endif
                        <p class="client-label">Address<span>:</span><span>{!! $accounts->address !!}</span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-xl-6 col-xxl-4">
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
            </div>



            <div class="col-lg-12 col-xl-6 col-xxl-4">
                <div class="profile-side-box green bio rounded-30 bg-white">
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
</div>
</div>

<!-- Tabbed Content for History, Reports, Payments -->
<div class="row pt-4">
    <!-- <h2 class="ch2 fw-600">History Details</h2> -->
    <ul class="nav nav-tabs px-4" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" role="tab" href="#acchistory"><b>Accounts History</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" href="#wiphistory"><b>WIP History</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#report"><b>Daily Work report</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#payment"><b>Payment Details</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#dmworks"><b>DM Works</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#invoice"><b>Invoice</b></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#proforma"><b>Proforma</b></a></li>
        <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" role="tab" data-toggle="tab" data-toggle="tab" href="#social"><b>Social Media login</b></a></li> -->
    </ul>

    <div class="tab-content">
        <!-- Accounts History Tab -->
        <div id="acchistory" class="tab-pane fade show active" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Accounts History</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>Date of Notes Created</th>
                                        <th>Employee Name</th>
                                        <th>Subject</th>
                                        <th>Summary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($notes)>0)
                                    @foreach($notes as $note)
                                    <tr>
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
                            <table class="table table-bordered">
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
                            <table class="table table-bordered">
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
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Date</th>
                                        <th>Create By</th>
                                        <th>Bank Name</th>
                                        <th>Cheque No</th>
                                        <th>NEFT</th>
                                        <th>Product/Service</th>
                                        <th>Proforma / Invoice</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($payments)>0)
                                    @foreach($payments as $index => $payment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $payment->paydate }}</td>
                                        <td>{{ $payment->fname }}</td>
                                        <td>{{ $payment->bankname }}</td>
                                        <td>{{ $payment->chequeno }}</td>
                                        <td>{{ $payment->neftnumber }}</td>
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
                                    </tr>
                                    @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="9" align="right"><b>Total Amount: Rs: {{ $totalPay }}</b></td>
                                    </tr>
                                </tbody>
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
                        {!! Form::label('dmtype', 'Type*', ['class' => 'label-color py-2 '] ) !!}
                        <select name="dmtype" class="tab-sel form-select" id="dmtype">
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
                        {!! Form::label('dmname', 'Name*', ['class' => 'label-color py-2 '] ) !!}
                        <select name="dmname" class="tab-sel form-select" id="dmname">
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

                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg-white border-0">
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($dmworks)>0)
                                    @foreach($dmworks as $index => $dmwork)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $dmwork->name }}</td>
                                        <td>{{ $dmwork->type }} </td>
                                        <td><a href={{ $dmwork->url }} target="blank" style="text-decoration:none;">View</a></td>
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

        <!-- Invoice Tab -->
        <div id="invoice" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Daily Work report</h4>
                        </div> -->
                        <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                            <table class="table table-bordered">
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
                                    @if(count($invoice)>0)
                                    @foreach($invoice as $index => $invoices)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $invoices->empid }}</td>
                                        <td>{{ $invoices->invoice_no }}</td>
                                        <td>{{ $invoices->invoice_date }}</td>
                                        <td>{{ $invoices->grosspay }}</td>
                                        <td><a class="btn" href="' . route('iprint', ['id' => {{$invoices->invoice_no}}]) . '"  target="blank"><i class="fi fi-ts-user-check"></i><span class="tooltiptext">view</span></a></td>
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

        <!-- Social Media Login Details Tab -->
        <div id="social" class="tab-pane fade show " role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="widget appac">
                        <!-- <div class="widget-title">
                            <h4><i class="icon-reorder"></i> Social Media Login Details</h4>
                        </div> -->
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
    </div>
</div>
</div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script type="text/javascript">
    function Status() {

        var dmname = $('select[name="dmname"]').val();
        var dmtypea = $('select[name="dmtypea"]').val();

        $.ajax({
            url: "/dmaccountsearch/"+dmtypea+"/"+dmname,
            type: 'GET',
            success: function(response) {
                window.location.reload();
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