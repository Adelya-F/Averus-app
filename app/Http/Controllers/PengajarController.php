<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajar; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajarController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role','siswa')->where('status','accepted')->count();
        $totalPengajar = User::where('role','pengajar')->count();
        $totalKelas = 0; 
        $jadwalHariIni = 0; 
        $unreadCount = 0;
        return view('admin.pengajar.dashboard', compact('totalSiswa', 'totalPengajar',  'totalKelas','jadwalHariIni', 'unreadCount'));
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'nip'            => 'required|string|unique:users,nip',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|string',
            'mata_pelajaran' => 'required|string',
        ]);

        // 2. Simpan ke tabel users langsung
        User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => 'pengajar',     // penting!
            'nip'            => $request->nip,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        return redirect()->route('admin.pengajar')
                         ->with('success', 'Pengajar berhasil ditambahkan!');
    }
}