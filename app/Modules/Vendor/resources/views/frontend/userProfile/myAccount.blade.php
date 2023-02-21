@extends('layouts.vendor.master')

@section('title')
    @lang('lang.my_account')
@endsection

@section('breadcrumb')
    @lang('lang.my_account')
@endsection
@push('styles')
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->


    <main class="page-bookings pb-5">
        <div class="container">
            <section class="sc-bookings px-3">
                <div class="boookings-content">
                    <ul class="nav nav-tabs" id="bookingTab" role="tablist">
                        <li class="nav-item nav-item-active" role="presentation">
                            <button class="nav-link active d-flex align-items-center" id="account-tab" data-bs-toggle="tab"
                                data-bs-target="#account" type="button" role="tab" aria-controls="account"
                                aria-selected="true">
                                <span class="tab-icon">
                                    <img src="{{ asset('frontendfiles/assets/images/user.svg') }}" alt='user icon'>
                                </span>
                                <span class="text-sm text-jet">@lang('lang.my_account')</span>
                            </button>
                        </li>

                    </ul>
                    <div class="tab-content" id="bookingTabContent">
                        <!-- MY ACCOUNT -->
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <div class="tab-pane-content">
                                <div class="row content-row">

                                    <!-- left column -->
                                    <div class="col-lg-5 content-col-l">
                                        <div class="acc-intro">
                                            <div class="acc-intro-img">
                                                <img src="{{ getOrginalUrl($user->image_id) ?? asset('frontendfiles/assets/images/profile-image.png') }}"
                                                    alt="" class="img-cover" id="profile-img-view">
                                                <button type="button"
                                                    class="profile-img-btn d-flex align-items-center bg-white">
                                                    <img src="{{ asset('frontendfiles/assets/images/gallery-export.svg') }}"
                                                        alt='icon' class="icon">
                                                    <span class="text-sm ms-1">@lang('lang.change_picture')</span>
                                                </button>
                                                <form class="profile-form image-form"
                                                    action="{{ route('vendor.profileImageUpdate') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    <input type="file" name="profile_image" class="profile-image"
                                                        accept="image/*" id="profile-img-input" accept="image/*">
                                                </form>
                                            </div>

                                            <div class="acc-intro-block border-bottom">
                                                <p class="text">{{ $user->name ?? 'N/A' }}</p>
                                                <ul>
                                                    <li class="text-sm my-2">{{ $user->email ?? 'N/A' }}</li>
                                                    <li class="text-sm my-2">{{ $user->phone ?? 'N/A' }}</li>
                                                </ul>
                                            </div>

                                            <div class="acc-intro-block">
                                                <p class="text-silver mb-2 text-sm">@lang('lang.organization'): </p>
                                                <p class="text mb-1">{{ $user->organization->organization_name ?? 'N/A' }}
                                                </p>
                                                <ul>
                                                    <li class="text-sm my-2">
                                                        {{ $user->organization->organization_phone_no ?? 'N/A' }}</li>
                                                    <li class="text-sm my-2">
                                                        {{ $user->organization->organization_email ?? 'N/A' }}</li>
                                                    <li class="text-sm my-2">
                                                        {{ $user->organization->organization_website ?? 'N/A' }}</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="acc-info">
                                            <h4 class="text mb-3">@lang('lang.information')</h4>
                                            <p class="text-sm">{!! $user->description ?? 'N/A' !!}</p>
                                        </div>
                                    </div>
                                    <!-- end of left column -->

                                    <!-- right column -->
                                    <div class="col-lg-7 content-col-r mt-5 mt-lg-0">
                                        <div class="mb-5">
                                            <form class="profile-form" action="{{ route('vendor.profileUpdate') }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-block mb-4">
                                                    <h3 class="text-lg form-block-title">@lang('lang.personal_profile'):</h3>
                                                    <div class="row form-elem-row">
                                                        <div class="col-xl-6">
                                                            <label for="name" class="form-label">@lang('lang.name')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="name" id="name"
                                                                value="{{ $user->name ?? old('name') }}"
                                                                class="form-control" placeholder="Name..." required>
                                                            @error('name')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="email" class="form-label">@lang('lang.email')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="email" id="email"
                                                                value="{{ $user->email ?? old('email') }}"
                                                                class="form-control" placeholder="Email..." required>
                                                            @error('email')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row form-elem-row">
                                                        <div class="col-xl-6">
                                                            <label for="phone" class="form-label">@lang('lang.phone_no')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="phone" id="phone"
                                                                value="{{ $user->phone ?? old('phone') }}"
                                                                class="form-control" placeholder="@lang('lang.phone_no')..."
                                                                required>
                                                            @error('phone')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="adddress" class="form-label">@lang('lang.address')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="address" id="address"
                                                                value="{{ $user->address ?? old('address') }}"
                                                                class="form-control" placeholder="@lang('lang.address')..."
                                                                required>
                                                            @error('address')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label for="description"
                                                            class="form-label">@lang('lang.description')</label>
                                                        <textarea rows="5" name="description" id="description" class="form-control" placeholder="@lang('lang.description')...">
                                                        {{ $user->description ?? old('description') }}
                                                    </textarea>
                                                        @error('description')
                                                            <span class="text-dange">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-block">
                                                    <h3 class="text-lg form-block-title">@lang('lang.organization_profile'):</h3>
                                                    <div class="row form-elem-row">
                                                        <div class="col-xl-6">
                                                            <label for="organization_name"
                                                                class="form-label">@lang('lang.organization_name')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="organization_name"
                                                                id="organization_name"
                                                                value="{{ $user->organization->organization_name ?? old('organization_name') }}"
                                                                class="form-control" placeholder="@lang('lang.organization_name')..."
                                                                required>
                                                            @error('organization_name')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="organization_phone_no"
                                                                class="form-label">@lang('lang.organization_phone_no').<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="organization_phone_no"
                                                                id="organization_phone_no"
                                                                value="{{ $user->organization->organization_phone_no ?? old('organization_phone_no') }}"
                                                                class="form-control" placeholder="@lang('lang.organization_phone_no')..."
                                                                required>
                                                            @error('organization_phone_no')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row form-elem-row">
                                                        <div class="col-xl-6">
                                                            <label for="organization_email"
                                                                class="form-label">@lang('lang.organization_email')<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="organization_email"
                                                                id="organization_email"
                                                                value="{{ $user->organization->organization_email ?? old('organization_email') }}"
                                                                class="form-control" placeholder="@lang('lang.organization_email')..."
                                                                required>
                                                            @error('organization_email')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="organization_website"
                                                                class="form-label">@lang('lang.organization_website')</label>
                                                            <input type="text" name="organization_website"
                                                                id="organization_website"
                                                                value="{{ $user->organization->organization_website ?? old('organization_website') }}"
                                                                class="form-control" placeholder="@lang('lang.organization_website')...">
                                                            @error('organization_website')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row form-elem-row">
                                                        <div class="col-xl-6">
                                                            <label for="organization_address"
                                                                class="form-label">@lang('lang.organization_address') <span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="organization_address"
                                                                id="organization_address"
                                                                value="{{ $user->organization->organization_address ?? old('organization_address') }}"
                                                                class="form-control" placeholder="@lang('lang.organization_address')..."
                                                                required>
                                                            @error('organization_address')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="organization_pan_no"
                                                                class="form-label">@lang('lang.organization_pan_no').<span
                                                                    class="text-danger"> *</span></label>
                                                            <input type="text" name="organization_pan_no"
                                                                value="{{ $user->organization->organization_pan_no ?? old('organization_pan_no') }}"
                                                                id="organization_pan_no" class="form-control"
                                                                placeholder="@lang('lang.organization_pan_no')." required>
                                                            @error('organization_pan_no')
                                                                <span class="text-dange">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mt-2 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary submit-btn">
                                                            <span class="btn-text">@lang('lang.profile_update')</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end of right column -->
                                </div>
                            </div>
                        </div>
                        <!-- END OF MY ACCOUNT -->

                        <!-- MY BOOKINGS -->
                        <div class="tab-pane fade" id="bookings" role="tabpanel" aria-labelledby="bookings-tab">
                            <div class="tab-pane-content mb-5">
                                <h3 class="text-lg mb-4">Current Bookings</h3>
                                <div class="bookings-list row">
                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-pending d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/hourglass.svg') }}"
                                                        alt='icon' class="icon">
                                                    <span class="text-sm text-white">Payment Pending</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2080/10/14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt='icon' class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center pending">
                                                        <img src="{{ asset('frontendfiles/assets/images/hourglass-atom.svg') }}"
                                                            alt='icon' class="icon">
                                                        <span class="fs-xx-sm text-tangerine">Payment Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">

                                                    <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}"
                                                        alt='icon' class="icon">

                                                    <span class="text-white text-sm">Cancel Booking</span>
                                                </a>
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center"
                                                    data-bs-toggle="modal" data-bs-target="#bookingDetailsModal">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="{{ asset('frontendfiles/assets/images/arrow-right.svg') }}"
                                                        alt='icon' class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-pending d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/hourglass.svg') }}"
                                                        alt='icon' class="icon">

                                                    <span class="text-sm text-white">Payment Pending</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2080/10/14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt='icon' class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center pending">
                                                        <img src="{{ asset('frontendfiles/assets/images/hourglass-atom.svg') }}"
                                                            alt='icon' class="icon">
                                                        <span class="fs-xx-sm text-tangerine">Payment Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}"
                                                        alt=' icon' class="icon">

                                                    <span class="text-white text-sm">Cancel Booking</span>
                                                </a>
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="{{ asset('frontendfiles/assets/images/arrow-right.svg') }}"
                                                        alt=' icon' class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-confirmed d-inline-flex align-items-center justify-content-center align-self-center">

                                                    <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                        alt='icon' class="icon">

                                                    <span class="text-sm text-primary">Confirmed</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2080/10/14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt='icon' class="icon">

                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center approved">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt='shop icon' class="icon">

                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}" alt=""
                                                        class="icon">
                                                    <span class="text-white text-sm">Cancel Booking</span>
                                                </a>
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="{{ asset('frontendfiles/assets/images/arrow-right.svg') }}"
                                                        alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-confirmed d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/check.svg') }}" alt=""
                                                        class="icon">
                                                    <span class="text-sm text-primary">Confirmed</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2080/10/14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center approved">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}" alt=""
                                                        class="icon">
                                                    <span class="text-white text-sm">Cancel Booking</span>
                                                </a>
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="assets/images/arrow-right.svg" alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-pending d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="assets/images/hourglass.svg" alt="" class="icon">
                                                    <span class="text-sm text-white">Payment Pending</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2080/10/14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center pending">
                                                        <img src="{{ asset('frontendfiles/assets/images/hourglass-atom.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-tangerine">Payment Pending</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">
                                                    <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}" alt=""
                                                        class="icon">
                                                    <span class="text-white text-sm">Cancel Booking</span>
                                                </a>
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="assets/images/arrow-right.svg" alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->
                                </div>
                            </div>

                            <div class="tab-pane-content mb-5">
                                <div class="">
                                    <h3 class="text-lg mb-4">Past Bookings</h3>
                                </div>
                                <div class="bookings-list row">
                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item past-bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-completed d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="assets/images/clock-check.svg" alt="" class="icon">
                                                    <span class="text-sm text-white">Completed 1 year ago</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2079/ 10 / 14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center approved">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center w-100">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="assets/images/arrow-right.svg" alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item past-bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-completed d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="assets/images/clock-check.svg" alt="" class="icon">
                                                    <span class="text-sm text-white">Completed 1 year ago</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2079/ 10 / 14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center approved">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center w-100">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="assets/images/arrow-right.svg" alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->

                                    <!-- bookings item  -->
                                    <div class="col-md-6 col-xl-4 mb-4">
                                        <div class="bookings-item past-bookings-item px-0 h-100">
                                            <div class="bookings-item-top d-flex flex-column">
                                                <div
                                                    class=" bookings-item-badge-completed d-inline-flex align-items-center justify-content-center align-self-center">
                                                    <img src="assets/images/clock-check.svg" alt="" class="icon">
                                                    <span class="text-sm text-white">Completed 1 year ago</span>
                                                </div>
                                                <p class="bookings-item-title text">Large Exbition Hall & area around it
                                                </p>
                                                <div class="bookings-item-time text-royal-blue text">2079/ 10 / 14</div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Application:</span>
                                                    <div class="d-flex align-items-center approved my-1">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                                <div class="info-item d-flex align-items-center">
                                                    <span class="text">Payment:</span>
                                                    <div class="d-flex align-items-center approved">
                                                        <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                            alt="" class="icon">
                                                        <span class="fs-xx-sm text-primary">Approved</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bookings-item-bottom d-flex">
                                                <a href="#"
                                                    class="bookings-item-btn btn-details d-flex align-items-center justify-content-center w-100">
                                                    <span class="text-white text-sm">Check Details</span>
                                                    <img src="assets/images/arrow-right.svg" alt="" class="icon">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of bookings item -->
                                </div>
                            </div>
                        </div>
                        <!-- END OF MY BOOKINGS -->
                    </div>
                </div>
            </section>
        </div>

        <!-- Modal -->

    </main>
@endsection

@push('scripts')
    <script>
        $(document).on('change', '.profile-image', function(e) {
            e.preventDefault();
            $('.image-form').submit();
        })

        $(document).on('submit', '.image-form', function(e) {
            e.preventDefault();
            var currentevent = $(this);
            currentevent.attr('disabled');
            var form = new FormData($('.image-form')[0]);
            var params = $('.image-form').serializeArray();
            var route = $(this).attr('action');
            console.log(route);
            $.each(params, function(i, val) {
                form.append(val.name, val.value)
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: route,
                contentType: false,
                processData: false,
                data: form,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {
                    $.unblockUI();
                    toastr.success(data.message);
                    $('.navbar-profile-avatar').

                    currentevent.attr('disabled', false);

                },
                error: function(err) {
                    console.log(err);
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(4000));
                        });
                    }
                    if (err.status == 404) {
                        toastr.error(err.responseJSON.message);
                    } else {
                        toastr.error(err.responseJSON.message);
                    }



                    currentevent.attr('disabled', false);
                },
                complete: function() {
                    $.unblockUI();
                }
            });

        });
    </script>
@endpush
