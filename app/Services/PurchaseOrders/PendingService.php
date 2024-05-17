<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Queries\StagedPurchaseOrders\StagedPurchaseOrderByStatusQuery;

class PendingService
{
    
    public function pending()
    {

        return (new StagedPurchaseOrderByStatusQuery)->getData(
        
            PurchaseOrderStatus::PENDING_VENDOR
        
        );

    }

}