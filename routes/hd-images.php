<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HdImages\HdImagesController;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::any('/hd-images', [HdImagesController::class, 'listing']);
    Route::get('/hd-images/files/{product_id}', [HdImagesController::class, 'getImages']);
    Route::post('/hd-images/upload', [HdImagesController::class, 'upload']);

});