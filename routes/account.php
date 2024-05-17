<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Account\AccountController;

Route::group(['middleware' => ['auth:sanctum']], function() {
    
    Route::get('/account/profile', [AccountController::class, 'profile']);
    Route::post('/account/update-info', [AccountController::class, 'postInfo']);
    Route::post('/account/update-addresses', [AccountController::class, 'postAddress']);
    Route::post('/account/update-contacts', [AccountController::class, 'postContacts']); 


});