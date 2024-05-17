<?php

namespace App\Services\Items\SaveItems\ComplexItems\Gemstones\TransactionServices;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;
use App\Models\ProductFeatureAttributeOption;

class RecordAttributesForSingleGemstoneService
{

    public function makeAttributeRecordsForGemstones($request, $product_id)
    {

        // get the product_description_product_feature_id

        $product_description_product_feature_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 1)

            ->value('id');

        // create a record for each gemstone attribute

        $this->makeGemstoneRecord($request, $product_description_product_feature_id);     

    } 

    public function makeGemstoneRecord($request, $product_description_product_feature_id)
    {

        // create a record for each gemstone attribute

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'value' => 1,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color,
            'optional_product_feature_attribute_option_id' => $request->color_2 ? $request->color_2 : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut,

        ]);

        // clarity - 6

        if ( $request->clarity > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity,
                'optional_product_feature_attribute_option_id' => $request->clarity_2 ? $request->clarity_2 : null,

            ]);

        }

        // grade - 51

        if ( $request->grade > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade,
                'optional_product_feature_attribute_option_id' => $request->grade_2 ? $request->grade_2 : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment') ) {

            $treatments = $request->gem_treatment;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        } 

    }

}