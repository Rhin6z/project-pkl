<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class check_user_email
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userEmail = Auth::user()->email;

            // Cek apakah email user ada di tabel siswa
            $exists = Siswa::where('email', $userEmail)->exists();

            if (!$exists) {
                Auth::logout(); // Logout user jika email tidak cocok
                return redirect('/login')->with('error', 'Email tidak terdaftar sebagai siswa.');
            }
        }
        
        return $next($request);
    }
}