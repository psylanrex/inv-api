<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateItemRequest;
use App\Services\Items\UpdateItems\Routers\UpdateItemRouterService;

class ItemUpdateController extends Controller
{
    
    public function updateItem(UpdateItemRequest $request)
    {

        return (new UpdateItemRouterService)->routeItem($request);

    }

}
