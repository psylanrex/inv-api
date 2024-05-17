<?php

namespace App\Queries\ProductRatings;
use App\Models\ProductStat;

class ProductRatingsQuery
{
    public function getData($vendor_id)
    {
        
        $ratings = ProductStat::join('inventory.ProductDescription as pd', 'ProductStats.product_id', '=', 'pd.id')

            ->join('inventory.VendorItemCode as vic', 'pd.vendor_item_code_id', '=', 'vic.id')
    
            ->where('vic.vendor_id', $vendor_id)
            ->where('pd.discontinued', 0)
            ->where('pd.reorderable', 1)
    
            ->selectRaw('COUNT(DISTINCT(IF(avg_rating < 4, product_id, NULL))) AS bad_rating')
   
            ->selectRaw('COUNT(DISTINCT(IF(avg_rating >= 4, product_id, NULL))) AS good_rating')
   
            ->first();

        return $ratings;
    }

}