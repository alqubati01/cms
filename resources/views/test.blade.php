@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Show topic #1') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @can('edit posts')
                            <a href="#">{{ __('Edit post') }}</a>
                        @endcan

                        @can('delete posts')
                            <a href="#">{{ __('Delete post') }}</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
