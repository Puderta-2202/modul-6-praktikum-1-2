<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Jangan lupa import Auth facade

class AuthController extends Controller
{
    public function cekLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba untuk login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session ID untuk keamanan
            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email'); // atau redirect()->route('login')->with('error', 'Login failed. Periksa Username/Password.');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna

        $request->session()->invalidate(); // Invalidasi session
        $request->session()->regenerateToken(); // Regenerasi token CSRF

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
