<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Models\StagedPurchaseOrder;
use App\Models\StagedPurchaseOrderItem;

class StockCheckDetailService
{
    
    public function stockCheckDetails($purchase_order_id)
    {
        
        $results = (object) [];

        $staged_values = StagedPurchaseOrder::purchaseOrderByStatus(PurchaseOrderStatus::STOCK_CHECK_PENDING)
        
            ->find($purchase_order_id);

        $results->items = StagedPurchaseOrderItem::with(['productDescription', 'productDescription.vendorItemCode'])
        
            ->where('staged_purchase_order_id', $purchase_order_id)
            
            ->get();

        $results->purchase_order = StagedPurchaseOrder::find($purchase_order_id);

        $results->item_count = $staged_values->quantity;

        $results->grand_total = $staged_values->total;

        return $results;

    }

}