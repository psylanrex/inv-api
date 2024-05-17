<?php

namespace App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices;

use App\Models\ProductDescriptionProductFeatureAttribute;

class RecordAttributesForWatchService
{

    public function makeAttributeRecordsForWatch($request, $watch_information_id)
    {
        // create one record for each watch attribute

        // gender - 20

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 49,
            'product_feature_attribute_option_id' => $request->gender,

        ]);

        // movement - 26    

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 26,
            'product_feature_attribute_option_id' => $request->movement,

        ]);

        // glass type - 27

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 27,
            'product_feature_attribute_option_id' => $request->glass_type,

        ]);

        // clasp_type - 28

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 28,
            'product_feature_attribute_option_id' => $request->clasp_type,

        ]);

        // band_material - 29

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 29,
            'product_feature_attribute_option_id' => $request->band_material,

        ]);

        // functions - 79

        if ( $request->filled('functions') ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $watch_information_id,
                'product_feature_attribute_id' => 79,
                'value' => implode(',', $request->functions),

            ]);

        }

        // timezones - 25

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 25,
            'value' => $request->timezones,

        ]);

        // diameter - 32

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 32,
            'value' => $request->diameter,

        ]);

        // height - 45

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 45,
            'value' => $request->height,

        ]);

        // length - 43

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 43,
            'value' => $request->length,

        ]);

        // weight - 30

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 30,
            'value' => $request->weight,

        ]);

        // warranty included - 81

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 81,
            'value' => $request->warranty_included,

        ]);

        // instructions included - 82

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $watch_information_id,
            'product_feature_attribute_id' => 82,
            'value' => $request->instructions_included,

        ]);














    }

}