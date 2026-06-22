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

        // Admin
        if ($user->role == 'admin') {

            $jadwals = Jadwal::with(['guru', 'kelas', 'mapel'])->get();

            $gurus = User::where('role', 'pengajar')->get();
            $siswas = User::where('role', 'siswa')->get();

            $mapels = Mapel::all();

            $hari_list = [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu',
                'Minggu'
            ];

            return view(
                'admin.jadwal.index',
                compact(
                    'jadwals',
                    'gurus',
                    'siswas',
                    'mapels',
                    'hari_list'
                )
            );
        }

        // Pengajar
        if ($user->role == 'pengajar') {

            $jadwals = Jadwal::with(['kelas', 'mapel'])
                ->where('user_id', $user->id)
                ->get();

            return view('pengajar.jadwal', compact('jadwals'));
        }

        // Siswa
        $jadwals = Jadwal::with(['guru', 'kelas', 'mapel'])->get();

        return view('siswa.jadwal', compact('jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required',
            'kelas_id'    => 'required',
            'mapel_id'    => 'required',
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ]);

        Jadwal::create($request->all());

        return redirect()
            ->back()
            ->with('success', 'Jadwal berhasil dibuat!');
    }

    public function destroy($id)
    {
        Jadwal::findOrFail($id)->delete();

        return redirect()
            ->back()
            ->with('success', 'Jadwal berhasil dihapus!');
    }
}