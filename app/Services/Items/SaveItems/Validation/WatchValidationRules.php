<?php

namespace App\Services\Items\SaveItems\Validation;

class WatchValidationRules
{

    public function watchValidationRules()
    {

        return [

            'gender' => 'required|integer',

            'movement' => 'required|integer',

            'glass_type' => 'required|integer',

            'clasp_type' => 'required|integer',

            'band_material' => 'required|integer',

            'functions' => 'nullable|array',

            'timezones' => 'required|integer',

            'diameter' => 'required|numeric',

            'height' => 'required|numeric',

            'length' => 'required|numeric',

            'weight' => 'required|numeric',

            'warranty_included' => 'required|boolean',

            'instructions_included' => 'required|boolean',

            'has_gemstone' => 'required|boolean',

            // material information

            'primary_material' => 'required|integer',

            'primary_material_karat' => 'nullable|integer',

            'secondary_material' => 'nullable|integer',

            'plating_material' => 'nullable|integer',

            'plating_material_karat' => 'nullable|integer',

            // gemstone one

            'has_gemstone_one' => 'required|boolean',

            'gemstone_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'

            ],

            'quantity_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'color_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'color_2_stone_one' => 'nullable|integer',

            'cut_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'clarity_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'clarity_2_stone_one' => 'nullable|integer',

            'height_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'width_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'depth_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'integer'
            ],

            'ctw_stone_one' => [

                'required_if:has_gemstone_one,1', 
                'nullable', 
                'string'
            ],

            'gem_treatment_stone_one' => 'nullable|array',


            // gemstone two

            'has_gemstone_two' => 'required|boolean',

            'gemstone_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'

            ],

            'quantity_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'color_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'color_2_stone_two' => 'nullable|integer',

            'cut_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'clarity_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'clarity_2_stone_two' => 'nullable|integer',

            'height_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'width_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'depth_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'integer'
            ],

            'ctw_stone_two' => [

                'required_if:has_gemstone_two,1', 
                'nullable', 
                'string'
            ],

            'gem_treatment_stone_two' => 'nullable|array',

            // gemstone three

            'has_gemstone_three' => 'required|boolean',

            'gemstone_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'

            ],

            'quantity_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'color_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'color_2_stone_three' => 'nullable|integer',

            'cut_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'clarity_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'clarity_2_stone_three' => 'nullable|integer',

            'height_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'width_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'depth_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'integer'
            ],

            'ctw_stone_three' => [

                'required_if:has_gemstone_three,1', 
                'nullable', 
                'string'
            ],

            'gem_treatment_stone_three' => 'nullable|array',

            // gemstone four

            'has_gemstone_four' => 'required|boolean',

            'gemstone_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'

            ],

            'quantity_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'color_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'color_2_stone_four' => 'nullable|integer',

            'cut_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'clarity_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'clarity_2_stone_four' => 'nullable|integer',

            'height_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'width_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'depth_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'integer'
            ],

            'ctw_stone_four' => [

                'required_if:has_gemstone_four,1', 
                'nullable', 
                'string'
            ],

            'gem_treatment_stone_four' => 'nullable|array',

            // gemstone five

            'has_gemstone_five' => 'required|boolean',

            'gemstone_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'

            ],

            'quantity_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'color_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'color_2_stone_five' => 'nullable|integer',

            'cut_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'clarity_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'clarity_2_stone_five' => 'nullable|integer',

            'height_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'width_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'depth_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'integer'
            ],

            'ctw_stone_five' => [

                'required_if:has_gemstone_five,1', 
                'nullable', 
                'string'
            ],

            'gem_treatment_stone_five' => 'nullable|array',

        ];

    }

}