<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $jadwals = Jadwal::with(['guru', 'siswa', 'mapel'])->get();
            $gurus = User::where('role', 'pengajar')->get();
            $siswas = User::where('role', 'siswa')->get();
            $mapels = \App\Models\Mapel::all();
            $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            return view('admin.jadwal.index', compact('jadwals', 'gurus', 'siswas', 'mapels', 'hari_list'));
        }

        if ($user->role == 'pengajar') {
            $jadwals = Jadwal::with(['siswa', 'mapel'])->where('user_id', $user->id)->get();
            return view('pengajar.jadwal', compact('jadwals'));
        }

        // Role Siswa
        $jadwals = Jadwal::with(['guru', 'mapel'])->where('siswa_id', $user->id)->get();
        return view('siswa.jadwal', compact('jadwals'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::create($request->all());
        return redirect()->back()->with('success', 'Jadwal berhasil dibuat!');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}