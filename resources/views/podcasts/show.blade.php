@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card card-body mx-3">
            <div class="col-lg-12">
                <h1>{{ $podcast->title }}</h1>
                <p class="fs-4">{{ $podcast->short_description }}</p>
                <p class="">
                    Written by <a href="" class="fw-bold">{{ $podcast->user->name }}</a> on {{ $podcast->created_at->diffForHumans() }}
                </p>
                <p>
                    Updated on {{ $podcast->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <audio controls loop src="{{ Storage::url($podcast->path) }}" class="img-fluid rounded mb-3">
                        Your browser doesn't support videos.
                    </audio>
                    <p class="text fs-4" id="content">{!! $podcast->content !!}</p>
                </div>
                <div class="col-lg-3">
                    <p>Category: <span class="fw-semibold">{{$podcast->category->name}}</span></p>
                    <p>
                        Tags:
                        @forelse($podcast->tags as $tag)
                            <span class="badge light badge-success">{{ $tag->name }}</span>
                        @empty
                            No tags for this video
                        @endforelse
                    </p>
                    <p>
                        Visibility:
                        @if($podcast->visibility == 0)
                            <span class="badge light badge-primary">Public</span>
                        @else
                            <span class="badge light badge-danger">Private</span>
                        @endif
                    </p>
                    <p>
                        Statues:
                        @if($podcast->statues_id == 1)
                            <span class="badge light badge-warning">{{ $podcast->statues->name }}</span>
                        @elseif($podcast->statues_id == 2)
                            <span class="badge light badge-success">{{ $podcast->statues->name }}</span>
                        @else
                            <span class="badge light badge-danger">{{ $podcast->statues->name }}</span>
                        @endif
                    </p>
                    <p>
                        Featured:
                        @if($podcast->featured == 0)
                            <span class="badge light badge-danger">Not Featured</span>
                        @else
                            <span class="badge light badge-primary">Featured</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <h3>Comments</h3>

            @forelse($podcast->comments as $comment)
            <div class="bg-white p-3 pb-2 mb-3 rounded-2">
                <p>{{ $comment->content }}</p>
                <p class="">
                    <a href="" class="fw-bold">{{ $comment->user->name }}</a>  on {{ $comment->created_at->diffForHumans() }}
                </p>
                @if($comment->statues_id == 1)
                    <span class="badge light badge-warning mb-2">{{ $comment->statues->name }}</span>
                @elseif($comment->statues_id == 2)
                    <span class="badge light badge-success mb-2">{{ $comment->statues->name }}</span>
                @else
                    <span class="badge light badge-danger mb-2">{{ $comment->statues->name }}</span>
                @endif
            </div>
            @empty
            <div class="bg-white p-3 pb-1 mb-3 rounded-2">
                <p>No comments add yet for this podcast</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection

