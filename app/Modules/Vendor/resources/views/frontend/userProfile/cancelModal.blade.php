<div class="modal-dialog modal-lg">
    <div class="modal-content overflow-hidden">
        <div class="booking-modal-header">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    बुकिंग रद्द</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <form action="{{ route('vendor.bookingCancelSubmit', $booking->id) }}" method="POSt" enctype="multipart/form-data">
                @csrf
                <div class="modal-body px-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    विषय</label>
                                <input type="text" required name="subject" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    कारण</label>
                                <textarea name="reason" required class="form-control" id="" cols="30" rows="15"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">
                                    आवेदन अपलोड गर्नुहोस्</label>
                                <input type="file" required name="applications[]" class="form-control" multiple="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="booking-modal-bottom mt-4">
                    <div class="btns-list d-flex">
                        <button type="submit" class="btns-list-item bottom-cancel-btn">
                            <span class="text-sm text-white ls-def">बुकिङ रद्द गर्नुहोस् </span>
                            <img src="{{ asset('frontendfiles/assets/images/cancel.svg') }}" alt=""
                                class="icon">
                        </button>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
