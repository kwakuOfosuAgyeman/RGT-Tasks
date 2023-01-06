<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if(!$user){
            return response()->json(['Fail', 'Invalid Credentials']);
        }
        $user_data = User::where('email', $request->email)->first();
        return response()->json(['user', $user_data], 200);
    }

    public function jwtStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $token = JWTAuth::fromUser($user);
        if(!$user){
            return response()->json(['Fail', 'Invalid Credentials']);
        }
        $user_data = User::where('email', $request->email)->first();
        return response()->json(['user', $user_data, 'token' => $token], 201);
    }
}
