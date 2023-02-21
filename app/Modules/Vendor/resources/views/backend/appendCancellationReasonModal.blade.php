<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Booking cancellation Details </h5>
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
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="text-primary">{{ $booking->cancellation->subject }}</h3>
                </div>
                <div class="card-body">
                    Reason:  <br>
                    {{ $booking->cancellation->short_description }}
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4>Cancellation files</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($booking->cancellation->cancellationApplications->isNotEmpty())
                                @foreach ($booking->cancellation->cancellationApplications as $application)
                                    <tr>
                                        <td> {{ getFileTitle($application->file_id) }} </td>
                                        <td> <a target="_blank" type="button"
                                                href="{{ checkFileExists($application->file_id) ? url('/') . getOrginalUrl($application->file_id) : null }}"
                                                class="btn btn-primary">View</a> </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>


        </div>
    </div>

</div>
</div>
