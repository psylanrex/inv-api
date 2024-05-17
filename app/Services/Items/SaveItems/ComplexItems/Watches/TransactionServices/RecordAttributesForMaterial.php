<?php

namespace App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices;

use App\Models\ProductDescriptionProductFeatureAttribute;

class RecordAttributesForMaterial
{

    public function makeAttributeRecordsForMaterial($request, $material_information_id)
    {

        // create one record for each material attribute

        // primary material - 20

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $material_information_id,
            'product_feature_attribute_id' => 20,
            'product_feature_attribute_option_id' => $request->primary_material,

        ]);

        // primary material Karat - 57

        if ( $request->filled('primary_material_karat') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $material_information_id,
                'product_feature_attribute_id' => 57,
                'product_feature_attribute_option_id' => $request->primary_material_karat,
    
            ]);

        }

        // plating material - 22

        if ($request->filled('plating_maretial') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $material_information_id,
                'product_feature_attribute_id' => 22,
                'product_feature_attribute_option_id' => $request->plating_material,
    
            ]);

        }

        // plating material Karat - 59

        if ( $request->filled('plating_material_karat') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $material_information_id,
                'product_feature_attribute_id' => 59,
                'product_feature_attribute_option_id' => $request->plating_material_karat,
    
            ]);

        }

        // secondary material - 54

        if ( $request->secondary_material > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $material_information_id,
                'product_feature_attribute_id' => 54,
                'product_feature_attribute_option_id' => $request->secondary_material,

            ]);

        }

        // secondary material karat - 58

        if ( $request->filled('secondary_material_karat') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $material_information_id,
                'product_feature_attribute_id' => 58,
                'product_feature_attribute_option_id' => $request->secondary_material_karat,

            ]);

        }

    }

}