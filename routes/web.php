<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\EditRoomController;
use App\Http\Controllers\SelectRoomController;
use App\Http\Controllers\EditMeetingController;
use App\Http\Controllers\NotificationController;

Route::middleware('auth')->group(function () {
    //profile page route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //dashboard page route
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/page', [MeetingController::class, 'index'])->name('page');
    Route::post('/page', [MeetingController::class, 'store'])->name('page.store');
    Route::put('/page', [MeetingController::class, 'update'])->name('page.update');
    
    Route::get('/select-room', [SelectRoomController::class, 'index'])->name('selectRoom');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::patch('/notifications/update-seen/{id}', [NotificationController::class, 'isSeen'])->name('mark-as-read');

    //meeting page route
    Route::get('/meetingDetails/{id}', [EditMeetingController::class, 'edit'])->name('meetingDetails.edit');
    Route::put('/meetingDetails/{id}', [EditMeetingController::class, 'update'])->name('meetingDetails.update');
    Route::patch('/meetingDetails/{id}', [EditMeetingController::class, 'activation'])->name('meetingDetails.activation');

    //members page route
    Route::get('/members', [MembersController::class, 'index'])->name('members');
    Route::post('/members', [MembersController::class, 'store'])->name('members.store');

    //rooms page route
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
    Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');

    //room details page route
    Route::get('/roomDetails/{id}', [EditRoomController::class, 'edit'])->name('roomDetails.edit');
    Route::put('/roomDetails/{id}', [EditRoomController::class, 'update'])->name('roomDetails.update');
    Route::patch('/roomDetails/{id}', [EditRoomController::class, 'activation'])->name('roomDetails.activation');

    //user page route
    Route::get('/user/{id}', [EditUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [EditUserController::class, 'update'])->name('user.update');
    Route::patch('/user/{id}', [EditUserController::class, 'activation'])->name('user.activation');
});
require __DIR__ . '/auth.php';
