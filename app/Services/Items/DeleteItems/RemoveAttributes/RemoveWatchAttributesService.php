<?php

namespace App\Services\Items\DeleteItems\RemoveAttributes;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;

class RemoveWatchAttributesService
{

    public function removeWatchAttributes($product_id)
    {
        // get the product_description_product_feature_ids
        // watch feature id is 9

        if ( ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 9)

            ->exists() ) {

                $features = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
                    ->where('product_feature_id', 9)

                    ->get();

        } else {

            return;

        }  

        // features is an id that represents the watch. 
        // we reference the feature id to remove all associated records
        
        foreach ($features as $feature) {
                
            ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $feature->id)->delete();

        }

    }

}