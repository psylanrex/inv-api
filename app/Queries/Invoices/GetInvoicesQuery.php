<?php

namespace App\Queries\Invoices;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class GetInvoicesQuery
{
   
    public function getData($invoice_statuses)
    {

        return Invoice::select('Invoice.*')
            
            ->with(['invoiceStatus', 'purchaseOrder'])
            
            ->join('inventory.PurchaseOrder', 'Invoice.purchase_order_id', '=' ,'PurchaseOrder.id')
            
            ->where('PurchaseOrder.vendor_id', Auth::user()->vendor_id)
            
            ->whereIn('Invoice.invoice_status_id', $invoice_statuses)
            
            ->get();
            
    }

}
