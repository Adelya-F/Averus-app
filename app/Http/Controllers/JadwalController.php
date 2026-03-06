<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;

class JadwalController extends Controller
{
    // Tampilkan semua jadwal
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    // Form tambah jadwal
    public function create()
    {
        return view('admin.jadwal.create');
    }

    // Simpan jadwal baru
    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'mapel' => 'required',
            'pengajar' => 'required',
        ]);

        Jadwal::create($request->only(['hari','tanggal','jam','mapel','pengajar']));

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Form edit jadwal
    public function edit(Jadwal $jadwal)
    {
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    // Update jadwal
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'mapel' => 'required',
            'pengajar' => 'required',
        ]);

        $jadwal->update($request->only(['hari','tanggal','jam','mapel','pengajar']));

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diupdate');
    }

    // Hapus jadwal
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}