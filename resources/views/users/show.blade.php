@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card card-body mx-3">
            <div class="col-lg-12">
                <h1>{{ $user->name }}</h1>
                <h3>{{ $user->username }}</h3>
                <h3>{{ $user->email }}</h3>
                <img src="{{ ($user->image) ? $user->image->url() : '' }}" alt="" srcset="" class="img-fluid rounded mb-3">
            </div>
        </div>
    </div>
@endsection
