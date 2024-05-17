<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\DashboardController;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/returned-rate', [DashboardController::class, 'returnedRated']);
    Route::get('/dashboard/damaged-items', [DashboardController::class, 'damagedItems']);
    Route::get('/dashboard/bad-rating', [DashboardController::class, 'badRating']);
    Route::get('/dashboard/good-rating', [DashboardController::class, 'goodRating']);

});

