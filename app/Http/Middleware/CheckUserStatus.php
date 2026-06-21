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
            $user = Auth::user();

            // 1. Jika masih pending (siswa baru daftar)
            if ($user->status === 'pending') {

                return redirect()->route('registration.status');
            }

            // 2. Jika ditolak (siswa tidak diterima)
            if ($user->status === 'rejected') {
                Auth::logout();
                return redirect()->route('login')
                    ->with('status', 'Pendaftaran kamu ditolak admin.');
            }


            // 3. JIKA INACTIVE (Siswa yang sudah berhenti tapi login lagi)
            if ($user->status === 'inactive') {
                // Kecuali jika dia memang sedang mengakses halaman reaktivasi, biarkan lewat
                // Ini supaya tidak terjadi infinite redirect (muter-muter terus)
                if (!$request->routeIs('siswa.reaktivasi.*')) {
                    return redirect()->route('siswa.reaktivasi.index');
                }
            }
        }

        return $next($request);
    }
    }
}