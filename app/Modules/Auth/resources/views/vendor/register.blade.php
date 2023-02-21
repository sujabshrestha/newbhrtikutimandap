@extends('layouts.vendor.master')
@section('title')
    दर्ता गर्नुहोस्
@endsection
@section('content')

<div class="col-md-12 mb-2 mt-2 container messages">
    @include('layouts.vendor.messages')
</div>




    <main class="page-register">
        <section class="sc-form register-form position-relative "
            style="background-image: url('{{ asset('frontendfiles/assets/images/login-banner.png') }}')">
            <div class="container">
                <div class="sc-form-content row align-items-center">
                    <div class="col-left d-flex flex-column justify-content-center px-4 px-md-3">
                        <div class="sc-form-title mt-5">
                            <p class="text-primary-v1 fw-6 fs-xx-lg mb-0">
                                दर्ता गर्नुहोस्</p>
                            <h1 class="text-primary-v1 fw-6">अनलाईन स्थल बुकिङ्ग प्रणाली </h1>
                        </div>

                        <form method="POST" action="{{ route('vendor.registersubmit') }}">
                            @csrf
                            <div class="form-element">
                                <label for="" class="form-label">
                                    पुरा नाम</label>
                                <input type="text" name="name" value="{{ old('name') ?? '' }}" required
                                    class="form-control" placeholder="पूरा नाम प्रविष्ट गर्नुहोस्" name="">
                                @if ($errors->has('name'))
                                    <small class="text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-element password-element">
                                <label for="" class="form-label">
                                    इमेल</label>
                                <input type="email" name="email" value="{{ old('email') ?? '' }}" class="form-control"
                                    placeholder="loginbhrikuti@example.com" name="">
                                @if ($errors->has('email'))
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-element password-element">
                                <label for="" class="form-label">पासवर्ड</label>
                                <input type="password" name="password" class="form-control password"
                                    placeholder="
                            पासवर्ड प्रविष्ट गर्नुहोस्" name="">
                                <span class="eye-icon">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>

                                @if ($errors->has('password'))
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <div class="form-element confirm-password-element">
                                <label for="" class="form-label">
                                    पासवर्ड सुनिश्चित गर्नुहोस</label>
                                <input type="password" name="password_confirm" class="form-control password"
                                    placeholder="
                            पासवर्ड सुनिश्चित गर्नुहोस" name="">
                                <span class="eye-icon">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>

                                @if ($errors->has('password_confirm'))
                                    <small class="text-danger">{{ $errors->first('password_confirm') }}</small>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <span class="btn-text">खाता सिर्जना गर्नुहोस्</span>
                            </button>
                            <div class="d-flex justify-content-between">
                                <p class="text-jet text form-text">
                                    पहिले नै खाता खोल्नुभएको छ ?<a href="{{ route('vendor.login') }}" class="text-primary">
                                        लग - इन </a></p>

                                        <p class="text-jet text form-text">
                                           <a href="{{ getOrginalUrl(returnSiteSetting('aggrement_file')) ?? "" }}" target="_blank" class="text-primary">
                                            शर्त तथा निति
                                            </a></p>
                            </div>

                            <p class="text-copyright text-center mb-0 mt-5">प्रतिलिपि अधिकार समाज कल्याण परिषद सचिबालय,
                                भृकुटीमण्डप-काठमाडौं</p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
