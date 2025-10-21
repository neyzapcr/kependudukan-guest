<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeluargaKKController;
use App\Http\Controllers\TambahDataController;
use App\Http\Controllers\AnggotaKeluargaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get ('/keluarga', [KeluargaKKController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'index'])->name('login.form');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::resource('tambah-data', TambahDataController::class)->except(['index', 'show']);

Route::get('/tambah-data', function () {
    if (!session('is_logged_in')) {
        return redirect()->route('login.form')->with('error', 'Silakan login terlebih dahulu!');
    }
    return view('tambah-data.create');
})->name('tambah.data');

Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');

Route::resource('keluarga', KeluargaKKController::class);

Route::get('/keluarga/{kk}/anggota', [KeluargaKKController::class, 'showAnggota'])->name('keluarga.anggota');

Route::get('/keluarga/{id}/anggota', [AnggotaKeluargaController::class, 'index'])->name('keluarga.anggota');
Route::get('/keluarga/{id}/anggota/{anggota_id}/edit', [AnggotaKeluargaController::class, 'edit'])->name('keluarga.anggota.edit');
Route::put('/keluarga/{id}/anggota/{anggota_id}', [AnggotaKeluargaController::class, 'update'])->name('keluarga.anggota.update');
Route::delete('/keluarga/{id}/anggota/{anggota_id}', [AnggotaKeluargaController::class, 'destroy'])->name('keluarga.anggota.destroy');

Route::put('/keluarga/{id}/anggota/{anggota_id}', [AnggotaKeluargaController::class, 'update'])
    ->name('keluarga.anggota.update');

    Route::delete('/keluarga/{kk_id}/anggota/{warga_id}', [AnggotaKeluargaController::class, 'destroy'])
     ->name('keluarga.anggota.destroy');

Route::resource('keluarga.anggota', AnggotaKeluargaController::class)
    ->only(['index', 'edit', 'update', 'destroy']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
