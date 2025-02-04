<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller {

    public function login(Request $request) {
    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Não autorizado'], 401);
    }

    $expires_in = JWTAuth::factory()->getTTL() * 60;

    return response()->json([
        'token' => $token,
        'token_type' => 'bearer',
        'expires_in' => $expires_in 
    ]);
}


    public function logout() {
        Auth::logout();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function me() {
        return response()->json(Auth::user());
    }
}
