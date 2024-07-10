<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\LogGuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dataGuruController;
use App\Http\Controllers\dataSatpamController;
use App\Http\Controllers\dataAbsenGuruController;
use App\Http\Controllers\dataTataUsahaController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\dataAbsenSatpamController;
use App\Http\Controllers\dataAbsenTataUsahaController;
use App\Http\Controllers\LogSatpamController;
use App\Http\Controllers\LogTataUsahaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Guru
Route::resource('data-guru', dataGuruController::class)->name('data-guru.index', 'data-guru');
Route::get('/data-absen-guru', [dataAbsenGuruController::class, 'index'])->name('data-absen-guru');
Route::resource('log-guru', LogGuruController::class)->name('log-guru.index', 'log-guru');
// Route::get('/data-guru', [dataGuruController::class, 'index'])->name('data-guru');
// Log Guru
Route::get('/log-guru', [LogGuruController::class, 'index'])->name('log-guru.index');
Route::post('/log-guru/set-kehadiran', [LogGuruController::class, 'setKehadiran'])->name('log-guru.setKehadiran');

// Tata Usaha
Route::resource('/data-tata-usaha', dataTataUsahaController::class)->name('data-tata-usaha.index', 'data-tata-usaha');
Route::get('/data-absen-tata-usaha', [dataAbsenTataUsahaController::class, 'index'])->name('data-absen-tata-usaha');
Route::get('/log-tata-usaha', [LogTataUsahaController::class, 'index'])->name('log-tata-usaha.index');
Route::post('/log-tata-usaha/set-kehadiran', [LogTataUsahaController::class, 'setKehadiran'])->name('log-tata-usaha.setKehadiran');

// Satpam
Route::resource('/data-satpam', dataSatpamController::class)->name('data-satpam.index', 'data-satpam');
Route::get('/data-absen-satpam', [dataAbsenSatpamController::class, 'index'])->name('data-absen-satpam');
Route::get('/log-satpam', [LogSatpamController::class, 'index'])->name('log-satpam.index');
Route::post('/log-satpam/set-kehadiran', [LogSatpamController::class, 'setKehadiran'])->name('log-satpam.setKehadiran');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
