<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Inbox;
use App\Models\Mapel;
use App\Models\Kelas; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')
            ->where('status', 'accepted')
            ->count();

        $totalPengajar = User::where('role', 'pengajar')->count();

        $pendingSiswa = User::where('role', 'siswa')
            ->where('status', 'pending')
            ->count();

        $unreadCount = Inbox::where('user_id', Auth::id())->where('is_read', false)->count();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalPengajar',
            'pendingSiswa',
            'unreadCount'
        ));
    }

    public function inbox()
    {
        $messages = Inbox::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.inbox', compact('messages'));
    }


    public function inboxShow($id)
    {
        $message = Inbox::where('user_id', Auth::id())->findOrFail($id);
        $message->update(['is_read' => true]);

        return view('admin.inbox_show', compact('message'));
    }


    public function indexKelas()
    {
        $daftar_kelas = Kelas::withCount(['users' => function($query) {
            $query->where('role', 'siswa')->where('status', 'accepted');
        }])->get();

        return view('admin.siswa.index_kelas', compact('daftar_kelas'));
    }

    public function showSiswaPerKelas(Request $request, $slug)
    {
        $kelas = Kelas::where('slug', $slug)->firstOrFail();
        $search = $request->input('search');

        $siswa = User::where('kelas_id', $kelas->id)
                    ->where('role', 'siswa')
                    ->where('status', 'accepted')
                    ->when($search, function ($query) use ($search) {
                        return $query->where('name', 'LIKE', '%' . $search . '%');
                    })
                    ->get();

        return view('admin.siswa.show', compact('kelas', 'siswa'));
    }

    public function editSiswa($id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);

        // Validasi seluruh input data lengkap siswa
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $id,
            'password'         => 'nullable|min:6',
            'school'           => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:20',
            'tanggal_lahir'    => 'nullable|date',
            'jenis_kelamin'    => 'nullable|in:Laki-laki,Perempuan',
            'address'          => 'nullable|string',
            'parent_name'      => 'nullable|string|max:255',
            'parent_phone'     => 'nullable|string|max:20',
            'hobby'            => 'nullable|string|max:255',
            'favorite_subject' => 'nullable|string|max:255',
            'instagram'        => 'nullable|string|max:255',
            'tiktok'           => 'nullable|string|max:255',
        ]);

        // Menyusun data pembaruan
        $data = [
            'name'             => $request->name,
            'email'            => $request->email,
            'school'           => $request->school,
            'phone'            => $request->phone,
            'tanggal_lahir'    => $request->tanggal_lahir,
            'jenis_kelamin'    => $request->jenis_kelamin,
            'address'          => $request->address,
            'parent_name'      => $request->parent_name,
            'parent_phone'     => $request->parent_phone,
            'hobby'            => $request->hobby,
            'favorite_subject' => $request->favorite_subject,
            'instagram'        => $request->instagram,
            'tiktok'           => $request->tiktok,
        ];

        // Update password baru hanya jika kolom password diisi oleh admin
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $siswa->update($data);

        // Kembali ke halaman daftar siswa per kelas sebelumnya dengan flash message sukses
        return redirect()->route('admin.siswa.show', $siswa->kelas->slug)
                         ->with('success', "Data siswa {$siswa->name} berhasil diperbarui!");
    }


    public function kirimUndanganNaikKelas(Request $request, $kelas_id)
    {
        $kelasSekarang = Kelas::findOrFail($kelas_id);
        
        if (!$kelasSekarang->next_class_id) {
            return back()->with('error', 'Kelas ini tidak memiliki tujuan kenaikan (mungkin kelas akhir).');
        }
    
        $semuaSiswa = User::where('kelas_id', $kelas_id)
                        ->where('role', 'siswa')
                        ->where('status', 'accepted')
                        ->get();

        $count = 0;
        foreach ($semuaSiswa as $siswa) {
            $sudahAda = Inbox::where('user_id', $siswa->id)
                            ->where('type', 'promotion')
                            ->where('is_confirmed', false)
                            ->exists();

            if (!$sudahAda) {
                Inbox::create([
                    'user_id' => $siswa->id,
                    'title'   => 'Konfirmasi Kenaikan Kelas',
                    'message' => "Halo {$siswa->name}, Admin mengundang kamu untuk naik ke kelas selanjutnya. Silakan klik konfirmasi.",
                    'type'    => 'promotion',
                    'target_class_id' => $kelasSekarang->next_class_id,
                ]);
                $count++;
            }
        }

        return back()->with('success', "Berhasil! $count undangan kenaikan kelas telah dikirim.");
    }

    public function naikKelas($id)
    {
        $user = User::findOrFail($id);
        $kelasSekarang = $user->kelas;

        if ($kelasSekarang && $kelasSekarang->next_class_id) {
            $user->update(['kelas_id' => $kelasSekarang->next_class_id]);
            return back()->with('success', "Selamat! {$user->name} berhasil naik kelas.");
        }

        return back()->with('error', 'Gagal! Kelas tujuan belum diatur.');
    }

    public function verifikasiSiswa()
    {
        $today = Carbon::today();
        $siswas = User::where('role', 'siswa')->where('status', 'pending')->get();

        $diterimaHariIni = User::where('status', 'accepted')->whereDate('updated_at', $today)->count();
        $ditolakHariIni = User::where('status', 'rejected')->whereDate('updated_at', $today)->count();

        return view('admin.verifikasi', compact('siswas', 'diterimaHariIni', 'ditolakHariIni'));
    }



    public function updateStatus(Request $request, User $user)
    {
        $request->validate(['status' => 'required|in:accepted,rejected']);
        $user->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', "Status siswa {$user->name} telah diperbarui.");
    }

    public function readInbox($id)
    {
        // 1. Cari pesan berdasarkan ID dan pastikan itu milik Admin yang sedang login
        $message = Inbox::where('user_id', Auth::id())->findOrFail($id);
        
        // 2. Tandai sudah dibaca
        $message->update(['is_read' => true]);

        // 3. LOGIKA PINDAH HALAMAN
        // Jika pesan adalah permintaan re-aktivasi atau pendaftaran baru, arahkan ke halaman verifikasi
        if ($message->type === 'request' || $message->type === 'registration') {
            return redirect()->route('admin.verifikasi')->with('success', 'Pesan dibaca. Silakan proses verifikasi siswa.');
        }

        // Kalau pesan tipe lain, tetap di halaman inbox tapi kasih notif sukses
        return back()->with('success', 'Pesan telah ditandai sebagai dibaca.');
    }

    public function pengajar()
    {
        $pengajar = User::where('role', 'pengajar')->get();
        return view('admin.pengajar.pengajar', compact('pengajar'));
    }

    public function createPengajar()
    {
        // Ubah dari $mapel menjadi $mapels agar sesuai dengan di Blade
        $mapels = Mapel::all();

        return view('admin.pengajar.create', compact('mapels'));
    }

    public function storePengajar(Request $request)
    {
        $request->validate([
            'nip'            => 'required|unique:users,nip',
            'name'           => 'required',
            'email'          => 'required|email|unique:users,email',
            'password'       => 'required|min:6',
            'mata_pelajaran' => 'required|array',
        ]);

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
            'mata_pelajaran' => implode(', ', $request->mata_pelajaran), 
        ]);

        return redirect()->route('admin.pengajar')->with('success', 'Pengajar berhasil ditambahkan!');
    }

    public function editPengajar($id)
    {
        $pengajar = User::where('role', 'pengajar')->findOrFail($id);
        $mapels = Mapel::all();

        return view('admin.pengajar.edit', compact('pengajar', 'mapels'));
    }

    public function updatePengajar(Request $request, $id)
    {
        $pengajar = User::where('role', 'pengajar')->findOrFail($id);

        $request->validate([
            'nip'            => 'required|unique:users,nip,' . $id,
            'name'           => 'required',
            'email'          => 'required|email|unique:users,email,' . $id,
            'password'       => 'nullable|min:6', // Boleh kosong kalau nggak mau ganti password
            'mata_pelajaran' => 'required|array',
        ]);

        $data = [
            'name'           => $request->name,
            'email'          => $request->email,
            'nip'            => $request->nip,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => implode(', ', $request->mata_pelajaran),
        ];

        // Enkripsi password baru hanya jika kolom password diisi
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $pengajar->update($data);

        return redirect()->route('admin.pengajar')->with('success', 'Data pengajar berhasil diperbarui!');
    }

    public function destroyPengajar($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.pengajar')->with('success', 'Data berhasil dihapus');
    }

    public function lulus($id) {
        User::findOrFail($id)->update(['status' => 'alumni']);
        return back()->with('success', "Siswa telah lulus.");
    }

    public function berhenti($id) {
        User::findOrFail($id)->update(['status' => 'inactive']);
        return back()->with('success', "Siswa telah berhenti.");
    }
}