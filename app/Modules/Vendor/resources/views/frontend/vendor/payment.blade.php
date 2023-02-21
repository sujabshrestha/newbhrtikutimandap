@extends('layouts.vendor.master')

@section('title')
@lang('lang.payment')
@endsection

@section('breadcrumb')
@lang('lang.payment')
@endsection

@push('styles')
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class="page-upload pb-5">
        <div class="container">
            <div class="row mx-0">
                <section class="sc-upload-slip col-xl-6 px-3 mt-5 pt-xl-5">
                    <div class="success-content">
                        <p class="text-lg text-center text-green success-text mb-3">बुकिंगको लागि तपाइँको अनुरोधलाई बधाई छ
                            स्वीकृत भएको छ!!!</p>
                        <div class="upload-slip-block">
                            <p class="text fw-6">कृपया निम्न विवरणहरूमा सहमत रकम तिर्नुहोस् र भुक्तानी स्लिप संलग्न गर्नुहोस्.</p>
                            <div class="row">
                                <div class="col-xl-7">

                                    <ul>
                                        <li class="text my-2">
                                            भुक्तानी गर्नुपर्ने रकम: Rs. {{ $booking->venues_sum_price }} </li>
                                        <li class="text my-2">खाताको नाम:
                                            {{ returnSiteSetting('account_name') ?? 'Samaj Kalyan Parisad' }} </li>
                                        <li class="text my-2">खाता नम्बर:
                                            {{ returnSiteSetting('account_number') ?? '1234532147720742' }} </li>
                                        <li class="text my-2">
                                            बैंक नाम:
                                            {{ returnSiteSetting('bank_name') ?? 'NMB Bank Nepal Ltd.' }} </li>
                                        <li class="text my-2">साखा:
                                            {{ returnSiteSetting('branch_name') ?? 'Putalisadak, Kathmandu' }} </li>
                                    </ul>
                                </div>
                                <div class="col-xl-5 mt-4 mt-xl-0">
                                    <div class="qr-img">
                                        <img src="{{ !is_null(returnSiteSetting('branch_name')) ? url('/') . getOrginalUrl(returnSiteSetting('qr_image')) : asset('frontendfiles/assets/images/qr-code.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="sc-upload px-3 overflow-hidden col-xl-6 ms-xl-auto">
                    <form method="POST" action="{{ route('vendor.payment.store', $booking->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="notification_id" value="{{ $notificationid ?? null }}">
                    <div class="success-content">
                        <p class="text-lg text-center max-w-wrapper mb-4">यहाँ आफ्नो भुक्तानी पर्ची अपलोड गर्नुहोस्।
                        </p>

                            <div class="success-body px-4 upload-highlight">
                                <div class = "upload-form">
                                    <div class = "upload-form-elem mb-xl-3">
                                        <label for="" class = "form-label mb-2 ps-0">
                                            द्वारा जम्मा:</label>
                                        <div class = "">
                                            <input type = "text" name="deposited_by" class = 'form-control' placeholder="Deposited By">
                                        </div>
                                    </div>
                                    <div class = "row">
                                        <div class = "col-md-6">
                                            <div class = "upload-form-elem">
                                                <label for="" class = "form-label mb-2 ps-0">संपर्क नम्बर:</label>
                                                <div class = "">
                                                    <input type = "text" name="contact" class = 'form-control' placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "col-md-6">
                                            <div class = "upload-form-elem">
                                                <label for="" class = "form-label mb-2 ps-0">
                                                    जम्मा भएको रकम:</label>
                                                <div>
                                                    <input type = "text" name="deposited_amount" class = 'form-control' placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-img mb-4" onchange="handleFiles(this.files)">
                                    <img src="{{ asset('frontendfiles/assets/images/upload-image.png') }} " style="height:  400px !important;" alt="">
                                </div>

                                <p class="text-xl text-center mb-3">
                                    अपलोड गर्न फाइलहरू तान्नुहोस् र छोड्नुहोस्</p>
                                <p class="text-xl text-center mb-4">वा</p>
                                <p class="upload-file-name text text-center">कुनै फाइल चयन गरिएको छैन !</p>

                                <div class="btns d-flex justify-content-center">
                                    <button type="button" class="btn btn-green-sm" id="upload-btn">
                                        <span class="btn-text">@lang('lang.browse')</span>
                                    </button>
                                    <input type="file" name="uploadfiles[]" multiple="" class="visually-hidden" id="upload-input">
                                </div>
                            </div>

                        <p class="text-lg fw-6 text-center mb-4 mt-4">Or</p>

                        <p class="text text-start">मार्फत भुक्तानी गर्नुहोस्:</p>
                        <div class="payment-methods d-flex align-items-center justify-content-center flex-wrap">
                            <a href="#" class="payment-method-item mx-3 my-2">
                                <img src="{{ asset('frontendfiles/assets/images/ips-connect.png') }}">
                            </a>
                        </div>

                        <div class="d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary submit-btn">@lang('lang.submit')</button>
                        </div>
                    </form>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
@endpush
