<?php

namespace Modules\Auth\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['token' => $token, 'user' => $user]);
        }

        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }
}
