@extends('layouts.vendor.master')
@section('content')
<main class = "page-register">
    <section class = "sc-form register-form position-relative"  style="background-image: url('{{ asset('frontendfiles/assets/images/login-banner.png') }}')">
        <div class = "container">
            <div class = "sc-form-content row align-items-center">
                <div class = "col-left d-flex flex-column justify-content-center px-4 px-md-3">
                    <div class = "sc-form-title mt-5">
                        <p class = "text-primary-v1 fw-6 fs-xx-lg mb-0">Reset Password</p>
                        <h1 class = "text-primary-v1 fw-6">To Venue Booking System. </h1>
                    </div>

                    <form method="POST" action="{{ route('vendor.recoverPassword', $email) }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token ?? '' }}">
                        <div class = "form-element password-element">
                            <label for = "" class = "form-label">Password</label>
                            <input type = "password" name="password" class = "form-control password" placeholder="Enter Password" name = "">
                            <span class = "eye-icon">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class = "form-element confirm-password-element">
                            <label for = "" class = "form-label">Confirm Password</label>
                            <input type = "password" name="passwordconfirmation" class = "form-control password" placeholder="Confirm Password" name = "">
                            <span class = "eye-icon">
                                <i class="fa-solid fa-eye-slash"></i>
                            </span>
                            @error('passwordconfirmation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type = "submit" class = "btn btn-primary">
                            <span class = "btn-text">Reset Password</span>
                        </button>

                        <p class = "text-copyright text-center mb-0 mt-5">Copyright by Samaj Kalyan Parisad Sachibalaya, Bhrikutimandap-Kathmandu</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection




