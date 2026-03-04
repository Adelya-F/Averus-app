<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Models\User;

Route::get('/', function () {
    return view('dashboard'); // ini dashboard umum
})->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration-status', function () {
        return view('siswa.status');
    })->name('registration.status');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pengajar', [AdminController::class, 'pengajar'])->name('admin.pengajar');
    Route::get('/admin/pengajar/create', [AdminController::class, 'createPengajar'])->name('admin.pengajar.create');
    Route::post('/admin/pengajar/store', [AdminController::class, 'storePengajar'])->name('admin.pengajar.store');
    // Halaman daftar pendaftar
    Route::get('/admin/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('admin.verifikasi');

    // Proses Accept & Reject
    Route::patch('/admin/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('admin.verifikasi.update');
});


    Route::middleware(['auth', 'role:siswa'])->group(function () {

    Route::get('/siswa', function () {
        $user = Auth::user();

        if ($user->status !== 'accepted') {
            return redirect()->route('registration.status');
        }

        return view('siswa.dashboard');
    })->name('siswa.dashboard');

    Route::get('/siswa/absen', function () {
        $user = Auth::user();

        if ($user->status !== 'accepted') {
            return redirect()->route('registration.status');
        }

        return view('siswa.absen');
    })->name('siswa.absen');

    Route::get('/siswa/jadwal', function () {
        $user = Auth::user();

        if ($user->status !== 'accepted') {
            return redirect()->route('registration.status');
        }

        return view('siswa.jadwal');
    })->name('siswa.jadwal');

});
require __DIR__.'/auth.php';