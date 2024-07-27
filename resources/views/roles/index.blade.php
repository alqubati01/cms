@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Roles</h4>
                <div>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">Add Role</a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="width50">
                                    <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="form-check-input mt-0" id="checkAll" required="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>Name</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tags">
                            @forelse($roles as $role)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                            <label class="custom-control-label" for="customCheckBox2"></label>
                                        </div>
                                    </td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit-role" data-edit-role="{{ $role->id }}">Edit</a>
                                                <a class="dropdown-item delete-role" data-delete-role="{{ $role->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        No Roles Founded Yet!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addRoleModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-validate" id="addRoleForm">
                            <div class="row">
                                <div class="errorMsg mb-2"></div>
                                <div class="form-group">
                                    <label class="form-label mb-0" for="name">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter a role name..">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addRoleBtn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editRoleModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-validate" id="editRoleForm">
                            <div class="errorEditMsg mb-2"></div>
                            <input type="hidden" name="role-id" id="role-id">
                            <div class="row">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="edit-name">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" id="edit-name" name="edit-name" placeholder="Enter a role name..">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateRoleBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Jquery Validation -->
    <script src={{ asset("vendor/jquery-validation/jquery.validate.min.js") }}></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '#addRoleBtn', function (e) {
                e.preventDefault();

                var data = {
                    'name': $('#name').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/roles',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            $('#addRoleModal').modal('hide');
                            $('#addRoleForm')[0].reset();
                            $('.table').load(location.href+' .table');
                            toastr.success(response.message, "Role", {
                                positionClass: "toast-bottom-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                        } else {
                            let error = response.errors.name;
                            $.each(error, function (index, value) {
                                $('.errorMsg').empty().append('<span class="text-danger">'+value+'</span>'+'<br>')
                            });
                        }
                    },
                });
            });

            $(document).on('click', '.edit-role', function (e) {
                e.preventDefault();
                let role_id = $(this).data('editRole');

                $('#editRoleModal').modal('show');
                $('.errorEditMsg').empty();
                $.ajax({
                    type: 'GET',
                    url: '/roles/' + role_id,
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editRoleModal').modal('hide');
                            toastr.error(response.message, "Role", {
                                positionClass: "toast-bottom-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                        } else {
                            $('#role-id').val(response.role.id);
                            $('#edit-name').val(response.role.name);
                        }
                    }
                });
            });

            $(document).on('click', '#updateRoleBtn', function (e) {
                e.preventDefault();

                let role_id = $('#role-id').val();
                var data = {
                    'name': $('#edit-name').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: '/roles/' + role_id,
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            $('#editRoleModal').modal('hide');
                            toastr.success(response.message, "Role", {
                                positionClass: "toast-bottom-right",
                                timeOut: 5e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1
                            });
                            $('.table').load(location.href+' .table');
                        } else {
                            let error = response.errors.name;
                            $.each(error, function (index, value) {
                                $('.errorEditMsg').append('<span class="text-danger">'+value+'</span>'+'<br>')
                            });
                        }
                    }
                });
            });

            $(document).on('click', '.delete-role', function (e) {
                e.preventDefault();
                let role_id = $(this).data('deleteRole');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: '/roles/' + role_id,
                            dataType: "json",
                            success: function (response) {
                                if (response.status == 404) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your record has been not deleted.',
                                        'error'
                                    )
                                } else {
                                    $('.table').load(location.href+' .table');
                                    Swal.fire(
                                        'Deleted!',
                                        'Your record has been deleted.',
                                        'success'
                                    )
                                }
                            }
                        });
                    }
                })
            });
        });
    </script>

    <script>
        jQuery(".form-validate").validate({
            rules: {
                "name": {
                    required: !0,
                    minlength: 3
                },
                "edit-name": {
                    required: !0,
                    minlength: 3
                },
            },
            messages: {
                "name": {
                    required: "Please enter a title",
                    minlength: "Your name must consist of at least 3 characters"
                },
                "edit-name": {
                    required: "Please enter a title",
                    minlength: "Your name must consist of at least 3 characters"
                },
            },
            ignore: [],
            errorClass: "invalid-feedback animated fadeInUp",
            errorElement: "div",
            errorPlacement: function(e, a) {
                jQuery(a).parents(".form-group > div").append(e)
            },
            highlight: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            },
            success: function(e) {
                jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            },
        });
    </script>
@endpush
