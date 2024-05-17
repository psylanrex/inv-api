<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;

// Auth

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/login-check', [AuthController::class, 'loginCheck']);

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/logout',[AuthController::class, 'logout']);

});

// Impersonate

Route::post('/impersonateVendor/{id}',[AuthController::class, 'impersonateVendor']);
Route::post('/impersonate',[AuthController::class, 'impersonate']);

Route::get('/permission-denied', [AuthController::class, 'permissionDenied']);

// Password Resets

Route::get('/get-password-reset-form/{token}', [PasswordResetController::class, 'getPasswordResetForm']);
Route::post('/password-reset', [PasswordResetController::class, 'passwordReset']);
Route::post('/request-password-token', [PasswordResetController::class, 'requestPasswordResetToken']);

