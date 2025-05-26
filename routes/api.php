<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\IndustriController;
use App\Http\Controllers\Api\PklController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes untuk semua entitas
Route::apiResource('guru', GuruController::class);
Route::apiResource('siswa', SiswaController::class);
Route::apiResource('industri', IndustriController::class);
Route::apiResource('pkl', PklController::class);
