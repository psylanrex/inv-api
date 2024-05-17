<?php

namespace App\Services\Items\UpdateItems\ComplexItems\Gemstones;

use App\Services\Items\UpdateItems\SimpleItems\UpdateSimpleItemsService;
use App\Services\Items\UpdateItems\ComplexItems\Gemstones\UpdateGemstoneTransactionService;
use App\Models\ProductDescription;

class UpdateGemstoneItemService
{

    public function updateGemstoneItem($request)
    {

        // updated the simple attributes of the item first

        (new UpdateSimpleItemsService)->updateItem($request);

        $product_id = $request->product_id;

        $product = ProductDescription::find($product_id);

        if ( $product->hasGemstone($product_id )) {

            return (new UpdateGemstoneTransactionService)->updateItemTransaction($request);
   

        }

        return [
            
            'product' => $product, 
            'message' => 'Gemstone Lot Updated Successfully.'
        
        ];

    }

}