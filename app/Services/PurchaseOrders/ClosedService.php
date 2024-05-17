<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Queries\PurchaseOrders\PurchaseOrderQuery;

class ClosedService
{
    
    public function closed()
    {
        
        return (new PurchaseOrderQuery)
            
            ->getData(PurchaseOrderStatus::VENDOR_CLOSED);  

    }

}