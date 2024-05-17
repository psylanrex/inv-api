<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderStatus;

class CloseService
{
    
    public function close($purchase_order_id)
    {
        
        PurchaseOrder::where(['id' => $purchase_order_id])
        
            ->update(['purchase_order_status_id' => PurchaseOrderStatus::VENDOR_CLOSED]);
        
    }

}