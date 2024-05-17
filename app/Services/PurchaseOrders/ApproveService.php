<?php

namespace App\Services\PurchaseOrders;

use App\Models\StagedPurchaseOrder;
use App\Queries\StagedPurchaseOrders\StagedPurchaseOrderItemQuery;
use App\Services\PurchaseOrders\ApproveTransactionService;

class ApproveService
{
    
    public function approve($staged_purchase_order_id)
    {

        // get staged purchase order

        $stagedPo = StagedPurchaseOrder::find($staged_purchase_order_id);

        // Get all the staged purchase order items on the staged po

        $stagedPoItems = (new StagedPurchaseOrderItemQuery)->getData($staged_purchase_order_id);

        return (new approveTransactionService)->approveTransaction(
            
            $stagedPo, 
            $stagedPoItems, 
            $staged_purchase_order_id
        
        );
        
    }

}