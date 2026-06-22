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
        
        // Kembalikan nama penampungnya menjadi $hariIni bray
        $hariIni = Carbon::now()->locale('id')->translatedFormat('l'); 

        $jadwalHariIni = Jadwal::where('is_active', true)
                                ->whereDate('tanggal', Carbon::today())
                                ->with(['mapel', 'guru', 'kelas']) 
                                ->orderBy('jam_mulai', 'asc')
                                ->get();

        $totalKehadiran = 20; 
        $totalTidakHadir = 2;
        $kelasAktif = Jadwal::where('is_active', true)->distinct('kelas_id')->count('kelas_id');

        // Ubah compact-nya juga kembali mengirimkan 'hariIni'
        return view('siswa.dashboard', compact(
            'totalKehadiran', 
            'totalTidakHadir', 
            'kelasAktif', 
            'jadwalHariIni',
            'hariIni' 
        ));
    }

    /**
     * FITUR BARU: Menampilkan seluruh Jadwal Belajar Terpusat untuk Siswa
     */
    public function indexJadwal()
    {
        $hariIni = Carbon::today()->format('Y-m-d');

        Jadwal::where('is_active', true)
            ->where('tanggal', '<', $hariIni)
            ->update(['is_active' => false]);

        $jadwal_siswa = Jadwal::with(['kelas', 'mapel', 'guru']) 
                                ->where('is_active', true)
                                ->orderBy('tanggal', 'asc')
                                ->orderBy('jam_mulai', 'asc')
                                ->get();

        // FIXED: Diarahkan langsung ke file jadwal.blade.php di folder siswa
        return view('siswa.jadwal', compact('jadwal_siswa')); 
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