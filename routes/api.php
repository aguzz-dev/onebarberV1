<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::post('/register', [AuthController::class, 'register'])
    ->name('user.register');

Route::post('/login', [AuthController::class, 'login'])
    ->name('user.login');

Route::middleware(['auth:sanctum'])->group(function (){

    Route::get('/user-profile', [AuthController::class, 'userProfile'])
        ->name('user.profile');
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('user.logout');
});

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
    ->name('user.reset-password')->middleware(['auth:sanctum']);
Route::post('/forgot-password', [ResetPasswordController::class, 'sendLinkResetPassword'])
    ->name('user.forgot-password');
Route::post('/reset-password-mail', [ResetPasswordController::class, 'resetPasswordFromMail'])
    ->name('user.reset-password-mail');
