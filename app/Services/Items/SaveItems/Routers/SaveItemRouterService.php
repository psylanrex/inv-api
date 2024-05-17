<?php

namespace App\Services\Items\SaveItems\Routers;

use App\Services\Items\SaveItems\SimpleItems\SaveSimpleItemService;
use App\Services\Items\SaveItems\Routers\RouteComplexItemService;

class SaveItemRouterService

{
    public function routeItemToSave($request)
    {

        $category_id = $request->category;

        $complex_forms = [21, 53, 38];

        if ( in_array($category_id, $complex_forms) ) {

            return (new RouteComplexItemService)->routeSaveItem($request);

        }

        return (new SaveSimpleItemService)->saveSimpleItem($request);

    }

}