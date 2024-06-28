<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\adminDashboardController;
use App\Http\Controllers\dataAbsenGuruController;
use App\Http\Controllers\dataGuruController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/data-guru', [dataGuruController::class, 'index'])->name('data-guru');
Route::resource('data-guru', dataGuruController::class)->name('data-guru.index', 'data-guru');
Route::get('/data-absen-guru', [dataAbsenGuruController::class, 'index'])->name('data-absen-guru');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
