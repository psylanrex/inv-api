<?php

namespace App\Services\Items\SaveItems\ComplexItems\Jewelry;

use App\Services\Items\SaveItems\SimpleItems\SaveSimpleItemService;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\SaveJewelryTransactionService;

class SaveJewelryItemService
{

    public function saveJewelryItem($request)
    {

        $results = (new SaveSimpleItemService)->saveSimpleItem($request);

        // product is ProductDescription model

        $product_id = $results['product']['id'];

        return (new SaveJewelryTransactionService)->saveJewelryTransaction($request, $product_id);
  
    }

}