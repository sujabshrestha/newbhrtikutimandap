@if (isset($venues) && count($venues) > 0)
<div class="sc-title">
    <h3>उपलब्ध स्थानहरु</h3>
    तपाईंले रोज्नुभएको मितिमा  उपलब्ध स्थानहरु रोज्नुहोस् अथवा तपाईलाई आवश्यक पर्ने स्थान नभेटिएमा अर्को मिति रोज्नुहोस् र खोज्नुहोस् ।
</div>
    <form action="{{ route('vendor.bookingStore') }}" method="POST">
        @csrf

        <input type="hidden" id="from_date" value="{{ $from_date ?? '' }}" name="from_date">
        <input type="hidden" id="to_date" value="{{ $to_date ?? '' }}" name="to_date">
        <div class="avail-data">
            <table class="table">
                <thead>
                    <tr>
                        <th class="avail-text-lg">@lang('lang.check')</th>
                        <th class="text-start avail-text-lg">@lang('lang.venue')</th>
                        <th class="avail-text-lg">@lang('lang.time')</th>
                        <th class="avail-text-lg">@lang('lang.status')</th>
                        <th class="avail-text-lg">@lang('lang.cost')</th>
                        <th class="avail-text-lg">@lang('lang.view')</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- @include('Vendor::frontend.vendor.appendVenueList') --}}

                    @foreach ($venues as $venue)
                        {{-- @if (isset($bookedVenues) && $bookedVenues)
                            @foreach ($bookedVenues as $bookedVenue) --}}
                        {{-- @if ($bookedVenue->id == $venue->id) --}}
                        <tr>
                            <td>
                                <div class="form-check d-flex align-items-center p-0 m-0">
                                    <input class="form-check-input p-0 m-0" type="checkbox" name="venue[]"
                                        value="{{ $venue->id }}" id="flexCheckDefault">
                                </div>
                            </td>
                            <td class="text-start">
                                <span class="avail-text-lg text-color">{{ $venue->title }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    {{-- @php
                                            if(){

                                            }
                                        @endphp --}}
                                    <span class="avail-text">
                                        <span class="text-success" style="font-size:"> {{ $from_date }}</span>  देखि  <span class="text-success">{{ $to_date }} </span>  सम्म</span>
                                    {{-- <span class="text-color avail-text mt-2">On 25,26 & 27th Jan</span> --}}
                                </div>
                            </td>
                            <td>
                                <div class="status-pills status-pills-green">
                                    <div class="pills-dot"></div>
                                    <span class="pills-text">@lang('lang.available')</span>
                                </div>
                            </td>
                            <td>
                                <span class="avail-text-lg text-color">Rs. {{ $venue->np_price }} @lang('lang.per_day')</span>
                            </td>
                            <td>
                                <a href="#" data-url="{{ route('vendor.bookingdetails.view.modal', $venue->id) }}" class="btn btn-primary px-3 bookingDetailsView"><span
                                        class="btn-text">@lang('lang.details')</span></a>
                            </td>
                        </tr>
                    @endforeach




                </tbody>

            </table>

        </div>
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-green"><span class="btn-text">बुक गर्नुहोस्</span></button>
        </div>
        <form>
        @else
            <h3 class="text-danger text-center">
                माफ गर्नुहोस्, सबै स्थानहरू हाल तपाईंले चयन गर्नुभएको मितिमा बुक भईसकेका छन् । कृपया वैकल्पिक मिति छनौट गर्नुहोस्। धन्यवाद !
            </h3>
@endif



{{-- <tr>
    <td>
        <div class="form-check d-flex align-items-center p-0 m-0">
            <input class="form-check-input p-0 m-0" type="checkbox" value="" id="flexCheckDefault">
        </div>
    </td>
    <td class = "text-start">
        <span class = "avail-text-lg text-color">Large Ground</span>
    </td>
    <td>
        <div class = "d-flex flex-column">
            <span class = "text-red avail-text">Not Available</span>
            <span class = "text-color avail-text mt-2">Before 30 Jan</span>
        </div>
    </td>
    <td>
        <div class = "status-pills status-pills-red">
            <div class = "pills-dot"></div>
            <span class = "pills-text">Booked</span>
        </div>
    </td>
    <td>
        <span class = "avail-text-lg text-color">Rs. 75,000 per day</span>
    </td>
    <td>
        <a href = "#" class = "btn btn-primary px-3"><span class = "btn-text">Details</span></a>
    </td>
</tr>


<tr>
    <td>
        <div class="form-check d-flex align-items-center p-0 m-0">
            <input class="form-check-input p-0 m-0" type="checkbox" value="" id="flexCheckDefault">
        </div>
    </td>
    <td class = "text-start">
        <span class = "avail-text-lg text-color">Garden</span>
    </td>
    <td>
        <div class = "d-flex flex-column">
            <span class = "text-green avail-text">Available</span>
            <span class = "text-color avail-text mt-2">On 25,26 & 27th Jan</span>
        </div>
    </td>
    <td>
        <div class = "status-pills status-pills-green">
            <div class = "pills-dot"></div>
            <span class = "pills-text">Available</span>
        </div>
    </td>
    <td>
        <span class = "avail-text-lg text-color">Rs. 75,000 per day</span>
    </td>
    <td>
        <a href = "#" class = "btn btn-primary px-3"><span class = "btn-text">Details</span></a>
    </td>
</tr>

<tr>
    <td>
        <div class="form-check d-flex align-items-center p-0 m-0">
            <input class="form-check-input p-0 m-0" type="checkbox" value="" id="flexCheckDefault">
        </div>
    </td>
    <td class = "text-start">
        <span class = "avail-text-lg text-color">Ground adjacent to Main gate</span>
    </td>
    <td>
        <div class = "d-flex flex-column">
            <span class = "text-green avail-text">Available</span>
            <span class = "text-color avail-text mt-2">On 25,26 & 27th Jan</span>
        </div>
    </td>
    <td>
        <div class = "status-pills status-pills-green">
            <div class = "pills-dot"></div>
            <span class = "pills-text">Available</span>
        </div>
    </td>
    <td>
        <span class = "avail-text-lg text-color">Rs. 30,000 per day</span>
    </td>
    <td>
        <a href = "#" class = "btn btn-primary px-3"><span class = "btn-text">Details</span></a>
    </td>
</tr>

<tr>
    <td>
        <div class="form-check d-flex align-items-center p-0 m-0">
            <input class="form-check-input p-0 m-0" type="checkbox" value="" id="flexCheckDefault">
        </div>
    </td>
    <td class = "text-start">
        <span class = "avail-text-lg text-color">Ground behind exibition hall</span>
    </td>
    <td>
        <div class = "d-flex flex-column">
            <span class = "text-red avail-text">Not Available</span>
            <span class = "text-color avail-text mt-2">Before 30 Jan</span>
        </div>
    </td>
    <td>
        <div class = "status-pills status-pills-red">
            <div class = "pills-dot"></div>
            <span class = "pills-text">Booked</span>
        </div>
    </td>
    <td>
        <span class = "avail-text-lg text-color">Rs. 12,500 per day</span>
    </td>
    <td>
        <a href = "#" class = "btn btn-primary px-3"><span class = "btn-text">Details</span></a>
    </td>
</tr>

<tr>
    <td>
        <div class="form-check d-flex align-items-center p-0 m-0">
            <input class="form-check-input p-0 m-0" type="checkbox" value="" id="flexCheckDefault">
        </div>
    </td>
    <td class = "text-start">
        <span class = "avail-text-lg text-color">Ticket counter</span>
    </td>
    <td>
        <div class = "d-flex flex-column">
            <span class = "text-green avail-text">Available</span>
            <span class = "text-color avail-text mt-2">On 25,26 & 27th Jan</span>
        </div>
    </td>
    <td>
        <div class = "status-pills status-pills-green">
            <div class = "pills-dot"></div>
            <span class = "pills-text">Available</span>
        </div>
    </td>
    <td>
        <span class = "avail-text-lg text-color">Rs. 5,000 per day</span>
    </td>
    <td>
        <a href = "#" class = "btn btn-primary px-3"><span class = "btn-text">Details</span></a>
    </td>
</tr> --}}
