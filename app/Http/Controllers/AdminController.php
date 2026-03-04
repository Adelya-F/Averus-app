<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // 🔥 DASHBOARD ADMIN
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->where('status', 'accepted')->count();
        $totalPengajar = User::where('role', 'pengajar')->count();
        // Hitung juga pendaftar yang butuh ACC untuk notifikasi di dashboard
        $pendingSiswa = User::where('role', 'siswa')->where('status', 'pending')->count();
        $unreadCount = Inbox::where('is_read', false)->count();

        return view('admin.dashboard', compact('totalSiswa', 'totalPengajar', 'pendingSiswa', 'unreadCount'));
    }

    // 🔥 DATA SISWA (Hanya yang sudah diterima)
    public function siswa()
    {
        $siswa = User::where('role', 'siswa')->where('status', 'accepted')->get();
        return view('admin.siswa', compact('siswa'));
    }

    // 🔥 HALAMAN VERIFIKASI (Siswa yang statusnya masih 'pending')
    public function verifikasiSiswa()
    {
        $siswas = User::where('role', 'siswa')
                      ->where('status', 'pending')
                      ->get();
                      
        return view('admin.verifikasi', compact('siswas'));
    }

    // 🔥 PROSES UPDATE STATUS (Accept atau Reject)
    public function updateStatus(Request $request, User $user)
    {
        // Validasi agar status yang masuk cuma accepted atau rejected
        $user->update([
            'status' => $request->status 
        ]);

        $pesan = $request->status == 'accepted' ? 'diterima' : 'ditolak';
        return redirect()->back()->with('success', "Siswa {$user->name} berhasil {$pesan}!");
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
            'status' => 'accepted', // Pengajar yang dibuat admin langsung aktif
        ]);

        return redirect()->route('admin.pengajar')
            ->with('success', 'Pengajar berhasil ditambahkan!');
    }

    public function inbox()
    {
        // Mengambil semua pesan, yang terbaru tampil di atas
        $messages = Inbox::orderBy('created_at', 'desc')->get();
        
        // Menghitung jumlah pesan yang belum dibaca untuk badge/notifikasi
        $unreadCount = Inbox::where('is_read', false)->count();

        return view('admin.inbox', compact('messages', 'unreadCount'));
    }

    // Fungsi "Jembatan" untuk menandai pesan dibaca lalu pindah halaman
    public function readInbox($id)
    {
        $inbox = Inbox::findOrFail($id);
        
        // Ubah status is_read menjadi true (angka 1)
        $inbox->update(['is_read' => true]);

        // Redirect admin ke link yang tersimpan (Halaman Verifikasi)
        return redirect($inbox->link);
    }
}