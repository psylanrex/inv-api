<?php

namespace App\Queries\ReturnProducts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReturnedProductsQuery
{
    public function getData($vendor_id)
    {

        $start = Carbon::now()->subDays(180);

        $query = "

            SELECT

                GROUP_CONCAT(DISTINCT(c.product_description_id)) AS pids
            FROM
            
                inventory.Rma AS r
            
            JOIN
            
                (inventory.RmaPendingRefund AS rpr, inventory.PendingRefund AS pr) ON (rpr.rma_id = r.id AND rpr.pending_refund_id = pr.id AND pr.pending_refund_status_id = 2) ### DONE
                
            JOIN

                (inventory.Control AS c, websites.Schedule AS s) ON (r.control_id = c.id AND c.id = s.control_id)
            
            JOIN

                inventory.ProductDescription AS pd ON (c.product_description_id = pd.id)
                
            JOIN

                inventory.VendorItemCode AS vic ON (pd.vendor_item_code_id = vic.id)

            WHERE

                r.rma_reason_id NOT IN (6, 7) ### (Other, Duplicate Payment)

            AND

                s.event_end BETWEEN '{$start}' AND NOW()

            AND

                pd.reorderable = 1

            AND

                pd.discontinued = 0
        
            AND
            
                vic.vendor_id = {$vendor_id}

        ";

        return DB::select($query);
        
    }

}