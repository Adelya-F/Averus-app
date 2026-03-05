<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajar; // Pastikan Model Pengajar di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajarController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role','siswa')
                            ->where('status','accepted')
                            ->count();

        $totalKelas = 0; 
        $jadwalHariIni = 0; 
        $unreadCount = 0; 

        return view('admin.pengajar.dashboard', compact(
            'totalSiswa',
            'totalKelas',
            'jadwalHariIni',
            'unreadCount'
        ));
    }

    // TAMBAHKAN FUNGSI STORE INI
    public function store(Request $request)
    {
        // 1. Validasi - Arahkan 'unique' ke tabel 'pengajar'
        $request->validate([
            'nip'           => 'required|string|unique:pengajar,nip',
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|unique:pengajar,email',
            'phone'         => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'address'       => 'required|string',
        ]);

        // 2. Simpan ke tabel pengajar
        Pengajar::create([
            'nip'            => $request->nip,
            'nama'           => $request->nama,
            'email'          => $request->email,
            'no_hp'          => $request->phone,    // disesuaikan dengan migration
            'alamat'         => $request->address,  // disesuaikan dengan migration
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => 'Umum', // Karena di migration required tapi di blade tidak ada
        ]);

        // 3. Redirect
        return redirect()->route('admin.pengajar')
                         ->with('success', 'Data pengajar berhasil ditambahkan!');
    }
}