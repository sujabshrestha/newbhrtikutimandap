@extends('layouts.vendor.master')

@section('title')
    @lang('lang.about')
@endsection

@section('breadcrumb')
    @lang('lang.about')
@endsection
@push('styles')

@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <main class = "page-about">
        <div class = "container">
            <section class = "sc-about-block-1 px-3">
                <div class="about-block-1-content py-5">
                    <div class = "row align-items-xl-center">
                        <div class = "col-xl-6 pe-xl-5">
                            <div class="paragraph-content text-justify">
                                <div class="sc-title">
                                    <h3>@lang('lang.bhrikuti_mandap')</h3>
                                </div>
                                {{ returnSiteSetting('about_us') ?? ''}}
                            </div>

                            <div class = "about-info-list row">
                                <div class = "col-md-6">
                                    <div class = "info-list-item my-3">
                                        <div class = "item-icon">
                                            <img src = "{{ asset('frontendfiles/assets/images/call-calling.svg')}}">
                                        </div>
                                        <div class = "item-text">
                                            <span class = "d-block fw-6 text mb-1">@lang('lang.contact')</span>
                                            <span class = "text-sm">{{ returnSiteSetting('primary_phone') ?? '' }}, {{ returnSiteSetting('secondary_phone') ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class = "col-md-6">
                                    <div class = "info-list-item my-3">
                                        <div class = "item-icon">
                                            <img src = "{{ asset('frontendfiles/assets/images/sms-tracking.svg')}}">
                                        </div>
                                        <div class = "item-text">
                                            <span class = "d-block fw-6 text mb-1">@lang('lang.mail')</span>
                                            <span class = "text-sm">{{ returnSiteSetting('primary_email') ?? ''}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "col-xl-6 mt-4 mt-xl-0">
                            <div class = "row align-items-center">
                                <div class = "col-sm-6">
                                    <div class = "mb-3">
                                        <img src = "{{ getOrginalUrl(returnSiteSetting('about_first_image')) ?? asset('frontendfiles/assets/images/about-pg/about-img-1.png') }}" alt = "">
                                    </div>
                                </div>
                                <div class = "col-sm-6">
                                    <div class = "mb-3">
                                        <img src = "{{ getOrginalUrl(returnSiteSetting('about_second_image')) ?? asset('frontendfiles/assets/images/about-pg/about-img-2.png') }}" alt = "">
                                    </div>
                                    <div>
                                        <img src = "{{ getOrginalUrl(returnSiteSetting('about_third_image')) ?? asset('frontendfiles/assets/images/about-pg/about-img-3.png') }}" alt = "">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class = "sc-about-block-2 px-3">
                <div class = "about-block-2-content py-5">
                    <div class = "row align-items-center">
                        <div class = "col-xl-5 mb-4">
                            <div class = "max-w-wrapper mx-auto">
                                <img src = "{{ getOrginalUrl(returnSiteSetting('about_us_image')) ?? asset('frontendfiles/assets/images/about-pg/about-img-3.png') }}" alt = "">

                            </div>
                        </div>
                        <div class = "col-xl-7 ps-xl-5">
                            <div class="sc-title mb-3">
                                <h3>@lang('lang.venues')</h3>
                            </div>
                            <div class = "paragraph-content text-justify">
                               {{ returnSiteSetting('about_venues')}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class = "sc-about-block-3 px-3">
                <div class = "about-block-3-content py-5">
                    <div class = "row">
                        <div class = "col-xl-6">
                            <div class="sc-title mb-3">
                                <h3>@lang('lang.venues')</h3>
                            </div>
                            <div class = "paragraph-content">
                                <table class = "table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('lang.venue')</th>
                                            <th>@lang('lang.rate')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Large Exbition Hall & area around it</td>
                                            <td>RS. 2,50,000/day</td>
                                        </tr>
                                        <tr>
                                            <td>Large Exbition Hall & area around it</td>
                                            <td>RS. 2,50,000/day</td>
                                        </tr>
                                        <tr>
                                            <td>Large Exbition Hall & area around it</td>
                                            <td>RS. 2,50,000/day</td>
                                        </tr>
                                        <tr>
                                            <td>Large Exbition Hall & area around it</td>
                                            <td>RS. 2,50,000/day</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class = "col-xl-6">
                            <div class = "max-w-wrapper mx-auto">
                                <img src = "{{ getOrginalUrl(returnSiteSetting('venue_image')) ?? asset('frontendfiles/assets/images/about-pg/about-img-2.png') }}" alt = "">

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>


    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')


@endpush
