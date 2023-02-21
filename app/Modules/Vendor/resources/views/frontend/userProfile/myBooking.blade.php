@extends('layouts.vendor.master')

@section('title')
    @lang('lang.my_bookings')
@endsection

@section('breadcrumb')
    @lang('lang.my_bookings')
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
                            <button class="nav-link active d-flex align-items-center" id="bookings-tab" data-bs-toggle="tab"
                                data-bs-target="#bookings" type="button" role="tab" aria-controls="bookings"
                                aria-selected="false">
                                <span class="tab-icon">
                                    <img src="{{ asset('frontendfiles/assets/images/shop.svg') }}" alt='icon'>
                                </span>
                                <span class="text-sm text-jet">@lang('lang.my_bookings')</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="bookingTabContent">


                        <!-- MY BOOKINGS -->
                        <div class="tab-pane fade show active" id="bookings" role="tabpanel"
                            aria-labelledby="bookings-tab">
                            <div class="tab-pane-content mb-5">
                                <h3 class="text-lg mb-4">@lang('lang.current_bookings')</h3>
                                <div class="bookings-list row">
                                    @if (isset($bookings) && count($bookings) > 0)
                                        @foreach ($bookings as $booking)
                                            <div class="col-md-6 col-xl-4 mb-4">
                                                <div class="bookings-item px-0 h-100">
                                                    <div class="bookings-item-top d-flex flex-column">
                                                        <div
                                                            class=" bookings-item-badge-pending d-inline-flex align-items-center justify-content-center align-self-center">
                                                            @if ($booking->payment_status == 'Pending')
                                                                <img src="{{ asset('frontendfiles/assets/images/hourglass.svg') }}"
                                                                    alt="" style="width: 21px;" class="icon">
                                                                <span class="text-sm text-white">@lang('lang.payment_pending')</span>
                                                            @elseif($booking->payment_status == 'Approved')
                                                                <img style="width: 21px;"
                                                                    src="{{ asset('frontendfiles/assets/images/check-green.svg') }}">

                                                                <span class="text-sm text-white">@lang('lang.confirmed')</span>

                                                            @elseif ($booking->payment_status == 'Declined')
                                                                <img style="width: 21px;"
                                                                    src="{{ asset('frontendfiles/assets/images/cancel.svg') }}">
                                                                    <span class="text-sm text-white">रद्द गरियो</span>

                                                            @endif
                                                        </div>
                                                        {{-- @dd($booking->venues) --}}
                                                        @if ($booking->venues->count() > 0)
                                                            <p class="bookings-item-title text">

                                                                @foreach ($booking->venues as $venue)
                                                                    {{ $venue->title }}

                                                                    @if ($loop->count > 1)
                                                                        ,
                                                                    @elseif($loop->last)
                                                                        .
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                        @endif
                                                        <div class="bookings-item-time text-royal-blue text">
                                                            {{ $booking->from_date->format('Y/m/d') }} -
                                                            {{ $booking->to_date->format('Y/m/d') }}</div>
                                                        <div class="info-item d-flex align-items-center">
                                                            <span class="text">@lang('lang.application')</span>
                                                            @if ($booking->status == 'Pending')
                                                                <div class="d-flex align-items-center pending my-1">
                                                                    <img src="{{ asset('frontendfiles/assets/images/hourglass-atom.svg') }}"
                                                                        alt="" class="icon">
                                                                    <span
                                                                        class="fs-xx-sm  text-warning">@lang('lang.pending')</span>
                                                                </div>
                                                            @elseif($booking->status == 'Approved')
                                                                <div class="d-flex align-items-center approved my-1">
                                                                    <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                                        alt="" class="icon">
                                                                    <span
                                                                        class="fs-xx-sm  text-primary">@lang('lang.approved')</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="info-item d-flex align-items-center">
                                                            <span class="text">@lang('lang.payment')</span>
                                                            @if ($booking->payment_status == 'Pending')
                                                                <div class="d-flex align-items-center pending my-1">
                                                                    <img src="{{ asset('frontendfiles/assets/images/hourglass-atom.svg') }}"
                                                                        alt="" class="icon">
                                                                    <span
                                                                        class="fs-xx-sm  text-warning">@lang('lang.pending')</span>
                                                                </div>
                                                            @elseif($booking->payment_status == 'Approved')
                                                                <div class="d-flex align-items-center approved my-1">
                                                                    <img src="{{ asset('frontendfiles/assets/images/check.svg') }}"
                                                                        alt="" class="icon">
                                                                    <span
                                                                        class="fs-xx-sm  text-primary">@lang('lang.approved')</span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>



                                                    <div class="bookings-item-bottom d-flex">
                                                        @if ($booking->payment_status != 'Cancelled' || $booking->status != 'Cancelled')
                                                            <a href="#" data-id="{{ $booking->id }}" id="bookingCancel"
                                                                class="bookings-item-btn btn-cancel d-flex align-items-center justify-content-center">
                                                                <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}"
                                                                    alt="" class="icon">
                                                                <span class="text-white text-sm">@lang('lang.cancel_booking')</span>
                                                            </a>
                                                        @endif

                                                        <a type="button"
                                                            class="bookings-item-btn btn-details d-flex align-items-center justify-content-center bookingDetails"
                                                            data-id=" {{ $booking->id }}">
                                                            <span class="text-white text-sm">@lang('lang.check_details')</span>
                                                            <img src="{{ asset('frontendfiles/assets/images/arrow-right.svg') }}"
                                                                alt="" class="icon">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>

                            <div class="modal fade bookingDetailsModal" id="bookingDetailsModal" tabindex="-1"
                                aria-labelledby="bookingDetailsModal" aria-hidden="true">

                            </div>


                        </div>
                        <!-- END OF MY BOOKINGS -->
                    </div>
                </div>
            </section>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.bookingDetails', function($e) {
            $e.preventDefault();
            var id = $(this).data('id');
            var route = "{{ route('vendor.myBookingDetails', ':id') }}";
            route = route.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: route,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {
                    $(".bookingDetailsModal").html(data.data.view);
                    $(".bookingDetailsModal").modal('show');
                    $.unblockUI();
                },
                error: function(err) {
                    alert('Something Went Wrong.');
                    currentevent.attr('disabled', false);
                },
                complete: function() {
                    $.unblockUI();
                }
            });

        })



        $(document).on('click', '#bookingCancel', function($e) {
            $e.preventDefault();
            // $(".bookingDetailsModal").modal('hide');

            var id = $(this).data('id');
            var route = "{{ route('vendor.bookingCancelModal', ':id') }}";
            route = route.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: route,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {
                    console.log(data.data.view);
                    $("#globalModal").html(data.data.view);
                    $("#globalModal").modal('show');

                },
                error: function(err) {
                    alert('Something Went Wrong.');
                    currentevent.attr('disabled', false);
                },
                complete: function() {
                    $.unblockUI();
                }
            });

        })
    </script>
@endpush
