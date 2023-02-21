<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Venue Booking Sytem | Register </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('backendfiles/assets/img/favicon.ico') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"> --}}
    <link href="{{ asset('backendfiles/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backendfiles/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backendfiles/assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backendfiles/assets/css/forms/theme-checkbox-radio.css ') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backendfiles/assets/css/forms/switches.css') }}">
</head>
<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Register In to <a href="{{ route('backend.register') }}"><span class="brand-name">Venue Booking System</span></a></h1>
                        {{-- {{ route('admin.user.register') }} --}}
                        <p class="signup-link">New Here? <a href="{{ route('backend.login') }}">Already have an account?</a></p>

                        <form class="text-left" method="POST" action="{{ route('backend.registersubmit') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form">

                                    <div class="col-md-12">
                                        <div id="name-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            <input id="name" name="name" type="text" value="{{ old('name') }}" class="form-control" placeholder="Name">
                                            @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div id="email-field" class="field-wrapper input">
                                            <i data-feather="at-sign"></i>
                                            <input id="email" name="email" type="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                                            @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>


                                    {{-- <div class="col-md-12">
                                        <div id="contact-field" class="field-wrapper input">
                                            <i data-feather="phone"></i>
                                            <input id="phone_no" name="phone_no" value="{{ old('phone_no') }}" type="number" class="form-control" placeholder="Contact">
                                            @error('phone_no')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-12">
                                        <div id="address-field" class="field-wrapper input">
                                            <i data-feather="map-pin"></i>
                                            <input id="address" name="address" value="{{ old('address') }}" type="text" class="form-control" placeholder="Address">
                                        </div>
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div id="password-field" class="field-wrapper input mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                            @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="password-field" class="field-wrapper input mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                            <input id="passwordconfirmation" name="passwordconfirmation" type="password" class="form-control" placeholder="Confirm Password">
                                            @error('passwordconfirmation')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Register</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backendfiles/assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('backendfiles/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('backendfiles/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <script>
        setTimeout(function(){ $('.text-danger').hide(); }, 3000);
    </script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backendfiles/assets/js/authentication/form-1.js') }}"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
</body>
</html>
