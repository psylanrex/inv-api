<?php

namespace App\Queries\HdImages;

use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\DB;

class HdImageStatsQuery
{
    public function getData($vendor_id)
    {

        $select = [

            'COUNT(derived.product_description_id) AS item_count,
            COUNT(IF(derived.hd_count = 0, derived.product_description_id, NULL)) AS image_count,
            GROUP_CONCAT(IF(derived.hd_count = 0, derived.product_description_id, NULL)) AS pids'

        ];

        $select = [
            'COUNT(derived.product_description_id) AS item_count',
            'COUNT(IF(derived.hd_count = 0, derived.product_description_id, NULL)) AS image_count',
            'GROUP_CONCAT(IF(derived.hd_count = 0, derived.product_description_id, NULL)) AS pids'
        ];
        
        $result = PurchaseOrder::selectRaw(implode(', ', $select))->from(DB::raw('(
        
            SELECT
        
                pos.product_description_id,
        
            COUNT(DISTINCT(IF(i.image_type_id IN (24, 25), i.id, NULL))) AS hd_count
            
            FROM
        
                inventory.PurchaseOrder AS po
        
            JOIN
        
                inventory.PurchaseOrderSummary AS pos ON (po.id = pos.purchase_order_id)
        
            JOIN
        
                inventory.ProductDescription AS pd ON (pos.product_description_id = pd.id AND pd.reorderable = 1 AND pd.discontinued = 0)
            
            JOIN
        
                inventory.Image AS i ON (pd.id = i.product_description_id AND i.image_type_id IN (24, 25))
        
            LEFT JOIN
        
                inventory.PurchaseOrderLineItem AS li ON (li.purchase_order_summary_id = pos.id)
            
            LEFT JOIN
        
                inventory.Control AS c ON (c.purchase_order_line_item_id = li.id AND c.item_status_id NOT IN (30, 1))
        
            WHERE
        
                po.vendor_id = :vendor_id
        
            AND
        
                po.purchase_order_status_id = 4
        
            GROUP BY
        
                pos.product_description_id
            
            ) as derived'))
            
            ->setBindings(['vendor_id' => $vendor_id])
            
            ->first();
        
        return $result;
        

    }

}