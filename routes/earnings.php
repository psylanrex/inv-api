<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Earnings\EarningsController;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/earnings/owed-invoices', [EarningsController::class, 'owed']);
    Route::any('/earnings/paid-invoices', [EarningsController::class, 'paid']);

});


