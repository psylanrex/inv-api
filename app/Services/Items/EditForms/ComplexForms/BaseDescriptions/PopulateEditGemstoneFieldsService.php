<?php

namespace App\Services\Items\EditForms\ComplexForms\BaseDescriptions;

use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\GetOldGemstoneValuesService;

class PopulateEditGemstoneFieldsService
{

    public function stoneOne($stone_count, $product_description_product_features)
    {

        if ($stone_count == 0) {

            return [

                'has_gemstone_one' => 0,
                'gemstone_stone_one' => 0,
                'quantity_stone_one' => 0,
                'color_stone_one' => 0,
                'color_2_stone_one' => 0,
                'cut_stone_one' => 0,
                'clarity_stone_one' => 0,
                'clarity_2_stone_one' => 0,
                'grade_stone_one' => 0,
                'grade_2_stone_one' => 0,
                'height_stone_one' => '',
                'width_stone_one' => '',
                'depth_stone_one' => '',
                'ctw_stone_one' => '',
                'gem_treatment_stone_one' => []

            ];

        }

        // get the attributes for the first stone using index 0
        // array key is 0 because we are starting at 0

        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 0);

        return [

            // stone one

            'has_gemstone_one' => $stone_count > 0 ? 1 : 0,
            'gemstone_stone_one' => $values['gemstone'],
            'gemstone_name_stone_one' => $values['gemstone_name'],
            'quantity_stone_one' => $values['quantity'],
            'color_stone_one' => $values['color'],
            'color_name_stone_one' => $values['color_name'],
            'color_2_stone_one' => $values['color_2'],
            'color_2_name_stone_one' => $values['color_2_name'],
            'cut_stone_one' => $values['cut'],
            'cut_name_stone_one' => $values['cut_name'],
            'clarity_stone_one' => $values['clarity'],
            'clarity_name_stone_one' => $values['clarity_name'],
            'clarity_2_stone_one' => $values['clarity_2'],
            'clarity_2_name_stone_one' => $values['clarity_2_name'],
            'grade_stone_one' => $values['grade'],
            'grade_name_stone_one' => $values['grade_name'],
            'grade_2_stone_one' => $values['grade_2'],
            'grade_2_name_stone_one' => $values['grade_2_name'],
            'height_stone_one' => $values['height'],
            'width_stone_one' => $values['width'],
            'depth_stone_one' => $values['depth'],
            'ctw_stone_one' => $values['ctw'],
            'gem_treatment_stone_one' => $values['gem_treatments'],
            'gem_treatment_selected_stone_one' => $values['gem_treatments_selected']

        ];

    }

    public function stoneTwo($stone_count, $product_description_product_features)
    {

        if ($stone_count < 2) {

            return [

                'has_gemstone_two' => 0,
                'gemstone_stone_two' => 0,
                'quantity_stone_two' => 0,
                'color_stone_two' => 0,
                'color_2_stone_two' => 0,
                'cut_stone_two' => 0,
                'clarity_stone_two' => 0,
                'clarity_2_stone_two' => 0,
                'grade_stone_two' => 0,
                'grade_2_stone_two' => 0,
                'height_stone_two' => '',
                'width_stone_two' => '',
                'depth_stone_two' => '',
                'ctw_stone_two' => '',
                'gem_treatment_stone_two' => []

            ];

        }

        // get the attributes for the second stone using index 1
        // array key is 1 because we are starting at 0
        
        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 1);
         
        return [

            // stone two

            'has_gemstone_two' => 1,
            'gemstone_stone_two' => $values['gemstone'],
            'gemstone_stone_one_two' => $values['gemstone_name'],
            'quantity_stone_two' => $values['quantity'],
            'color_stone_two' => $values['color'],
            'color_name_stone_two' => $values['color_name'],
            'color_2_stone_two' => $values['color_2'],
            'color_2_name_stone_two' => $values['color_2_name'],
            'cut_stone_two' => $values['cut'],
            'cut_name_stone_two' => $values['cut_name'],
            'clarity_stone_two' => $values['clarity'],
            'clarity_name_stone_two' => $values['clarity_name'],
            'clarity_2_stone_two' => $values['clarity_2'],
            'clarity_2_name_stone_two' => $values['clarity_2_name'],
            'grade_stone_two' => $values['grade'],
            'grade_name_stone_two' => $values['grade_name'],
            'grade_2_stone_two' => $values['grade_2'],
            'grade_2_name_stone_two' => $values['grade_2_name'],
            'height_stone_two' => $values['height'],
            'width_stone_two' => $values['width'],
            'depth_stone_two' => $values['depth'],
            'ctw_stone_two' => $values['ctw'],
            'gem_treatment_stone_two' => $values['gem_treatments'],
            'gem_treatment_selected_stone_two' => $values['gem_treatments_selected']

        ];

    }

    public function stoneThree($stone_count, $product_description_product_features)
    {

        if ($stone_count < 3) {

            return [

                'has_gemstone_three' => 0,
                'gemstone_stone_three' => 0,
                'quantity_stone_three' => 0,
                'color_stone_three' => 0,
                'color_2_stone_three' => 0,
                'cut_stone_three' => 0,
                'clarity_stone_three' => 0,
                'clarity_2_stone_three' => 0,
                'grade_stone_three' => 0,
                'grade_2_stone_three' => 0,
                'height_stone_three' => '',
                'width_stone_three' => '',
                'depth_stone_three' => '',
                'ctw_stone_three' => '',
                'gem_treatment_stone_three' => []

            ];

        }

        // get the attributes for the third stone using index 2
        // array key is 2 because we are starting at 0
        
        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 2);
         
        return [

            // stone three

            'has_gemstone_three' => 1,
            'gemstone_stone_three' => $values['gemstone'],
            'gemstone_stone_one_three' => $values['gemstone_name'],
            'quantity_stone_three' => $values['quantity'],
            'color_stone_three' => $values['color'],
            'color_name_stone_three' => $values['color_name'],
            'color_2_stone_three' => $values['color_2'],
            'color_2_name_stone_three' => $values['color_2_name'],
            'cut_stone_three' => $values['cut'],
            'cut_name_stone_three' => $values['cut_name'],
            'clarity_stone_three' => $values['clarity'],
            'clarity_name_stone_three' => $values['clarity_name'],
            'clarity_2_stone_three' => $values['clarity_2'],
            'clarity_2_name_stone_three' => $values['clarity_2_name'],
            'grade_stone_three' => $values['grade'],
            'grade_name_stone_three' => $values['grade_name'],
            'grade_2_stone_three' => $values['grade_2'],
            'grade_2_name_stone_three' => $values['grade_2_name'],
            'height_stone_three' => $values['height'],
            'width_stone_three' => $values['width'],
            'depth_stone_three' => $values['depth'],
            'ctw_stone_three' => $values['ctw'],
            'gem_treatment_stone_three' => $values['gem_treatments'],
            'gem_treatment_selected_stone_three' => $values['gem_treatments_selected']

        ];

    }

    public function stoneFour($stone_count, $product_description_product_features)
    {
        
        if ($stone_count < 4) {

            return [

                'has_gemstone_four' => 0,
                'gemstone_stone_four' => 0,
                'quantity_stone_four' => 0,
                'color_stone_four' => 0,
                'color_2_stone_four' => 0,
                'cut_stone_four' => 0,
                'clarity_stone_four' => 0,
                'clarity_2_stone_four' => 0,
                'grade_stone_four' => 0,
                'grade_2_stone_four' => 0,
                'height_stone_four' => '',
                'width_stone_four' => '',
                'depth_stone_four' => '',
                'ctw_stone_four' => '',
                'gem_treatment_stone_four' => []

            ];

        }

        // get the attributes for the fourth stone using index 3
        // array key is 3 because we are starting at 0

        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 3);

        return [

            // stone four

            'has_gemstone_four' => 1,
            'gemstone_stone_four' => $values['gemstone'],
            'gemstone_stone_one_four' => $values['gemstone_name'],
            'quantity_stone_four' => $values['quantity'],
            'color_stone_four' => $values['color'],
            'color_name_stone_four' => $values['color_name'],
            'color_2_stone_four' => $values['color_2'],
            'color_2_name_stone_four' => $values['color_2_name'],
            'cut_stone_four' => $values['cut'],
            'cut_name_stone_four' => $values['cut_name'],
            'clarity_stone_four' => $values['clarity'],
            'clarity_name_stone_four' => $values['clarity_name'],
            'clarity_2_stone_four' => $values['clarity_2'],
            'clarity_2_name_stone_four' => $values['clarity_2_name'],
            'grade_stone_four' => $values['grade'],
            'grade_name_stone_four' => $values['grade_name'],
            'grade_2_stone_four' => $values['grade_2'],
            'grade_2_name_stone_four' => $values['grade_2_name'],
            'height_stone_four' => $values['height'],
            'width_stone_four' => $values['width'],
            'depth_stone_four' => $values['depth'],
            'ctw_stone_four' => $values['ctw'],
            'gem_treatment_stone_four' => $values['gem_treatments'],
            'gem_treatment_selected_stone_four' => $values['gem_treatments_selected']

        ];

    }

    public function stoneFive($stone_count, $product_description_product_features)
    {

        if ($stone_count < 5) {

            return [

                'has_gemstone_five' => 0,
                'gemstone_stone_five' => 0,
                'quantity_stone_four' => 0,
                'color_stone_five' => 0,
                'color_2_stone_five' => 0,
                'cut_stone_five' => 0,
                'clarity_stone_five' => 0,
                'clarity_2_stone_five' => 0,
                'grade_stone_five' => 0,
                'grade_2_stone_five' => 0,
                'height_stone_five' => '',
                'width_stone_five' => '',
                'depth_stone_five' => '',
                'ctw_stone_five' => '',
                'gem_treatment_stone_five' => []

            ];

        }

        // get the attributes for the fifth stone using index 4
        // array key is 4 because we are starting at 0

        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 4);
            

        return [

            // stone five

            'has_gemstone_five' => 1,
            'gemstone_stone_five' => $values['gemstone'],
            'gemstone_stone_one_five' => $values['gemstone_name'],
            'quantity_stone_five' => $values['quantity'],
            'color_stone_five' => $values['color'],
            'color_name_stone_five' => $values['color_name'],
            'color_2_stone_five' => $values['color_2'],
            'color_2_name_stone_five' => $values['color_2_name'],
            'cut_stone_five' => $values['cut'],
            'cut_name_stone_five' => $values['cut_name'],
            'clarity_stone_five' => $values['clarity'],
            'clarity_name_stone_five' => $values['clarity_name'],
            'clarity_2_stone_five' => $values['clarity_2'],
            'clarity_2_name_stone_five' => $values['clarity_2_name'],
            'grade_stone_five' => $values['grade'],
            'grade_name_stone_five' => $values['grade_name'],
            'grade_2_stone_five' => $values['grade_2'],
            'grade_2_name_stone_five' => $values['grade_2_name'],
            'height_stone_five' => $values['height'],
            'width_stone_five' => $values['width'],
            'depth_stone_five' => $values['depth'],
            'ctw_stone_five' => $values['ctw'],
            'gem_treatment_stone_five' => $values['gem_treatments'],
            'gem_treatment_selected_stone_five' => $values['gem_treatments_selected']

        ];

    }

}