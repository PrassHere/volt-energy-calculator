<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

//Authentication
Route::get('/', [PageController::class, 'login'])->name('login');
Route::get('/login', [PageController::class, 'login'])->name('login');
Route::get('/registrasi', [PageController::class, 'registrasi'])->name('registrasi');

// Halaman utama
Route::get('/dashboard', [PageController::class, 'index'])->name('dashboard');

// Halaman fitur
Route::get('/analytics', [PageController::class, 'analytics'])->name('analytics');
Route::get('/history', [PageController::class, 'history'])->name('history');
Route::get('/eco-tips', [PageController::class, 'ecoTips'])->name('eco-tips');
Route::get('/add-device', [PageController::class, 'addDevice'])->name('add-device');
