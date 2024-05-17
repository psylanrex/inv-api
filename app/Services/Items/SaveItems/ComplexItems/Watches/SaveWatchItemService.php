<?php

namespace App\Services\Items\SaveItems\ComplexItems\Watches;

use App\Services\Items\SaveItems\SimpleItems\SaveSimpleItemService;
use App\Services\Items\SaveItems\ComplexItems\Watches\SaveWatchTransactionService;

class SaveWatchItemService
{

    public function saveWatchItem($request)
    {

        $results = (new SaveSimpleItemService)->saveSimpleItem($request);

        // product is ProductDescription model

        $product_id = $results['product']['id'];

        return (new SaveWatchTransactionService)->saveWatchTransaction($request, $product_id);

    }

}