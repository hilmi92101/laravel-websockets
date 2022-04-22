<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return response()->json($post->comments()->with('user')->latest()->get());
    }

    public function store(Request $request)
    {
        $post = Post::where('id', $request->postId)->first();
        $comment = $post->comments()->create([
            'body' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();
        return $comment->toJson();
    }
}
