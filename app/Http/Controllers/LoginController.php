<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            $users = User::all();
            return response()->json(['Success', $users]);
        }

        return response()->json(['Fail', 'Invalid Credentials']);



    }

    public function jwtStore(Request $request)
    {
        $request->validate([
            // 'name' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $users = User::all();

        // Return a successful response with the token
        return response()->json([
            'user' => $users,
            'token' => $token,
        ]);
    }


}
