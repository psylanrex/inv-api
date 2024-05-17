<?php

namespace App\Services\Items\EditForms\ComplexForms\Gemstones;

use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\GetOldGemstoneValuesService;

class PopulateValuesForSingleGemstoneEditService
{
    public function populateValues($product_description_product_features)
    {
        // get the attributes for the first stone using index 0
        // array key is 0 because we are starting at 0

        $values = (new GetOldGemstoneValuesService)->getOldGemstoneValues($product_description_product_features, 0);

        return [

            // stone one

            'gemstone' => $values['gemstone'],
            'gemstone_name' => $values['gemstone_name'],
            'quantity' => 1,
            'color' => $values['color'],
            'color_name' => $values['color_name'],
            'color_2' => $values['color_2'],
            'color_2_name' => $values['color_2_name'],
            'cut' => $values['cut'],
            'cut_name' => $values['cut_name'],
            'clarity' => $values['clarity'],
            'clarity_name' => $values['clarity_name'],
            'clarity_2' => $values['clarity_2'],
            'clarity_2_name' => $values['clarity_2_name'],
            'grade' => $values['grade'],
            'grade_name' => $values['grade_name'],
            'grade_2' => $values['grade_2'],
            'grade_2_name' => $values['grade_2_name'],
            'height' => $values['height'],
            'width' => $values['width'],
            'depth' => $values['depth'],
            'ctw' => $values['ctw'],
            'gem_treatment' => $values['gem_treatments'],
            'gem_treatment_selected' => $values['gem_treatments_selected']

        ];
        
    }

}