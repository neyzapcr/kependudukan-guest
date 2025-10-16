<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeluargaKKController;


Route::get('/', function () {
    return view('welcome');
});

Route::get ('/keluarga', [KeluargaKKController::class, 'index']);

Route::get('/auth', [AuthController::class, 'index']);
Route::post('/auth/login', [AuthController::class, 'login']);


Route::get('/dashboard', function () {
    $message = session('success');
    $username = session('username');
    return view('dashboard', compact('message', 'username'));
})->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');
