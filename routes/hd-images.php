<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::any('/hd-images', 'HdImagesController@listing');
    Route::get('/hd-images/files/{product_id}', 'HdImagesController@getImages');
    Route::post('/hd-images/upload', 'HdImagesController@upload');


});