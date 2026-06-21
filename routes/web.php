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
use App\Http\Controllers\AbsensiController; // siswa
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
// PROFILE
// =====================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// =====================================
// ADMIN
// =====================================
Route::middleware(['auth','role:admin'])
->prefix('admin')
->name('admin.')
->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // ===== PENGAJAR =====
    Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar.index');
    Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
    Route::post('/pengajar', [AdminController::class, 'storePengajar'])->name('pengajar.store');
    Route::get('/pengajar/{id}/edit', [AdminController::class, 'editPengajar'])->name('pengajar.edit');
    Route::put('/pengajar/{id}', [AdminController::class, 'updatePengajar'])->name('pengajar.update');
    Route::delete('/pengajar/{id}', [AdminController::class, 'destroyPengajar'])->name('pengajar.destroy');

    // ===== MAPEL =====
    Route::prefix('mapel')->name('mapel.')->group(function () {
        Route::get('/', [MapelController::class, 'index'])->name('index');
        Route::post('/', [MapelController::class, 'store'])->name('store');
        Route::delete('/{id}', [MapelController::class, 'destroy'])->name('destroy');
    });

    // ===== JADWAL =====
    Route::resource('jadwal', JadwalController::class);

    // ===== ABSENSI ADMIN =====
    Route::prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', [AdminAbsensiController::class, 'index'])->name('index');
        Route::post('/store', [AdminAbsensiController::class, 'store'])->name('store');
    });

    // ===== SISWA =====
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/', [AdminController::class, 'indexKelas'])->name('index');
        Route::get('/kelas/{slug}', [AdminController::class, 'showSiswaPerKelas'])->name('show');

        Route::post('/naik/{id}', [AdminController::class, 'naikKelas'])->name('naik');
        Route::post('/lulus/{id}', [AdminController::class, 'lulus'])->name('lulus');
        Route::post('/berhenti/{id}', [AdminController::class, 'berhenti'])->name('berhenti');
    });

    // ===== KELAS =====
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [KelasController::class, 'index'])->name('index');
        Route::post('/', [KelasController::class, 'store'])->name('store');
        Route::delete('/{id}', [KelasController::class, 'destroy'])->name('destroy');
    });

    // ===== INBOX ADMIN =====
    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
});


// =====================================
// SISWA
// =====================================
Route::middleware(['auth','role:siswa'])
->prefix('siswa')
->name('siswa.')
->group(function () {

    Route::get('/', [SiswaController::class, 'index'])->name('dashboard');

    // ✅ ABSEN (tanggal & jam otomatis)
    Route::get('/absen', [AbsensiController::class, 'index'])->name('absen');
    Route::post('/absen', [AbsensiController::class, 'store'])->name('absen.store');

    // ✅ JADWAL
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');

    // ✅ FIX ERROR (INI YANG TADI HILANG)
    Route::get('/inbox', [SiswaController::class, 'inbox'])->name('inbox');
});


// =====================================
// PENGAJAR
// =====================================
Route::middleware(['auth','role:pengajar'])
->prefix('pengajar')
->name('pengajar.')
->group(function () {

    Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
});


require __DIR__.'/auth.php';