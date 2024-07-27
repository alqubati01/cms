@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tags</h4>
                <div>
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">Add Tag</a>
                    <div id="headingOne"
                         data-bs-toggle="collapse"
                         data-bs-target="#collapseOne"
                         aria-controls="collapseOne"
                         aria-expanded="true"
                         role="button"
                         class="btn btn-primary">
                        <span>Filters</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('tags.index') }}" method="GET">
                <div id="collapseOne"
                     class="collapse hidden px-4 pt-3 pb-2"
                     aria-labelledby="headingOne"
                     data-bs-parent="#accordion-one">
                    <div class="form-row">
                        <div class="col-4">
                            <input class="form-control mb-2" type="text" name="search_text" placeholder="Search by tag name">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20">Filter</button>
                    <a href="{{route('tags.index')}}" class="btn btn-primary w-20">Clear Filter</a>
                </div>
            </form>
            <hr class="m-0"/>

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
                                <th><strong>Status</strong></th>
                                <th><strong>Post Counts</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tags">
                            @forelse($tags as $tag)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                            <label class="custom-control-label" for="customCheckBox2"></label>
                                        </div>
                                    </td>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        @if($tag->is_active == 0)
                                            <span class="badge light badge-danger">Suspend</span>
                                        @else
                                            <span class="badge light badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ $tag->posts_count }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit-tag" data-edit-tag="{{ $tag->id }}">Edit</a>
                                                <a class="dropdown-item delete-tag" data-delete-tag="{{ $tag->id }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        No Tags Founded Yet!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $tags->appends($data)->links() }}

    <!-- Add Modal -->
    <div class="modal fade" id="addTagModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tag</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-validate" id="addTagForm">
                            <div class="row">
                                <div class="errorMsg mb-2"></div>
                                <div class="form-group">
                                    <label class="form-label mb-0" for="name">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter a tag name..">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label mb-0" for="status">Status</label>
                                    <div class="">
                                        <select class="form-control default-select" id="status" name="status">
                                            <option value="1">Activated</option>
                                            <option value="0">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_title">Meta Title</label>
                                    <textarea class="form-control" id="meta_title" name="meta_title" rows="2" placeholder="Enter meta title for tag"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter meta description for tag"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addTagBtn">Add</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editTagModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tag</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-validate" id="editTagForm">
                            <div class="errorEditMsg mb-2"></div>
                            <input type="hidden" name="tag-id" id="tag-id">
                            <div class="row">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="edit-name">Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="">
                                        <input type="text" class="form-control" id="edit-name" name="edit-name" placeholder="Enter a tag name..">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label mb-0" for="edit-status">Status</label>
                                    <div class="">
                                        <select class="form-control default-select" id="edit-status" name="edit-status">
                                            <option value="1">Activated</option>
                                            <option value="0">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edit-meta_title">Meta Title</label>
                                    <textarea class="form-control" id="edit-meta_title" name="edit-meta_title" rows="2" placeholder="Enter meta title for tag"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="edit-meta_description">Meta Description</label>
                                    <textarea class="form-control" id="edit-meta_description" name="edit-meta_description" rows="3" placeholder="Enter meta description for tag"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateTagBtn">Update</button>
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
            $(document).on('click', '#addTagBtn', function (e) {
                e.preventDefault();

                var data = {
                    'name': $('#name').val(),
                    'status': $('#status').val(),
                    'meta_title': $('#meta_title').val(),
                    'meta_description': $('#meta_description').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '/tags',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            $('#addTagModal').modal('hide');
                            $('#addTagForm')[0].reset();
                            $('.table').load(location.href+' .table');
                            toastr.success(response.message, "Tag", {
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

            $(document).on('click', '.edit-tag', function (e) {
                e.preventDefault();
                let tag_id = $(this).data('editTag');

                $('#editTagModal').modal('show');
                $('.errorEditMsg').empty();
                $.ajax({
                    type: 'GET',
                    url: '/tags/' + tag_id,
                    success: function (response) {
                        if (response.status == 404) {
                            $('#editTagModal').modal('hide');
                            toastr.error(response.message, "Tag", {
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
                            console.log(response);
                            $('#tag-id').val(response.tag.id);
                            $('#edit-name').val(response.tag.name);
                            $('select[name=edit-status]').val(response.tag.is_active);
                            $('#edit-meta_title').val(response.tag.meta_title);
                            $('#edit-meta_description').val(response.tag.meta_description);
                            $('#edit-status').selectpicker('refresh');
                        }
                    }
                });
            });

            $(document).on('click', '#updateTagBtn', function (e) {
                e.preventDefault();

                let tag_id = $('#tag-id').val();
                var data = {
                    'name': $('#edit-name').val(),
                    'status': $('#edit-status').val(),
                    'meta_title': $('#edit-meta_title').val(),
                    'meta_description': $('#edit-meta_description').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: 'PUT',
                    url: '/tags/' + tag_id,
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            $('#editTagModal').modal('hide');
                            toastr.success(response.message, "Tag", {
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

            $(document).on('click', '.delete-tag', function (e) {
                e.preventDefault();
                let tag_id = $(this).data('deleteTag');

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
                            url: '/tags/' + tag_id,
                            dataType: "json",
                            success: function (response) {
                                if (response.status == 404) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been not deleted.',
                                        'error'
                                    )
                                } else {
                                    $('.table').load(location.href+' .table');
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
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
