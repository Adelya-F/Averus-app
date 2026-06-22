<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;

// Absensi
use App\Http\Controllers\AbsensiController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pengajar' => redirect()->route('pengajar.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => view('dashboard'),
        };
    }

    return view('dashboard');
})->name('home');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // ====================
        // PENGAJAR
        // ====================
        Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar.index');
        Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
        Route::post('/pengajar', [AdminController::class, 'storePengajar'])->name('pengajar.store');
        Route::get('/pengajar/{id}/edit', [AdminController::class, 'editPengajar'])->name('pengajar.edit');
        Route::put('/pengajar/{id}', [AdminController::class, 'updatePengajar'])->name('pengajar.update');
        Route::delete('/pengajar/{id}', [AdminController::class, 'destroyPengajar'])->name('pengajar.destroy');

        // ====================
        // MAPEL
        // ====================
        Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
        Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
        Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');

        // ====================
        // JADWAL
        // ====================
        Route::resource('jadwal', JadwalController::class);

        // ====================
        // VERIFIKASI
        // ====================
        Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
        Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');

        // ====================
        // INBOX
        // ====================
        Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
        Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');

        // ====================
        // SISWA
        // ====================
        Route::get('/siswa', [AdminController::class, 'indexKelas'])->name('siswa.index');
        Route::get('/siswa/kelas/{slug}', [AdminController::class, 'showSiswaPerKelas'])->name('siswa.show');

        Route::post('/siswa/naik/{id}', [AdminController::class, 'naikKelas'])->name('siswa.naik-kelas');
        Route::post('/siswa/lulus/{id}', [AdminController::class, 'lulus'])->name('siswa.lulus');
        Route::post('/siswa/berhenti/{id}', [AdminController::class, 'berhenti'])->name('siswa.berhenti');

        Route::post('/siswa/store-direct', [AdminController::class, 'storeSiswa'])->name('siswa.store-direct');

        Route::get('/siswa/{id}/edit', [AdminController::class, 'editSiswa'])->name('siswa.edit');
        Route::put('/siswa/update-direct/{id}', [AdminController::class, 'updateSiswa'])->name('siswa.update-direct');

        Route::post('/siswa/kirim-undangan-naik/{kelas_id}', [AdminController::class, 'kirimUndanganNaikKelas'])
            ->name('siswa.kirim-undangan');

        // ====================
        // KELAS
        // ====================
        Route::get('/kelas-management', [KelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas-management', [KelasController::class, 'store'])->name('kelas.store');
        Route::delete('/kelas-management/{id}', [KelasController::class, 'destroy'])->name('kelas.destroy');
    });

/*
|--------------------------------------------------------------------------
| SISWA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/', [SiswaController::class, 'index'])->name('dashboard');

        // ABSENSI
        Route::get('/absen', [AbsensiController::class, 'index'])->name('absen');
        Route::post('/absen', [AbsensiController::class, 'store'])->name('absen.store');

        // JADWAL
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');

        // INBOX
        Route::get('/inbox', [SiswaController::class, 'inbox'])->name('inbox');
        Route::post('/inbox/konfirmasi/{id}', [SiswaController::class, 'konfirmasiKenaikan'])->name('inbox.konfirmasi');
        Route::post('/inbox/berhenti/{id}', [SiswaController::class, 'berhenti'])->name('inbox.berhenti');

        // REAKTIVASI
        Route::get('/reaktivasi', [SiswaController::class, 'showReaktivasi'])->name('reaktivasi.index');
        Route::post('/reaktivasi/ajukan', [SiswaController::class, 'ajukanReaktivasi'])->name('reaktivasi.ajukan');
    });

/*
|--------------------------------------------------------------------------
| PENGAJAR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pengajar'])
    ->prefix('pengajar')
    ->name('pengajar.')
    ->group(function () {

        Route::get('/dashboard', [PengajarController::class, 'dashboard'])
            ->name('dashboard');

        // JADWAL
        Route::get('/jadwal', [JadwalController::class, 'index'])
            ->name('jadwal');

        // ABSENSI PENGAJAR
        // PERHATIAN: cek dulu apakah AbsensiController sudah punya method
        // pengajarIndex() dan pengajarStore() sebelum route ini diakses,
        // kalau belum ada akan error "Method does not exist".
        Route::get('/absensi', [AbsensiController::class, 'pengajarIndex'])
            ->name('absensi');

        Route::post('/absensi', [AbsensiController::class, 'pengajarStore'])
            ->name('absensi.store');
    });

require __DIR__.'/auth.php';