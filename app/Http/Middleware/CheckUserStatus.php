<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Cek jika status pending DAN user TIDAK sedang mengakses halaman status
            if (Auth::user()->status === 'pending' && !$request->routeIs('registration.status')) {
                return redirect()->route('registration.status');
            }

            if (Auth::user()->status === 'rejected') {
                Auth::logout();
                return redirect()->route('login')
                    ->with('status', 'Pendaftaran kamu ditolak admin.');
            }
        }

        return $next($request);
    }
}