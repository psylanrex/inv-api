<?php

namespace App\Services\Items\SaveItems\SimpleItems;

use App\Services\Items\SaveItems\Images\SaveImagesService;
use App\Services\Items\SaveItems\SimpleItems\SetSimpleItemValuesService;

class SaveSimpleItemService
{
    public function saveSimpleItem($request)
    {
        
        // set values for the product

        $values = (new SetSimpleItemValuesService)->setSimpleItemValues($request);

        // record the ProductDescription, VendorItemCode, and DescriptionDetail

        $product = (new SimpleItemTransactionService)->simpleItemTransaction($values);

        // send product to save images service

       (new SaveImagesService)->saveImages($request, $product);

        return [

            'message' => 'Simple item saved.',

            'product' => $product,

        ];
        
    }

}