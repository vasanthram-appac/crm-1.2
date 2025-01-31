<div class="modal-dialog cascading-modal" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close waves-effect waves-light fs-4" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <h4 class="title">Edit User</h4>
        </div>
        <div class="modal-body mb-0">
            {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'PUT']) !!}

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('fname', 'First Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('fname', $user->fname, ['class' => 'form-control', 'placeholder' => 'First Name', 'maxlength' => 40, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('lname', 'Last Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('lname', $user->lname, ['class' => 'form-control', 'placeholder' => 'Last Name', 'maxlength' => 40, 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('emailid', 'Official Email ID*', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('emailid', $user->emailid, ['class' => 'form-control', 'placeholder' => 'Email ID', 'maxlength' => 50, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('personalemailid', 'Personal Email ID*', ['class' => 'label-color py-2']) !!}
                        {!! Form::email('personalemailid', $profile->personalemailid, ['class' => 'form-control', 'placeholder' => 'Email ID', 'maxlength' => 50, 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('mno', 'Mobile Number*', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('mno', $user->mno, ['class' => 'form-control', 'placeholder' => 'Mobile Number', 'maxlength' => 10, 'minlength' => 10, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('altmno', 'Alternate Mobile Number', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('altmno', $profile->altmno, ['class' => 'form-control', 'placeholder' => 'Alternate Mobile Number', 'maxlength' => 10, 'minlength' => 10]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('emergencycontact', 'Emergency Contact Number*', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('emergencycontact', $profile->emergencycontact, ['class' => 'form-control', 'placeholder' => 'Emergency Mobile Number', 'maxlength' => 10, 'minlength' => 10, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('emergencycontactperson', 'Emergency Contact Person*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('emergencycontactperson', $profile->emergencycontactperson, ['class' => 'form-control', 'placeholder' => 'Enter Name', 'maxlength' => 40, 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('address', 'Address', ['class' => 'label-color py-2']) !!}
                        {!! Form::textarea('address', $profile->address, ['class' => 'form-control', 'placeholder' => 'Address', 'maxlength' => 300, 'rows' => 1]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('city', 'City', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('city', $profile->city, ['class' => 'form-control', 'placeholder' => 'City', 'maxlength' => 40]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('landmark', 'Landmark', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('landmark', $profile->landmark, ['class' => 'form-control', 'placeholder' => 'Landmark', 'maxlength' => 40]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('state', 'State', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('state', $profile->state, ['class' => 'form-control', 'placeholder' => 'State', 'maxlength' => 40]) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('pincode', 'Pincode', ['class' => 'label-color py-2']) !!}
                        {!! Form::number('pincode', $profile->pincode, ['class' => 'form-control', 'placeholder' => 'Pincode', 'maxlength' => 6, 'minlength' => 6]) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('designation', 'Designation', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('designation', $profile->designation, ['class' => 'form-control', 'placeholder' => 'Designation', 'maxlength' => 50]) !!}
                    </div>
                </div>
            </div>



            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('emptype', 'Employment Type*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('emptype', ['1' => 'Permanent', '2' => 'Intern'], $user->emptype, ['class' => 'form-control', 'id' => 'emptype', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12" id="duration-field" style="display: none;">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('duration', 'Internship Duration', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('duration', ['' => 'Select', '1 Month' => '1 Month', '3 Months' => '3 Months', '6 Months' => '6 Months'], $user->duration, ['class' => 'form-control', 'id' => 'duration']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('role', 'User Role*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('role', ['user' => 'User', 'superadmin' => 'Super Admin', 'admin' => 'Admin', 'subadmin' => 'Sub Admin'], $user->role, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('dob', 'Date of Birth*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('dob', $profile->dob, ['class' => 'form-control', 'placeholder' => 'Date of Birth', 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('doj', 'Date of Joining*', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('doj', $profile->doj, ['class' => 'form-control', 'placeholder' => 'Date of Joining', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('department', 'Department*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('department', $department_master, $user->dept_id, ['class' => 'form-control', 'required' => 'required']) !!}

                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('password', 'New Password*(eg:tester#12,min-char:8)', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('password', null, ['class' => 'form-control', 'placeholder' => 'Password']) !!}

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('confirmpwd', 'Confirm Password*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('confirmpwd', null, ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
                    </div>
                </div>
            </div> 

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('bloodgroup', 'Blood Group', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('bloodgroup', $profile->bloodgroup, ['class' => 'form-control', 'placeholder' => 'Enter Bloodgroup', 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('salary', 'Salary (CTC)', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('salary', $profile->salary, ['class' => 'form-control', 'required', 'maxlength' => '15']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('appraisaldate', 'Appraisal Date', ['class' => 'label-color py-2']) !!}
                        {!! Form::date('appraisaldate', $profile->appraisaldate, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                    {!! Form::label('nxtappraisaldate', 'Next Appraisal Date', ['class' => 'label-color py-2']) !!}
                    {!! Form::date('nxtappraisaldate', $profile->nxtappraisaldate, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    {!! Form::label('status', 'Status*', ['class' => 'label-color py-2']) !!}

                    <div class="mt-2">
                        <div class="form-check form-check-inline">
                            {!! Form::radio('status', '1', $user->status == '1', ['id' => 'activeRadio1', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('activeRadio1', 'Active EMP', ['class' => 'label-color']) !!}
                        </div>

                        <div class="form-check form-check-inline">
                            {!! Form::radio('status', '0', $user->status == '0', ['id' => 'inactiveRadio2', 'class' => 'form-check-input', 'required']) !!}
                            {!! Form::label('inactiveRadio2', 'Inactive EMP', ['class' => 'label-color']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">Bank Details</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('acholder', 'Account Holder Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('acholder', $bank->acholder, ['class' => 'form-control', 'placeholder' => 'Account Holder Name', 'maxlength' => 40, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('bankname', 'Bank Name*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('bankname', $bank->bankname, ['class' => 'form-control', 'placeholder' => 'Bank Name', 'maxlength' => 50, 'required']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('branch', 'Bank Branch*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('branch', $bank->branch, ['class' => 'form-control', 'placeholder' => 'Bank Branch', 'maxlength' => 30, 'required']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('acno', 'Account Number*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('acno', $bank->acno, ['class' => 'form-control', 'placeholder' => 'Account Number', 'maxlength' => 30, 'required']) !!}
                    </div>
                </div>
            </div>


            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('actype', 'Account Type*', ['class' => 'label-color py-2']) !!}
                        {!! Form::select('actype', ['Savings account' => 'Savings account', 'Current account' => 'Current account', 'Salary Account' => 'Salary Account'], $bank->actype, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('ifsccode', 'IFSC Code*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('ifsccode', $bank->ifsccode, ['class' => 'form-control', 'placeholder' => 'IFSC Code', 'maxlength' => 30, 'required']) !!}
                    </div>
                </div>

            </div>

            <div class="row m-0 mb-0">

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('panno', 'Pan Number*', ['class' => 'label-color py-2']) !!}
                        {!! Form::text('panno', $bank->panno, ['class' => 'form-control', 'placeholder' => 'Pan Number', 'maxlength' => 30, 'required']) !!}
                    </div>
                </div>

            </div>


            <div class="" style="border-bottom: 1px solid #ccc;">
                <h5 class="title">ID Proof's</h5>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('photo', 'Profile Photo*', ['class' => 'label-color py-2']) !!}
                        <div class="row m-0 mb-0">
                            @if(!empty($document->photo))
                            <div class="col-lg-6 col-sm-12">
                                <img class="w-50" src="{{ asset('uploadphoto/' . $document->photo) }}" alt="">
                            </div>
                            @endif
                            <div class="col-lg-6 col-sm-12">
                                {!! Form::file('photo', ['class' => 'form-control', 'accept' => 'image/png, image/jpeg, image/jpg']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('resume', 'Resume (PDF Format, File size below 1MB)', ['class' => 'label-color py-2']) !!}
                        @if(!empty($document->resume))
                        <a href="{{ asset('uploadresume/' . $document->resume) }}" target="_blank">View</a>
                        @endif
                        {!! Form::file('resume', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
                    </div>
                </div>
            </div>

            <div class="row m-0 mb-0">
                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('addressproof', 'Address Proof (Aadhar, PDF Format, File size below 1MB)*', ['class' => 'label-color py-2']) !!}
                        @if(!empty($document->addressproof))
                        <a href="{{ asset('uploadaddressproof/' . $document->addressproof) }}" target="_blank">View</a>
                        @endif
                        {!! Form::file('addressproof', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="alidate-input m-b-23 mb-2">
                        {!! Form::label('identityproof', 'Identity Proof (Pancard, PDF Format, File size below 1MB)*', ['class' => 'label-color py-2']) !!}
                        @if(!empty($document->identityproof))
                        <a href="{{ asset('uploadidentityproof/' . $document->identityproof) }}" target="_blank">View</a>
                        @endif
                        {!! Form::file('identityproof', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
                    </div>
                </div>
            </div>


            <div class="text-center">
                <label class="err_lbl"></label><br>
                <button type="submit" data-id="8" class="frm-btn pri-text-color" role="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> Update
                </button>
                <button type="button" data-bs-dismiss="modal" class="frm-btn outline-btn" role="button">
                    <i class="fa fa-times"></i> Cancel
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>