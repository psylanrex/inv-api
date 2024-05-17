<?php

namespace App\Services\Items\UpdateItems\Routers;

use App\Services\Items\UpdateItems\SimpleItems\UpdateSimpleItemsService;
use App\Services\Items\UpdateItems\Routers\RouteComplexItemUpdateService;

class UpdateItemRouterService
{

    public function routeItem($request)
    {

        $category_id = $request->category;

        $complex_forms = [21, 53, 38];

        if ( in_array($category_id, $complex_forms) ) {

            return (new RouteComplexItemUpdateService)->routeItem($request);

        }

        return (new UpdateSimpleItemsService)->updateItem($request);   

    }


}