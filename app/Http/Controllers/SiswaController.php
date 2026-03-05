<<<<<<< HEAD
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        return view('siswa.dashboard', compact('user'));
=======
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        // Data sementara (dummy) agar error hilang
        // Nantinya kamu bisa ganti dengan query database asli
        $totalKehadiran = 20; 
        $totalTidakHadir = 2;
        $kelasAktif = 5;
        $jadwalHariIni = collect([
            (object)[
                'mata_pelajaran' => 'Matematika',
                'jam_mulai' => '08:00',
                'jam_selesai' => '09:30',
                'ruang' => 'Lab A'
            ],
            (object)[
                'mata_pelajaran' => 'Bahasa Inggris',
                'jam_mulai' => '10:00',
                'jam_selesai' => '11:30',
                'ruang' => 'Kelas 10'
            ]
        ]);

        return view('siswa.dashboard', compact(
            'totalKehadiran', 
            'totalTidakHadir', 
            'kelasAktif', 
            'jadwalHariIni'
        ));
>>>>>>> f395cbaa24c485e99227485ec99a260c15694f13
    }
}