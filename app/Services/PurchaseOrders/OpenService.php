<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Queries\PurchaseOrders\PurchaseOrderQuery;

class OpenService
{
    
    public function open()
    {
        
        return (new PurchaseOrderQuery)
        
            ->getData(PurchaseOrderStatus::OPEN);

    }

}