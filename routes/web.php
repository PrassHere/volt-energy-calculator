<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/history', [PageController::class, 'history'])->name('history');
    Route::get('/eco-tips', [PageController::class, 'ecoTips'])->name('eco-tips');
    Route::get('/add-device', [PageController::class, 'addDevice'])->name('add-device');
    
});

// Gambar foto profil: di luar grup 'nocache' agar boleh di-cache browser
Route::get('/profil/foto', [ProfilController::class, 'foto'])
    ->middleware('auth')
    ->name('profil.foto');