<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\absenController;
use App\Http\Controllers\dataGuruController;
use App\Http\Controllers\tmpUidController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'Test'], 200);
});

Route::get('/absen', [absenController::class, 'absen']);
Route::get('/kirim-uid', [tmpUidController::class, 'kirimUid']);
Route::get('/cek-uid', [dataGuruController::class, 'cekUid']);
// Route::get('/jam', [GuruController::class, 'getJam']);