<?php

namespace App\Services\Invoices;

use App\Models\Invoice;
use App\Services\Invoices\FinalizeInvoiceTransactionService;

class FinalizeInvoiceService
{ 
    
    public function finalizeInvoice($request, $invoice_id)
    {

        // Validate the request

        $request->validate([

            'invoice_id' => ['required', 'integer', 'exists:Invoice,id']

        ]);

        $invoice_id = $request->get('invoice_id');

        // Get the invoice

        $invoice = Invoice::find($invoice_id);

        // transaction to finalize the invoice

        return (new FinalizeInvoiceTransactionService())->transaction($request, $invoice);

    }

}