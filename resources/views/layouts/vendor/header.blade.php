<header>
    <nav class="page-navbar d-flex align-items-center">
        <div class="container">
            <div class="page-navbar-content px-3 d-flex align-items-center justify-content-between">
                <div class="brand-and-toggler d-flex align-items-center justify-content-between">
                    <a href="{{ route('vendor.home') }}" class="page-navbar-brand">
                        <img src="{{ asset('frontendfiles/assets/images/logo.svg') }} " alt="site logo">
                    </a>

                    <button type="button" class="page-navbar-toggler d-lg-none">
                        <img src="{{ asset('frontendfiles/assets/images/menu.png') }}" alt="menu icon">
                    </button>
                </div>


                {{-- <div class="col-md-4">
                    @dd(session()->get('locale'))
                    <select class="form-control changeLang">

                        <option value="nep" {{ session()->get('locale') == 'np' ? 'selected' : '' }}>Nepali</option>
                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                        <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish</option>
                    </select>
                </div> --}}

                <div class="page-navbar-collapse">
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="page-navbar-close-btn d-lg-none">
                            <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}" alt="cancel icon">
                        </button>
                    </div>

                    <ul class="page-navbar-nav d-flex align-items-center">
                        @auth

                            <li class="page-nav-item">
                                <a href="{{ route('vendor.home') }}" class="page-nav-link text-sm">@lang('lang.home')</a>
                            </li>
                        @endauth
                        <li class="page-nav-item">
                            <a href="{{ route('vendor.gallery') }}" class="page-nav-link text-sm">@lang('lang.gallery')</a>
                        </li>
                        <li class="page-nav-item">
                            <a href="{{ route('vendor.about') }}" class="page-nav-link text-sm">@lang('lang.about')</a>
                        </li>
                    </ul>
                </div>
                @auth
                    <div class="page-navbar-profile d-flex align-items-center">
                        <!-- notification -->
                        <div class="notification-btn-wrapper position-relative">
                            <button type="button" class="navbar-btn" id="notification-view-btn">
                                <img src="{{ asset('frontendfiles/assets/images/icons/notification.svg') }}">
                            </button>
                            <div class="notify-popup">
                                <div class="notify-popup-wrapper">
                                    <div
                                        class="notify-head d-flex align-items-center justify-content-between border-bottom">
                                        <h5 class="text">
                                            Notifications</h5>
                                        <a href="#" id="MarkRead"
                                            data-url="{{ route('vendor.markNotificationRead') }}"
                                            class="text-xs text-primary">Mark all as read</a>
                                    </div>

                                    <div class="notify-list-group">


                                        @if (!is_null(auth()->user()->unreadNotifications))
                                            @foreach (auth()->user()->unreadNotifications as $notification)
                                                <div class="notify-list-item border-bottom">
                                                    @if (isset($notification->data['status']))
                                                        @if ($notification->data['status'] == 'Approved')
                                                            <div class="notify-list-item-icon">
                                                                <img
                                                                    src="{{ asset('frontendfiles/assets/images/check-green.svg') }}">
                                                            </div>
                                                        @elseif($notification->data['status'] == 'Declined')
                                                            <div class="notify-list-item-icon"
                                                                style="background-color: #dc3545;">
                                                                <img
                                                                    src="{{ asset('frontendfiles/assets/images/cancel.svg') }}">
                                                            </div>
                                                        @else
                                                            <div class="notify-list-item-icon"
                                                                style="background-color: #8035dc;">
                                                                <img
                                                                    src="{{ asset('frontendfiles/assets/images/check.svg') }}">
                                                            </div>
                                                        @endif
                                                        <div class="notify-list-item-text text-start">
                                                            <p class="text-sm mb-1">
                                                                @
                                                                @if ($notification->data['type'] == 'application')
                                                                    @lang('lang.application')
                                                                @else
                                                                    @lang('lang.payment')
                                                                @endif
                                                                {{ $notification->data['status'] }}
                                                            </p>

                                                            <p class="text-xs mb-1 fw-4">तपाईको @if ($notification->data['type'] == 'application')
                                                                    @lang('lang.application')
                                                                @else
                                                                    @lang('lang.payment')
                                                                @endif बुकिंग


                                                                {{ Carbon\Carbon::parse($notification->data['from_date'])->format("y-m-d") }}
                                                                को
                                                                {{ Carbon\Carbon::parse($notification->data['end_date'])->format("y-m-d") }}
                                                                {{ $notification->data['status'] }} भएको छ.</p>
                                                            <span
                                                                class="text-xxs text-silver d-block">{{ $notification->created_at->diffForHumans() }}</span>


                                                            @if ($notification->data['type'] == 'application')
                                                                @if ($notification->data['status'] == 'Approved')
                                                                    <a href="{{ route('vendor.application.proceedToPayment', [$notification->data['booking_id'], $notification->notifiable_id]) }}"
                                                                        class="btn-outline-primary-xs btn mt-1">
                                                                        <span class="btn-text">भुक्तानी गर्न अगाडि
                                                                            बढ्नुहोस्</span>
                                                                        <span class="ms-2 text-primary text-xs">
                                                                            <i class="fas fa-arrow-right"></i>
                                                                        </span>
                                                                    </a>
                                                                @elseif($notification->data['status'] == 'Pending')
                                                                    <a href="#"
                                                                        class="btn-outline-primary-xs btn mt-1">
                                                                        <span class="btn-text">
                                                                            स्वीकृतिको लागि पर्खँदै</span>
                                                                        <span class="ms-2 text-primary text-xs">
                                                                            <i class="fas fa-arrow-right"></i>
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div class="notify-list-item-icon"
                                                            style="background-color: #dc3545;">
                                                            <img
                                                                src="{{ asset('frontendfiles/assets/images/cancel.svg') }}">
                                                        </div>

                                                        <div class="notify-list-item-text text-start">
                                                            {{-- <p class="text-sm mb-1">
                                                                @
                                                                @if ($notification->data['type'] == 'application')
                                                                    Application
                                                                @else
                                                                    Payment
                                                                @endif
                                                                {{ $notification->data['status'] }}
                                                            </p> --}}
                                                            <p class="text-xs mb-1 fw-4">
                                                                {{ $notification->data['message'] }}</p>
                                                            <span
                                                                class="text-xxs text-silver d-block">{{ $notification->created_at->diffForHumans() }}</span>


                                                            {{-- @if ($notification->data['type'] == 'application')
                                                                @if ($notification->data['status'] == 'Approved')
                                                                    <a href="{{ route('vendor.application.proceedToPayment', $notification->data['booking_id']) }}"
                                                                        class="btn-outline-primary-xs btn mt-1">
                                                                        <span class="btn-text">Proceed to payment</span>
                                                                        <span class="ms-2 text-primary text-xs">
                                                                            <i class="fas fa-arrow-right"></i>
                                                                        </span>
                                                                    </a>
                                                                @elseif($notification->data['status'] == 'Pending') --}}
                                                            @if ($notification->data['type'] == 'application')
                                                                <a href="{{ route('vendor.application.index', [$notification->data['booking_id'] ?? null, $notification->notifiable_id]) }}"
                                                                    class="btn-outline-primary-xs btn mt-1">
                                                                    <span class="btn-text">
                                                                        आवेदन पठाउनुहोस्</span>
                                                                    <span class="ms-2 text-primary text-xs">
                                                                        <i class="fas fa-arrow-right"></i>
                                                                    </span>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('vendor.application.proceedToPayment', [$notification->data['booking_id'] ?? null, $notification->notifiable_id]) }}"
                                                                    class="btn-outline-primary-xs btn mt-1">
                                                                    <span class="btn-text">भुक्तानी गर्न अगाडि
                                                                        बढ्नुहोस्</span>
                                                                    <span class="ms-2 text-primary text-xs">
                                                                        <i class="fas fa-arrow-right"></i>
                                                                    </span>
                                                                </a>
                                                            @endif
                                                            {{-- @endif
                                                            @endif --}}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif




                                    </div>
                                    <div
                                        class="notify-head d-flex align-items-center justify-content-center justify-content-md-end border-bottom">
                                        <a href="#" class="text-xs text-primary">

                                            सबै हेर्नुहोस्
                                            <span class="ms-1">
                                                <i class="fas fa-arrow-right"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of notification -->

                        <!-- profile -->
                        <div class="profile-btn-wrapper position-relative">
                            <button type="button" class="navbar-profile-avatar avatar ms-2 ms-lg-3" id="profile-view-btn">
                                <img src="{{ isset(auth()->user()->image_id) ? url('/').getOrginalUrl(auth()->user()->image_id) : asset('frontendfiles/assets/images/avatar.jpg')}}">
                            </button>
                            <div class="profile-popup">
                                <div class="profile-popup-wrapper">
                                    <div class="popup-head border-bottom pb-3">
                                        <div class="popup-img mx-auto">
                                            <img src="{{ isset(auth()->user()->image_id) ? url('/').getOrginalUrl(auth()->user()->image_id) : asset('frontendfiles/assets/images/avatar.jpg') }}">
                                        </div>
                                        <div class="ps-2">
                                            @php
                                                $user = Auth::user();
                                            @endphp
                                            <span
                                                class="text-sm fw-6 my-1 d-inline-block mt-sm-0">{{ $user->name }}</span>
                                            <div class="d-flex align-items-center  justify-content-sm-start">
                                                <img src="{{ asset('frontendfiles/assets/images/logged-user.svg') }}"
                                                    class="icon">
                                                <span class="text-xs text-color">{{ $user->phone ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="popup-list-group py-1 border-bottom">
                                        <a href="{{ route('vendor.myAccount') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/user.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.my_account')</span>
                                        </a>
                                        <a href="{{ route('vendor.myBooking') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/shop.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.my_bookings')</span>
                                        </a>
                                    </div>
                                    <div class="popup-list-group py-1 ">
                                        <a href="{{ route('vendor.rules') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/info-circle.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.rules')</span>
                                        </a>
                                        <a href="{{ route('vendor.gallery') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/gallery.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.gallery')</span>
                                        </a>
                                        <a href="{{ route('vendor.about') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/question-mark.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.about')</span>
                                        </a>

                                        <a href="{{ route('vendor.logout') }}"
                                            class="popup-list-item d-flex align-items-center">
                                            <span class="icon d-block">
                                                <img src="{{ asset('frontendfiles/assets/images/question-mark.svg') }}">
                                            </span>
                                            <span class="text-sm text-color">@lang('lang.logout')</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end of profile -->
                    </div>
                @else
                    <div class="page-navbar-btns d-flex">
                        <!-- <button type = "button" class = "navbar-btn btn-white btn-sm">
                                                    <span class = "btn-text">SignUp</span>
                                                </button> -->
                        @if (Route::is('vendor.login'))
                            <a href="{{ route('vendor.register') }}"
                                class="navbar-btn btn-primary btn-sm ms-2 d-flex align-items-center justify-content-center">
                                <span class="text-white">@lang('lang.sign up')</span>
                            </a>
                        @else
                            <a href="{{ route('vendor.login') }}"
                                class="navbar-btn btn-primary btn-sm ms-2 d-flex align-items-center justify-content-center">
                                <span class="text-white">Sign In</span>
                            </a>
                        @endif

                    </div>
                @endauth


            </div>
        </div>
    </nav>
</header>


<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">

</div>

<!-- Create Modal -->
<div class="modal fade" id="globalModal" tabindex="-1" role="dialog" aria-hidden="true">

</div>
