<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RideController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\VerifiedUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// MAIN RIDE BOARD (Uses 'dashboard' URL but acts as Ride Board)
Route::get('/dashboard', [RideController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    // RIDE ACTIONS (Create, Store, Delete)
    Route::middleware(VerifiedUser::class)->group(function () {
        Route::get('/rides/create', [RideController::class, 'create'])->name('rides.create');
        Route::post('/rides', [RideController::class, 'store'])->name('rides.store');
        Route::delete('/rides/{ride}', [RideController::class, 'destroy'])->name('rides.destroy');
    });

    // ADMIN ACTIONS
    Route::middleware(IsAdmin::class)->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::patch('/admin/users/{user}/verify', [AdminController::class, 'verify'])->name('admin.verify');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.delete');
    });

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
