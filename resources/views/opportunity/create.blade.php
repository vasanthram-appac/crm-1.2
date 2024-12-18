<div class="row">
<a href="/opportunity">Back</a>
    <!-- BEGIN PROFILE PORTLET-->
    <div class="profile span12">

        <div class="span10">
            <div class="profile-head">
                    <h1 class="ch2 comp-name">{{ $opportunity->company_name }}</h1>
        </div>


        <div class="space15"></div>
        <div class="row col-wrap pb-4">
            <div class="col-lg-12 col-xl-6">
            <div class="bio rounded-30 bg-white h-100 client-li">
                <div class="space15"></div>
                <h4 class="mb-3">Personal Details</h4>
            <div class="client-li-d">
                <p><label class="client-label">First Name</label><span>:</span><span>{{ $opportunity->firstname }}</span></p>
                <p><label class="client-label">Last Name</label><span>:</span> <span>{{ $opportunity->lastname }}</span></p>
                <p><label class="client-label">Surname</label><span>:</span> <span>{{ $opportunity->title }} {{ $opportunity->firstname }} {{ $opportunity->lastname }}</span></p>
                <p><label class="client-label">Email</label><span>:</span> <span><a href="mailto:{{ $opportunity->emailid }}">{{ $opportunity->emailid }}</span></a></p>
                <p><label class="client-label">Phone</label><span>:</span> <span>{{ $opportunity->phone }}</span></p>
                <p><label class="client-label">Alternate Phone</label><span>:</span> <span>{{ $opportunity->alternate_phone }}</span></p>
                </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-6">
                    <div class="desk bio rounded-30 bg-white h-100">
                        <div class="row experience client-li-d ">
                        <div class="space15"></div>
                        <h4 class="mb-3 ps-0">Opportunity Details</h4>
                        <div class="client-li-d">
                            <p><label class="client-label">Opportunity Date</label><span>:</span><span> {{ $opportunity->opportunitydate }}</span></p>
                            <p><label class="client-label">Last Update</label><span>:</span><span> {{ $opportunity->opportunityupdate }}</span></p>
                            <p><label class="client-label">Opportunity Source</label><span>:</span><span> {{ $opportunity->opportunitysource }}</span></p>
                            <p><label class="client-label">Opportunity Assigned</label><span>:</span><span> {{ $opportunity->assignedto }}</span></p>
                            <p><label class="client-label">Opportunity Summary</label><span>:</span><span> {{ $opportunity->summary }}</span></p>
                            {{-- <!--   <p><b>Opportunity Stage</b>: {{ $opportunity->oppourtunitystage }}</p>  --> --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<!-- END PROFILE PORTLET-->
</div>