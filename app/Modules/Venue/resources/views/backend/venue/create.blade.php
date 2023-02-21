<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Venue</h5>
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
            {{-- <div class="col-xl-12 col-md-12 col-sm-12"> --}}
                <form action="{{ route('backend.venue.store') }}" id="submit-form">
                    @include('Venue::backend.venue.commonform')

                </form>
            </div>

        {{-- </div> --}}
    </div>

</div>
</div>



<script>
    var firstUpload = new FileUploadWithPreview('myFirstImage')

    $('#summernote').summernote({
        height:200
    });
</script>
