<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Services\Items\SaveItems\Routers\SaveItemRouterService;

class ItemSaveController extends Controller
{
    public function saveItem(StoreItemRequest $request)
    {

        return (new SaveItemRouterService)->routeItemToSave($request);

    }
}
