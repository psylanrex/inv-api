<?php

namespace App\Services\Items\UpdateItems\Routers;

use App\Services\Items\UpdateItems\ComplexItems\Jewelry\UpdateJewelryItemService;
use App\Services\Items\UpdateItems\ComplexItems\Watches\UpdateWatchItemService;
use App\Services\Items\UpdateItems\ComplexItems\Gemstones\UpdateGemstoneItemService;

class RouteComplexItemUpdateService
{

    public function routeItem($request)
    {

        $category_id = $request->category;

        // match the category_id to the appropriate update service
   
        switch ($category_id) {

            case 21:

                return (new UpdateJewelryItemService)->updateJewelryItem($request);
                break;

            case 38:

                return (new UpdateWatchItemService)->updateWatchItem($request);
                break;

            case 53:

                return (new UpdateGemstoneItemService)->updateGemstoneItem($request);
                break;

            default:

                return ['error' => 'Category not found.'];

        }
     

    }

}