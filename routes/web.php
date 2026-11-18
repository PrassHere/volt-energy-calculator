<?php

use App\Http\Controllers\KalkulasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PerangkatController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiwayatController;

Route::redirect('/', '/login');
Route::middleware(['guest', 'nocache'])->group(function () {
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.process');

    Route::get('/registrasi', [PageController::class, 'registrasi'])->name('registrasi');
    Route::post('/registrasi', [UserController::class, 'register'])->name('registrasi.process');
});

Route::middleware(['auth','nocache'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Profil user
    Route::get('/profil', [ProfilController::class, 'show'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

    // Halaman utama
    Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');
    

    // Halaman fitur
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [PageController::class, 'analytics'])->name('analytics');
    Route::get('/eco-tips', [PageController::class, 'ecoTips'])->name('eco-tips');
    Route::get('/add-device', [PageController::class, 'addDevice'])->name('add-device');
    Route::post('/add-device', [PerangkatController::class, 'store'])->name('add-device.store');
    Route::get('/add-device/reset', [PerangkatController::class, 'reset'])->name('add-device.reset');
    Route::post('/kalkulasi/hitung', [KalkulasiController::class, 'hitung'])->name('kalkulasi.hitung');
    Route::post('/kalkulasi/simpan', [KalkulasiController::class, 'simpan'])->name('kalkulasi.simpan');
    Route::get('/history', [RiwayatController::class, 'index'])->name('history');
    Route::put('/history/{perangkat}', [PerangkatController::class, 'update'])->name('perangkat.update');
    Route::delete('/history/{perangkat}', [PerangkatController::class, 'destroy'])->name('perangkat.destroy');
    
    
});

// Gambar foto profil: di luar grup 'nocache' agar boleh di-cache browser
Route::get('/profil/foto', [ProfilController::class, 'foto'])
    ->middleware('auth')
    ->name('profil.foto');