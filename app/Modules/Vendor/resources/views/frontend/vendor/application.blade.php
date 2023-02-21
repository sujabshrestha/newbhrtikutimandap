@extends('layouts.vendor.master')

@section('title')
    @lang('lang.application')
@endsection

@section('breadcrumb')
    @lang('lang.application')
@endsection
@push('styles')
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />


    <style>
        .file-upload-content {
            background-color: rgba(0, 0, 0, 0.02);
            box-shadow: rgba(0, 0, 0, 0.01) 0px 1px 3px 0px, rgba(27, 31, 35, 0.05) 0px 0px 0px 1px;
        }

        .file-upload-content .upload-body>div {
            display: none;
        }

        .file-upload-content .upload-element {
            border: 1.22px dashed #3A3A3A;
            border-radius: 12px;
            min-height: 320px;
        }

        .file-upload-content .upload-element .upload-img-default {
            max-width: 200px;
        }

        .file-upload-content .upload-element .upload-btn:hover {
            color: #fff;
        }

        .file-upload-content .upload-element .uploaded-imgs {
            padding: 12px;
            height: 200px;
            overflow-y: scroll;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
        }

        .file-upload-content .upload-element .uploaded-imgs .uploaded-img {
            height: 100px;
            position: relative;
            z-index: initial;
        }

        .file-upload-content .upload-element .uploaded-imgs .uploaded-img .img-close-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: initial;
            width: 22px;
            height: 22px;
            font-size: 14px;
            line-height: normal;
            letter-spacing: normal;
            background-color: rgba(9, 20, 70, 0.9) !important;
            border-radius: 100%;
            -moz-align-items: center;
            align-items: center;
            -moz-justify-content: center;
            justify-content: center;
            color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.5) !important;
        }

        @media (max-width: 479.99px) {
            .file-upload-content .upload-element .uploaded-imgs {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class="file-upload py-3">
        <div class="container">
            <div class="file-upload-content py-5 px-4">
                <p class="text-lg text-center max-w-wrapper mb-4">कृपया व्यक्तिगत अथाव संस्थागत मध्ये एक छनोट गरि रोजेको
                    मिति/स्थलमा आफ्नो बुकिङ्ग उपलब्ध गराईदिनुहुन भनि आवेदनको स्क्यान प्रतिलिपि पेश गर्नुहोस् ।
                </p>
                <form action="{{ route('vendor.application.store') }}" method="POST" enctype="multipart/form-data"
                    class="file-upload-form">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id ?? null }}">
                    <input type="hidden" name="notification_id" value="{{ $notificationid ?? null }}">
                    <div class="upload-type">
                        <label for="" class="form-label mb-3">
                            बुकिङ्ग गर्ने को हो? रोज्नुहोस् ।</label>
                        <select name="application_type" class="form-control">
                            <option selected disabled> -- Select type -- </option>
                            <option value="personal" @if (isset($booking) && $booking->type == 'personal') selected @endif id="type-personal">
                                व्यक्तिगत</option>
                            <option @if (isset($booking) && $booking->type == 'personal') selected @endif value="institutional"
                                id="type-institutional">
                                संस्थागत</option>
                        </select>
                    </div>
                    <div class="row upload-body">
                        <div class="col-md-6 mb-2 upload-box-application">
                            <h4 class="upload-title py-3">@lang('lang.application')</h4>
                            <div class="upload-element bg-white fw-6 py-4">
                                <img src="{{ asset('applicationphoto.jpg') }}" alt=""
                                    class="upload-img-default mx-auto">
                                <p class="upload-file-name text text-center mt-3 text-sm">कुनै फाइल चयन गरिएको छैन !</p>
                                <div class="btns d-flex justify-content-center">
                                    <button type="button" class="btn btn-green-sm upload-btn">
                                        <span class="btn-text">ब्राउज गर्नुहोस्</span>
                                    </button>
                                    <input type="file" required name="applicationImages[]" id="applicationImages"
                                        class="visually-hidden upload-input applicationImages" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2 upload-box-company">
                            <h4 class="upload-title py-3 fw-6 text">
                                कम्पनी दर्ता प्रतिलिपि</h4>
                            <div class="upload-element bg-white py-4">
                                <img src="{{ asset('applicationphoto.jpg') }}" alt=""
                                    class="upload-img-default mx-auto">
                                <p class="upload-file-name text text-center mt-3 text-sm">कुनै फाइल चयन गरिएको छैन !</p>
                                <div class="btns d-flex justify-content-center">
                                    <button type="button" class="btn btn-green-sm upload-btn">
                                        <span class="btn-text">
                                            ब्राउज गर्नुहोस्</span>
                                    </button>
                                    <input type="file" name="companyRegistrationImages[]" id="companyRegistrationImages"
                                        class="visually-hidden upload-input companyRegistrationImages" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2 upload-box-pan">
                            <h4 class="upload-title py-3">प्यान / भ्याट रजिष्ट्रेसन प्रतिलिपि:</h4>
                            <div class="upload-element bg-white fw-6 py-4">
                                <img src="{{ asset('applicationphoto.jpg') }}" alt=""
                                    class="upload-img-default mx-auto">
                                <p class="upload-file-name text text-center mt-3 text-sm">कुनै फाइल चयन गरिएको छैन !</p>
                                <div class="btns d-flex justify-content-center">
                                    <button type="button" class="btn btn-green-sm upload-btn">
                                        <span class="btn-text">ब्राउज गर्नुहोस्</span>
                                    </button>
                                    <input type="file" id="panNumberImages" name="panNumberImages[]"
                                        class="visually-hidden upload-input panNumberImages" multiple>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2 upload-box-other">
                            <h4 class="upload-title py-3">
                                अरू डकुमेन्ट यदि भएमा</h4>
                            <div class="upload-element bg-white fw-6 py-4">
                                <img src="{{ asset('applicationphoto.jpg') }}" alt=""
                                    class="upload-img-default mx-auto">
                                <p class="upload-file-name text text-center mt-3 text-sm">कुनै फाइल चयन गरिएको छैन !</p>
                                <div class="btns d-flex justify-content-center">
                                    <button type="button" class="btn btn-green-sm upload-btn">
                                        <span class="btn-text">ब्राउज गर्नुहोस्</span>
                                    </button>
                                    <input type="file" id="otherImages" name="otherImages[]"
                                        class="visually-hidden upload-input otherImages" multiple>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary submit-btn">
                            पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>
        </div>
    </main>





    {{-- <main class="page-upload pb-5">
        <div class="container">
            <section class="sc-upload px-3 overflow-hidden">
                <div class="success-content">
                    <p class="text-lg text-center max-w-wrapper mb-4">कृपया कम्पनीको लेटर हेड र अधिकृत हस्ताक्षर सहितको A4 साइजको कागजमा आवश्यक स्थान र मितिको विवरण सहितको आवेदन (निबेधन) अपलोड गर्नुहोस्।
                    </p>

                    <form action="{{ route('vendor.application.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id ?? null }}">
                        <input type="hidden" name="notification_id" value="{{ $notificationid ?? null }}">
                        <div class="success-body px-4 upload-highlight">
                            <div class = "upload-form">
                                <div class = "upload-form-elem mb-xl-3">
                                    <label for="" class = "form-label mb-2 ps-0">@lang('lang.name')</label>
                                    <div class = "">
                                        <input type = "text" name="name" class = 'form-control' value="{{ auth()->user()->name ?? "" }}"
                                         placeholder="@lang('lang.name')">
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class = "col-md-12">
                                        <div class = "upload-form-elem">
                                            <label for="" class = "form-label mb-2 ps-0">@lang('lang.contact'):</label>
                                            <div class = "">
                                                <input type = "text" name="contact" class = 'form-control' value="{{ auth()->user()->phone ?? "" }}"
                                                 placeholder="@lang('lang.contact')">
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
                            <p class="text-xl text-center mb-4">
                                वा</p>
                            <p class="upload-file-name text text-center">कुनै फाइल चयन गरिएको छैन !</p>

                            <div class="btns d-flex justify-content-center">
                                <button type="button" class="btn btn-green-sm" id="upload-btn">
                                    <span class="btn-text">Browse</span>
                                </button>
                                <input type="file" name="uploadfiles[]" multiple="" class="visually-hidden" id="upload-input">
                            </div>
                        </div>


                        <div class="d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main> --}}

    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
    <script>
        $('#applicationImages').change(function() {

            var fp = $("#applicationImages");

            var lg = fp[0].files.length; // get length

            var items = fp[0].files;

            var fileSize = 0;

            if (lg > 0) {

                for (var i = 0; i < lg; i++) {

                    fileSize = fileSize + items[i].size; // get file size

                }

                if (fileSize > 2097152) {

                    alert('File size must not be more than 2 MB');

                    $('#applicationImages').val('');

                }

            }

        });


        $('#companyRegistrationImages').change(function() {

            var fp = $("#companyRegistrationImages");

            var lg = fp[0].files.length; // get length

            var items = fp[0].files;

            var fileSize = 0;

            if (lg > 0) {

                for (var i = 0; i < lg; i++) {

                    fileSize = fileSize + items[i].size; // get file size

                }

                if (fileSize > 2097152) {

                    alert('File size must not be more than 2 MB');

                    $('#companyRegistrationImages').val('');

                }

            }

        });



        $('#panNumberImages').change(function() {

            var fp = $("#panNumberImages");

            var lg = fp[0].files.length; // get length

            var items = fp[0].files;

            var fileSize = 0;

            if (lg > 0) {

                for (var i = 0; i < lg; i++) {

                    fileSize = fileSize + items[i].size; // get file size

                }

                if (fileSize > 2097152) {

                    alert('File size must not be more than 2 MB');

                    $('#panNumberImages').val('');

                }

            }

        });


        $('#otherImages').change(function() {

            var fp = $("#otherImages");

            var lg = fp[0].files.length; // get length

            var items = fp[0].files;

            var fileSize = 0;

            if (lg > 0) {

                for (var i = 0; i < lg; i++) {

                    fileSize = fileSize + items[i].size; // get file size

                }

                if (fileSize > 2097152) {

                    alert('File size must not be more than 2 MB');

                    $('#otherImages').val('');

                }

            }

        });


        $(document).on('submit', '#file-upload-form', function(){
            loader();
        });



    </script>


    <script>
        const allUploadBtns = $('.upload-btn');
        jQuery.each(allUploadBtns, function(idx, uploadBtn) {
            $(uploadBtn).on('click', function() {
                let uploadElem = $(uploadBtn).parent().parent();
                $(uploadElem).find('.upload-input').trigger('click');
            });
        });

        const allUploadInputs = $('.upload-input');
        jQuery.each(allUploadInputs, function(idx, uploadInput) {
            $(uploadInput).on('change', function(event) {
                let uploadElem = $(uploadInput).parent().parent();
                if (event.target.files) {

                    let filesAmount = event.target.files.length;
                    $(uploadElem).find('.upload-img-default').remove();
                    $(uploadElem).find('.upload-file-name').text(filesAmount + " files(s) selected.");

                    if (($(uploadElem).find('.uploaded-imgs')).length == 0) {
                        $(uploadElem).prepend('<div class = "uploaded-imgs"></div>');
                    } else {
                        $(uploadElem).find('.uploaded-imgs').html("");
                    }

                    for (let i = 0; i < filesAmount; i++) {
                        let reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML(`
                            <div class = "uploaded-img img-fit-cover">
                                <img src = "${event.target.result}" alt = "" />
                                <button type = "button" class = "img-close-btn">&#10006;</button>
                            </div>
                        `)).appendTo($(uploadElem).find(".uploaded-imgs"));
                        }

                        reader.readAsDataURL(event.target.files[i]);
                    }
                }
            });
        })

        $('.upload-type select').change(function() {
            let selectedType = $(this).children("option:selected").val();
            let uploadBoxes = $('.upload-body > div');

            if (selectedType == "personal") {
                jQuery.each(uploadBoxes, function(idx, uploadbox) {
                    if (!$(uploadbox).hasClass(('upload-box-company'))) $(uploadbox).css('display',
                        'block');
                    else $(uploadbox).css('display', 'none');
                });
            }

            if (selectedType == "institutional") {
                jQuery.each(uploadBoxes, function(idx, uploadbox) {
                    $(uploadbox).css('display', 'block');
                });
            }
        });

        $(document).on('click', function(event) {
            console.log(event.target);
            if ($(event.target).hasClass('img-close-btn')) {
                $(event.target).parent().remove();
            }
        });
    </script>
@endpush
