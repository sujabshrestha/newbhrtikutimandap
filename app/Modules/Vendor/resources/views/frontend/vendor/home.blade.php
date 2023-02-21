@extends('layouts.vendor.master')

@section('title')
    @lang('lang.home')
@endsection

@section('breadcrumb')
    @lang('lang.home')
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('nepalidatepicker/css/nepali.datepicker.v4.0.1.min.css') }}">
    {{-- <link href="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
        rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />
    <style>
        .datepicker-days .disabled {
            color: #d4cece !important;
        }
    </style>
@endpush

@section('content')
    {{-- @dd("fkjdshkfjsd") --}}

    <!--  BEGIN CONTENT AREA  -->
    <main class="page-index">
        <div class="container">
            <section class="sc-booking-selection px-3">
                <form id="filter-form" action="{{ route('vendor.bookingFilter') }}">



                    <div class="booking-selection-content d-lg-flex justify-content-lg-center">
                        <div class="booking-selection-item d-flex align-items-center">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <img src="{{ asset('frontendfiles/assets/images/icons/calendar-search.svg') }}">
                                </div>
                                <input type="text" autocomplete="off" id="FromDate"
                                    class="form-control nepali-datepicker" placeholder="@lang('lang.check-in')" name="from_date">
                            </div>
                        </div>

                        <div class="booking-selection-item d-flex align-items-center">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <img src="{{ asset('frontendfiles/assets/images/icons/calendar-search.svg') }}">
                                </div>
                                <input type="text" autocomplete="off" class="form-control nepali-datepicker"
                                    id="ToDate" placeholder=" @lang('lang.check-out')" name="to_date">
                            </div>
                        </div>


                        <div class="booking-selection-item">
                            <button type="submit" class="btn btn-charcoal text-capitalize book-now-btn"><span
                                    class="btn-text">खोज्नुहोस्</span></button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="sc-avail px-3 overflow-hidden">
                <div class="sc-avail-content mb-5">

                    <div class="venueListTable">
                        <div class="sc-title">
                            <h3>भृकुटीमन्डप परिसरमा ईभेन्ट तथा प्रदर्शनीको लागि उत्तम ठाँउ तथा समय रोज्नुहोस् ।</h3>
                        </div>

                    </div>

                </div>
            </section>
        </div>
    </main>


    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
    <script src="{{ asset('nepalidatepicker/js/nepali.datepicker.v4.0.1.min.js') }}"></script>
    {{-- <script src="http://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
        type="text/javascript"></script> --}}

    <script type="text/javascript">
        $(document).on('click', '#ToDate', function() {
            $('#ToDate').nepaliDatePicker();
        });
    </script>
    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("FromDate");
            mainInput.nepaliDatePicker();
        };
    </script>

    <script>
        $(document).on('change', '#FrodmDate, #TodDate', function(e) {
            e.preventDefault();
            var from_date = $('#FromDate').val();
            var to_date = $('#ToDate').val();
            console.log(from_date, to_date);
            $('#from_date').val(from_date);
            $('#to_date').val(to_date);


        });
    </script>


    <script>
        var now = "{{ Carbon\Carbon::now()->addMonth()->format('m/d/Y') }}";
        $('.check-in-datepicker').datepicker('setStartDate', now);

        $('.check-in-datepicker').change(function() {
            var date = $('.check-in-datepicker').val();
            $('.check-out-datepicker').datepicker('setStartDate', date);
        });


        $(document).on('submit', '#filter-form', function(e) {

            e.preventDefault();
            var currentevent = $(this);
            currentevent.attr('disabled');
            var form = new FormData($('#filter-form')[0]);
            var params = $('#filter-form').serializeArray();
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

                    toastr.success(data.message);
                    // $('#global-table').DataTable().ajax.reload();
                    // $('#summernote-editor').summernote('code', '');
                    // $('#filter-form').trigger("reset");
                    // $('#globalModal').modal('hide');
                    $('.venueListTable').html(data.data.view);
                    currentevent.attr('disabled', false);

                },
                error: function(err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(4000));
                        });
                    }

                    currentevent.attr('disabled', false);
                },
                complete: function() {
                    $.unblockUI();
                }
            });

        });




        $(document).on('click', '.bookingDetailsView', function(e) {

            e.preventDefault();
            var currentevent = $(this);
            var url = currentevent.data('url');
            $.ajax({
                type: "GET",
                url: url,

                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {

                    $("#globalModal").html(data.data.view);
                    $("#globalModal").modal('show');

                },
                error: function(err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(4000));
                        });
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
