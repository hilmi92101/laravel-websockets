<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;


class PostController extends Controller
{
    public $isLoggedIn = false;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function post(Request $request)
    {
        
        $this->checkLogin();
        
        //$post = Post::where('id', $request->id)->with('user', 'comments.user')->first();

        $post = Post::where('id', $request->id)
        ->with(['comments' => function($query) {
            $query->with('user');
            $query->orderBy('id', 'desc');
        }, 'user'])
        ->first();

        return response()->json([
            'post' => $post,
            'status' => true,
            'is_logged_in' => $this->isLoggedIn,
        ]);
    }

    private function checkLogin()
    {
        if(Auth::check()){
            $this->isLoggedIn = true;
        }
    }
}
