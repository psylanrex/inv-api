<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// code generator

use App\CodeGenerator\Controllers\Generators\ProjectsController;
use App\CodeGenerator\Controllers\Generators\FoundationsController;
use App\CodeGenerator\Controllers\Generators\CrudSystemController;
use App\CodeGenerator\Controllers\Generators\SupportSystemController;
use App\CodeGenerator\Controllers\Generators\AddToEnvController;
use App\CodeGenerator\Controllers\Generators\MakeNewServiceController;
use App\CodeGenerator\Controllers\Generators\MakeViewsController;
use App\CodeGenerator\Controllers\Generators\MakeCronController;
use App\CodeGenerator\Controllers\Removers\FoundationRemoverController;
use App\CodeGenerator\Controllers\Removers\CrudSystemRemoverController;
use App\CodeGenerator\Controllers\Removers\ProjectRemoverController;
use App\CodeGenerator\Controllers\Removers\SupportSystemRemoverController;
use App\CodeGenerator\Controllers\Removers\ServiceRemoverController;
use App\CodeGenerator\Controllers\Removers\CronRemoverController;

// admin


// auth

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetTokenController;
use App\Http\Controllers\Auth\UserVerificationController;

// test

use App\Http\Controllers\TestController;





/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "isAdmin" middleware group. Make something great!
| As of now, there is no admin middleware
|
*/


Route::group(['middleware' => ['auth:sanctum', 'isAdmin']], function() {

  

});


/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
|
| The auth:sanctum middleware will check for authentication via token, 
| the roles middleware will check for multiple roles, 
| comma separated with no space. Status routes are here just
| as an example. The base role is not meant to be a visible role
| and should be removed from the route group. All staff get a base role, 
| so they appear in the pool of assignable users.
| It's left in here to show that roles middleware supports multiple roles
*/

Route::group(['middleware' => ['auth:sanctum']], function() {
   

});



/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Here is where you can register public routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| not have middleware
|
*/

// Auth routes begin

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/login-check', [AuthController::class, 'loginCheck']);

Route::get('/account/verify/{token}', [UserVerificationController::class, 'verifyAccount']);
Route::get('/request-verification-token', [UserVerificationController::class, 'requestVerificationToken']);

Route::get('/get-password-reset-form/{token}', [PasswordResetTokenController::class, 'getPasswordResetForm']);
Route::post('/password-reset', [PasswordResetTokenController::class, 'passwordReset']);
Route::post('/request-password-token', [PasswordResetTokenController::class, 'requestPasswordResetToken']);

// Auth routes end

// Code Generator routes begin

Route::post('/make-foundation', [FoundationsController::class, 'makeFoundation']);
Route::post('/make-project', [ProjectsController::class, 'setUpProject']);
Route::post('/make-crud-system', [CrudSystemController::class, 'makeCrudSystem']);
Route::post('/make-support-system', [SupportSystemController::class, 'makeSupportSystem']);
Route::post('/make-new-service', [MakeNewServiceController::class, 'makenewService']);
Route::post('/make-views', [MakeViewsController::class, 'makeViews']);
Route::post('/make-cron', [MakeCronController::class, 'makeCron']);

Route::post('/remove-foundation', [FoundationRemoverController::class, 'removeFoundation']);
Route::post('/remove-crud-system', [CrudSystemRemoverController::class, 'removeCrudSystem']);
Route::post('/remove-cron', [CronRemoverController::class, 'removeCron']);
Route::post('/remove-project', [ProjectRemoverController::class, 'removeProject']);
Route::post('/remove-support-system', [SupportSystemRemoverController::class, 'removeSupportSystem']);
Route::post('/remove-service', [ServiceRemoverController::class, 'removeService']);
Route::get('/add-to-env', [AddToEnvController::class, 'addToEnv']);

// Code Generator routes end

// Test routes begin

Route::get('/test', [TestController::class, 'index']);

// Test routes end