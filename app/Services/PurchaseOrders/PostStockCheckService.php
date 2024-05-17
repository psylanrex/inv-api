<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrderStatus;
use App\Models\StagedPurchaseOrderItem;
use App\Models\StagedPurchaseOrder;

class PostStockCheckService
{
    
    public function postStockCheck($request, $purchase_order_id)
    {
        
        // Iterate through the staged purchase order items and update the quantities

        foreach ($request->get('StagedPurchaseOrderItem') AS $id => $item) {

            if ( empty($item['quantity']) ) {

                $item['quantity'] = 0;

            }

            if ( empty($item['price']) ) {

                $item['price'] = 0;

            }

            StagedPurchaseOrderItem::where('id', $id)
            
                ->update($item);
        }

        StagedPurchaseOrder::where('id', $purchase_order_id)
        
            ->update(['purchase_order_status_id' => PurchaseOrderStatus::STOCK_CHECK_COMPLETE]);

        return [
            
            'message' => 'Stock check complete. Purchase order is now ready for approval.', 
            'status' => 'success', 
            'code' => 200
        
        ];
     
    }

}