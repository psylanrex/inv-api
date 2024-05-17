<?php

namespace App\Queries\ProductRatings;

use Illuminate\Support\Facades\DB;

class GoodRatingsQuery
{
    public function getData($vendor_id)
    {
        $query = "
            SELECT
                GROUP_CONCAT(DISTINCT(IF(ps.avg_rating >= 4, ps.product_id, NULL))) AS pids
            FROM
                reporting.ProductStats AS ps
                    JOIN
                (inventory.ProductDescription AS pd, inventory.VendorItemCode AS vic) ON (ps.product_id = pd.id AND pd.vendor_item_code_id = vic.id)
            WHERE
                vic.vendor_id = {$vendor_id}
            AND
                pd.discontinued = 0
            AND
                pd.reorderable = 1
        ";
        
        

        return  DB::select($query);
    }
}