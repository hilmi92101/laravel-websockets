<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return response()->json([
                'status' => true,
                'user' => Auth::user(),
            ]);
        }
 
        return response()->json([
            'status' => false,
        ]);
    }

    public function checkLogin(Request $request)
    {
        if(Auth::check()){
            return response()->json([
                'status' => true,
                'user' => Auth::user(),
            ]);
        }
        
        return response()->json([
            'status' => false,
        ]);
    }
}
