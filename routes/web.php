<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/page', [MeetingController::class, 'index'])->name('page');
    Route::get('/members', function () {
        return view('members');
    })->name('members');
    Route::get('/rooms', function () {
        return view('rooms');
    })->name('rooms');
    Route::get('/user', function () {
        return view('user');
    })->name('user');
    
});

require __DIR__ . '/auth.php';
