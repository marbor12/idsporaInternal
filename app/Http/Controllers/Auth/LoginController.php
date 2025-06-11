<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Generate token (jika pakai Sanctum)
            $token = $user->createToken('api-token')->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'message' => 'Email atau password salah.'
        ], 401);
    }


    //punya copilot
    // public function logout(Request $request)
    // {
    //     $user = $request->user();
    //     if ($user) {
    //         $user->currentAccessToken()->delete();
    //     }
    //     return response()->json(['message' => 'Logged out']);
    // }

    //punya step
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();
    //     return redirect('/login');
    // }
}
