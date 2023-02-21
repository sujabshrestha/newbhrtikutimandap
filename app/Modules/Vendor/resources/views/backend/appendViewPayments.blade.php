<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking Details [ <span class="text-primary">
                    {{ Carbon\Carbon::parse($booking->from_date)->format('dS M Y') }} -
                    {{ Carbon\Carbon::parse($booking->end_date)->format('dS M Y') }} </span> ] </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            @if (isset($booking) && !is_null($booking->venues))
                <div class="statbox widget box box-shadow mb-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Venue Table</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($booking->venues as $venue)
                                        <tr>
                                            <td>{{ $venue->title }}</td>
                                            <td>Rs. {{ $venue->price }}</td>
                                            <td>
                                                <select name="status" class="form-control statusVenueChange"
                                                    data-url="{{ route('admin.approvalLists.change.venueStatus', $venue->id) }}"
                                                    id="">
                                                    <option @if ($venue->status == 'Approved') selected @endif
                                                        value="Approved">Approved</option>
                                                    <option @if ($venue->status == 'Declined') selected @endif
                                                        value="Declined">Declined</option>
                                                    <option @if ($venue->status == 'Pending') selected @endif
                                                        value="Pending">Pending</option>
                                                    @if ($booking->payment_status == 'Approved')
                                                        <option @if ($venue->status == 'Reserved') selected @endif
                                                            value="Reserved">Reserved</option>
                                                    @endif
                                                </select>
                                            </td>
                                            <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="feather feather-trash-2 icon">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg></td>
                                        </tr>
                                    @empty
                                        <h1 class="text-danger text-center">Venue not found!!!</h1>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            @endif

            {{-- @if (isset($booking) && !is_null($booking->applications))
            <div class="statbox widget box box-shadow mb-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Application Table</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-4">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($booking->venues as $venue)
                                    <tr>
                                        <td>{{ $venue->title }}</td>
                                        <td>Rs. {{ $venue->price }}</td>
                                        <td>
                                            <select name="status" class="form-control statusVenueChange"  data-url="{{ route('admin.approvalLists.change.venueStatus', $venue->id) }}" id="">
                                                <option @if ($venue->status == 'Approved') selected @endif
                                                    value="Approved">Approved</option>
                                                <option @if ($venue->status == 'Declined') selected @endif
                                                    value="Declined">Declined</option>
                                                <option @if ($venue->status == 'Pending') selected @endif
                                                    value="Pending">Pending</option>
                                                @if ($booking->payment_status == 'Approved')
                                                    <option @if ($venue->status == 'Reserved') selected @endif
                                                        value="Reserved">Reserved</option>
                                                @endif
                                            </select>
                                        </td>
                                        <td class="text-center"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-trash-2 icon">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                            </svg></td>
                                    </tr>
                                @empty
                                    <h1 class="text-danger text-center">Venue not found!!!</h1>
                                @endforelse

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        @endif --}}


            @if (isset($booking) && $booking->bookingpaymentsimages->isNotEmpty())
                <div class="statbox widget box box-shadow mb-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Payment Slips</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            @foreach ($booking->bookingpaymentsimages as $payment)
                                <div class="col-md-6 mb-2">
                                    <a target="_blank" href="{{ url('/') . getOrginalUrl($payment->file_id) }}">
                                        <img src="{{ url('/') . getOrginalUrl($payment->file_id) }}"
                                            style="height: 100px;width:100px; " alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            @endif



            @if (isset($booking) && $booking->applicationImages->isNotEmpty())
            <div class="statbox widget box box-shadow mb-4">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Application Images</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="row">
                        @foreach ($booking->applicationImages as $applicationImage)
                            <div class="col-md-6 mb-2">
                                <a target="_blank"
                                    href="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}">
                                    <img src="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}"
                                        style="height: 100px;width:100px; " alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>



                </div>
            </div>
        @endif

            @if (isset($booking) && $booking->companyRegistrationApplicationImages->isNotEmpty())
                <div class="statbox widget box box-shadow mb-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Company Registration Images</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            @foreach ($booking->companyRegistrationApplicationImages as $applicationImage)
                                <div class="col-md-6 mb-2">
                                    <a target="_blank"
                                        href="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}">
                                        <img src="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}"
                                            style="height: 100px;width:100px; " alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            @endif


                {{-- @dd($booking->panNumberApplicationImages) --}}

            @if (isset($booking) && $booking->panNumberApplicationImages->count() > 0)
                <div class="statbox widget box box-shadow mb-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>PAN Number Images</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            @foreach ($booking->panNumberApplicationImages as $applicationImage)
                                <div class="col-md-6 mb-2">
                                    <a target="_blank"
                                        href="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}">
                                        <img src="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}"
                                            style="height: 100px;width:100px; " alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            @endif



            @if (isset($booking) && $booking->otherApplicationImages->isNotEmpty())
                <div class="statbox widget box box-shadow mb-4">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Other Images</h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content">
                        <div class="row">
                            @foreach ($booking->otherApplicationImages as $applicationImage)
                                <div class="col-md-6 mb-2">
                                    <a target="_blank"
                                        href="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}">
                                        <img src="{{ url('/') . getOrginalUrl($applicationImage->file_id) }}"
                                            style="height: 100px;width:100px; " alt="">
                                    </a>
                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            @endif

        </div>
    </div>

</div>
</div>



<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage')
</script>
