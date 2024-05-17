<?php

use Illuminate\Support\Facades\Route;

Route::get('/invalidate', function(){

    \App\Models\Image::invalidateCache(['/21/5/123123123']);

    //\App\Models\Image::invalidateCache(['/21/5/77140']);

});