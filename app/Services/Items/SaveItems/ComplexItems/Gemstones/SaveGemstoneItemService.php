<?php

namespace App\Services\Items\SaveItems\ComplexItems\Gemstones;

use App\Services\Items\SaveItems\SimpleItems\SaveSimpleItemService;
use App\Services\Items\SaveItems\ComplexItems\Gemstones\SaveGemstoneTransactionService;

class SaveGemstoneItemService
{

    public function saveGemstoneItem($request)
    {

        $results = (new SaveSimpleItemService)->saveSimpleItem($request);

        // if lot is selected, return results, there is no gemstone transaction to save

        if ( $request->lot == 1 ) {

            return $results;

        }

        // product is ProductDescription model

        $product_id = $results['product']['id'];

        return (new SaveGemstoneTransactionService)->saveGemstoneTransaction($request, $product_id);

    }

}