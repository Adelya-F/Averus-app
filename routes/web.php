<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;

// Landing page / redirect berdasarkan role
Route::get('/', function () {
    if (Auth::check()) {
        switch (Auth::user()->role) {
            case 'admin': return redirect()->route('admin.dashboard');
            case 'pengajar': return redirect()->route('pengajar.dashboard');
            case 'siswa': return redirect()->route('siswa.dashboard');
        }
    }
    return view('dashboard');
})->name('home');

// =====================================
// PROFILE & GENERAL ROUTES
// =====================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});

// =====================================
// ADMIN ROUTES
// =====================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Pengajar, Mapel, Jadwal
    Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar');
    Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
    Route::post('/pengajar/store', [AdminController::class, 'storePengajar'])->name('pengajar.store');
    Route::get('/pengajar/{id}/edit', [AdminController::class, 'editPengajar'])->name('pengajar.edit');
    Route::put('/pengajar/{id}', [AdminController::class, 'updatePengajar'])->name('pengajar.update');
    Route::delete('/pengajar/{id}', [AdminController::class, 'destroyPengajar'])->name('pengajar.destroy');

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
    Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');

    Route::resource('jadwal', JadwalController::class);

    // Verifikasi & Inbox Admin
    Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
    Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');
    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
    Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');

    // Manajemen Siswa & Kelas
    Route::get('/siswa', [AdminController::class, 'indexKelas'])->name('siswa.index');
    Route::get('/siswa/kelas/{slug}', [AdminController::class, 'showSiswaPerKelas'])->name('siswa.show');
    Route::post('/siswa/naik/{id}', [AdminController::class, 'naikKelas'])->name('siswa.naik-kelas');
    Route::post('/siswa/lulus/{id}', [AdminController::class, 'lulus'])->name('siswa.lulus');
    Route::post('/siswa/berhenti/{id}', [AdminController::class, 'berhenti'])->name('siswa.berhenti');
    Route::post('/siswa/store-direct', [AdminController::class, 'storeSiswa'])->name('siswa.store-direct');
    Route::put('/siswa/update-direct/{id}', [AdminController::class, 'updateSiswa'])->name('siswa.update-direct');

    // Manajemen Master Kelas & Undangan
    Route::get('/kelas-management', [KelasController::class, 'index'])->name('kelas.index');
    Route::post('/kelas-management', [KelasController::class, 'store'])->name('kelas.store');
    Route::delete('/kelas-management/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    Route::post('/siswa/kirim-undangan-naik/{kelas_id}', [AdminController::class, 'kirimUndanganNaikKelas'])->name('siswa.kirim-undangan');
});

// =====================================
// SISWA ROUTES
// =====================================
Route::middleware(['auth','role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    
    // 1. Halaman Reaktivasi
    Route::get('/reaktivasi', [SiswaController::class, 'showReaktivasi'])->name('reaktivasi.index');
    Route::post('/reaktivasi/ajukan', [SiswaController::class, 'ajukanReaktivasi'])->name('reaktivasi.ajukan');

    // 2. Inbox & Konfirmasi
    Route::get('/inbox', [SiswaController::class, 'inbox'])->name('inbox');
    Route::post('/inbox/konfirmasi/{id}', [SiswaController::class, 'konfirmasiKenaikan'])->name('inbox.konfirmasi');
    Route::post('/inbox/berhenti/{id}', [SiswaController::class, 'berhenti'])->name('inbox.berhenti');

    // 3. Halaman yang Butuh Status 'Accepted/Active'
    Route::middleware(['check.status'])->group(function () {
        Route::get('/', [SiswaController::class, 'index'])->name('dashboard');
        Route::get('/absen', function () { return view('siswa.absen'); })->name('absen');
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    });
});

// =====================================
// PENGAJAR ROUTES
// =====================================
Route::middleware(['auth','role:pengajar'])->prefix('pengajar')->name('pengajar.')->group(function () {
    Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
});

require __DIR__.'/auth.php';