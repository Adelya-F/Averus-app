<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel; // Pastikan ini di-import

class MapelController extends Controller
{
    public function index()
    {
        // Mengambil semua data mapel untuk ditampilkan di tabel
        $mapels = Mapel::all();
        return view('admin.mapel.index', compact('mapels'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|unique:mapels,nama_mapel'
        ]);

        // Simpan ke database
        Mapel::create([
            'nama_mapel' => $request->nama_mapel
        ]);

        // Balik ke halaman tadi dengan pesan sukses
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus!');
    }
}