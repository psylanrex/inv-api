<?php

namespace App\Services\Items\SaveItems\Validation;

class GemstoneValidationRules
{


    public function gemstoneValidationRules()
    {

        return [


            'single' => 'required|boolean',
            'lot' => 'required|boolean',
            'gemstone' => [

                'required', 
                'integer'

            ],

            'color' => [

                'required', 
                'integer'
            ],

            'color_2' => 'nullable|integer',

            'cut' => [

                'required', 
                'integer'
            ],

            'grade' => [

                'exclude_if:gemstone,70',
                'integer' 
            ],

            'grade_2' => [

                'exclude_if:gemstone,70',
                'integer'

            ],

            'clarity' => [

                'required_if:gemstone,70', 
                'integer'
            ],

            'clarity_2' => 'nullable|integer',

            'height' => [

                'required', 
                'integer'
            ],

            'width' => [

                'required', 
                'integer'
            ],

            'depth' => [

                'required', 
                'integer'
            ],

            'ctw' => [

                'required', 
                'string'
            ],

            'gem_treatment' => 'nullable|array',

        ];

    }


}