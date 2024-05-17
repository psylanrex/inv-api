<?php

namespace App\Services\Invoices;

use App\Models\Invoice;
use App\Models\SitePage;
use App\Models\PageType;
use Illuminate\Support\Facades\Auth;


class PrintInvoiceService
{

    public function printInvoice($invoice_id){

        // Check if the invoice exists and belongs to the vendor

        if ( ! $invoice = Invoice::join(
            
                'inventory.PurchaseOrder', 
                'Invoice.purchase_order_id', 
                '=', 
                'PurchaseOrder.id')
        
                ->where('PurchaseOrder.vendor_id', Auth::user()->vendor_id)

                ->where('Invoice.id', $invoice_id)
        
                ->exists() ) {

            return ['error' => 'Invoice not found'];

        }

        // Get the invoice

        $invoice = Invoice::join('inventory.PurchaseOrder', 'Invoice.purchase_order_id', '=', 'PurchaseOrder.id')
        
            ->where('PurchaseOrder.vendor_id', Auth::user()->vendor_id)

            ->where('Invoice.id', $invoice_id)
            
            ->first();

        // Get the invoice agreement page
        
        $site_page = SitePage::where('page_type_id', PageType::INVOICE_AGREEMENT)->first();

        // Replace the invoice number in the message

        $message = str_replace("[INVOICE_NUMBER]", $invoice->invoice_number, $site_page->text);

        return [
            
            'invoice' => $invoice, 
            'message' => $message
        
        ];

    }

}