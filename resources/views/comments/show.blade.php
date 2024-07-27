@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-9">
            <h3>Comment</h3>

            <div class="bg-white p-3 pb-2 mb-3 rounded-2">
                <p>{{ $comment->content }}</p>
                <p class="">
                    <a href="" class="fw-bold">{{ $comment->user->name }}</a>  on {{ $comment->created_at->diffForHumans() }}
                </p>
                <a href="{{ route('posts.show', ['post' => $comment->commentable_id]) }}" class="d-block mb-3">
                    View Blog
                </a>
                @if($comment->statues_id == 1)
                    <span class="badge light badge-warning mb-3">{{ $comment->statues->name }}</span>
                @elseif($comment->statues_id == 2)
                    <span class="badge light badge-success mb-3">{{ $comment->statues->name }}</span>
                @else
                    <span class="badge light badge-danger mb-3">{{ $comment->statues->name }}</span>
                @endif
            </div>
        </div>
    </div>
@endsection
