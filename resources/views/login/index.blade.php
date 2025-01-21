<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Appac Login</title>
    @include('layouts/partials/css')



    <!-- Styles -->
    <style>
	


    </style>
</head>

<body class="" onload="digi()">

    <div class="row m-0" style="height: 100vh;">
        <div class="bm-secondary-color align-items-center d-flex  gap-bt-frm  flex-column   h-100 bg1">
<div class="logo-div  d-flex w-100 justify-content-end">
            <a class="text-align-last" id="logo" href="https://appacmedia.com/">
                    <img class="login-logo1 center" alt="blue logo" width="170" src="/asset/image/appac-logo.png">
					<img class="login-logo2  center" alt="white logo" width="170" src="/asset/image/Appac-Logo-1.png">
                </a>
            </div>
        
            <div class="col-12 col-sm-6 col-md-6 col-lg-5  col-xl-4 col-xxl-3   d-flex flex-column  h-70 justify-content-center" >
                <!--<p id="tt"></p>
                <p>

                 <?php echo  date("l F d Y"); ?>
            </p>-->

                <!--<a class="center " id="logo" href="https://appacmedia.com/">
                    <img class="center mb-5" alt="logo" width="170" src="/asset/image/appac-logo.png">
                </a>-->
               
               <div class="login-column login-form-div">
             @if(env('IPADDRESS')==request()->session()->get('serverip'))
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="row login-form-row pb-0 pt-3  m-auto  bg-white rounded-top-3 mbpad">
                        <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->

                        <div class="col-12 position-relative input-fld">
                            <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                            {!! Form::text('username', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => ''
                            ]) !!}

<div class="AxOyFc snByac" aria-hidden="true">Username</div>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row login-form-row pb-3 bg-white rounded-bottom-3">
                        <!-- <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label> -->

                         <div class="col-12 position-relative input-fld ">
                        <span class="input-group-text  pass-hider bg-transparent border-0" style="cursor: pointer;" onclick="togglePasswordVisibility()">
							<i id="toggle-icon" class="fa fa-eye"></i>
						</span>
                            {!! Form::password('password', [
                            'class' => 'form-control',
                            'required' => 'required',
                            'id' => 'password-field',
                            'placeholder' => ''
                            ]) !!}
                            <div class="AxOyFc snByac" aria-hidden="true">Password</div>
                           
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    
                            @enderror
                           
                        </div>
                    </div>
<div class="justify-content-between align-items-center d-flex my-3  m-4">

                     <!-- <div class="">
    <a href="" class="text-decoration-none">Forgot Password?</a>
</div> -->
</div>

                    <button type="submit" class="btn bg-white pri-text-color loginform-btn">
                        {{ __('Sign in') }}
                    </button>
                </form>
                   @else
                @if(empty(request()->session()->get('otp')) && empty(request()->session()->get('empid')) )
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="row mb-3 rounded-top-3 rounded-bottom-3 login-form-row bg-white">
                        <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->
                        <div class="col-md-12 pt-3 pb-3">
                            <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                            {!! Form::text('username', null, [
                            'class' => 'form-control',
                            'required' => 'required',
                            'placeholder' => 'Username'
                            ]) !!}

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn bg-white pri-text-color loginform-btn">
                        {{ __('Send OTP') }}
                    </button>
                </form>
                @else
                <form method="POST" action="{{ url('/verifyotp') }}">
                    @csrf
                    <div class="row mb-3 rounded-top-3 rounded-bottom-3 login-form-row bg-white">
                        <!-- <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label> -->
                        <div class="col-md-12">
                            <!-- <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> -->
                            {!! Form::number('otp', null, [
                            'class' => 'form-control',
                            'required' => true,
                            'placeholder' => 'Enter OTP',
                            'maxlength' => 6,
                            'minlength' => 6,
                                ]) !!}

                                @error('otp')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn bg-white pri-text-color loginform-btn">
                        {{ __('Submit') }}
                    </button>
                </form>
                @endif
                @endif

                @if(session()->has('secmessage'))
                <div class="alert alert-danger alert-dismissible px-3 mt-3 bold col-5 secalert">
                    {{ session()->get('secmessage') }}
                    <button class="float-end btn btn-large p-0" onclick="this.parentElement.style.display='none';">&times;</button>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>

    @include('layouts/partials/js')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Check if credentials are saved in localStorage
            if (localStorage.getItem('rememberMe') == 'true') {
                // If 'Remember Me' is selected, fill the username and password
                document.getElementById('username').value = localStorage.getItem('username');
                document.getElementById('password-field').value = localStorage.getItem('password');
                document.getElementById('rememberMe').checked = true;
            }

            // Add event listener to the checkbox
            document.getElementById('rememberMe').addEventListener('change', function() {
                if (this.checked) {
                    // Save credentials to localStorage if checked
                    localStorage.setItem('rememberMe', 'true');
                    localStorage.setItem('username', document.getElementById('username').value);
                    localStorage.setItem('password', document.getElementById('password-field').value);
                } else {
                    // Clear credentials from localStorage if unchecked
                    localStorage.removeItem('rememberMe');
                    localStorage.removeItem('username');
                    localStorage.removeItem('password');
                }
            });
        });
    </script>
</body>

</html>