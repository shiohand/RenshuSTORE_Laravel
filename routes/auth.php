<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest')
                ->name('register');

Route::post('/register_confirm', [RegisteredUserController::class, 'confirm'])
                ->middleware('guest')
                ->name('register.confirm');
Route::get('/register_confirm', [RegisteredUserController::class, 'confirm_get'])
                ->middleware('guest')
                ->name('register.confirm_get');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest')
                ->name('register.store');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest')
                ->name('login.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('password.request');

// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.email');

// Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('password.reset');

// Route::post('/reset-password', [NewPasswordController::class, 'store'])
//                 ->middleware('guest')
//                 ->name('password.update');

// Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
//                 ->middleware('auth')
//                 ->name('verification.notice');

// Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
//                 ->middleware(['auth', 'signed', 'throttle:6,1'])
//                 ->name('verification.verify');

// Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
//                 ->middleware(['auth', 'throttle:6,1'])
//                 ->name('verification.send');

// Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
//                 ->middleware('auth')
//                 ->name('password.confirm');

// Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
//                 ->middleware('auth');