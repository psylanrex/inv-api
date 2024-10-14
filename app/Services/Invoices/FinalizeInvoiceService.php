<?php

namespace App\Services\Invoices;

use App\Models\Invoice;
use App\Services\Invoices\FinalizeInvoiceTransactionService;

class FinalizeInvoiceService
{ 
    
    public function finalizeInvoice($request, $invoice_id)
    {

        // Get the invoice

        $invoice = Invoice::find($invoice_id);

        // transaction to finalize the invoice

        return (new FinalizeInvoiceTransactionService())->transaction($request, $invoice);

    }

}