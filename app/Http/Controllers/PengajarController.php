<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengajar; 
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajarController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role','siswa')->where('status','accepted')->count();
        $totalPengajar = User::where('role','pengajar')->count();
        
        // SINKRONISASI GLOBAL: Hitung semua kelas unik yang aktif di bimbel bray
        $totalKelas = Jadwal::where('is_active', true)
                            ->distinct('kelas_id')
                            ->count('kelas_id'); 

        // Hitung TOTAL semua jadwal mengajar hari ini di bimbel bray
        $jadwalHariIni = Jadwal::where('is_active', true)
                               ->whereDate('tanggal', Carbon::today())
                               ->count(); 
                               
        $unreadCount = 0;

        return view('pengajar.dashboard', compact('totalSiswa', 'totalPengajar', 'totalKelas', 'jadwalHariIni', 'unreadCount'));
    }

    public function indexJadwal()
    {
        $hariIni = Carbon::today()->format('Y-m-d');

        // Backend Cleaner: Tetap nonaktifkan jadwal yang sudah lewat tanggalnya
        Jadwal::where('is_active', true)
              ->where('tanggal', '<', $hariIni)
              ->update(['is_active' => false]);

        // AMBIL SEMUA JADWAL AKTIF (Eager load pakai 'guru' sesuai model lo bray)
        $jadwal_pengajar = Jadwal::with(['kelas', 'mapel', 'guru']) 
                                 ->where('is_active', true)
                                 ->orderBy('tanggal', 'asc')
                                 ->orderBy('jam_mulai', 'asc')
                                 ->get();

        return view('pengajar.jadwal.index', compact('jadwal_pengajar'));
    }

    public function store(Request $request)
    {
        // Validasi
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

        // Simpan langsung ke users
        User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => 'pengajar',
            'nip'            => $request->nip,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => $request->mata_pelajaran,
        ]);

        return redirect()->route('admin.pengajar.index')
                         ->with('success', 'Pengajar berhasil ditambahkan!');
    }
}