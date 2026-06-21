<?php

namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil hari ini (Contoh: "Minggu")
        $hariIni = Carbon::now()->isoFormat('dddd'); 

        // Ambil jadwal asli dari database sesuai kelas_id si siswa
        $jadwalHariIni = Jadwal::where('kelas_id', $user->kelas_id)
                        ->where('hari', $hariIni)
                        ->with(['mapel', 'guru'])
                        ->orderBy('jam_mulai', 'asc')
                        ->get();

        // Data statistik
        $totalKehadiran = 20; 
        $totalTidakHadir = 2;
        $kelasAktif = 5;

        return view('siswa.dashboard', compact(
            'totalKehadiran', 
            'totalTidakHadir', 
            'kelasAktif', 
            'jadwalHariIni',
            'hariIni'
        ));
    }

    public function inbox()
    {
        $messages = Inbox::where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('siswa.inbox', compact('messages'));
    }

    public function konfirmasiKenaikan($id)
    {
        $pesan = Inbox::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        if ($pesan->type === 'promotion' && !$pesan->is_confirmed) {
            $user = Auth::user();
            $user->update(['kelas_id' => $pesan->target_class_id]);
            $pesan->update(['is_confirmed' => true, 'is_read' => true]);

            return back()->with('success', 'Selamat! Kamu resmi naik kelas.');
        }

        return back()->with('error', 'Gagal memproses kenaikan kelas.');
    }

    public function berhenti($id)
    {
        $pesan = Inbox::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $user = Auth::user();

        // 1. Update status user jadi inactive
        $user->update([
            'status' => 'inactive'
        ]);

        // 2. Tandai pesan sudah diproses
        $pesan->update([
            'is_read' => true,
            'is_confirmed' => true 
        ]);

        // 3. Logout karena status sudah tidak aktif
        Auth::logout();
        
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Kamu telah menonaktifkan akun. Sampai jumpa lagi!');
    }

    // =====================================
    // FITUR RE-AKTIVASI (KEAMANAN DATA DIPERKUAT)
    // =====================================

    /**
     * Menampilkan halaman Welcome Back untuk siswa inactive
     */
    public function showReaktivasi()
    {
        if (Auth::user()->status !== 'inactive') {
            return redirect()->route('siswa.dashboard');
        }

        return view('siswa.reaktivasi');
    }

    /**
     * Memproses pengajuan aktivasi kembali dengan update data terbaru
     * Tanpa menghapus data lama (Hobi, Sosmed, dsb tetap aman)
     */
    public function ajukanReaktivasi(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi data yang masuk dari form
        $request->validate([
            'school' => 'required',
            'kelas_id' => 'required',
            'phone' => 'required',
            'parent_phone' => 'required',
            'address' => 'required',
        ]);

        // 2. Update HANYA kolom yang dikirim dari form
        // Ini memastikan kolom lain di DB tidak tertimpa/hilang
        $user->school       = $request->school;
        $user->kelas_id     = $request->kelas_id;
        $user->phone        = $request->phone;
        $user->parent_phone = $request->parent_phone;
        $user->address      = $request->address;
        $user->status       = 'pending'; // Ubah ke pending untuk verifikasi admin
        
        $user->save(); // Simpan perubahan secara manual

        // 3. Kirim notifikasi ke inbox Admin
        Inbox::create([
            'user_id' => 1, // ID Admin
            'title'   => 'Daftar Ulang Siswa',
            'message' => "Siswa {$user->name} telah memperbarui data dan mengajukan daftar ulang.",
            'type'    => 'request',
            'is_read' => false
        ]);

        return redirect()->route('registration.status')->with('success', 'Permintaan aktivasi sudah dikirim ke Admin. Silakan tunggu verifikasi.');
    }
}