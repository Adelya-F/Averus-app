<?php

namespace App\Http\Controllers;

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
        $siswas = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->get();

        return view('admin.verifikasi', compact('siswas'));
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
        $pengajar = User::where('role', 'pengajar')->get();

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
        $request->validate([
            'nip' => 'required|unique:users,nip',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => 'password123',
            'role' => 'pengajar',
            'status' => 'accepted',
            'nip' => $request->nip,
            'phone' => $request->phone,
            'address' => $request->address,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->route('admin.pengajar')
            ->with('success', 'Pengajar berhasil ditambahkan');
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