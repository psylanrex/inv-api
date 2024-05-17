<?php

namespace App\Services\Dashboard;

use App\Queries\Products\GetProductsFromIdsQuery;
use App\Queries\ReturnProducts\ReturnedProductsQuery;
use Illuminate\Support\Facades\Auth;

class ReturnedRatedService
{

    public function handleReturnedRated()
    {

        $vendor_id = Auth::user()->vendor_id;

        $title = 'Return Rate %';

        $sub_title = 'Products - Return Rate';

        $product_ids = (new ReturnedProductsQuery)->getData($vendor_id)[0]->pids;

        $product_ids = explode(',', $product_ids);

        $products = GetProductsFromIdsQuery::getProductsFromIds($product_ids);

        return [
            
            'title' => $title, 
            'sub_title' => $sub_title, 
            'products' => $products
        
        ];

    }
}