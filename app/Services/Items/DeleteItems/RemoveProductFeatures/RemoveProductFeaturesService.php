<?php

namespace App\Services\Items\DeleteItems\RemoveProductFeatures;

use App\Models\ProductDescriptionProductFeature;

class RemoveProductFeaturesService
{

    public function removeProductFeatures($product_id)
    {

        if (  ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->exists() ) {

                $productFeatures = ProductDescriptionProductFeature::where('product_description_id', $product_id)->get();

        } else {

            return;

        }
        
        foreach ($productFeatures as $productFeature) {
                
            $productFeature->delete();

        }

    }

}