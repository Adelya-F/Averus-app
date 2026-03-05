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

            if (Auth::user()->status === 'pending') {
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