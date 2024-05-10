<?php

use Illuminate\Support\Facades\Route;
use App\CodeGenerator\Controllers\Generators\MakeNewServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('code-generators.index');
});

Route::get('/make-new-service', function () {
    return view('code-generators.make-new-service');
});

Route::get('/make-new-cron', function () {
    return view('code-generators.make-new-cron');
});

Route::get('/make-new-project', function () {
    return view('code-generators.make-project');
});

Route::get('/make-new-foundation', function () {
    return view('code-generators.make-new-foundation');
});

Route::get('/add-env', function () {
    return view('code-generators.add-env');
});

Route::get('/remove-env', function () {
    return view('code-generators.remove-env');
});

Route::get('/remove-service', function () {
    return view('code-generators.remove-service');
});

Route::get('/remove-project', function () {
    return view('code-generators.remove-project');
});

Route::get('/remove-foundation', function () {
    return view('code-generators.remove-foundation');
});

Route::get('/remove-cron', function () {
    return view('code-generators.remove-cron');
});