<?php

namespace App\Services\Items\SaveItems\Routers;

use App\Services\Items\SaveItems\ComplexItems\Jewelry\SaveJewelryItemService;
use App\Services\Items\SaveItems\ComplexItems\Watches\SaveWatchItemService;
use App\Services\Items\SaveItems\ComplexItems\Gemstones\SaveGemstoneItemService;

class RouteComplexItemService
{
    public function routeSaveItem($request)
    {
        $category_id = $request->category;

        // match the category_id to the appropriate save service
   
        switch ($category_id) {

            case 21:

                return (new SaveJewelryItemService)->saveJewelryItem($request);
                break;

            case 38:

                return (new SaveWatchItemService)->saveWatchItem($request);
                break;

            case 53:

                return (new SaveGemstoneItemService)->saveGemstoneItem($request);
                break;

            default:

                return ['error' => 'Category not found.'];

        }

    }

}