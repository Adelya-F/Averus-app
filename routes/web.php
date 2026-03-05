<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\SiswaController;
use App\Models\User;

Route::get('/', function () {
    return view('dashboard'); // dashboard umum
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

    // Verifikasi siswa
    Route::get('/admin/verifikasi', [AdminController::class, 'verifikasiSiswa'])->name('admin.verifikasi');
    Route::patch('/admin/verifikasi/{user}/update', [AdminController::class, 'updateStatus'])->name('admin.verifikasi.update');

    // Inbox
    Route::get('/admin/inbox', [AdminController::class, 'inbox'])->name('admin.inbox');
    Route::get('/admin/inbox/read/{id}', [AdminController::class, 'readInbox'])->name('admin.inbox.read');

});


Route::middleware(['auth', 'role:siswa', 'check.status'])->group(function () {

    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.dashboard');

    Route::get('/siswa/absen', function () {
        return view('siswa.absen');
    })->name('siswa.absen');

    Route::get('/siswa/jadwal', function () {
        return view('siswa.jadwal');
    })->name('siswa.jadwal');

});

Route::middleware(['auth','role:pengajar'])
    ->prefix('pengajar')
    ->name('pengajar.')
    ->group(function () {

        Route::get('/dashboard', [PengajarController::class, 'dashboard'])
            ->name('dashboard');

});


require __DIR__.'/auth.php';