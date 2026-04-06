<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inbox;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Mapel;

class AdminController extends Controller
{
    // 🔥 DASHBOARD ADMIN
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')
            ->where('status', 'accepted')
            ->count();

        $totalPengajar = User::where('role', 'pengajar')->count();

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
        $today = Carbon::today();

        $siswas = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->get();

        $diterimaHariIni = User::where('status', 'accepted')
            ->whereDate('updated_at', $today)
            ->count();

        $ditolakHariIni = User::where('status', 'rejected')
            ->whereDate('updated_at', $today)
            ->count();

        return view('admin.verifikasi', compact(
            'siswas', 
            'diterimaHariIni', 
            'ditolakHariIni'
        ));
    }

    // 🔥 UPDATE STATUS SISWA
    public function updateStatus(Request $request, User $user)
    {
        $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $user->update([
            'status' => $request->status
        ]);

        $pesan = $request->status === 'accepted' ? 'diterima' : 'ditolak';

        return redirect()->back()
            ->with('success', "Siswa {$user->name} berhasil {$pesan}!");
    }

    // 🔥 DATA PENGAJAR
    public function pengajar()
    {
        // Ambil dari table users dengan role pengajar
        $pengajar = User::where('role', 'pengajar')->get();

        return view('admin.pengajar.pengajar', compact('pengajar'));
    }

    // 🔥 FORM TAMBAH PENGAJAR
    public function createPengajar()
    {
        // 1. Ambil semua data mata pelajaran dari database
        $mapels = \App\Models\Mapel::all(); 

        // 2. Kirim variabel $mapels ke dalam view
        return view('admin.pengajar.create', compact('mapels'));
    }

    // 🔥 SIMPAN PENGAJAR
    public function storePengajar(Request $request)
    {
        $request->validate([
            'nip'            => 'required|unique:users,nip',
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|string|min:6',
            'phone'          => 'required|string',
            'address'        => 'required|string',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required|in:Laki-laki,Perempuan',
            'mata_pelajaran' => 'required|array', // Sekarang divalidasi sebagai array
        ]);

        // Proses penggabungan array mata pelajaran menjadi string (misal: "Matematika, Fisika")
        $mapelTerpilih = $request->has('mata_pelajaran') 
            ? implode(', ', $request->mata_pelajaran) 
            : 'Umum';

        // Simpan ke table users
        \App\Models\User::create([
            'name'           => $request->name,
            'email'          => $request->email,
            'password'       => bcrypt($request->password),
            'role'           => 'pengajar',
            'nip'            => $request->nip,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => $mapelTerpilih, 
        ]);

        return redirect()->route('admin.pengajar')
            ->with('success', 'Pengajar berhasil ditambahkan!');
    }

    public function editPengajar($id)
    {
        $pengajar = User::findOrFail($id);
        $mapels = Mapel::all(); // 🔥 ini yang kurang

        return view('admin.pengajar.edit', compact('pengajar','mapels'));
    }

    public function updatePengajar(Request $request, $id)
    {
        $pengajar = User::findOrFail($id);

        $pengajar->update([
            'name' => $request->name,
            'email' => $request->email,
            'mata_pelajaran' => $request->mata_pelajaran,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.pengajar')->with('success', 'Data berhasil diupdate');
    }

    public function destroyPengajar($id)
    {
        $pengajar = User::findOrFail($id);
        $pengajar->delete();

        return redirect()->route('admin.pengajar')->with('success', 'Data berhasil dihapus');
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