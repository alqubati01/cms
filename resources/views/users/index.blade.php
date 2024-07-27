@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Users</h4>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Add User</a>
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

            <form action="{{ route('users.index') }}" method="GET">
                <div id="collapseOne"
                     class="collapse hidden px-4 pt-3 pb-2"
                     aria-labelledby="headingOne"
                     data-bs-parent="#accordion-one">
                    <div class="form-row">
{{--                        <div class="col-4">--}}
{{--                            <select class="form-control default-select mb-2" name="statues_id">--}}
{{--                                <option value="">Select Statues</option>--}}
{{--                                @foreach($statuses as $statues)--}}
{{--                                    <option value="{{ $statues->id }}">{{ $statues->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
                        <div class="col-4">
                            <input class="form-control mb-2" type="text" name="search_text" placeholder="Search by name or email">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20">Filter</button>
                    <a href="{{route('users.index')}}" class="btn btn-primary w-20">Clear Filter</a>
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
                            <th><strong>Username</strong></th>
                            <th><strong>Email</strong></th>
                            <th><strong>Status</strong></th>
                            <th><strong>Role</strong></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                        <label class="custom-control-label" for="customCheckBox2"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('users.show', ['user' => $user->id]) }}">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->is_active == 0)
                                        <span class="badge light badge-danger">Suspend</span>
                                    @else
                                        <span class="badge light badge-success">Active</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge light badge-primary">
                                        {{ (!empty($user->roles[0])) ? $user->roles[0]->name : 'No Role Assign' }}</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-outline-light light sharp" data-bs-toggle="dropdown">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                        </button>
                                        <div class="dropdown-menu">
                                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="dropdown-item">Edit</a>
                                                <a class="dropdown-item delete-user" data-delete-user="{{ $user->id }}">Delete</a>
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
                                    No Users Founded Yet!
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $users->appends($data)->links() }}
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).on('click', '.delete-user', function (e) {
            e.preventDefault();
            let user_id = $(this).data('deleteUser');

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
                        url: '/users/' + user_id,
                        dataType: "json",
                        success: function (response) {
                            if (response.status == 404) {
                                toastr.error(response.message, "User", {
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
