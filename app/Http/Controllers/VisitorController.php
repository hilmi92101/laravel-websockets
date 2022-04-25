<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function onload(Request $request)
    {
        $name = $request->visitor["name"];

        $visitor = Visitor::where('name', $name)->first();
        if(is_null($visitor)){
            $visitor = Visitor::create([
                'name' => $name,
                'password' => Hash::make('1q2w3e4r'),
            ]);
        }

        return response()->json([ 
            'status' => true, 
            //'new_visitor' => $new_visitor, 
            'visitor' => $visitor, 
        ]);
    }
}
