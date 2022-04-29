<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Visitor;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $visitor = Visitor::where('name', $request->name)->first();
        if(is_null($visitor)){
            $visitor = Visitor::create([
                'name' => $request->name,
                'password' => Hash::make('1q2w3e4r'),
            ]);
        }

        $visitor->tokens()->delete();

        if (! $visitor || ! Hash::check($request->password, $visitor->password)) {
            throw ValidationException::withMessages([
                'name' => ['The provided credentials are incorrect.'],
            ]);
        }
     
        return response()->json([ 
            'status' => true, 
            'visitor_token' => $visitor->createToken("authVisitor")->plainTextToken, 
        ]);
    }

    
    
    
}
