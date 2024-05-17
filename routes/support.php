<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Support\SupportController;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::post('/support', [SupportController::class, 'postSupport']);

});