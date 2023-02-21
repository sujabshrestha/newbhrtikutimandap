<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit to {{ $gallery->title }}</h5>
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
            <div class="col-xl-12 col-md-12 col-sm-12">
                <form action="{{ route('backend.cms.gallery.update', $gallery->id) }}" id="update-form">

                    @include('CMS::Backend.gallery.commonform')
                </form>
            </div>
        </div>

    </div>
</div>


<script>
    @if (isset($gallery->image_id))

        var importedBaseImage = "{{ url('/').getOrginalUrl($gallery->image_id)  }}";
        var FooterImage = new FileUploadWithPreview('editFirstImage', {
            images: {
                baseImage: importedBaseImage,
            },
        })
    @else
        var firstUpload = new FileUploadWithPreview('editFirstImage')
    @endif
</script>
