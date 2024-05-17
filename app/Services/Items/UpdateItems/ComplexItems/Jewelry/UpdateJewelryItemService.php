<?php

namespace App\Services\Items\UpdateItems\ComplexItems\Jewelry;

use App\Services\Items\UpdateItems\ComplexItems\Jewelry\UpdateJewelryTransactionService;
use App\Services\Items\UpdateItems\SimpleItems\UpdateSimpleItemsService;

class UpdateJewelryItemService
{

    public function updateJewelryItem($request)
    {

        // updated the simple attributes of the item first

        (new UpdateSimpleItemsService)->updateItem($request);


        return (new UpdateJewelryTransactionService)->updateItemTransaction($request);

    }

}