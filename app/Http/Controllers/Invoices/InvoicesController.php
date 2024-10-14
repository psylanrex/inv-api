<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinalizeInvoicePostRequest;
use App\Queries\Invoices\GetInvoicesQuery;
use App\Models\InvoiceStatus;
use App\Services\Invoices\PrintInvoiceService;
use App\Queries\Invoices\InvoiceDetailsQuery;
use App\Services\Invoices\FinalizeInvoiceService;
use App\Services\Invoices\CancelInvoiceService;

class InvoicesController extends Controller
{
    
    public function pending()
    {

        return (new GetInvoicesQuery())->getData([InvoiceStatus::PENDING]);

    }

    public function shipped()
    {

        return (new GetInvoicesQuery())->getData([InvoiceStatus::INVOICED]);

    }

    public function received()
    {

        return (new GetInvoicesQuery())->getData([InvoiceStatus::LANDED, InvoiceStatus::RECEIVED]);

    }

    public function cancelled()
    {

        return (new GetInvoicesQuery())->getData([InvoiceStatus::CANCELLED]);

    }

    public function printInvoice($invoice_id)
    {

        return (new PrintInvoiceService())->printInvoice($invoice_id);

    }


    public function details($invoice_id)
    {

        return (new InvoiceDetailsQuery())->getData($invoice_id);

    }

    public function finish($invoice_id)
    {

        return (new InvoiceDetailsQuery())->getData($invoice_id);

    }

    public function finalizeInvoice(FinalizeInvoicePostRequest $request, $invoice_id)
    {

        return (new FinalizeInvoiceService())->finalizeInvoice($request, $invoice_id);

    }

    public function cancelInvoice($id)
    {

        return (new CancelInvoiceService())->cancelInvoice($id);

    }

    public function noInvoiceFound()
    {

        return response()->json(['message' => 'No invoice found.'], 404);

    }

}
