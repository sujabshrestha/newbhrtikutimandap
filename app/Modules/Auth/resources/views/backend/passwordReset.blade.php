<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> {{ returnSiteSetting('title') ?? 'NDC'}} | Password Reset</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
    <link href="{{ asset( 'backendfiles/bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'backendfiles/assets/css/plugins.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'backendfiles/assets/css/authentication/form-1.css' ) }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset( 'backendfiles/assets/css/forms/theme-checkbox-radio.css' ) }}">
    <link rel="stylesheet" type="text/css" href="{{asset( 'backendfiles/assets/css/forms/switches.css')}}">
    {{-- Summernote css/js --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>
<body class="form">


    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link">Enter your email and instructions will sent to you!</p>
                        <form class="text-left" action="{{ route('backend.auth.forgetPasswordSubmit') }}" method="post" >
                            @csrf
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" required value="{{ old('email') }}" type="text" placeholder="Enter Your Email">
                                    @if($errors->has('email'))
                                        <span style="color: red">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Reset</button>
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
    <script src="{{asset('backendfiles/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('backendfiles/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('backendfiles/bootstrap/js/bootstrap.min.js')}}"></script>
    {!! Toastr::message() !!}
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('backend/assets/js/authentication/form-1.js')}}"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

</body>
</html>
