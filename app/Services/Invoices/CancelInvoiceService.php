<?php

namespace App\Services\Invoices;

use App\Services\Invoices\CancelInvoiceTransactionService;

class CancelInvoiceService
{

    public function cancelInvoice($invoice_id)
    {

        return (new CancelInvoiceTransactionService())->transaction($invoice_id);

    }

}