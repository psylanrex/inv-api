<?php

namespace App\Services\PurchaseOrders;


use App\Models\Vendor;
use App\Queries\Invoices\InvoiceProductsQuery;
use App\Queries\Invoices\PurchaseOrderSummariesQuery;

class CreateInvoiceService
{
   
    public function createInvoice($request, $purchase_order_id)
    {

        // get values from request

        $product_ids = array_keys($request->get('products'));

        $invoiced = $request->get('invoiced');

        $quantities = $request->get('products');

        // Get Vendor record

        $vendor = Vendor::find(auth()->user()->vendor_id);

        // Get the products

        $products = (new InvoiceProductsQuery)->getData($product_ids);
    
        // Get the purchase order summaries for the products

        $purchaseOrderSummaries = (new PurchaseOrderSummariesQuery)->getData($purchase_order_id, $product_ids);

        // Format the purchase order summaries

        $summary_ids = (new SummaryFormatService)->formatSummaries($purchaseOrderSummaries, $invoiced, $products);

        
        return (new CreateInvoiceTransactionService)->createInvoiceTransaction(
            
            $purchase_order_id,  
            $quantities, 
            $vendor, 
            $products,  
            $summary_ids
        
        );

    }

}