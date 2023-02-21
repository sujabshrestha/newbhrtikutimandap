<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Notify application to {{ $vendor->name ?? "" }}</h5>
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
            <form action="{{ route('admin.submitApplication', $vendor->id) }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <input type="hidden" name="booking_id" value="{{ $booking->id ?? "" }}">

                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                        @if($errors->has('message'))
                        <small class="text-danger">{{ $errors->first('message') }}</small>
                        @endif
                    </div>
                </div>
                <div class="col-md-12 mt-2 text-right">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>

        </div>
    </div>

</div>
</div>




