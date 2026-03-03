<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 🔥 DASHBOARD ADMIN
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count();
        $totalPengajar = User::where('role', 'pengajar')->count();

        return view('admin.dashboard', compact('totalSiswa', 'totalPengajar'));
    }

    // 🔥 DATA SISWA
    public function siswa()
    {
        $siswa = User::where('role', 'siswa')->get();
        return view('admin.siswa', compact('siswa'));
    }

    // 🔥 DATA PENGAJAR
    public function pengajar()
    {
        $pengajar = User::where('role', 'pengajar')->get();
        return view('admin.pengajar', compact('pengajar'));
    }

    // 🔥 FORM TAMBAH PENGAJAR
    public function createPengajar()
    {
        return view('admin.create-pengajar');
    }

    // 🔥 SIMPAN PENGAJAR
    public function storePengajar(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengajar',
        ]);

        return redirect()->route('admin.pengajar')
            ->with('success', 'Pengajar berhasil ditambahkan!');
    }
}