<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Invoices\InvoicesController;
use App\Http\Controllers\Invoices\InvoiceBarcodeController;


Route::group(['middleware' => ['auth:sanctum', 'hasInvoice']], function() {

    Route::get('/invoices/pending', [InvoicesController::class, 'pending']);
    Route::get('/invoices/shipped', [InvoicesController::class, 'shipped']);
    Route::get('/invoices/received', [InvoicesController::class, 'received']);
    Route::get('/invoices/cancelled', [InvoicesController::class, 'cancelled']);
        
    Route::get('invoice/barcode/{code}', [InvoiceBarcodeController::class, 'barcdoe']);

    Route::get('/invoices/details/{invoice_id}', [InvoicesController::class, 'details']);
    Route::get('/invoices/finish/{invoice_id}', [InvoicesController::class, 'finish']);
    Route::post('/invoices/finish/{invoice_id}', [InvoicesController::class, 'finalizeInvoice']);
    Route::get('/invoices/print/{invoice_id}', [InvoicesController::class, 'printInvoice']);
    Route::post('/invoices/cancel', [InvoicesController::class, 'cancelInvoice']);

    Route::get('/invoices/no-invoice-found', [InvoicesController::class, 'noInvoiceFound']);
  
});