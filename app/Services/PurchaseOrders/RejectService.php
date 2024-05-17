<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Models\StagedPurchaseOrder;

class RejectService
{
    
    public function reject($purchase_order_id)
    {
        
        StagedPurchaseOrder::where(['id' => $purchase_order_id])
        
            ->update(['purchase_order_status_id' => PurchaseOrderStatus::REJECTED]);

        return ['message' => 'Purchase order has been rejected.', 'status' => 'success', 'code' => 200];
        
    }

}