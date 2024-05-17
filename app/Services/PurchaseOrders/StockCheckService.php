<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Queries\StagedPurchaseOrders\StagedPurchaseOrderByStatusQuery;

class StockCheckService
{
    
    public function stockCheck()
    {
        
        return (new StagedPurchaseOrderByStatusQuery)->getData(
        
            PurchaseOrderStatus::STOCK_CHECK_PENDING
        
        );

    }

}