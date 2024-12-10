<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::patch('/profile', [ProfileController::class, 'update']);


Route::get('/dashboard', [RegisteredUserController::class, 'index'])->name('user.dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::inertia('/', 'Hero');
});

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::post('password/request-reset', [PasswordResetController::class, 'requestPasswordReset'])->name('password.request-reset');
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset');
Route::post('password', [PasswordResetController::class, 'changePassword'])->name('password.change');
