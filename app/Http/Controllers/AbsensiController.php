<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // =====================
    // SISWA
    // =====================

    public function index()
    {
        $absensis = Absensi::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('siswa.absen', compact('absensis'));
    }


  public function store()
{
    $sudahAbsen = Absensi::where('user_id', Auth::id())
        ->whereDate('tanggal', now()->toDateString())
        ->exists();

    if ($sudahAbsen) {
        return back()->with(
            'error',
            'Kamu sudah absen hari ini!'
        );
    }


    Absensi::create([
        'user_id' => Auth::id(),
        'tanggal' => now(),
        'jam_masuk' => now()->format('H:i:s'),
        'status' => 'Hadir'
    ]);


    return back()->with(
        'success',
        'Absen berhasil!'
    );
}



    // =====================
    // PENGAJAR
    // =====================

    public function pengajarIndex()
    {
        $siswas = User::where('role','siswa')->get();


        $absensis = Absensi::with('user')
            ->where('guru_id', Auth::id())
            ->latest()
            ->get();


        return view('admin.pengajar.absensi', compact('absensis'));
    }



   public function pengajarStore(Request $request)
   {

    $sudahAbsen = Absensi::where('guru_id', Auth::id())
        ->whereDate('tanggal', now()->toDateString())
        ->exists();


     if($sudahAbsen){

        return back()->with(
            'error',
            'Anda sudah absen hari ini'
        );

     }


     Absensi::create([

        'guru_id' => Auth::id(),
        'tanggal' => now(),
        'jam_masuk' => now(),
        'status' => 'Hadir'

     ]);


     return back()->with(
        'success',
        'Absensi pengajar berhasil'
     );
    }
}