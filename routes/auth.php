<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;

use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Hero');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::post('password/request-reset', [PasswordResetController::class, 'requestPasswordReset'])->name('password.request-reset');
Route::post('password/reset', [PasswordResetController::class, 'resetPassword'])->name('password.reset');
Route::post('password', [PasswordResetController::class, 'changePassword'])->name('password.change');

