<?php

namespace App\Queries\StagedPurchaseOrders;

use App\Models\StagedPurchaseOrderItem;

class StagedPurchaseOrderItemQuery
{
    
    public function getData($staged_purchase_order_id)
    {
        
        // Get all the staged purchase order items on the staged po

        $staged_po_items = StagedPurchaseOrderItem::select('StagedPurchaseOrderItem.*')
        
            ->join('inventory.ProductDescription', function($join) {

                $join->on('StagedPurchaseOrderItem.product_description_id', '=', 'ProductDescription.id');

            })
                
            ->join('inventory.VendorItemCode', 'ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')

            ->where('staged_purchase_order_id', $this->$staged_purchase_order_id)

            ->orderBy('VendorItemCode.item_code', 'ASC')
            
            ->get();
        
            return $staged_po_items;
        
    }

}