<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsensiController;
use App\Models\Jadwal;
use App\Models\Absensi;

// Landing page
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


    // ================= PROFILE =================
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});


   // ================= ADMIN =================
   Route::middleware(['auth','role:admin'])
   ->prefix('admin')
   ->name('admin.')
   ->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // ===== PENGAJAR =====
    Route::get('/pengajar', [AdminController::class, 'pengajar'])->name('pengajar');
    Route::get('/pengajar/create', [AdminController::class, 'createPengajar'])->name('pengajar.create');
    Route::post('/pengajar/store', [AdminController::class, 'storePengajar'])->name('pengajar.store');
    Route::get('/pengajar/{id}/edit', [AdminController::class, 'editPengajar'])->name('pengajar.edit');
    Route::put('/pengajar/{id}', [AdminController::class, 'updatePengajar'])->name('pengajar.update');
    Route::delete('/pengajar/{id}', [AdminController::class, 'destroyPengajar'])->name('pengajar.destroy');

    // ===== MAPEL =====
    Route::get('/mapel', [App\Http\Controllers\MapelController::class, 'index'])->name('mapel');
    Route::post('/mapel', [App\Http\Controllers\MapelController::class, 'store'])->name('mapel.store');
    Route::delete('/mapel/{id}', [App\Http\Controllers\MapelController::class, 'destroy'])->name('mapel.destroy');

    // ===== JADWAL (CRUD) =====
    Route::resource('jadwal', JadwalController::class);

    // ===== ABSENSI (CRUD) =====
    Route::resource('absensi', AbsensiController::class);

    // ===== VERIFIKASI =====
    Route::get('/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('verifikasi');
    Route::patch('/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('verifikasi.update');

    // ===== INBOX =====
    Route::get('/inbox', [AdminController::class, 'inbox'])->name('inbox');
    Route::get('/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('inbox.read');
});


   // ================= SISWA =================
   Route::middleware(['auth','role:siswa'])
   ->prefix('siswa')
   ->name('siswa.')
   ->group(function () {

    Route::get('/', [SiswaController::class, 'index'])->name('dashboard');

    Route::middleware(['check.status'])->group(function () {

        // ABSENSI 
        Route::get('/absen', function () {
            $absensis = Absensi::all();
            return view('siswa.absen', compact('absensis'));
        })->name('absen');

        // JADWAL 
        Route::get('/jadwal', function () {
            $jadwals = Jadwal::all(); 
            return view('siswa.jadwal', compact('jadwals'));
        })->name('jadwal');

    });
});


// ================= PENGAJAR =================
Route::middleware(['auth','role:pengajar'])
->prefix('pengajar')
->name('pengajar.')
->group(function () {
    Route::get('/dashboard', [PengajarController::class, 'dashboard'])->name('dashboard');
});


// ================= AUTH =================
require __DIR__.'/auth.php';