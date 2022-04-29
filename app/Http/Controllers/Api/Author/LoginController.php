<?php

namespace App\Http\Controllers\Api\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Author;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $author = Author::where('username', $request->name)->first();
        if(is_null($author)){
            $author = Author::create([
                'username' => $request->name,
                'password' => Hash::make('1q2w3e4r'),
            ]);
        }

        $author->tokens()->delete();

        if (! $author || ! Hash::check($request->password, $author->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $author->createToken("authAuthor")->plainTextToken;
        $status = true;

        return response()->json([ 
            'status' => true, 
            'author_token' => $token, 
        ]);
    }

    
    
    
}
