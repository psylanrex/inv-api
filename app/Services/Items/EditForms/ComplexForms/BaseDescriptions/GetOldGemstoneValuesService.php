<?php
namespace App\Services\Items\EditForms\ComplexForms\BaseDescriptions;

use App\Models\ProductDescriptionProductFeatureAttribute;
use App\Models\ProductFeatureAttributeOption;

class GetOldGemstoneValuesService
{

    public function getOldGemstoneValues($product_description_product_features, $index)
    {

        // find the stone attributes associated with the index value
        // For this query, index values with be 0, 1, 2, 3, 4,
        // representing 5 stone numbers 1 - 5

        $stone_attributes = ProductDescriptionProductFeatureAttribute::
         
            where('product_description_product_feature_id', $product_description_product_features[$index])

            ->get()

            ->toArray();

        //  get the following $stone_attributes
        // $product_description_product_features is a nested array
        // the array keys specified here are for the attributes of the stone, not the stone number itself

        $gemstone = $stone_attributes[0]['product_feature_attribute_option_id'];
        $gemstone_name = ProductFeatureAttributeOption::where('id', $gemstone)->value('value');

        $quantity = $stone_attributes[1]['product_feature_attribute_option_id'];

        $color = $stone_attributes[2]['product_feature_attribute_option_id'];
        $color_name = ProductFeatureAttributeOption::where('id', $color)->value('value');

        $color_2 = isset($stone_attributes[2]['optional_product_feature_attribute_option_id']) ? 
            $stone_attributes[2]['optional_product_feature_attribute_option_id'] : 0;
        $color_2_name = $color_2 > 0 ? ProductFeatureAttributeOption::where('id', $color_2)->value('value') : 0;

        $cut = $stone_attributes[3]['product_feature_attribute_option_id'];
        $cut_name = ProductFeatureAttributeOption::where('id', $cut)->value('value');

        // at position 4 in the array, we will have either clarity or grade

        if ( $this->hasAttribute($stone_attributes, 6) )  {

            $clarity = $stone_attributes[4]['product_feature_attribute_option_id'];

            $clarity_name = ProductFeatureAttributeOption::where('id', $clarity)->value('value');

            $clarity_2 = isset($stone_attributes[4]['optional_product_feature_attribute_option_id']) ? 

                $stone_attributes[4]['optional_product_feature_attribute_option_id'] : 0;
        
            $clarity_2_name = $clarity_2 > 0 ? ProductFeatureAttributeOption::where('id', $clarity_2)->value('value') : 0;

        } else {

            $clarity = 0;
            $clarity_name = 0;
            $clarity_2 = 0;
            $clarity_2_name = 0;

        }

        if ( $this->hasAttribute($stone_attributes, 51) )  {

            $grade = $stone_attributes[4]['product_feature_attribute_option_id'];

            $grade_name = ProductFeatureAttributeOption::where('id', $grade)->value('value');

            $grade_2 = isset($stone_attributes[4]['optional_product_feature_attribute_option_id']) ? 

                $stone_attributes[4]['optional_product_feature_attribute_option_id'] : 0;
        
            $grade_2_name = $grade_2 > 0 ? ProductFeatureAttributeOption::where('id', $grade_2)->value('value') : 0;

        } else {

            $grade = 0;
            $grade_name = 0;
            $grade_2 = 0;
            $grade_2_name = 0;

        }

        $height = $stone_attributes[5]['value'];

        $width = $stone_attributes[6]['value'];

        $depth = $stone_attributes[7]['value'];

        $ctw = $stone_attributes[8]['value'];

        $gem_treatments = [];

        if ( $this->hasAttribute($stone_attributes, 52) )  {

            $gem_treatments = $stone_attributes[9]['value'];

        } 

        // provide ids and names of selected gem treatments

        $gem_treatments_selected = [];

        if ( ! empty($gem_treatments) ) {

            $gem_treatments = explode(',', $gem_treatments);

            $gem_treatments_selected = ProductFeatureAttributeOption::whereIn('id', $gem_treatments)
            
                ->orderBy('value', 'asc')
                
                ->pluck('value', 'id');

        } 

        return compact(

            'gemstone',
            'gemstone_name',
            'quantity',
            'color',
            'color_name',
            'color_2',
            'color_2_name',
            'cut',
            'cut_name',
            'clarity',
            'clarity_name',
            'clarity_2',
            'clarity_2_name',
            'grade',
            'grade_name',
            'grade_2',
            'grade_2_name',
            'height',
            'width',
            'depth',
            'ctw',
            'gem_treatments',
            'gem_treatments_selected',

        );

    }

    public function hasAttribute($stone_attributes, $id)
    {

        // for optional attributes, we need to check if the attribute is present

        $has_attribute = false;

        foreach ($stone_attributes as $item) {
    
            if ($item['product_feature_attribute_id'] == $id) {

                $has_attribute = true;
        
                break; // No need to continue once we find it

            }

        }

        return $has_attribute;

    }
   
}