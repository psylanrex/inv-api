<?php

use Illuminate\Support\Facades\Route;

Route::get('/premission-denied', function(){

    return response()->json(['error' => 'Permission Denied'], 403);

});