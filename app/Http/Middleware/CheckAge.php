<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan pengguna sudah login dan memiliki atribut 'age'
        // dan usianya minimal 18 tahun
        if (Auth::check() && Auth::user()->age !== null && Auth::user()->age >= 18) {
            return $next($request);
        }

        // Jika pengguna belum login, tidak punya usia, atau usia di bawah 18,
        // redirect mereka ke halaman login dengan pesan error
        return redirect('login')->with('error', 'Anda harus berusia minimal 18 tahun untuk mengakses halaman ini.');
    }
}
