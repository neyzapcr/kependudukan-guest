<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluargaKKController;


Route::get('/', function () {
    return view('welcome');
});

Route::get ('/keluarga', [KeluargaKKController::class, 'index']);
