<?php

namespace App\Queries\PurchaseOrders;

use Illuminate\Support\Facades\DB;

class PoDetailsQuery
{

    public function getData($purchase_order_id)
    {

        // Ensure it's an integer

        $purchase_order_id = (int) $purchase_order_id; 

        $query = "
    
            SELECT
                pd.id,
                vic.item_code,
                pd.name,
                pd.short_name,
                pd.category_id,
                pos.unit_cost,
                pos.quantity,
                COUNT(DISTINCT li.id) AS invoiced,
                pos.quantity - COUNT(DISTINCT li.id) AS remaining
            FROM
                inventory.PurchaseOrderSummary AS pos
            JOIN
                inventory.ProductDescription AS pd ON pos.product_description_id = pd.id
            JOIN
                inventory.VendorItemCode AS vic ON pd.vendor_item_code_id = vic.id
            LEFT JOIN
                inventory.Invoice AS i ON pos.purchase_order_id = i.purchase_order_id
            LEFT JOIN
                inventory.PurchaseOrderLineItem AS li ON i.id = li.invoice_id AND pos.id = li.purchase_order_summary_id
            WHERE
                pos.purchase_order_id = ?
            GROUP BY
                pd.id, vic.item_code, pd.name, pd.short_name, pd.category_id, pos.unit_cost, pos.quantity
            ORDER BY
                remaining DESC, pd.id ASC
        
        ";

            return DB::select($query, [$purchase_order_id]);

    }

}