<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('admin', AdminController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

Route::resource('resources', ResourceController::class)
    ->only(['index', 'store', 'destroy'])
    ->middleware(['auth']);

Route::resource('factories', FactoryController::class)
    ->only(['index', 'store', 'destroy'])
    ->middleware(['auth']);

Route::resource('dashboard', DashboardController::class)
    ->only(['index', 'store'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
