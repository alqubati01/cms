@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="card card-body mx-3">
            <div class="col-lg-12">
                <h1>{{ $post->title }}</h1>
                <p class="fs-4">{{ $post->short_description }}</p>
                <p class="">
                    Written by <a href="" class="fw-bold">{{ $post->user->name }}</a> on {{ $post->created_at->diffForHumans() }}
                </p>
                <p>
                    Updated on {{ $post->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="row">
                <div class="col-lg-9 h-100">
                    <img src="{{ ($post->image) ? $post->image->url() : '' }}" alt="" srcset="" class="img-fluid h-50 rounded mb-3">
                    <p class="text fs-4" id="content">{!! $post->content !!}</p>
                </div>
                <div class="col-lg-3">
                    <p>Category: <span class="fw-semibold">{{$post->category->name}}</span></p>
                    <p>
                        Tags:
                        @forelse($post->tags as $tag)
                            <span class="badge light badge-success">{{ $tag->name }}</span>
                        @empty
                            No tags for this post
                        @endforelse
                    </p>
                    <p>
                        Visibility:
                        @if($post->visibility == 0)
                            <span class="badge light badge-primary">Public</span>
                        @else
                            <span class="badge light badge-danger">Private</span>
                        @endif
                    </p>
                    <p>
                        Statues:
                        @if($post->statues_id == 1)
                            <span class="badge light badge-warning">{{ $post->statues->name }}</span>
                        @elseif($post->statues_id == 2)
                            <span class="badge light badge-success">{{ $post->statues->name }}</span>
                        @else
                            <span class="badge light badge-danger">{{ $post->statues->name }}</span>
                        @endif
                    </p>
                    <p>
                        Featured:
                        @if($post->featured == 0)
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

            @forelse($post->comments as $comment)
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
                <p>No comments add yet for this post</p>
            </div>
            @endforelse
        </div>
    </div>
@endsection

