<?php

namespace App\Services\Dashboard;

use App\Queries\Products\GetProductsFromIdsQuery;
use App\Queries\ProductRatings\GoodRatingsQuery;

class GoodRatingService
{
    public function handleGoodRating()
    {

        $vendor_id = auth()->user()->vendor_id;

        $title = 'Good Rating';

        $sub_title = 'Products - Good Rating (4 Stars or Greater)';

        $product_ids = (new GoodRatingsQuery)->getData($vendor_id)[0]->pids;

        $product_ids = explode(',', $product_ids);

        $products = GetProductsFromIdsQuery::getProductsFromIds($product_ids);

        return [

            'title' => $title,
            'sub_title' => $sub_title,
            'products' => $products
        ];

    }
    
}