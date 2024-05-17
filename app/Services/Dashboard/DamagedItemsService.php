<?php

namespace App\Services\Dashboard;

use App\Queries\Products\GetProductsFromIdsQuery;
use App\Queries\DamagedProducts\DamagedProductsQuery;
use Illuminate\Support\Facades\Auth;

class DamagedItemsService
{
    public function handleDamagedItems()
    {

        $vendor_id = Auth::user()->vendor_id;

        $title = 'Damaged Item %';

        $sub_title = 'Products - Damage Items';

        $product_ids = (new DamagedProductsQuery)->getData($vendor_id)[0]->pids;

        $product_ids = explode(',', $product_ids);

        $products = GetProductsFromIdsQuery::getProductsFromIds($product_ids);

        return [

            'title' => $title, 
            'sub_title' => $sub_title, 
            'products' => $products

        ];
        
    }
}