@extends('layouts.admin.master')

@section('title', 'NDC | Branch')

@section('breadcrumb', 'Branch')

@section('content')
    <!--  BEGIN CONTENT AREA  -->

        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="col-12">
                            <h5 style="display: inline;">Users Table</h5>
                            {{-- <a href="{{ route('backend.user.trashedIndex') }}" class="btn btn-danger float-right "><i
                                    class="fa fa-trash"></i> Trash </a> --}}
                            <button class="btn btn-success float-right " data-toggle="modal" data-target="#createModal"
                                data-placement="top" title="createModal" data-original-title="Create">Create <i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="global-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.no.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Verified User</th>
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
            <!-- Create Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
                @include('User::backend.user.create')
            </div>

            <!-- Edit Modal -->
            <div class="modal animated fadeInUp" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">

            </div>

        </div>

    <!--  END CONTENT AREA  -->
@endsection

@push('scripts')
    <script>
        $('#global-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('backend.user.getUserData') }}",
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    render: function(data, type, row) {
                        return '<p class="text-capitalize">'+row.name+'</p>';
                    }
                },
                {
                    data: 'email',
                    render: function(data, type, row) {
                        return row.email;
                    }
                },
                {
                    data: 'email_verified_at',
                    render: function(data, type, row) {
                        if (row.email_verified_at == null ){
                            return "Unverified";
                        }
                        else{
                            return "Verified";
                        }
                     }
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $(document).on('click', '.edit-new', function() {

            event.preventDefault();
            var id = $(this).attr('data-id');
            var editUrl = "{{ route('backend.user.edit', ':id') }}";
            myUrl = editUrl.replace(':id', id);

            $.ajax({
                type: 'GET',
                url: myUrl,
                success: function(data) {
                    $("#editModal").modal('show');
                    $("#editModal").html(data);
                },
            });
        });

        $(document).on("submit", "#user-update-form", function(e) {

            e.preventDefault();
            var currentevent = $(this);
            currentevent.attr('disabled');
            var params = $('#user-update-form').serializeArray();
            var formData = new FormData($('#user-update-form')[0]);

            var id = $("#updateid").val();
            var route = $(this).attr('action');
            var myUrl = route.replace(':id', id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: myUrl,
                contentType: false,
                processData: false,
                cache: false,
                data: formData,
                beforeSend: function(data) {
                    loader();
                },
                success: function(data) {
                    toastr.success(data.message);
                    $('#editModal').modal('hide');
                    $('#global-table').DataTable().ajax.reload();
                },
                error: function(err) {
                    if (err.status == 422) {
                        console.log(err);
                        $.each(err.responseJSON.errors, function(i, error) {
                            var el = $(document).find('[name="' + i + '"]');
                            el.after($('<span style="color: red;">' + error[0] + '</span>')
                                .fadeOut(3000));
                        });
                    }
                },
                complete: function() {}
            });
            });
    </script>

@endpush
