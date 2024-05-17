<?php

namespace App\Queries\StagedPurchaseOrders;

use App\Models\StagedPurchaseOrderItem;

class StagedDetailsQuery
{

    public function getData($purchase_order_id)
    {

        $select = [

            'ProductDescription.id',
            'VendorItemCode.item_code',
            'ProductDescription.short_name',
            'ProductDescription.name',
            'ProductDescription.category_id',
            'StagedPurchaseOrderItem.price AS unit_cost',
            'StagedPurchaseOrderItem.quantity'

        ];

         return StagedPurchaseOrderItem::select($select)      
         
            ->join('inventory.ProductDescription', 'StagedPurchaseOrderItem.product_description_id', '=', 'ProductDescription.id')
            ->join('inventory.VendorItemCode', 'ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')
            
            ->where('staged_purchase_order_id', $purchase_order_id)
            
            ->get();

    }

}