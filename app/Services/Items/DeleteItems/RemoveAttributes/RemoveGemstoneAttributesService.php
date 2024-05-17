<?php

namespace App\Services\Items\DeleteItems\RemoveAttributes;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;

class RemoveGemstoneAttributesService
{

    public function removeGemstoneAttributes($product_id)
    {
        // get the product_description_product_feature_ids
        // gemstone feature id is 1

        if ( ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 1)

            ->exists() ) {

                $features = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
                    ->where('product_feature_id', 1)

                    ->get();

        } else {

            return;

        }  

        // features is an id that represents the gemstone. 
        // you can have up to 5 records
        // we reference the feature id to remove all associated records
        
        foreach ($features as $feature) {
                
            ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $feature->id)->delete();

        }

    }

}