<?php

namespace App\Services\Dashboard;

use App\Queries\ProductRatings\BadRatingsQuery;
use App\Queries\Products\GetProductsFromIdsQuery;

class BadRatingService
{
    public function handleBadRating()
    {

        $vendor_id = auth()->user()->vendor_id;

        $title = 'Bad Rating';

        $sub_title = 'Products - Bad Rating (Less than 4 stars)';

        $product_ids = (new BadRatingsQuery)->getData($vendor_id)[0]->pids;

        $product_ids = explode(',', $product_ids);

        $products = GetProductsFromIdsQuery::getProductsFromIds($product_ids);

        return [

            'title' => $title,
            'sub_title' => $sub_title,
            'products' => $products
        ];

    }
    
}