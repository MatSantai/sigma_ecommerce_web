<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'role' => ['required', 'in:customer,admin'],
        ]);

        // Check if the user exists and has the correct role
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user || $user->role !== $request->role) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'role' => 'required|in:customer,admin',
        ]);

        // Check if the user exists and has the correct role
        $user = \App\Models\User::where('email', $request->email)->first();
        if ($user && $user->role !== $request->role) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['The selected role does not match your account.'],
            ]);
        }
    }
} 