<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ipkController;

// Route untuk form login dan proses login
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard
Route::get('admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('user/dashboard', [DashboardController::class, 'user'])->name('dashboard.user');


Route::get('/user/ipk', [ipkController::class, 'showIPK'])->name('siswa.ipk');
Route::get('/user/prodi', [ipkController::class, 'prodiIPK'])->name('siswa.prodi');
Route::get('/user/angkatan', [ipkController::class, 'angkatanIPK'])->name('siswa.angkatan');

