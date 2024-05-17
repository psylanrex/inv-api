<?php

namespace App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices;

use App\Models\ProductDescriptionProductFeatureAttribute;

class RecordAttributesForJewelryService
{

    public function makeAttributeRecordsForJewelry($request, $jewelry_information_id)
    {

        // create one record for each jewelry attribute

        // mount type - 48

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $jewelry_information_id,
            'product_feature_attribute_id' => 48,
            'product_feature_attribute_option_id' => $request->mount_type,

        ]);

        // gender - 49

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $jewelry_information_id,
            'product_feature_attribute_id' => 49,
            'product_feature_attribute_option_id' => $request->gender

        ]);

        // size - 8

        if ( $request->filled('size') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $jewelry_information_id,
                'product_feature_attribute_id' => 8,
                'value' => $request->size,

            ]);

        }

        // length - 11

        if ( $request->filled('length') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $jewelry_information_id,
                'product_feature_attribute_id' => 11,
                'value' => $request->length,

            ]);

        }

        // overall weight - 50

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $jewelry_information_id,
            'product_feature_attribute_id' => 50,
            'value' => $request->overall_weight,

        ]);

    }

}