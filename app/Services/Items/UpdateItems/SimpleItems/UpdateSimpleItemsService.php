<?php 

namespace App\Services\Items\UpdateItems\SimpleItems;

use App\Services\Items\UpdateItems\SimpleItems\SetSimpleItemsValuesForUpdateService;
use App\Services\Items\UpdateItems\SimpleItems\SimpleItemUpdateTransactionService;
use App\Services\Items\UpdateItems\Images\UpdateImagesService;

class UpdateSimpleItemsService
{

    public function updateItem($request)
    {

        // set values for the product

        $values = (new SetSimpleItemsValuesForUpdateService)->setValues($request);

        // record the ProductDescription, VendorItemCode, and DescriptionDetail

        $product = (new SimpleItemUpdateTransactionService)->simpleItemUpdateTransaction($values);

        // send product to update images service

        (new UpdateImagesService)->updateImages($request, $product);

        return [

            'message' => 'Simple item update.',

            'product' => $product,

        ];

    }

}