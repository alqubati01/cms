<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Statuse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $comments = Comment::with('user', 'statues')->filter()->orderBy('id')->paginate(10);
        $statuses = Statuse::all();
//        foreach ($comments as $comment) {
//            echo $comment->content . '<br>';
//            echo $comment->commentable_id . '<br>';
//            echo $comment->user->id . '<br>';
////            echo $comment->commentable->commentable_id . '<br>';
//        }
//        dd($request);
        $data = $request->all();

        return view('comments.index', ['comments' => $comments, 'data' => $data, 'statuses' => $statuses]);
    }

    public function show(string $id)
    {
        $comment = Comment::with('user', 'statues')->findOrFail($id);

        return view('comments.show', ['comment' => $comment]);
    }

    public function edit(string $id)
    {
        $comment = Comment::with('statues')->findOrFail($id);

        if($comment) {
            return response()->json([
                'status' => 200,
                'comment' => $comment,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Comment Found.'
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'integer',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status'=> 400,
                'errors'=> $validator->messages()
            ]);
        } else {
            $comment = Comment::findOrFail($id);
            if ($comment) {
                $comment->statues_id = $request->input('status');
                $comment->update();
                return response()->json([
                    'status'=> 200,
                    'message'=> 'Comment Updated Successfully.'
                ]);
            } else {
                return response()->json([
                    'status'=> 404,
                    'errors'=> 'No Comment Found'
                ]);
            }
        }
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        if($comment) {
            $comment->delete();
            return response()->json([
                'status' => 200,
                'message' => 'The comment was deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No Comment Found.'
            ]);
        }
    }
}
