<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function post(Request $request)
    {
        $post = Post::where('id', $request->id)->first();
        return response()->json([
            'post' => $post,
            'status' => true,
        ]);
    }
}
