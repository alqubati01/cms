@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="profile-info">
                        <div class="profile-photo mt-0">
                            <img src="{{ ($user->image) ? $user->image->url() : '' }}" alt="" srcset="" class="img-fluid rounded-circle">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{ $user->name }}</h4>
                                <p>{{ $user->roles[0]->name }}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{ $user->email }}</h4>
                                <p>Email</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="profile-tab">
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
{{--                                <li class="nav-item"><a href="#about-me"  data-bs-toggle="tab" class="nav-link">About Me</a>--}}
{{--                                </li>--}}
                                <li class="nav-item"><a href="#profile-settings"  data-bs-toggle="tab" class="nav-link active show">Setting</a>
                                </li>
                            </ul>
                            <div class="tab-content">
{{--                                <div id="about-me" class="tab-pane fade">--}}
{{--                                    <div class="profile-about-me">--}}
{{--                                        <div class="pt-4 border-bottom-1 pb-3">--}}
{{--                                            <h4 class="text-primary">About Me</h4>--}}
{{--                                            <p class="mb-2">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of existence was created for the bliss of souls like mine.I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>--}}
{{--                                            <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="profile-skills mb-5">--}}
{{--                                        <h4 class="text-primary mb-2">Skills</h4>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Admin</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Dashboard</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Photoshop</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Bootstrap</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Responsive</a>--}}
{{--                                        <a href="javascript:void(0);" class="btn btn-primary light btn-xs mb-1">Crypto</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="profile-lang  mb-5">--}}
{{--                                        <h4 class="text-primary mb-2">Language</h4>--}}
{{--                                        <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i class="flag-icon flag-icon-us"></i> English</a>--}}
{{--                                        <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i class="flag-icon flag-icon-fr"></i> French</a>--}}
{{--                                        <a href="javascript:void(0);" class="text-muted pe-3 f-s-16"><i class="flag-icon flag-icon-bd"></i> Bangla</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="profile-personal-info">--}}
{{--                                        <h4 class="text-primary mb-4">Personal Information</h4>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Name <span class="pull-right d-none d-sm-block">:</span>--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>Mitchell C.Shay</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Email <span class="pull-right d-none d-sm-block">:</span>--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>example@examplel.com</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Availability <span class="pull-right d-none d-sm-block">:</span></h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>Full Time (Free Lancer)</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Age <span class="pull-right d-none d-sm-block">:</span>--}}
{{--                                                </h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>27</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Location <span class="pull-right d-none d-sm-block">:</span></h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>Rosemont Avenue Melbourne,--}}
{{--                                                                Florida</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row mb-4 mb-sm-2">--}}
{{--                                            <div class="col-sm-3">--}}
{{--                                                <h5 class="f-w-500">Year Experience <span class="pull-right d-none d-sm-block">:</span></h5>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-sm-9"><span>07 Year Experiences</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div id="profile-settings" class="tab-pane fade active show">
                                    <div class="pt-3">
                                        <div class="settings-form">
                                            <h4 class="text-primary">Account Setting</h4>
                                            <form action="{{ route('profile.changePassword', ['profile' => $user->id]) }}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="old_password">Old Password</label>
                                                    <input type="password" id="old_password" name="old_password" placeholder="Old Password" class="form-control">
                                                    @error('old_password')
                                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-row row">
                                                    <div class="form-group col-md-6">
                                                        <label for="new_password">New Password</label>
                                                        <input type="password" id="new_password" name="new_password" placeholder="New Password" class="form-control">
                                                        @error('new_password')
                                                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="password-confirm">Confirm Password</label>
                                                        <input type="password" id="password-confirm" name="new_password_confirmation" placeholder="Confirm Password" class="form-control">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary" type="submit">Change Password</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
