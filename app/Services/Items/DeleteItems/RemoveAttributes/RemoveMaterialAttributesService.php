<?php

namespace App\Services\Items\DeleteItems\RemoveAttributes;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;

class RemoveMaterialAttributesService
{

    public function removeMaterialAttributes($product_id)
    {
        // get the product_description_product_feature_ids
        // material feature id is 15

        if ( ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 15)

            ->exists() ) {

                $features = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
                    ->where('product_feature_id', 15)

                    ->get();

        } else {

            return;

        }  

        // features is an id that represents the material. 
        // we reference the feature id to remove all associated records
        
        foreach ($features as $feature) {
                
            ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $feature->id)->delete();

        }

    }

}