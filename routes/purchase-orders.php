<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PurchaseOrders\PurchaseOrderController;

Route::group(['middleware' => ['auth:sanctum']], function() {

    Route::get('/purchase-orders/stock-check', [PurchaseOrderController::class, 'stockCheck']);
    Route::get('/purchase-orders/pending', [PurchaseOrderController::class, 'pending']);
    Route::get('/purchase-orders/open', [PurchaseOrderController::class, 'open']);
    Route::get('/purchase-orders/closed', [PurchaseOrderController::class, 'closed']);
    Route::get('/purchase-orders/pending/details/{purchase_order_id}', [PurchaseOrderController::class, 'stagedDetails']);

    Route::group(['middleware' => 'hasPo'], function() {

        Route::get('/purchase-orders/stock-check/{purchase_order_id}', [PurchaseOrderController::class, 'stockCheckDetails']);
        Route::post('/purchase-orders/stock-check/{purchase_order_id}', [PurchaseOrderController::class, 'postStockCheck']);
        Route::get('/purchase-orders/details/{purchase_order_id}', [PurchaseOrderController::class, 'details']);
        Route::post('/purchase-orders/details/{purchase_order_id}', [PurchaseOrderController::class, 'createInvoice']);
        Route::get('/purchase-orders/approve/{purchase_order_id}', [PurchaseOrderController::class, 'approve']);
        Route::get('/purchase-orders/reject/{purchase_order_id}', [PurchaseOrderController::class, 'reject']);
        Route::get('/purchase-orders/close/{purchase_order_id}', [PurchaseOrderController::class, 'close']);

        Route::get('/no-purchase-order-found', [PurchaseOrderController::class, 'noPurchaseOrderFound']);
        
    });

});