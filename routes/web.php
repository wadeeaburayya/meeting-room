<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/page', [MeetingController::class, 'index'])->name('page');
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/members', [UserController::class, 'index'])->name('members');

    Route::post('/members', [UserController::class, 'store'])->name('members.store');
    Route::get('/rooms', function () {
        return view('rooms');
    })->name('rooms');
    Route::get('/user', function () {
        return view('user');
    })->name('user');
});
require __DIR__ . '/auth.php';
