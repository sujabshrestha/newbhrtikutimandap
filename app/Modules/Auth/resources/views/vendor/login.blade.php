@extends('layouts.vendor.master')

@section('title')
    लगइन स्थल बुकिंग प्रणाली
@endsection

@section('content')

<div class="col-md-12 mb-2 mt-2 container messages">
    @include('layouts.vendor.messages')
</div>

    <main class="page-login">
        <section class="sc-form login-form position-relative"
            style="background-image: url('{{ asset('frontendfiles/assets/images/login-banner.png') }}')">
            <div class="container">
                <div class="sc-form-content row align-items-center h-100">
                    <div class="col-left d-flex flex-column justify-content-center px-4 px-md-3">
                        <div class="sc-form-title">
                            <p class="text-primary-v1 fw-6 fs-xx-lg mb-0">@lang('lang.welcome')</p>
                            <h1 class="text-primary-v1 fw-6">अनलाईन स्थल बुकिङ्ग प्रणाली</h1>
                        </div>
                        <p class="text mb-0">लग इन गर्नुहोस् वा खाता सिर्जना गर्नुहोस्</p>

                        <form method="POST" action="{{ route('vendor.loginSubmit') }}">
                            @csrf
                            <div class="form-element">
                                <label for="" class="form-label">इमेल</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}"
                                    placeholder="bhrikuti@example.com" name="">
                                @if ($errors->has('email'))
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                            <div class="form-element password-element">
                                <label for="" class="form-label">@lang('lang.password')</label>
                                <input type="password" name="password" class="form-control password"
                                    placeholder="Enter Password" name="">
                                <span class="eye-icon">
                                    <i class="fa-solid fa-eye-slash"></i>
                                </span>
                                @if ($errors->has('password'))
                                    <small class="text-danger">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                            <div class="form-elemen d-flex align-items-center justify-content-between">
                                <div>
                                    <input class="form-check-input" required type="checkbox" value=""
                                        id="remember_me">
                                    <label class="form-check-label ps-2 text" for="remember_me"><a
                                            href="{{ getOrginalUrl(returnSiteSetting('aggrement_file')) ?? "" }}" target="_blank">नियम र सर्तहरूमा
                                            सहमत छु ।</a></label>
                                </div>
                                <a href="{{ route('vendor.forgetPassword') }}" class="text-primary text">पासवर्ड बिर्सनुभयो ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-text">@lang('lang.login')</span>
                            </button>
                            <p class="text-jet text form-text">खाता छैन?<a href="{{ route('vendor.register') }}"
                                    class="text-primary">नयाँ खाता खोल्नुहोस्</a></p>

                            <p class="text-copyright text-center mb-0 mt-5">प्रतिलिपि अधिकार २०२२ समाज कल्याण परिषद सचिबालय,
                                भृकुटीमण्डप - काठमाडौँ</p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
