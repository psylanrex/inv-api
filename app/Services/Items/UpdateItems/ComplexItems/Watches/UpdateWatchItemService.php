<?php

namespace App\Services\Items\UpdateItems\ComplexItems\Watches;

use App\Services\Items\UpdateItems\ComplexItems\Watches\UpdateWatchTransactionService;
use App\Services\Items\UpdateItems\SimpleItems\UpdateSimpleItemsService;

class UpdateWatchItemService
{

    public function updateWatchItem($request)
    {

        // updated the simple attributes of the item first

        (new UpdateSimpleItemsService)->updateItem($request);


        return (new UpdateWatchTransactionService)->updateItemTransaction($request);

    }

}   