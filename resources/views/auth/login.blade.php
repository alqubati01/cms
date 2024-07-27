@extends('layouts.auth')

@section('content')
<div class="container h-100">
    <div class="row h-100 align-items-center justify-contain-center">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row m-0">
                        <div class="col-xl-6 col-md-6 sign text-center">
                            <div>
                                <div class="text-center my-5">
                                    <a href="index.html"><img src="images/logo-dark.png" alt=""></a>
                                </div>
                                <img src="images/log.png" class="img-fix bitcoin-img sd-shape7"></img>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 mt-5 pt-3">
                            <div class="sign-in-your py-4 px-4">
                                <h4 class="fs-20">{{ __('Login') }}</h4>
                                <span>Welcome back! Login with your data that you entered<br> during registration</span>

                                <form method="POST" action="{{ route('login') }}" class="mt-4">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="mb-1"><strong>{{ __('Email Address') }}</strong></label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>{{ __('Password') }}</strong></label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="mb-3">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

