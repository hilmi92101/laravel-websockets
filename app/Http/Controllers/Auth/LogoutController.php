<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if(Auth::check()){
            return response()->json([
                'status' => true,
            ]);
        }
        
        return response()->json([
            'status' => false,
        ]);
    }
}
