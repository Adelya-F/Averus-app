<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('siswa.absen', compact('absensis'));
    }

    public function store()
    {
        // ❗ CEGAH ABSEN 2X HARI INI
        $sudahAbsen = Absensi::where('user_id', Auth::id())
            ->whereDate('tanggal', now()->toDateString())
            ->exists();

        if ($sudahAbsen) {
            return back()->with('error', 'Kamu sudah absen hari ini!');
        }

        Absensi::create([
            'user_id' => Auth::id(),
            'tanggal' => now()
        ]);

        return back()->with('success', 'Absen berhasil!');
    }
}