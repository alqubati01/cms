<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::with('user', 'tags')->get();

        return response()->json($videos, 200);
    }

    public function show(string $id)
    {
        $video = Video::with(
            'user',
            'statues',
            'category',
            'comments',
            'comments.user',
            'comments.statues'
        )->findOrFail($id);

        return response()->json($video, 200);
    }

    public function addComment(string $id)
    {
        $video = Video::findOrFail($id);

        $comment = new Comment();
        $comment->content = 'test';
        $comment->user_id = 1;
        $video->comments()->save($comment);

        return response()->json($video, 200);
    }
}
