<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Models\StagedPurchaseOrder;
use App\Queries\StagedPurchaseOrders\StagedDetailsQuery;
use App\Queries\StagedPurchaseOrders\StagedPoByStatusAndIdQuery;

class StagedDetailsService
{
    
    public function stagedDetails($purchase_order_id)
    {
        
        $results = (object) [];

        $stagedValues = (new StagedPoByStatusAndIdQuery)
        
            ->getData(PurchaseOrderStatus::PENDING_VENDOR , $purchase_order_id);

        $results->items = (new StagedDetailsQuery)->getData($purchase_order_id);

        $results->purchase_order = StagedPurchaseOrder::find($purchase_order_id);

        $results->item_count = $stagedValues->quantity;

        $results->grand_total = $stagedValues->total;

        $results->is_staged = true;

        return $results;

    }

}