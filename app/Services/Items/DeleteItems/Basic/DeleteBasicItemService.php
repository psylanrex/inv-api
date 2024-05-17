<?php

namespace App\Services\Items\DeleteItems\Basic;

use App\Models\ProductDescription;
use App\Models\VendorItemCode;
use App\Models\DescriptionDetail;

class DeleteBasicItemService
{

    public function deleteBasicItem($product_id)
    {

        // delete the item vendor code record

        $product = ProductDescription::where('id', $product_id)->first();

        VendorItemCode::where('id', $product->vendor_item_code_id)->delete();

        if ( DescriptionDetail::where('id', $product->description_details_id)->exists() ) {

            DescriptionDetail::where('id', $product->description_details_id)->delete();

        }   

        // delete the product description record

        ProductDescription::where('id', $product_id)->delete();

        return ['msessage' => "Item $product_id has been deleted.", 'status' => 200];

    }

}