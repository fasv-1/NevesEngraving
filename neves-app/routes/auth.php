<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

//---------------------- Guest Acess Routes for Authentication ----------------------------------- 
Route::middleware('guest')->group(function () {

  //---------------------- Register Page -------------------------------------------
  Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

  //---------------------- Registarion --------------------------------------------
  Route::post('register', [RegisteredUserController::class, 'store']);


  //---------------------- Login Page ----------------------------------------------
  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  //----------------------- Login secion iniciated ---------------------------------
  Route::post('login', [AuthenticatedSessionController::class, 'store']);

  //------------------------ Forgot password page -----------------------------------
  Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

  //----------------------- Restore password request email --------------------------
  Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

  //---------------------------- Restore password page ----------------------------
  Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

  //---------------------------- Restore password validation and store ----------------------------
  Route::post('reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');
});

//----------------------------- Authenticated Acess Routes for Authentication-----------------------
Route::middleware('auth')->group(function () {
  //---------------------------- Email verification Notice ----------------------------
  Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

  //---------------------------- Email verification ----------------------------
  Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');
  
  //---------------------------- Email verified and updated on DB -----------------------------------------
  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  //---------------------------- Confirm password page ----------------------------
  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  //---------------------------- Validate and store password ----------------------------
  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

  //---------------------------- Update password -----------------------------------------
  Route::put('password', [PasswordController::class, 'update'])->name('password.update');

  //---------------------------- Logout Session -----------------------------------------
  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
});
