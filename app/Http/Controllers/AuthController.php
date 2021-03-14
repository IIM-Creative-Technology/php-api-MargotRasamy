<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $email = request('email');
        $password = request('password');

        $token       = auth()->attempt(['email' => $email, 'password' => $password, 'admin'=> true]);

        if (!$token) {
            return response()->json('Unauthorized', 401);
        }

        return $this->respondWithToken($token);
    }

    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60,
        ]);
    }

    public function guard()
    {
        return Auth::guard();
    }
}
