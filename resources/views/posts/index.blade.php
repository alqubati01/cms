@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Posts</h4>
                <div>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
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

            <form action="{{ route('posts.index') }}" method="GET">
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
{{--                        <div class="col-4">--}}
{{--                            <select class="form-control default-select mb-2" name="visibility">--}}
{{--                                <option value="">Select Visibility</option>--}}
{{--                                <option value="0">Public</option>--}}
{{--                                <option value="1">Private</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col-4">
                            <select class="form-control default-select mb-2" name="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <input class="form-control mb-2" type="text" name="search_text" placeholder="Search by title or author">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20">Filter</button>
                    <a href="{{route('posts.index')}}" class="btn btn-primary w-20">Clear Filter</a>
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
                                <th><strong>Title</strong></th>
                                <th><strong>Author</strong></th>
                                <th><strong>Visibility</strong></th>
                                <th><strong>Comments</strong></th>
                                <th><strong>Category</strong></th>
                                <th><strong>Status</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                            <label class="custom-control-label" for="customCheckBox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                            {{ \Illuminate\Support\Str::limit($post->title, 25) }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', ['user' => $post->user->id]) }}">
                                            {{ $post->user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($post->visibility == 0)
                                            <span class="badge light badge-primary">Public</span>
                                        @else
                                            <span class="badge light badge-danger">Private</span>
                                        @endif
                                    </td>
                                    <td class="px-3">
                                        <a href="{{ route('comments.index', ['type' => 'post', 'id' => $post->id]) }}">
                                            {{ $post->comments_count }}
                                            <svg width="24" height="24" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M34.4998 1.91666H11.4998C8.95911 1.9197 6.52332 2.93035 4.72676 4.72691C2.93019 6.52348 1.91955 8.95927 1.9165 11.5V26.8333C1.91929 29.0417 2.68334 31.1816 4.07988 32.8924C5.47642 34.6031 7.42004 35.7801 9.58317 36.225V42.1667C9.58312 42.5137 9.67727 42.8542 9.85558 43.1518C10.0339 43.4495 10.2897 43.6932 10.5956 43.8569C10.9016 44.0206 11.2462 44.0982 11.5928 44.0814C11.9394 44.0645 12.2749 43.9539 12.5636 43.7613L23.5748 36.4167H34.4998C37.0406 36.4136 39.4764 35.403 41.2729 33.6064C43.0695 31.8098 44.0801 29.374 44.0832 26.8333V11.5C44.0801 8.95927 43.0695 6.52348 41.2729 4.72691C39.4764 2.93035 37.0406 1.9197 34.4998 1.91666ZM30.6665 24.9167H15.3332C14.8248 24.9167 14.3373 24.7147 13.9779 24.3553C13.6184 23.9958 13.4165 23.5083 13.4165 23C13.4165 22.4917 13.6184 22.0041 13.9779 21.6447C14.3373 21.2853 14.8248 21.0833 15.3332 21.0833H30.6665C31.1748 21.0833 31.6623 21.2853 32.0218 21.6447C32.3812 22.0041 32.5832 22.4917 32.5832 23C32.5832 23.5083 32.3812 23.9958 32.0218 24.3553C31.6623 24.7147 31.1748 24.9167 30.6665 24.9167ZM34.4998 17.25H11.4998C10.9915 17.25 10.504 17.0481 10.1446 16.6886C9.78511 16.3292 9.58317 15.8417 9.58317 15.3333C9.58317 14.825 9.78511 14.3375 10.1446 13.978C10.504 13.6186 10.9915 13.4167 11.4998 13.4167H34.4998C35.0082 13.4167 35.4957 13.6186 35.8551 13.978C36.2146 14.3375 36.4165 14.825 36.4165 15.3333C36.4165 15.8417 36.2146 16.3292 35.8551 16.6886C35.4957 17.0481 35.0082 17.25 34.4998 17.25Z" fill="#2953e8b3"/>
                                            </svg>
                                        </a>
                                    </td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        @if($post->statues_id == 1)
                                            <span class="badge light badge-warning">{{ $post->statues->name }}</span>
                                        @elseif($post->statues_id == 2)
                                            <span class="badge light badge-success">{{ $post->statues->name }}</span>
                                        @else
                                            <span class="badge light badge-danger">{{ $post->statues->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            @if($post->statues_id == 1)
                                                <button type="button" class="btn btn-warning light sharp" data-bs-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                            @elseif($post->statues_id == 2)
                                                <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                            @else
                                                <button type="button" class="btn btn-danger light sharp" data-bs-toggle="dropdown">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                </button>
                                            @endif
                                            <div class="dropdown-menu">
                                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="dropdown-item">Edit</a>
                                                <a class="dropdown-item delete-post" data-delete-post="{{ $post->id }}">Delete</a>
{{--                                                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    @csrf--}}
{{--                                                    <input type="submit" value="Delete" class="dropdown-item">--}}
{{--                                                </form>--}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        No Posts Founded Yet!
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
    {{ $posts->appends($data)->links() }}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.delete-post', function (e) {
            e.preventDefault();
            let post_id = $(this).data('deletePost');

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
                        url: '/posts/' + post_id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                toastr.error(response.message, "Post", {
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
                                toastr.success(response.message, "Post", {
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
