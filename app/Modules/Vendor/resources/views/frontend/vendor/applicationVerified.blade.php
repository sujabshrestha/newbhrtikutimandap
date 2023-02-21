@extends('layouts.vendor.master')

@section('title', '
आवेदन प्रमाणित')

@section('breadcrumb', '
आवेदन प्रमाणित')
@push('styles')
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class="page-success">
        <div class="container">
            <section class="sc-success px-3 overflow-hidden">
                <div class="success-content">
                    <div class="success-img">
                        <img src="{{ asset('frontendfiles/assets/images/success-image.png') }} " alt="">
                    </div>

                    <p class="text-xl text-center text-green success-text">धन्यवाद, स्थन बुकिङ्गको लागि तपाईको आवेदन प्राप्त भयो, हामी हेरेर तपाईलाई चाडै सुचित
                        गर्नेछौ ।
                    </p>

                    <div class="btns d-flex justify-content-center">
                        <a href="{{ route('vendor.home') }}" class="btn btn-outline-primary-sm me-2">
                            <span class="btn-text">@lang('lang.dashboard')</span>
                        </a>
                        <a href="{{route('vendor.myBooking') }}" class="btn btn-primary-sm">
                            <span class="btn-text">
                                तपाईको बुकिङ्ग हेर्नुहोस्</span>
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
