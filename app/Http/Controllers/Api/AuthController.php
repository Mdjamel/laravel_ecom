<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserApiResource;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);

        $user =  User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => bin2hex(openssl_random_pseudo_bytes(30)),
        ]);

        return new UserApiResource($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user  = User::where('email', $request->email)->first();
            return new UserApiResource($user);
        }

        $message =  [
            'error' => true,
            'message' => 'user login attempt failed'
        ];

        return response($message, 401);
    }
}
