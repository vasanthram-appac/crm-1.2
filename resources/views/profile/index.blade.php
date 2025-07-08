@extends('layouts/app')

@section('title','Profile')

@section('css')
<style>
    .odd {
        background-color: #0515263d !important;
    }

    .buttons-csv {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-excel {
        background-color: #01152b !important;
        color: #fff !important;
    }

    .buttons-collection {
        background-color: #01152b !important;
        color: #fff !important;
    }
</style>
@endsection

@section('content')


<div class="row m-0 appac_hide">
<div class="d-flex justify-content-between  align-items-end  inside-nav mb-4">
        <a id="preback" href="javascript:history.back()">Back</a>
        <ul class="nav nav-tabs my-4 justify-content-end mb-0">
            <li class="nav-item">
                <a class="nav-link active" href="/profile"><b>Profile</b></a>
            </li>
           @if (request()->session()->get('empid') == 'AM090' || request()->session()->get('empid') == 'AM063' || request()->session()->get('empid') == 'AM003' || request()->session()->get('dept_id') == '6' || request()->session()->get('dept_id') == '1' || request()->session()->get('dept_id') == '8')
            <li class="nav-item">
                <a class="nav-link" href="/user"><b>Employee</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/leaveapproval"><b>Leave Approvel</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/payslip"><b>Payslip</b></a>
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/applyleave"><b>Employee Leave</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/celebration"><b>Celebration</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/resignation"><b>Resignation</b></a>
            </li>
         
        </ul>
    </div>
    <div class="profile my-3 col-12 col-lg-12 col-xl-12 col-xxl-12">
        <div class="profile-head">
            <h1 class="ch2 comp-name">View Profile</h1>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 ">
        <div class="row  col-wrap">
            <div class="col-lg-12 col-xl-12 col-xxl-6 pr-20 h-100">
                <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">


                    <div class="alert alert-success alert-dismissible px-3 bold" id="session_message" style="display: none;">
                    </div>

                    <div class="row m-0 justify-content-between profile-col align-items-center">
                        <div class="col-lg-4 col-xl-3 col-xxl-4">


                            <div class="pro-img">


                                <img class="w-100" src="{{ $document->photo ? asset('uploadphoto/' . $document->photo)  : asset('asset/image/avatar/' . $document->avatar.'.png') }}" alt="">

                            </div>


                            <div class="ud">
                                <h4 class="u-name">{{$user->fname}} {{$user->lname}}</h4>
                            </div>
                            <div class="ud">
                                <p class='u-mail'>{{$user->empid}}</p>
                            </div>

                        </div>
                        <div class="col-lg-8 col-xl-8 col-xxl-8">
                            <div class="d-grid-2 profile-val">
                                <div class="">
                                    <p class="label">Role</p>
                                    <p class=val>{{$profile->designation}}</p>
                                </div>
                                <div class="">
                                    <p class="label">Department</p>
                                    <p class=val>{{$profile->department}}</p>
                                </div>
                                <div class="">
                                    <p class="label">Birthday</p>
                                    <p class=val>{{$profile->dob}}</p>
                                </div>
                                <div class="">
                                    <p class="label">Blood Group</p>
                                    <p class=val>{{$profile->bloodgroup}}</p>
                                </div>
                                <div class="">
                                    <p class="label">Phone no </p>
                                    <p class=val>{{$user->mno}}</p>
                                </div>
                                <div class="">
                                    <p class="label">Personal Mail</p>
                                    <p class=val>{{$profile->personalemailid}}</p>
                                </div>

                            </div>
                        </div>




                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-xl-6 col-xxl-3">
                <div class="bio  rounded-30 bg-white h-100 prof-div client-li  profile-div">
                    <div class="widget-body">
                        <h5>Emergency Details</h5>
                    </div>
                    <div class="bio p-0 client-li">
                        <div class="client-li-d2">
                            <p><label class="client-label">Contact Person</label>: <span>{{$profile->emergencycontactperson}}</span></p>
                            <p><label class="client-label">Contact No</label>: <span>{{$profile->emergencycontact}}</span></p>
                            <p><label class="client-label">Alternate No</label>: <span>{{$profile->altmno}}</span></p>
                            <p><label class="client-label">Medical Condition</label>: <span>{{$profile->medical}}</span></p>
                        </div>
                    </div>


                </div>

            </div>

            <div class="col-lg-6 col-xl-6 col-xxl-3">
                <div class="bio  rounded-30 bg-white h-100 prof-div client-li  profile-div">
                    <div class="widget-body">
                        <h5>Address</h5>
                        <div class="d-flex gap-2 p-0 ad">
                            <ul class="nav nav-tabs " role="tablist">
                                <li class="nav-item">
                                    <button class="nav-link active active pre ad-btn" data-toggle="tab" href="#acchistory" role="tab"><b>Present</b></button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link per ad-btn" data-toggle="tab" href="#report" role="tab"><b>Permanent</b></button>
                                </li>
                            </ul>
                            <!-- <button class="ad-btn active pre">Present</button><button class="ad-btn per">Permanent</button> -->
                        </div>
                        <div class="pre pt-3">
                            <p>{{$profile->address}}</p>
                            <p>{{$profile->city}}</p>
                            <p>{{$profile->landmark}}</p>
                            <p>{{$profile->state}} -{{$profile->pincode}}</p>
                        </div>
                        <div class="per pt-3" style="display:none">
                            <p>{{$profile->permaddress}}</p>
                            <p>{{$profile->permcity}}</p>
                            <p>{{$profile->permlandmark}}</p>
                            <p>{{$profile->permstate}} -{{$profile->permpincode}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 mt-3  mb-5">
                <div class="row  col-wrap">
                    <div class="col-lg-12 col-xl-12 col-xxl-8 pr-20">
                        <div class="bio  rounded-30 bg-white h-100  client-li  profile-div">
                            <div class="widget-body p-0">
                                <h5>Other Details</h5>
                            </div>
                            <div class="d-flex gap-2 p-0 pb-2 flex-wrap ot pt-2">
                                <ul class="nav nav-tabs " role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active active active com ad-btn" data-toggle="tab" href="#acchistory" role="tab"><b>Company Details</b></button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link ban ad-btn" data-toggle="tab" href="#report" role="tab"><b>Bank Details</b></button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link pro ad-btn" data-toggle="tab" href="#report" role="tab"><b>Personal</b></button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link upl ad-btn" data-toggle="tab" href="#report" role="tab"><b>Uploads</b></button>
                                    </li>
                                </ul>

                            </div>
                            {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT']) !!}
                            <div class="row com pt-3" style="display:flex">
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('doj', 'Date of Joining*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::date('doj', $profile->doj, ['class' => 'form-control val', 'placeholder' => 'Date of Joining', 'readonly']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('emptype', 'Employment Type*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('emptype', $user->emptype == '1' ? 'Permanent' : 'Intern', ['class' => 'form-control val', 'readonly' => 'readonly']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('emailid', 'Official Email ID*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::email('emailid', $user->emailid, ['class' => 'form-control val', 'placeholder' => 'Email ID', 'maxlength' => 50, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('appraisaldate', 'Appraisal Date', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('appraisaldate', $profile->appraisaldate, ['class' => 'form-control val', 'readonly']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('salary', 'Salary (CTC)', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('salary', $profile->salary, ['class' => 'form-control val', 'readonly', 'maxlength' => '15']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('nxtappraisaldate', 'Next Appraisal Date', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('nxtappraisaldate', $profile->nxtappraisaldate, ['class' => 'form-control val', 'readonly']) !!}</p>
                                </div>
                            </div>

                            <div class="row ban pt-3" style="display:none">
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('acholder', 'Account Holder Name*', ['class' => 'label']) !!}</p>
                                    <p class=""> {!! Form::text('acholder', $bank->acholder, ['class' => 'form-control val', 'placeholder' => 'Account Holder Name', 'maxlength' => 40, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6  col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('bankname', 'Bank Name*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('bankname', $bank->bankname, ['class' => 'form-control val', 'placeholder' => 'Bank Name', 'maxlength' => 50, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label"> {!! Form::label('branch', 'Bank Branch*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('branch', $bank->branch, ['class' => 'form-control val', 'placeholder' => 'Bank Branch', 'maxlength' => 30, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6  col-lg-4 profile-val">
                                    <p class="label"> {!! Form::label('acno', 'Account Number*', ['class' => 'label']) !!}</p>
                                    <p class=""> {!! Form::text('acno', $bank->acno, ['class' => 'form-control val', 'placeholder' => 'Account Number', 'maxlength' => 30, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label"> {!! Form::label('actype', 'Account Type*', ['class' => 'label ']) !!}</p>
                                    <p class="">{!! Form::select('actype', ['Savings account' => 'Savings account', 'Current account' => 'Current account', 'Salary Account' => 'Salary Account'], $bank->actype, ['class' => 'form-control val']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label">{!! Form::label('ifsccode', 'IFSC Code*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('ifsccode', $bank->ifsccode, ['class' => 'form-control val', 'placeholder' => 'IFSC Code', 'maxlength' => 30, 'required']) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-4 profile-val">
                                    <p class="label"> {!! Form::label('panno', 'Pan Number*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::text('panno', $bank->panno, ['class' => 'form-control val', 'placeholder' => 'Pan Number', 'maxlength' => 30, 'required']) !!}</p>
                                </div>
                            </div>

                            <div class="row pro pt-3" style="display:none">
                                <div class="row pb-3 ">
                                    <div class="col-lg-12 widget-body p-0">
                                        <h6>Persnol Info</h6>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('fname', 'First Name*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('fname', $user->fname, ['class' => 'form-control val', 'placeholder' => 'First Name', 'maxlength' => 40, 'required']) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('lname', 'Last Name*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('lname', $user->lname, ['class' => 'form-control val', 'placeholder' => 'Last Name', 'maxlength' => 40, 'required']) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('dob', 'Date of Birth*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::date('dob', $profile->dob, ['class' => 'form-control val', 'placeholder' => 'Date of Birth', 'required']) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('bloodgroup', 'Blood Group', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('bloodgroup', $profile->bloodgroup, ['class' => 'form-control val', 'placeholder' => 'Enter Bloodgroup', 'required']) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label"> {!! Form::label('personalemailid', 'Personal Email ID*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::email('personalemailid', $profile->personalemailid, ['class' => 'form-control val', 'placeholder' => 'Email ID', 'maxlength' => 50, 'required']) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('mno', 'Mobile Number*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::number('mno', $user->mno, ['class' => 'form-control val', 'placeholder' => 'Mobile Number', 'maxlength' => 10, 'minlength' => 10, 'required']) !!}</p>
                                    </div>
                                </div>
                                <div class="row py-3 mt-3">
                                    <div class="col-lg-12 widget-body p-0">
                                        <h6>Emergency Details</h6>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('altmno', 'Alternate Mobile Number', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::number('altmno', $profile->altmno, ['class' => 'form-control val', 'placeholder' => 'Alternate Mobile Number', 'maxlength' => 10, 'minlength' => 10]) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('emergencycontact', 'Emergency Contact Number*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::number('emergencycontact', $profile->emergencycontact, ['class' => 'form-control val', 'placeholder' => 'Emergency Mobile Number', 'maxlength' => 10, 'minlength' => 10, 'required']) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('emergencycontactperson', 'Emergency Contact Person*', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('emergencycontactperson', $profile->emergencycontactperson, ['class' => 'form-control val', 'placeholder' => 'Enter Name', 'maxlength' => 40, 'required']) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('medical', 'Medical conditions or allergies ', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::textarea('medical', $profile->medical, ['class' => 'form-control val', 'placeholder' => 'Enter Medical conditions or allergies', 'rows' =>1]) !!}</p>
                                    </div>
                                </div>
                                <div class="row py-3 mt-3">
                                    <div class="col-lg-12 widget-body p-0">
                                        <h6>Present Address</h6>
                                    </div>
                                    <div class="col-md-6  col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('address', 'Address', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::textarea('address', $profile->address, ['class' => 'form-control val', 'placeholder' => 'Address', 'maxlength' => 300, 'rows' => 1]) !!}</p>
                                    </div>
                                    <div class="col-md-6  col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('city', 'City', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('city', $profile->city, ['class' => 'form-control val', 'placeholder' => 'City', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-md-6  col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('landmark', 'Landmark', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('landmark', $profile->landmark, ['class' => 'form-control val', 'placeholder' => 'Landmark', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('state', 'State', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('state', $profile->state, ['class' => 'form-control val', 'placeholder' => 'State', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-md-6 col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('pincode', 'Pincode', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::number('pincode', $profile->pincode, ['class' => 'form-control val', 'placeholder' => 'Pincode', 'maxlength' => 6, 'minlength' => 6]) !!}</p>
                                    </div>
                                </div>
                                <div class="row py-3  mt-3">
                                    <div class="col-lg-12 widget-body p-0">
                                        <h6>Permanent Address</h6>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('address', 'Address', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::textarea('permaddress', $profile->permaddress, ['class' => 'form-control val', 'placeholder' => 'Address', 'maxlength' => 300, 'rows' => 1]) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('city', 'City', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('permcity', $profile->permcity, ['class' => 'form-control val', 'placeholder' => 'City', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('landmark', 'Landmark', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('permlandmark', $profile->permlandmark, ['class' => 'form-control val', 'placeholder' => 'Landmark', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('state', 'State', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::text('permstate', $profile->permstate, ['class' => 'form-control val', 'placeholder' => 'State', 'maxlength' => 40]) !!}</p>
                                    </div>
                                    <div class="col-lg-4 profile-val">
                                        <p class="label">{!! Form::label('pincode', 'Pincode', ['class' => 'label']) !!}</p>
                                        <p class="">{!! Form::number('permpincode', $profile->permpincode, ['class' => 'form-control val', 'placeholder' => 'Pincode', 'maxlength' => 6, 'minlength' => 6]) !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row upl pt-3" style="display:none">
                                <div class="col-lg-6 profile-val">
                                    <p class="label"> {!! Form::label('photo', 'Profile Photo*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::file('photo', ['class' => 'form-control val', 'accept' => 'image/png, image/jpeg, image/jpg']) !!}</p>
                                </div>
                                <div class="col-lg-6 profile-val">
                                    <p class="label">{!! Form::label('resume', 'Resume (PDF Format, File size below 1MB)', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::file('resume', ['class' => 'form-control val', 'accept' => 'application/pdf']) !!}</p>
                                </div>
                                <div class="col-lg-6 profile-val">
                                    <p class="label">{!! Form::label('addressproof', 'Address Proof (Aadhar, PDF Format, File size below 1MB)*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::file('addressproof', ['class' => 'form-control val', 'accept' => 'application/pdf']) !!}</p>
                                </div>
                                <div class="col-lg-6 profile-val">
                                    <p class="label">{!! Form::label('identityproof', 'Identity Proof (Pancard, PDF Format, File size below 1MB)*', ['class' => 'label']) !!}</p>
                                    <p class="">{!! Form::file('identityproof', ['class' => 'form-control val', 'accept' => 'application/pdf']) !!}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-end my-3">
                                    <label class="err_lbl"></label><br>
                                    <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">Update</button>

                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-12 col-xl-12 col-xxl-4 pr-20">
                        <div class="bio  rounded-30 bg-white  client-li  profile-div ">
                            <div class="widget-body p-0">
                                <h5 class="pb-2"> Documents</h5>
                                <div class="row  g-2">
                                    <div class="col-md-6 col-lg-6 col-sm-12 p-0">
                                        <div class="alidate-input  m-b-23 mb-2 p-0 profile-val">
                                            <p class="label">Profile Photo*</p>
                                            <div class="row m-0 mb-0 p-0">
                                                @if(!empty($document->photo))
                                                <div class="col-lg-12 col-sm-12 p-0  gap-1 d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                                        <path fill="#100c41" d="M14 11a3 3 0 0 1-3-3V4H7a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8zm-2-3a2 2 0 0 0 2 2h3.59L12 4.41zM7 3h5l7 7v9a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3" />
                                                    </svg> <a href="{{ asset('uploadphoto/' . $document->photo) }}" target="_blank">View</a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-sm-12 p-0 profile-val">
                                        <div class="alidate-input m-b-23 mb-2 p-0">
                                            <p class="label">Resume</p>
                                            <div class="row m-0 mb-0 p-0">
                                                @if(!empty($document->resume))
                                                <div class="col-lg-12 col-sm-12 p-0  gap-1 d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                                        <path fill="#100c41" d="M14 11a3 3 0 0 1-3-3V4H7a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8zm-2-3a2 2 0 0 0 2 2h3.59L12 4.41zM7 3h5l7 7v9a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3" />
                                                    </svg> <a href="{{ asset('uploadresume/' . $document->resume) }}" target="_blank">View</a>
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6  col-sm-12 p-0  profile-val">
                                        <div class="alidate-input m-b-23 mb-2 p-0">
                                            <p class="label">Address Proof</p>
                                            @if(!empty($document->addressproof))
                                            <div class="col-lg-12 col-sm-12 p-0  gap-1 d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                                    <path fill="#100c41" d="M14 11a3 3 0 0 1-3-3V4H7a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8zm-2-3a2 2 0 0 0 2 2h3.59L12 4.41zM7 3h5l7 7v9a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3" />
                                                </svg><a href="{{ asset('uploadaddressproof/' . $document->addressproof) }}" target="_blank">View</a>
                                            </div>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-6 p-0 col-sm-12 profile-val">
                                        <div class="alidate-input p-0 m-b-23 mb-2">
                                            <p class="label">Identity Proof</p>

                                            @if(!empty($document->identityproof))
                                            <div class="col-lg-12 col-sm-12 p-0 doc gap-1 d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 24 24">
                                                    <path fill="#100c41" d="M14 11a3 3 0 0 1-3-3V4H7a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-8zm-2-3a2 2 0 0 0 2 2h3.59L12 4.41zM7 3h5l7 7v9a3 3 0 0 1-3 3H7a3 3 0 0 1-3-3V6a3 3 0 0 1 3-3" />
                                                </svg> <a href="{{ asset('uploadidentityproof/' . $document->identityproof) }}" target="_blank">View</a>
                                            </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>







                    <div class="modal fade" id="errorModal" role="dialog" style="">
                        <div class="modal-dialog cascading-modal float-end me-3" role="document">
                            <!--Content-->
                            <div class="modal-content">
                                <!--Header-->

                                <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <h4 class="title ps-3 pt-1">Errors</h4>
                                <!--Body-->
                                <div class="error-modal px-2 pb-1">

                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                </div>


                @endsection


                @section('script')
                <script>
                    document.querySelectorAll('.ad .ad-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            // Remove 'active' class from both buttons
                            document.querySelectorAll('.ad .ad-btn').forEach(btn => btn.classList.remove('active'));

                            // Add 'active' class to the clicked button
                            this.classList.add('active');

                            // Toggle the visibility of the sections based on the button clicked
                            if (this.classList.contains('pre')) {
                                document.querySelector('.pre.pt-3').style.display = 'block';
                                document.querySelector('.per.pt-3').style.display = 'none';
                            } else if (this.classList.contains('per')) {
                                document.querySelector('.per.pt-3').style.display = 'block';
                                document.querySelector('.pre.pt-3').style.display = 'none';
                            } else {
                                document.querySelector('.per.pt-3').style.display = 'none';
                                document.querySelector('.pre.pt-3').style.display = 'none';
                            }
                        });
                    });
                </script>
                <script>
                    document.querySelectorAll('.ot .ad-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            // Remove 'active' class from both buttons
                            document.querySelectorAll('.ot .ad-btn').forEach(btn => btn.classList.remove('active'));

                            // Add 'active' class to the clicked button
                            this.classList.add('active');

                            // Toggle the visibility of the sections based on the button clicked
                            if (this.classList.contains('com')) {
                                document.querySelector('.com.pt-3').style.display = 'flex';
                                document.querySelector('.ban.pt-3').style.display = 'none';
                                document.querySelector('.pro.pt-3').style.display = 'none';
                                document.querySelector('.upl.pt-3').style.display = 'none';
                            } else if (this.classList.contains('ban')) {
                                document.querySelector('.ban.pt-3').style.display = 'flex';
                                document.querySelector('.com.pt-3').style.display = 'none';
                                document.querySelector('.pro.pt-3').style.display = 'none';
                                document.querySelector('.upl.pt-3').style.display = 'none';
                            } else if (this.classList.contains('pro')) {
                                document.querySelector('.ban.pt-3').style.display = 'none';
                                document.querySelector('.com.pt-3').style.display = 'none';
                                document.querySelector('.pro.pt-3').style.display = 'flex';
                                document.querySelector('.upl.pt-3').style.display = 'none';
                            } else {
                                document.querySelector('.ban.pt-3').style.display = 'none';
                                document.querySelector('.com.pt-3').style.display = 'none';
                                document.querySelector('.pro.pt-3').style.display = 'none';
                                document.querySelector('.upl.pt-3').style.display = 'flex';
                            }
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {



                        $(document).on('submit', 'form', function(e) {
                            e.preventDefault();

                            var form = $(this);
                            var container = form.closest('.modal');

                            var formData = new FormData(form[0]); // Create a FormData object

                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                data: formData,
                                dataType: 'json',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function(response) {

                                    $('#session_message').css('display', 'block');
                                    $('#session_message').text(response.message);

                                    setTimeout(function() {
                                        $('#session_message').hide();
                                        window.location.reload();
                                    }, 2000);
                                    if (typeof response.reload !== 'undefined') {
                                        $('.appac_show').hide();
                                        $('.appac_hide').show();

                                        setTimeout(function() {
                                            window.location.reload();
                                        }, 2000);
                                    } else {
                                        $('.customer_modal').modal('hide');
                                        $('.appac_show').hide();
                                        $('.appac_hide').show();
                                        cat_table.ajax.reload(null, false); // Prevents table state reset on reload
                                    }



                                },
                                error: function(xhr) {
                                    // Handle other types of errors (e.g., server error)

                                    var errors = xhr.responseJSON.errors;
                                    var errorString = '';

                                    for (var key in errors) {
                                        errorString += '<span class="text-danger">' + errors[key][0] + '</span><br>';
                                    }

                                    // Show errors in a Bootstrap modal (assuming you are using Bootstrap)
                                    $('#errorModal .error-modal').html(errorString);
                                    $('#errorModal').modal('show');
                                }
                            });
                        });





                    });
                </script>
                @endsection