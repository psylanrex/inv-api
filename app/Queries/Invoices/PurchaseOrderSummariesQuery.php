<?php

namespace App\Queries\Invoices;

use App\Models\PurchaseOrderSummary;


class PurchaseOrderSummariesQuery
{

    public function getData($purchase_order_id, $product_ids)
    {
        
        return PurchaseOrderSummary::where('purchase_order_id', $purchase_order_id)
        
            ->whereIn('product_description_id', $product_ids)
        
            ->get();
        
    }

}