<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;

// Absensi
use App\Http\Controllers\AbsensiController; // Siswa
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;

// =====================================
// LANDING
// =====================================
Route::get('/', function () {
    if (Auth::check()) {
        return match (Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'pengajar' => redirect()->route('pengajar.dashboard'),
            'siswa' => redirect()->route('siswa.dashboard'),
            default => view('dashboard')
        };
    }
    return view('dashboard');
})->name('home');


// =====================================
// PROFILE (UNIVERSAL AUTH)
// =====================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =====================================
// ROUTE GRUP: ADMIN
// =====================================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Utama
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // ===== 1. MANAJEMEN JADWAL =====
        Route::get('/jadwal', [AdminController::class, 'indexJadwal'])->name('jadwal.index');
        Route::get('/jadwal/create', [AdminController::class, 'createJadwal'])->name('jadwal.create');
        Route::post('/jadwal/store', [AdminController::class, 'storeJadwal'])->name('jadwal.store');
        Route::delete('/jadwal/{id}', [AdminController::class, 'destroyJadwal'])->name('jadwal.destroy');
        Route::get('/jadwal/{id}/edit', [AdminController::class, 'editJadwal'])->name('jadwal.edit');
        Route::put('/jadwal/{id}', [AdminController::class, 'updateJadwal'])->name('jadwal.update');

        // ===== 2. MANAJEMEN PENGAJAR (FIXED BY AI) =====
        Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar.index');
        Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
        // Sekarang proses store diarahkan ke PengajarController agar logika validasi & enkripsinya jalan bray
        Route::post('/pengajar', [PengajarController::class, 'store'])->name('pengajar.store');
        Route::get('/pengajar/{id}/edit', [AdminController::class, 'editPengajar'])->name('pengajar.edit');
        Route::put('/pengajar/{id}', [AdminController::class, 'updatePengajar'])->name('pengajar.update');
        Route::delete('/pengajar/{id}', [AdminController::class, 'destroyPengajar'])->name('pengajar.destroy');

        // ===== 3. MANAJEMEN MAPEL =====
        Route::prefix('mapel')->name('mapel.')->group(function () {
            Route::get('/', [MapelController::class, 'index'])->name('index');
            Route::post('/', [MapelController::class, 'store'])->name('store');
            Route::delete('/{id}', [MapelController::class, 'destroy'])->name('destroy');
        });

        // ===== 4. MANAJEMEN MASTER KELAS =====
        Route::prefix('kelas')->name('kelas.')->group(function () {
            Route::get('/', [KelasController::class, 'index'])->name('index');
            Route::post('/', [KelasController::class, 'store'])->name('store');
            Route::delete('/{id}', [KelasController::class, 'destroy'])->name('destroy');
        });

        // ===== 5. MANAJEMEN SISWA =====
        Route::prefix('siswa')->name('siswa.')->group(function () {
            Route::get('/', [AdminController::class, 'indexKelas'])->name('index');
            Route::get('/kelas/{slug}', [AdminController::class, 'showSiswaPerKelas'])->name('show');
            Route::get('/{id}/edit', [AdminController::class, 'editSiswa'])->name('edit');
            Route::post('/store-direct', [AdminController::class, 'storeSiswa'])->name('store-direct');
            Route::put('/update-direct/{id}', [AdminController::class, 'updateSiswa'])->name('update-direct');
            Route::post('/naik/{id}', [AdminController::class, 'naikKelas'])->name('naik');
            Route::post('/lulus/{id}', [AdminController::class, 'lulus'])->name('lulus');
            Route::post('/berhenti/{id}', [AdminController::class, 'berhenti'])->name('berhenti');
            Route::post('/kirim-undangan-naik/{kelas_id}', [AdminController::class, 'kirimUndanganNaikKelas'])->name('kirim-undangan');
        });

        // ===== 6. VERIFIKASI SISWA & INBOX ADMIN =====
        Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
        Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');
        Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
        Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');
    });


// =====================================
// ROUTE GRUP: SISWA
// =====================================
Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {

        Route::get('/reaktivasi', [SiswaController::class, 'showReaktivasi'])->name('reaktivasi.index');
        Route::post('/reaktivasi/ajukan', [SiswaController::class, 'ajukanReaktivasi'])->name('reaktivasi.ajukan');
        Route::get('/inbox', [SiswaController::class, 'inbox'])->name('inbox');
        Route::post('/inbox/konfirmasi/{id}', [SiswaController::class, 'konfirmasiKenaikan'])->name('inbox.konfirmasi');
        Route::post('/inbox/berhenti/{id}', [SiswaController::class, 'berhenti'])->name('inbox.berhenti');
        Route::get('/siswa/jadwal', [SiswaController::class, 'indexJadwal'])->name('siswa.jadwal.index');

        Route::middleware(['check.status'])->group(function () {
            Route::get('/', [SiswaController::class, 'index'])->name('dashboard');
            Route::get('/absen', [AbsensiController::class, 'index'])->name('absen');
            Route::post('/absen', [AbsensiController::class, 'store'])->name('absen.store');
            Route::get('/jadwal', [SiswaController::class, 'jadwalBelajar'])->name('jadwal');
        });
    });


// =====================================
// ROUTE GRUP: PENGAJAR
// =====================================
Route::middleware(['auth', 'role:pengajar'])
    ->prefix('pengajar')
    ->name('pengajar.')
    ->group(function () {

        Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
        Route::get('/jadwal', [PengajarController::class, 'indexJadwal'])->name('jadwal.index');
    });

require __DIR__.'/auth.php';