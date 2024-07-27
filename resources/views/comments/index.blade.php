@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Comments</h4>
                <div>
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

            <form action="{{ route('comments.index') }}" method="GET">
                <div id="collapseOne"
                     class="collapse hidden px-4 pt-3 pb-2"
                     aria-labelledby="headingOne"
                     data-bs-parent="#accordion-one">
                    <div class="form-row">
                        <div class="col-4">
                            <select class="form-control default-select mb-2" name="statues_id">
                                <option value="">Select Statues</option>
                                @foreach($statuses as $statues)
                                    <option value="{{ $statues->id }}">{{ $statues->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input class="form-control mb-2" type="text" name="search_text" placeholder="Search by title or author">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20">Filter</button>
                    <a href="{{route('comments.index')}}" class="btn btn-primary w-20">Clear Filter</a>
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
                            <th><strong>Author</strong></th>
                            <th><strong>Content</strong></th>
                            <th><strong>Post</strong></th>
                            <th><strong>Status</strong></th>
                            <th><strong>Created At</strong></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($comments as $comment)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                        <label class="custom-control-label" for="customCheckBox2"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('users.show', ['user' => $comment->user->id]) }}" class="fw-semibold">
                                        {{ $comment->user->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('comments.show', ['comment' => $comment->id]) }}">
                                        {{ \Illuminate\Support\Str::limit($comment->content, 25) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', ['post' => $comment->commentable_id]) }}" class="text-decoration-underline">
                                        View Blog
                                    </a>
                                </td>
                                <td>
                                    @if($comment->statues_id == 1)
                                        <span class="badge light badge-warning">{{ $comment->statues->name }}</span>
                                    @elseif($comment->statues_id == 2)
                                        <span class="badge light badge-success">{{ $comment->statues->name }}</span>
                                    @else
                                        <span class="badge light badge-danger">{{ $comment->statues->name }}</span>
                                    @endif
                                </td>
                                <td>{{ $comment->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        @if($comment->statues_id == 1)
                                            <button type="button" class="btn btn-warning light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                        @elseif($comment->statues_id == 2)
                                            <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                        @endif
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit-comment" data-edit-comment="{{ $comment->id }}">Edit</a>
                                            <a class="dropdown-item delete-comment" data-delete-comment="{{ $comment->id }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    No Comments Founded Yet!
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--    {{ $posts->links() }}--}}
    {{ $comments->appends($data)->links() }}

    <!-- Edit Modal -->
    <div class="modal fade" id="editCommentModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Comment</h5>
                    <button type="button" class="close" data-bs-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-validation">
                        <form class="form-validate" id="editCommentForm">
                            <div class="errorEditMsg mb-2"></div>
                            <input type="hidden" name="comment-id" id="comment-id">
                            <div class="row">
                                <div class="form-group">
                                    <label class="form-label mb-0" for="edit-status">Status</label>
                                    <div class="">
                                        <select class="form-control default-select" id="edit-status" name="edit-status">
                                            @foreach($statuses as $statues)
                                                <option value="{{ $statues->id }}">{{ $statues->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateCommentBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.edit-comment', function (e) {
            e.preventDefault();
            let comment_id = $(this).data('editComment');

            $('#editCommentModal').modal('show');
            $('.errorEditMsg').empty();
            $.ajax({
                type: 'GET',
                url: '/comment-edit/' + comment_id,
                success: function (response) {
                    if (response.status == 404) {
                        $('#editCommentModal').modal('hide');
                        toastr.error(response.message, "Comment", {
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
                        $('#comment-id').val(response.comment.id);
                        $('select[name=edit-status]').val(response.comment.statues_id);
                        $('#edit-status').selectpicker('refresh');
                    }
                }
            });
        });

        $(document).on('click', '#updateCommentBtn', function (e) {
            e.preventDefault();

            let comment_id = $('#comment-id').val();
            var data = {
                'status': $('#edit-status').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'PUT',
                url: '/comments/' + comment_id,
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status == 200) {
                        $('#editCommentModal').modal('hide');
                        toastr.success(response.message, "Comment", {
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

        $(document).on('click', '.delete-comment', function (e) {
            e.preventDefault();
            let comment_id = $(this).data('deleteComment');

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
                        url: '/comments/' + comment_id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                toastr.error(response.message, "Comment", {
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
                                $('.table').load(location.href+' .table');
                                toastr.success(response.message, "Comment", {
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
                            }
                        }
                    });
                }
            })
        });
    </script>
@endpush
