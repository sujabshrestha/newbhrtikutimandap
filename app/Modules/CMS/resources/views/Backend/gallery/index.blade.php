@extends('layouts.admin.master')

@section('title', 'Gallery')

@section('breadcrumb', 'Gallery')
@push('styles')
    <link href="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.css') }} " rel="stylesheet"
        type="text/css" />
@endpush

@section('content')
    <!--  BEGIN CONTENT AREA  -->

    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-18 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="col-12">
                        <h5 style="display: inline;">Gallery Table</h5>
                        {{-- <a href="{{ route('backend.user.trashedIndex') }}" class="btn btn-danger float-right "><i
                                    class="fa fa-trash"></i> Trash </a> --}}
                        <button class="btn btn-success float-right " id="create"
                            data-url="{{ route('backend.cms.gallery.create') }}">Create <i class="fa fa-plus"></i></button>
                    </div>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="global-table" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>

    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
    <script>
        $('#global-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('backend.cms.gallery.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'title',
                    render: function(data, type, row) {
                        return '<p class="text-capitalize">' + row.title + '</p>';
                    }
                },

                {
                    data: 'image',
                    name: 'image',

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    </script>

    <script src="{{ asset('backendfiles/plugins/file-upload/file-upload-with-preview.min.js') }} "></script>
    <script>
        var firstUpload = new FileUploadWithPreview('myFirstImage')
    </script>


<script>
        $(document).on('click', '.editGallery', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            myUrl = $(this).data('url');

            $.ajax({
                type: 'GET',
                url: myUrl,
                success: function(data) {
                    // venueImage(Image);
                    $("#globalModal").html(data.data.view);
                    $("#globalModal").modal('show');

                },
            });
        });

</script>


@endpush
