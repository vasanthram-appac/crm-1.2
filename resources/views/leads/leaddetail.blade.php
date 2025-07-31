<div class="row">
<div>
        <a href="/lead" class="nav_btn">Back</a>
    </div>
    <!-- BEGIN PROFILE PORTLET -->
    <div class="profile col-12 my-2 col-lg-12 col-xl-12 col-xxl-12">
        <div class="profile-head my-3">
            <h1 class="ch2 comp-name">{{ $lead->company_name }}</h1>
        </div>
    </div>
    <div class="col-12">
        <div class="row  col-wrap">
        <div class="col-lg-12 col-xl-6 col-xxl-4 pr-20">
        <div class="bio  rounded-30 bg-white h-100  client-li">
            <div class="client-li-d">
            <p><label class="client-label">Contact Person</label>: <span>{{ $lead->title }} {{ $lead->firstname }} {{ $lead->lastname }} </span></p>
            <p><label class="client-label">GST Number</label>:<span> {{ $lead->gst_number }}</span></p>
            <p class="email-label"><label class="client-label">Email</label>:<span> <a href="mailto:{{ $lead->emailid }}">{{ $lead->emailid }}</span></a></p>
            <p><label class="client-label">Phone</label>:<span> {{ $lead->phone }}</span></p>
            <p><label class="client-label">Alternate Phone</label>: <span>{{ $lead->alternate_phone }}</span></p>
            <p class="email-label"><label class="client-label">Website</label>: <span><a href="{{ $lead->website }}" target="blank">{{ $lead->website }}</span></a></p>
            <p><label class="client-label">Address</label>: <span>{{ $lead->address . ', ' . $lead->city . ', ' . $lead->state . ', ' . $lead->country }}</span></p>
            </div>
            <div  class="cl-ad-li">

            </div>
        </div>
        </div>
        <div class="col-12 col-lg-12 col-xl-6 col-xxl-4 ">
                    <div class="desk bio rounded-30 bg-white ">
                <div class="row experience client-li-d ">
<p class="client-label">Lead Date <span>:</span><span> {{ $lead->leaddate }}</span></p>
<p class="client-label">Lead Source <span>:</span><span> {{ $lead->leadsource }}</span></p>
<p class="client-label">Lead Assigned <span>: </span><span>{{ $lead->assignedto }}</span></p>
<p class="client-label">Lead Status <span>:</span><span> {{ $lead->status }}</span></p>
<p class="client-label">Lead Summary <span>:</span><span> {{ $lead->summary }}</span></p>


                    <!-- <b></b><br><br> -->
                    <!-- <b>Lead Source</b>: {{ $lead->leadsource }}<br><br>
                    <b>Lead Assigned</b>: {{ $lead->assignedto }}<br><br>
                    <b>Lead Status</b>: {{ $lead->status }}<br><br>
                    <b>Lead Summary</b>: {{ $lead->summary }}<br><br> -->
                </div>
                <div class="space10"></div>
            </div>
                    </div>
        <div class="col-lg-12 col-xl-6 col-xxl-4">
            <div class="profile-side-box green bio rounded-30 bg-white">


                    <div class="widget-body">
                    <h4 class="ch4">Client Comments</h4>
                     <div class="mt-3 p-0">

                 
                    {!! Form::open(['route' => ['leaddetailupdate'], 'method' => 'Post']) !!}

                        @csrf

                        {!! Form::hidden('datetimestamp', now(), ['class' => 'col-6', 'readonly']) !!}
                        {!! Form::hidden('employee', request()->session()->get('empid'), ['class' => 'col-6', 'readonly']) !!}
                        {!! Form::hidden('company_name', $lead->id, ['class' => 'col-6', 'readonly']) !!}

                        <div class="control-group mb-2 p-0">
                            {!! Form::text('subject', null, ['class' => 'span6 form-control', 'placeholder' => 'Subject']) !!}
                        </div>

                        <div class="control-group mb-2 p-0">
                            {!! Form::date('date', null, ['class' => 'span6 form-control', 'placeholder' => 'Follow -up Date']) !!}
                        </div>

                        <div class="control-group mb-2 p-0">
                            {!! Form::textarea('summary', null, ['class' => 'span6 form-control', 'rows' => 5, 'placeholder' => 'Brief Description', 'style' => 'resize:none;', 'required']) !!}
                        </div>

                        <div class="text-end">
                            <label class="err_lbl"></label><br>
                            <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button" width="auto"> Update </button>
                        </div>

                        {!! Form::close() !!}
                        </div>
                </div>
                    </div>


            </div>
        </div>
    </div>
</div>


    <!-- History and Report Tabs -->
    <div class="row  pt-4">
       
        <ul class="nav nav-tabs px-4" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#acchistory" role="tab"><b >Leads History</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#report" role="tab"><b>Daily Work Report</b></a>
            </li>
        </ul>

        <div class="tab-content">
            <!-- Leads History Tab -->
            <div id="acchistory" class="tab-pane fade show active" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="widget appac">
                           
                            <div class="widget-body" style="height: 500px; overflow: auto;margin:20px 0px">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-white border-0">
                                            <th class="text-grey">Date of Notes Created</th>
                                            <th class="text-grey">Follow -up date</th>
                                            <th class="text-grey">Emp ID</th>
                                            <th class="text-grey">Subject</th>
                                            <th class="text-grey">Summary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($leadshistory as $history)
                                        <tr>
                                            <td>{{ $history->datetimestamp }}</td>
                                            <td>{{ $history->followupdate }}</td>
                                            <td>{{ $history->empid }}</td>
                                            <td>{{ $history->subject }}</td>
                                            <td>{{ $history->summary }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4">No history available.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Work Report Tab -->
            <div id="report" class="tab-pane fade show" role="tabpanel">
                <div class="row">
                    <div class="col-12">
                        <div class="widget appac">
                           
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
                                        @forelse($dailyreport as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->report_date }}</td>
                                            <td>{{ $report->employee_name }}</td>
                                            <td>{{ $report->project_name }}</td>
                                            <td>{{ $report->total_time }}</td>
                                            <td>{{ $report->status }}</td>
                                            <td>{{ $report->submit_time }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">No reports available.</td>
                                        </tr>
                                        @endforelse
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