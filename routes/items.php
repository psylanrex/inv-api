<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Items\ItemsCreateFormController;
use App\Http\Controllers\Items\ItemSaveController;
use App\Http\Controllers\Items\ItemEditFormController;
use App\Http\Controllers\Items\ItemUpdateController;
use App\Http\Controllers\Items\ItemDeleteController;

Route::group(['middleware' => ['auth:sanctum']], function() {

   // Item Create Forms
   
    Route::get('/items/get-form-fields', [ItemsCreateFormController::class, 'getFormFields']);
    
    Route::get('/items/gemstone-dependent-fields/{id}', [ItemsCreateFormController::class, 'getGemstoneDependentFields']);

    // Item Edit Forms

    Route::get('items/edit/{product_id}', [ItemEditFormController::class, 'getEditForm']);

    // Save Items

    Route::post('/items/save-item', [ItemSaveController::class, 'saveItem']);

    // Update Items

    Route::post('/items/update-item', [ItemUpdateController::class, 'updateItem']);

    // Delete Items

    Route::post('/items/delete-item', [ItemDeleteController::class, 'deleteItem']);

    // Update Items


});