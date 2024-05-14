<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name       => required|string|max:255',
            'email      => required|string|max:255|unique:users,email',
            'password   => required|string|max:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password)
        ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'data' =>$user,
            'access_token' =>$token,
            'token_type' =>'Bearer'
        ],200);
    }   
}
