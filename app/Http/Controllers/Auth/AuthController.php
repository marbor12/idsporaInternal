<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        $credentials = $request->only('email', 'password');

        // Check if user exists, if not create with auto role assignment
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            // Auto create user with role based on email
            $role = $this->determineRoleFromEmail($request->email);
            
            $user = User::create([
                'name' => explode('@', $request->email)[0], // Use email prefix as name
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $role,
            ]);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // For API, generate token
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            
            // Check if request expects JSON (API call)
            if ($request->expectsJson()) {
                return response()->json([
                    'user' => $user,
                    'token' => $token,
                    'message' => 'Login successful'
                ]);
            }
            
            // Redirect to dashboard
            return redirect()->intended('/dashboard');
        }

        return redirect()->back()
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->withInput($request->except('password'));
    }

    private function determineRoleFromEmail($email)
    {
        // Auto assign role based on email domain or specific emails
        $emailLower = strtolower($email);
        
        // CEO emails
        if (str_contains($emailLower, 'ceo') || 
            str_contains($emailLower, 'chief') || 
            in_array($emailLower, ['boss@company.com', 'director@company.com'])) {
            return 'CEO';
        }
        
        // COO emails
        if (str_contains($emailLower, 'coo') || 
            str_contains($emailLower, 'operations') ||
            str_contains($emailLower, 'ops')) {
            return 'COO';
        }
        
        // CFO emails
        if (str_contains($emailLower, 'cfo') || 
            str_contains($emailLower, 'finance') ||
            str_contains($emailLower, 'accounting')) {
            return 'CFO';
        }
        
        // Default to PM for all other emails
        return 'PM';
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Logged out successfully']);
        }
        
        return redirect()->route('login');
    }
}