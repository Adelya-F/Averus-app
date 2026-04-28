<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelasController extends Controller
{
    // Tampilkan daftar kelas
    public function index()
    {
        // Tambahkan with('nextClass') agar relasi ter-load dengan efisien
        $all_kelas = Kelas::with('nextClass')->withCount('users')->get();
        return view('admin.kelas.index', compact('all_kelas'));
    }

    // Simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas',
            'next_class_id' => 'nullable|exists:kelas,id' // Validasi ID kelas tujuan
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'slug' => Str::slug($request->nama_kelas),
            'next_class_id' => $request->next_class_id // Simpan alur kenaikannya
        ]);

        return back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Hapus kelas
    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        
        // Opsional: Cek apakah kelas ini sedang dijadikan "target" oleh kelas lain
        // Biar alur kenaikan kelas klien tidak rusak saat ada kelas yang dihapus
        Kelas::where('next_class_id', $id)->update(['next_class_id' => null]);

        $kelas->delete();

        return back()->with('success', 'Kelas berhasil dihapus!');
    }
}