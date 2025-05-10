<?php

use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\PegawaiControllerller;
use App\Http\Controllers\RuangControllerller;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\RuangController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unit-kerja', [UnitKerjaController::class, 'index']);
Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/ruang', [RuangController::class, 'index']);
Route::get('/peminjaman', [PeminjamanController::class, 'index']);