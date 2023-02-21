@extends('layouts.admin.master')

@section('title', 'All items')
@section('breadcrumb', 'All items')

@push('styles')
    <style>
        td {
            cursor: all-scroll;
        }
    </style>
@endpush


@section('content')

    <div class="row layout-top-spacing">
        <div id="tableSimple" class="col-lg-12 col-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <h4>Approval Lists</h4>
                                </div>
                                {{-- <div class="col-md-2">
                        <a href="{{ route('backend.item.add') }}" type="button"
                            class="btn btn-primary mt-3 mb-3">Add</a>
                        <a href="{{ route('backend.item.trashed.index') }}" type="button"
                            class="btn btn-danger mt-3 mb-3">Trash</a>
                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="widget-content ">
                    @if (isset($bookinglists) && !empty($bookinglists))
                        <div class="table-responsive">
                            <table class="table table-bordered mb-4">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Start Date</th>
                                        <th class="text-center">End Date</th>
                                        <th class="text-center">Vendor</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Payment Status</th>
                                        <th style="max-width: 5% !important;">Applications</th>
                                        {{-- <th class="text-center">Venue</th> --}}
                                        <th style="width: 15% !important;">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row_position">
                                    @foreach ($bookinglists as $item)
                                        <tr id="{{ $item->id }}" class="text-capitalize text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ !is_null('from_date') ? Carbon\Carbon::parse($item->from_date)->format('Y-m-d') : '' }}
                                            </td>
                                            <td>{{ !is_null('end_date') ? Carbon\Carbon::parse($item->to_date)->format('Y-m-d') : '' }}
                                            </td>
                                            <td>{{ $item->vendor->name }}</td>
                                            <td class="text-center">
                                                <select name="status"
                                                    data-url="{{ route('admin.approvalLists.changeStatus', $item->id) }}"
                                                    class="form-control statusChange" id="status">
                                                    <option @if ($item->status == 'Approved') selected @endif
                                                        value="Approved">Approved</option>
                                                    <option @if ($item->status == 'Declined') selected @endif
                                                        value="Declined">Declined</option>
                                                    <option @if ($item->status == 'Pending') selected @endif
                                                        value="Pending">Pending</option>
                                                    {{-- @if ($item->payment_status == 'Approved')
                                                        <option @if ($item->status == 'Reserved') selected @endif
                                                            value="Reserved">Reserved</option>
                                                    @endif --}}

                                                    <option @if ($item->status == 'Cancelled') selected @endif
                                                        value="Cancelled">Cancelled</option>
                                                </select>
                                            </td>
                                            <td class="text-center">
                                                <select name="payment_status"
                                                    data-url="{{ route('admin.approvalLists.paymentChangeStatus', $item->id) }}"
                                                    class="form-control paymentChange" id="payment_status">
                                                    <option @if ($item->payment_status == 'Pending') selected @endif
                                                        value="Pending">Pending</option>
                                                    <option @if ($item->payment_status == 'Approved') selected @endif
                                                        value="Approved">Approved</option>
                                                    <option @if ($item->payment_status == 'Declined') selected @endif
                                                        value="Declined">Declined</option>
                                                    <option @if ($item->payment_status == 'Cancelled') selected @endif
                                                        value="Declined">Cancelled</option>

                                                </select>
                                            </td>

                                            <td>
                                                @if ($item->applicationImages->isNotEmpty())
                                                    @foreach ($item->applicationImages as $application)
                                                        <a href="{{ url('/') . getOrginalUrl($application->file_id) }}"
                                                            type="button" target="_blank"
                                                            class="btn @if ($loop->iteration % 2 == 0) btn-primary
                                                    @elseif($loop->iteration % 3 == 0)
                                                    btn-info
                                                    @else
                                                    btn-secondary @endif btn-sm mt-2">
                                                            {{ Str::limit(getFileTitle($application->file_id), 15, '...') }}</a>
                                                        <br>
                                                    @endforeach
                                                @endif
                                            </td>


                                            <td>
                                                {{-- <a href="#" class="btn btn-success btn-sm"><i
                                                        class="fa-solid fa-pen-to-square"></i></a> --}}
                                                <a href="#" class="btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i></a>




                                                <a href="#" data-url="{{ route('admin.view', $item->id) }}"
                                                    class="btn viewBooking btn-secondary btn-sm"><i
                                                        class="fa-solid fa-eye"></i></a>

                                                @if ($item->applicationImages->isNotEmpty())
                                                    <a href="#"
                                                        data-url="{{ route('admin.applicationModal', [$item->vendor->id, $item->id]) }}"
                                                        class="btn create btn-secondary mt-2 btn-sm">Application</a> <br>
                                                @endif
                                                @if ($item->bookingpaymentsimages->isNotEmpty())
                                                <a href="#"
                                                    data-url="{{ route('admin.paymentModal', [$item->vendor->id, $item->id]) }}"
                                                    class="btn create btn-secondary mt-2 btn-sm">Payment</a> <br>
                                            @endif
                                                @if (!empty($item->cancellation))
                                                    <a href="#"
                                                        data-url="{{ route('admin.viewCancellation',$item->id) }}"
                                                        class="btn create btn-secondary mt-2 btn-sm">Cancellation</a> <br>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            <div class="pagination d-flex justify-content-center">
                                {!! $bookinglists->links('pagination::bootstrap-4') !!}
                            </div>
                            {{--
                        <div class="pagination d-flex justify-content-center">
                            {!! $bookinglists->links('vendor.pagination.bootstrap-4') !!}
                        </div> --}}


                        </div>
                    @else
                        <h1 class="text-center text-danger">No any items found!!!</h1>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(".row_position").sortable({
            delay: 150,
            stop: function() {
                var selectedData = new Array();
                $('.row_position>tr').each(function() {
                    selectedData.push($(this).attr("id"));
                });
                console.log(selectedData);
                updateOrder(selectedData);
            }
        });

        function updateOrder(data) {
            console.log(data);
            var myUrl = "#";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: myUrl,
                data: {
                    position: data
                },
                beforeSend: function(result) {
                    $('#order-btn').hide();
                },
                success: function(result) {
                    $('#order-btn').show();
                },
                error: function(result) {
                    $('#order-btn').show();
                }
            });
        }
    </script>


    <script>
        $(document).on('click', '.viewBooking', function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data.data.view);
                    $("#globalModal").html(data.data.view);
                    $("#globalModal").modal('show');
                },
            });
        });
    </script>


    <script>
        $(document).on('click', '.viewCancellation', function(e) {
            e.preventDefault();
            var url = $(this).attr('data-url');

            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data.data.view);
                    $("#globalModal").html(data.data.view);
                    $("#globalModal").modal('show');
                },
            });
        });
    </script>

    <script>
        $(document).on('change', '.statusVenueChange', function(e) {
            e.preventDefault();
            var currentthis = $(this);
            var status = currentthis.val();
            var url = currentthis.data('url');
            $.ajax({
                type: "GET",
                data: {
                    'status': status
                },
                url: url,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {


                    toastr.success(data.message);



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
                complete: function(data) {

                    $.unblockUI();
                }
            });
        });


        $(document).on('change', '.statusChange', function(e) {
            e.preventDefault();
            var currentthis = $(this);
            var status = currentthis.val();
            var url = currentthis.data('url');
            $.ajax({
                type: "GET",
                data: {
                    'status': status
                },
                url: url,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {


                    toastr.success(data.message);



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
                complete: function(data) {

                    $.unblockUI();
                }
            });
        });


        $(document).on('change', '.paymentChange', function(e) {
            e.preventDefault();

            var currentthis = $(this);
            var status = currentthis.val();
            var url = currentthis.data('url');
            $.ajax({
                type: "GET",
                data: {
                    'status': status
                },
                url: url,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {


                    toastr.success(data.message);



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
                complete: function(data) {

                    $.unblockUI();
                }
            });
        });
    </script>
@endpush
