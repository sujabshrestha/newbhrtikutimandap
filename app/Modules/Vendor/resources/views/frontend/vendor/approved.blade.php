@extends('layouts.vendor.master')

@section('title', 'आवेदन स्वीकृत')

@section('breadcrumb', 'आवेदन स्वीकृत')
@push('styles')
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class = "page-success">
        <div class = "container">
            <section class = "sc-success px-3 overflow-hidden">
                <div class="success-content">
                    <div class="success-img">
                        <img src = "assets/images/success-image.png" alt = "">
                    </div>

                    <p class="text-xl text-center text-green success-text">Congratulations your Payment Slip was Verified.</p>

                    <div class="btns d-flex justify-content-center">
                        <a href = "#" class="btn btn-outline-primary-sm me-2">
                            <span class="btn-text">Dashboard</span>
                        </a>
                        <a href = "#" class = "btn btn-primary-sm">
                            <span class="btn-text">View My Bookings</span>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')


@endpush
