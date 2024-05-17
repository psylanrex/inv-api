<?php

namespace App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;

class RecordAttributesForGemstonesService
{

    public function makeAttributeRecordsForGemstones($request, $product_id)
    {

        // get the product_description_product_feature_ids

        if ( ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 1)

            ->exists() ) {

                $features = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
                    ->where('product_feature_id', 1)

                    ->get();

        } else {

            return;

        }


        foreach ( $features as $feature ) {

            $product_description_product_feature_ids [] = $feature->id;

        }

        $records_count = count($product_description_product_feature_ids);

        $gemstone_count = (new CountGemstonesService)->countGemstones($request);

        if ($records_count != $gemstone_count) {

            throw new \Exception('Gemstone count does not match records count.');

        }

        // check to see if a gemstone record exists for each gemstone
        // if so, create the product description product feature attribute records

        if ( isset($product_description_product_feature_ids[0]) ) {

            $this->makeGemstoneRecordOne($request, $product_description_product_feature_ids[0]);

        }

        if ( isset($product_description_product_feature_ids[1]) ) {

            $this->makeGemstoneRecordTwo($request, $product_description_product_feature_ids[1]);
            
        }

        if ( isset($product_description_product_feature_ids[2]) ) {

            $this->makeGemstoneRecordThree($request, $product_description_product_feature_ids[2]);
            
        }

        if ( isset($product_description_product_feature_ids[3]) ) {

            $this->makeGemstoneRecordFour($request, $product_description_product_feature_ids[3]);
            
        }

        if ( isset($product_description_product_feature_ids[4]) ) {

            $this->makeGemstoneRecordFive($request, $product_description_product_feature_ids[4]);
            
        }

        return $product_description_product_feature_ids;

    } 

    public function makeGemstoneRecordOne($request, $product_description_product_feature_id)
    {

        // create a record for each gemstone attribute

        // !! Do not change the order of the attributes !!
        // order must be preserved for updating records

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone_stone_one,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'product_feature_attribute_option_id' => $request->quantity_stone_one,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color_stone_one,
            'optional_product_feature_attribute_option_id' => $request->color_2_stone_one ? $request->color_2_stone_one : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut_stone_one,

        ]);

        // clarity - 6

        if ( $request->clarity_stone_one > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity_stone_one,
                'optional_product_feature_attribute_option_id' => $request->clarity_2_stone_one ? $request->clarity_2_stone_one : null,

            ]);

        }

        // grade - 51

        if ( $request->grade_stone_one > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade_stone_one,
                'optional_product_feature_attribute_option_id' => $request->grade_2_stone_one ? $request->grade_2_stone_one : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height_stone_one,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width_stone_one,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth_stone_one,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw_stone_one,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment_stone_one') ) {

            $treatments = $request->gem_treatment_stone_one;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        }          

    }
    

    public function makeGemstoneRecordTwo($request, $product_description_product_feature_id)
    {

        // create a record for each gemstone attribute

        // !! Do not change the order of the attributes !!
        // order must be preserved for updating records

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone_stone_two,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'product_feature_attribute_option_id' => $request->quantity_stone_two,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color_stone_two,
            'optional_product_feature_attribute_option_id' => $request->color_2_stone_two ? $request->color_2_stone_two : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut_stone_two,

        ]);

        // clarity - 6

        if ( $request->clarity_stone_two > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity_stone_two,
                'optional_product_feature_attribute_option_id' => $request->clarity_2_stone_two ? $request->clarity_2_stone_two : null,

            ]);

        }

        // grade - 51

        if ( $request->grade_stone_two > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade_stone_two,
                'optional_product_feature_attribute_option_id' => $request->grade_2_stone_two ? $request->grade_2_stone_two : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height_stone_two,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width_stone_two,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth_stone_two,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw_stone_two,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment_stone_two') ) {

            $treatments = $request->gem_treatment_stone_two;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        } 

    }

    public function makeGemstoneRecordThree($request, $product_description_product_feature_id)
    {

         // create a record for each gemstone attribute

         // !! Do not change the order of the attributes !!
        // order must be preserved for updating records

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone_stone_three,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'product_feature_attribute_option_id' => $request->quantity_stone_three,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color_stone_three,
            'optional_product_feature_attribute_option_id' => $request->color_2_stone_three ? $request->color_2_stone_three : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut_stone_three,

        ]);

        // clarity - 6

        if ( $request->clarity_stone_three > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity_stone_three,
                'optional_product_feature_attribute_option_id' => $request->clarity_2_stone_three ? $request->clarity_2_stone_three : null,

            ]);

        }

        // grade - 51

        if ( $request->grade_stone_three > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade_stone_three,
                'optional_product_feature_attribute_option_id' => $request->grade_2_stone_three ? $request->grade_2_stone_three : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height_stone_three,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width_stone_three,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth_stone_three,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw_stone_three,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment_stone_three') ) {

            $treatments = $request->gem_treatment_stone_three;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        } 

    }

    public function makeGemstoneRecordFour($request, $product_description_product_feature_id)
    {

        // create a record for each gemstone attribute

        // !! Do not change the order of the attributes !!
        // order must be preserved for updating records

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone_stone_four,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'product_feature_attribute_option_id' => $request->quantity_stone_four,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color_stone_four,
            'optional_product_feature_attribute_option_id' => $request->color_2_stone_four ? $request->color_2_stone_four : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut_stone_four,

        ]);

        // clarity - 6

        if ( $request->clarity_stone_four > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity_stone_four,
                'optional_product_feature_attribute_option_id' => $request->clarity_2_stone_four ? $request->clarity_2_stone_four : null,

            ]);

        }

        // grade - 51

        if ( $request->grade_stone_four > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade_stone_four,
                'optional_product_feature_attribute_option_id' => $request->grade_2_stone_four ? $request->grade_2_stone_four : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height_stone_four,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width_stone_four,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth_stone_four,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw_stone_four,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment_stone_four') ) {

            $treatments = $request->gem_treatment_stone_four;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        } 

    }

    public function makeGemstoneRecordFive($request, $product_description_product_feature_id)
    {

        // create a record for each gemstone attribute

        // !! Do not change the order of the attributes !!
        // order must be preserved for updating records

        // gemstone - 1

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 1,
            'product_feature_attribute_option_id' => $request->gemstone_stone_five,

        ]);

        // quantity - 2

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $this->$product_description_product_feature_id,
            'product_feature_attribute_id' => 2,
            'product_feature_attribute_option_id' => $request->quantity_stone_five,

        ]);

        // color - 5

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 5,
            'product_feature_attribute_option_id' => $request->color_stone_five,
            'optional_product_feature_attribute_option_id' => $request->color_2_stone_five ? $request->color_2_stone_five : null,

        ]);

        // cut - 4

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 4,
            'product_feature_attribute_option_id' => $request->cut_stone_five,

        ]);

        // clarity - 6

        if ( $request->clarity_stone_five > 0 ) {
            

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 6,
                'product_feature_attribute_option_id' => $request->clarity_stone_five,
                'optional_product_feature_attribute_option_id' => $request->clarity_2_stone_five ? $request->clarity_2_stone_five : null,

            ]);

        }

        // grade - 51

        if ( $request->grade_stone_five > 0 ) {

            ProductDescriptionProductFeatureAttribute::create([

                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 51,
                'product_feature_attribute_option_id' => $request->grade_stone_five,
                'optional_product_feature_attribute_option_id' => $request->grade_2_stone_five ? $request->grade_2_stone_five : null,

            ]);

        }

        // height - 33

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 33,
            'value' => $request->height_stone_five,

        ]);

        // width - 46

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 46,
            'value' => $request->width_stone_five,

        ]);

        // depth - 47

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 47,
            'value' => $request->depth_stone_five,

        ]);

        // ctw - 3

        ProductDescriptionProductFeatureAttribute::create([

            'product_description_product_feature_id' => $product_description_product_feature_id,
            'product_feature_attribute_id' => 3,
            'value' => $request->ctw_stone_five,

        ]);

        // gem treatment - 52

        if ( $request->filled('gem_treatment_stone_five') ) {

            $treatments = $request->gem_treatment_stone_five;


            ProductDescriptionProductFeatureAttribute::create([
    
                'product_description_product_feature_id' => $product_description_product_feature_id,
                'product_feature_attribute_id' => 52,
                'value' => implode(',', $treatments),
    
            ]);
    
        } 

    }

}