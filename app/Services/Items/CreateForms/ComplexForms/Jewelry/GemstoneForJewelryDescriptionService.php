<?php

namespace App\Services\Items\CreateForms\ComplexForms\Jewelry;

use App\Models\ProductFeatureAttributeOption;

class GemstoneForJewelryDescriptionService
{

    public function gemstoneFields($category_id)
    {

        $base = ['has_gemstone' => 0];

        $fields = array_merge(
            
            $base, 
            $this->stoneOne(), 
            $this->stoneTwo(), 
            $this->stoneThree(), 
            $this->stoneFour(), 
            $this->stoneFive(),
            $this->metaData()
        
        );

        return $fields;

    }

    public function metaData()
    {

        return [

            'gemstone_required_fields' => $this->gemstoneRequiredField_Labels(),
            'gemstone_prompts' => $this->gemstonePrompts(),
            'gemstone_default_hidden_fields' => $this->gemstoneDefaultHiddenFields(),
            'gemstone_options' => $this->gemstoneOptions(),
            'color_options' => $this->colorOptions(),
            'cut_options' => $this->cutOptions(),
            'clarity_options' => $this->clarityOptions(),
            'grade_options' => $this->gradeOptions(),
            'gemstone_treatment_options' => $this->gemstoneTreatmentOptions(),
            'gemstone_dependent_fields' => $this->gemstoneDependentFields(),

        ];

    }

    public function gemstoneOptions()
    {
            
        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 1)

            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function colorOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 5)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');


    }

    public function cutOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 4)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');


    }

    public function clarityOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 6)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');


    }

    public function gradeOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 51)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function gemstoneTreatmentOptions()
    {

        return  ProductFeatureAttributeOption::where('product_feature_attribute_id', 52)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function gemstoneRequiredField_Labels()
    {

        return [

            'gemstone',
            'quantity',
            'color',
            'cut',
            'clarity',
            'grade',
            'height',
            'width',
            'depth',
            'ctw'

        ];

    }

    public function gemstoneDefaultHiddenFields()
    {

        return [

            'color_2',
            'clarity_2',
            'grade_2'

        ];

    }

    public function gemstonePrompts()
    {

        return [

            'ctw' => 'CTW',
            'height' => 'mm',
            'width' => 'mm',
            'depth' => 'mm'

        ];

    }

    public function gemstoneDependentFields()
    {

        return [

            'get dependency field by using gemstone_id as id' => '/api/items/gemstone-dependent-fields/{id}',

        ];

    }

    public function stoneOne()
    {

        return [

            // stone one

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

    public function stoneTwo()
    {

        return [

            // stone two

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

    public function stoneThree()
    {

        return [

            // stone three

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

    public function stoneFour()
    {
        
        return [

            // stone four

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
            'gem_treatment_stone_four' => [],

        ];

    }

    public function stoneFive()
    {

        return [

            // stone five

            'has_gemstone_five' => 0,
            'gemstone_stone_five' => 0,
            'quantity_stone_five' => 0,
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
            'gem_treatment_stone_five' => [],

        ];

    }   

}