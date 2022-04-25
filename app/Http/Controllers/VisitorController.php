<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function onload(Request $request)
    {
        $auth_user = [];
        $status_login = false;
        $name = $request->name;

        if(!Auth::guard('visitor')->check()){
            $visitor = Visitor::where('name', $name)->first();
            if(is_null($visitor)){
                $visitor = Visitor::create([
                    'name' => $request->name,
                    'password' => Hash::make('1q2w3e4r'),
                ]);
            }
            
            $credentials = $request->validate([
                'name' => ['required'],
                'password' => ['required'],
            ]);
    
            if (Auth::guard('visitor')->attempt($credentials)) {
                $request->session()->regenerate();
                $auth_user = Auth::guard('visitor')->user();
                $status_login = true;
            }
        } else {
            $visitor = Auth::guard('visitor')->user();
            $auth_user = Auth::guard('visitor')->user();
            $status_login = 'Already Logged In';
        }

        
        return response()->json([ 
            'status' => true, 
            'visitor' => $visitor, 
            'auth_user' => Auth::guard('visitor')->user(), 
            'status_login' => $status_login, 
        ]);
    }
}
