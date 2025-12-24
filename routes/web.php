<?php

use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\KeluargaKKController;
use App\Http\Controllers\KematianController;
use App\Http\Controllers\PindahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use Illuminate\Support\Facades\Route;

// Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Register
Route::get('/register', [UserController::class, 'create'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.post');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// dashboard
Route::get('/', [DashboardController::class, 'index'])->name('pages.dashboard.index');

// Warga

Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');


Route::get('/warga/create', [WargaController::class, 'create'])->name('pages.warga.create');


Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');

Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('pages.warga.edit');
Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');


Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

// Keluarga
Route::resource('keluarga', KeluargaKKController::class);


Route::get('keluarga/{keluarga}/edit', [KeluargaKKController::class, 'edit'])->name('keluarga.edit');

// Anggota Keluarga

Route::get('/anggota/{kk}', [AnggotaKeluargaController::class, 'index'])->name('anggota.index');


Route::get('/anggota/{kk}/create', [AnggotaKeluargaController::class, 'create'])->name('anggota.create');


Route::post('/anggota/{kk}/store', [AnggotaKeluargaController::class, 'store'])->name('anggota.store');

Route::get('/anggota/{anggota}/edit', [AnggotaKeluargaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{anggota}/update', [AnggotaKeluargaController::class, 'update'])->name('anggota.update');


Route::delete('/anggota/{anggota}', [AnggotaKeluargaController::class, 'destroy'])->name('anggota.destroy');

// User
// Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
// Route::post('/user', [UserController::class, 'store'])->name('user.store');
// Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
// Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
// Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

// tentang kami
Route::get('/tentang-kami', function () {
    return view('pages.about');
})->name('pages.about');

//kelahiran
// HAPUS FILE
Route::delete('/kelahiran/hapus-foto/{media_id}',
    [KelahiranController::class, 'hapusFoto']
)->name('kelahiran.hapusFoto');

// web.php

Route::resource('kelahiran', KelahiranController::class);

/// PREVIEW FILE LANGSUNG TAMPIL DI TAB YANG SAMA

// DOWNLOAD FILE
Route::get('/kelahiran/file/{id}/download', [KelahiranController::class, 'downloadFile'])
    ->name('kelahiran.downloadFile');

// PROFIL SENDIRI (SEMUA USER LOGIN BOLEH)
Route::get('/profil', [UserController::class, 'editProfile'])->name('user.profile.edit');
Route::put('/profil', [UserController::class, 'updateProfile'])->name('user.profile.update');
Route::delete('/profil/hapus-foto', [UserController::class, 'deleteOwnPhoto'])
    ->name('user.profile.photo.delete');

// User (KHUSUS SUPER-ADMIN)
Route::middleware('checkrole:super-admin')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
    // 🔥 HAPUS FOTO PROFIL USER
    Route::delete('/user/{user}/hapus-foto', [UserController::class, 'deletePhoto'])
        ->name('user.photo.delete');
});

// Kematian
Route::delete('/kematian/hapus-foto/{media_id}',
    [KematianController::class, 'hapusFoto']
)->name('kematian.hapusFoto');

Route::resource('kematian', KematianController::class);

Route::get('/kematian/file/{id}/download', [KematianController::class, 'downloadFile'])
    ->name('kematian.downloadFile');

Route::get('/kematian/file/{id}/preview', [KematianController::class, 'previewFile'])
    ->name('kematian.previewFile');

// PINDAH
Route::delete('/pindah/hapus-foto/{media_id}', [PindahController::class, 'hapusFoto'])
    ->name('pindah.hapusFoto');

Route::resource('pindah', PindahController::class);

Route::get('/pindah/file/{id}/preview', [PindahController::class, 'previewFile'])
    ->name('pindah.previewFile');

Route::get('/pindah/file/{id}/download', [PindahController::class, 'downloadFile'])
    ->name('pindah.downloadFile');
