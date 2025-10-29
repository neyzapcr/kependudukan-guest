<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\KeluargaKKController;
use App\Http\Controllers\TambahDataController;
use App\Http\Controllers\AnggotaKeluargaController;

Route::get('/', function () {
    return view('welcome');
});

// ==================== AUTH ROUTES ====================
// Login Routes (HAPUS DUPLIKASI - hanya satu set route login)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register Routes menggunakan UserController
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.post');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== PUBLIC ROUTES ====================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('guest.dashboard.index');

// ==================== PROTECTED ROUTES (Manual Check Session) ====================

Route::resource('tambah-data', TambahDataController::class)->except(['index', 'show']);
Route::resource('kelahiran', KelahiranController::class)->except(['index', 'show']);
// Route::resource('kematian', KematianController::class)->except(['index', 'show']);
// Route::resource('pindah', PindahController::class)->except(['index', 'show']);

// Warga Routes
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('guest.warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('guest.warga.edit');
Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

// Keluarga Routes
Route::resource('keluarga', KeluargaKKController::class);
Route::get('keluarga/{keluarga}/edit', [KeluargaKKController::class, 'edit'])->name('keluarga.edit');

// Anggota Keluarga Routes
Route::get('/anggota/{kk}', [AnggotaKeluargaController::class, 'index'])->name('anggota.index');
Route::get('/anggota/{kk}/create', [AnggotaKeluargaController::class, 'create'])->name('anggota.create');
Route::post('/anggota/{kk}/store', [AnggotaKeluargaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{anggota}/edit', [AnggotaKeluargaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{anggota}/update', [AnggotaKeluargaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{anggota}/destroy', [AnggotaKeluargaController::class, 'destroy'])->name('anggota.destroy');

// User Management Routes
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

// ==================== FALLBACK ROUTES ====================
Route::get('/home', [HomeController::class, 'index']);
