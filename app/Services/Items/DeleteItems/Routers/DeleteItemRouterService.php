<?php

namespace App\Services\Items\DeleteItems\Routers;

use App\Models\ProductDescription;
use App\Services\Items\DeleteItems\Jewelry\DeleteJewelryItemService;
use App\Services\Items\DeleteItems\Watches\DeleteWatchItemService;
use App\Services\Items\DeleteItems\Gemstones\DeleteGemstoneItemService;
use App\Services\Items\DeleteItems\Basic\DeleteBasicItemService;

class DeleteItemRouterService
{
    public function routeItem($request)
    {

        $product = ProductDescription::find($request->product_id);

        $product_id = $product->id;

        $category_id = $product->category_id;


        // match the category_id to the appropriate update service
   
        switch ($category_id) {

            case 21:

                return (new DeleteJewelryItemService)->deleteJewelryItem($product_id);
                break;

            case 38:

                return (new DeleteWatchItemService)->deleteWatchItem($product_id);
                break;

            case 53:

                return (new DeleteGemstoneItemService)->deleteGemstoneItem($product_id);
                break;

            default:

                return (new DeleteBasicItemService)->deleteBasicItem($product_id);

        }     

    }
    
}