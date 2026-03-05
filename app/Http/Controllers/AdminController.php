<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use App\Models\Inbox;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 🔥 DASHBOARD ADMIN
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')
            ->where('status', 'accepted')
            ->count();

        $totalPengajar = Pengajar::count();

        $pendingSiswa = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        $unreadCount = Inbox::where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalPengajar',
            'pendingSiswa',
            'unreadCount'
        ));
    }

    // 🔥 DATA SISWA
    public function siswa()
    {
        $siswa = User::where('role', 'siswa')
            ->where('status', 'accepted')
            ->get();

        return view('admin.siswa', compact('siswa'));
    }

    // 🔥 VERIFIKASI SISWA
    public function verifikasiSiswa()
    {
        // 1. Ambil tanggal hari ini pakai Carbon
        $today = \Carbon\Carbon::today();

        // 2. Ambil daftar siswa yang masih 'pending' (buat tabel verifikasi)
        $siswas = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->get();

        // 3. Hitung yang SUDAH diproses (accepted/rejected) KHUSUS HARI INI
        $diterimaHariIni = User::where('status', 'accepted')
            ->whereDate('updated_at', $today)
            ->count();

        $ditolakHariIni = User::where('status', 'rejected')
            ->whereDate('updated_at', $today)
            ->count();

        // 4. Kirim SEMUA variabelnya ke view verifikasi
        return view('admin.verifikasi', compact(
            'siswas', 
            'diterimaHariIni', 
            'ditolakHariIni'
        ));
    }

    // 🔥 UPDATE STATUS SISWA (Pastikan begini isinya)
        public function updateStatus(Request $request, User $user)
        {
            $request->validate([
                'status' => 'required|in:accepted,rejected' // Sesuai dengan value di form blade kamu
            ]);

            $user->update([
                'status' => $request->status
            ]);

            // Pesan notifikasi dinamis
            $pesan = $request->status === 'accepted' ? 'diterima' : 'ditolak';

            return redirect()->back()
                ->with('success', "Siswa {$user->name} berhasil {$pesan}!");
        }

    // 🔥 DATA PENGAJAR
        public function pengajar()
        {
            // 🟢 PERBAIKAN: Ambil dari tabel pengajar agar muncul di list
            $pengajar = Pengajar::all(); 

            // Sesuaikan dengan letak file blade Anda (admin.pengajar.pengajar)
            return view('admin.pengajar.pengajar', compact('pengajar'));
        }

    // 🔥 FORM TAMBAH PENGAJAR
        public function createPengajar()
        {
            return view('admin.pengajar.create');
        }

        // 🔥 SIMPAN PENGAJAR
        public function storePengajar(Request $request)
        {
        // 1. Validasi - Arahkan ke tabel 'pengajar'
        $request->validate([
            'nip' => 'required|unique:pengajar,nip', // Ganti users jadi pengajar
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengajar,email', // Ganti users jadi pengajar
            'phone' => 'required',
            'address' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);

    // 2. Simpan ke tabel 'pengajar' (Ganti User::create jadi Pengajar::create)
    \App\Models\Pengajar::create([
        'nip'           => $request->nip,
        'nama'          => $request->nama,
        'email'         => $request->email,
        'no_hp'         => $request->phone,   // Nama kolom di migration Anda 'no_hp'
        'alamat'        => $request->address, // Nama kolom di migration Anda 'alamat'
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'mata_pelajaran'=> 'Umum',            // Tambahkan default karena di migration NOT NULL
    ]);

    return redirect()->route('admin.pengajar')
        ->with('success', 'Pengajar berhasil ditambahkan ke tabel pengajar!');
}
    // 🔥 INBOX
    public function inbox()
    {
        $messages = Inbox::orderBy('created_at', 'desc')->get();
        $unreadCount = Inbox::where('is_read', false)->count();

        return view('admin.inbox', compact('messages', 'unreadCount'));
    }

    // 🔥 READ INBOX
    public function readInbox($id)
    {
        $inbox = Inbox::findOrFail($id);

        $inbox->update([
            'is_read' => true
        ]);

        return redirect($inbox->link);
    }
}