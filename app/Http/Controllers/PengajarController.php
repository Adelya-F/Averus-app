<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PengajarController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role','siswa')
                            ->where('status','accepted')
                            ->count();

        $totalKelas = 0; // sementara
        $jadwalHariIni = 0; // sementara
        $unreadCount = 0; // sementara

        return view('admin.pengajar.dashboard', compact(
            'totalSiswa',
            'totalKelas',
            'jadwalHariIni',
            'unreadCount'
        ));
    }
}