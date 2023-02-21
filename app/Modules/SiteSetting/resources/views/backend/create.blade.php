@extends('layouts.admin.master')

@section('title', 'Site Setting - ')

@section('breadcrumb', 'Site Setting')

@push('styles')
    {{-- FileUpload --}}
<link href="{{ asset('backendFiles/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    hr{
    margin-top:5px;
    border-top: 1px solid #e0e6ed;
}
.required{
    color: red;
}
.custom-file-container__image-preview{
    margin-top: 6px !important;
    margin-bottom: 24px !important; 
}

</style>


@endpush


@section('content')
  <!--  BEGIN CONTENT AREA  -->
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <form enctype="multipart/form-data" method="POST" action="{{ route('backend.siteSetting.store') }}">
                    @csrf
                    @include('SiteSetting::backend.commonForm')

                </form>
            </div>
        </div>

<!--  END CONTENT AREA  -->
@endsection

@push('scripts')
{{-- File Upload --}}
<script src="{{ asset('adminfiles/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>

<script>

    @if (getThumbnailUrl(returnSiteSetting('logo')))
    // getThumbnailUrl(returnSiteSetting('logo'))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('logo')) }}";
        var firstUpload = new FileUploadWithPreview('mysiteLogo', {
        images: {
        baseImage: importedBaseImage,
        },
        });
    @else
        var firstUpload = new FileUploadWithPreview('mysiteLogo');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('favicon')))
    // getThumbnailUrl(returnSiteSetting('favicon'))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('favicon')) }}";
        var firstUpload = new FileUploadWithPreview('siteFavIcon', {
        images: {
        baseImage: importedBaseImage,
        },
        });
    @else
        var firstUpload = new FileUploadWithPreview('siteFavIcon');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('about_us_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('about_us_image')) }}";
        var firstUpload = new FileUploadWithPreview('aboutUsImage', {
        images: {
        baseImage: importedBaseImage,
        },
        });
    @else
        var firstUpload = new FileUploadWithPreview('aboutUsImage');
    @endif


    @if (getThumbnailUrl(returnSiteSetting('qr_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('qr_image')) }}";
        var firstUpload = new FileUploadWithPreview('qrImage', {
        images: {
        baseImage: importedBaseImage,
        },
        });
    @else
        var firstUpload = new FileUploadWithPreview('qrImage');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('venue_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('venue_image')) }}";
        var firstUpload = new FileUploadWithPreview('venueImage', {
            images: {
                    baseImage: importedBaseImage,
                },
        });
    @else
        var firstUpload = new FileUploadWithPreview('venueImage');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('about_first_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('about_first_image')) }}";
        var firstUpload = new FileUploadWithPreview('aboutFirstImage', {
            images: {
                    baseImage: importedBaseImage,
                },
        });
    @else
        var firstUpload = new FileUploadWithPreview('aboutFirstImage');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('about_second_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('about_second_image')) }}";
        var firstUpload = new FileUploadWithPreview('aboutSecondImage', {
            images: {
                    baseImage: importedBaseImage,
                },
        });
    @else
        var firstUpload = new FileUploadWithPreview('aboutSecondImage');
    @endif

    @if (getThumbnailUrl(returnSiteSetting('about_third_image')))
        var importedBaseImage = "{{ getThumbnailUrl(returnSiteSetting('about_third_image')) }}";
        var firstUpload = new FileUploadWithPreview('aboutThirdImage', {
            images: {
                    baseImage: importedBaseImage,
                },
        });
    @else
        var firstUpload = new FileUploadWithPreview('aboutThirdImage');
    @endif


    

</script>




@endpush
