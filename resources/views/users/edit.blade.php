@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Basic User</h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-validate" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <div>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Enter a user fullname..">
                                    </div>
                                    @error('name')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="username">UserName</label>
                                    <div>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Enter a username..">
                                    </div>
                                    @error('username')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email">Email</label>
                                    <div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Enter a user email..">
                                    </div>
                                    @error('email')
                                    <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <label class="form-label" for="role">Role</label>
                                    <select class="form-control default-select" id="role" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" @selected($role->id == ((!empty($user->roles[0]) ? $user->roles[0]->id : '')))>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="form-control default-select" id="status" name="status">
                                        <option value="1" @selected(1 == $user->is_active)>Active</option>
                                        <option value="0" @selected(0 == $user->is_active)>Suspend</option>
                                    </select>
                                </div>
                                <div>
                                    <img src="{{ ($user->image) ? $user->image->url() : '' }}" alt="" srcset="" class="img-fluid rounded">
                                </div>
                                <div class="form-group">
                                    <label for="file" class="form-label">Image</label>
                                    <input class="form-control" type="file" id="file" name="file">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-20">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit User Password</h4>
            </div>
            <div class="card-body">
                <div class="form-validation">
                    <form class="form-validate" action="{{ route('users.updatePassword', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <div>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter a user password..">
                                </div>
                                @error('password')
                                <div id="val-terms-error" class="invalid-feedback animated fadeInUp" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password-confirm">Confirm Password</label>
                                <div>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Enter a confirm password..">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-20">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Jquery Validation -->
    <script src={{ asset("vendor/jquery-validation/jquery.validate.min.js") }}></script>
    <script>
        jQuery(".form-validate").validate({
            rules: {
                "name": {
                    required: !0,
                    minlength: 3
                },
                "email": {
                    required: !0,
                    email: !0
                },
                "password": {
                    required: !0,
                    minlength: 8
                },
                "password-confirm": {
                    required: !0,
                    equalTo: "#password"
                },
            },
            messages: {
                "name": {
                    required: "Please enter a user name",
                    minlength: "Your name must consist of at least 3 characters"
                },
                "email": "Please enter a valid email address",
                "password": {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long"
                },
                "password-confirm": {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 8 characters long",
                    equalTo: "Please enter the same password as above"
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



