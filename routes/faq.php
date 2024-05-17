<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Faqs\FaqsController;

Route::get('/faqs', [FaqsController::class, 'index']);