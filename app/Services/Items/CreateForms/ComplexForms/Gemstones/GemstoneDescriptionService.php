<?php

namespace App\Services\Items\CreateForms\ComplexForms\Gemstones;

use App\Models\ProductFeatureAttributeOption;

class GemstoneDescriptionService
{

    public function gemstoneFields($category_id)
    {

        $fields = [

            'gemstone' => 0,
            'color' => 0,
            'color_2' => 0,
            'cut' => 0,
            'clarity' => 0,
            'clarity_2' => 0,
            'grade' => 0,
            'grade_2' => 0,
            'height' => '',
            'width' => '',
            'depth' => '',
            'ctw' => '',
            'gem_treatment' => [],

        ];

        if ( $category_id == 53 ) {

            $fields = array_merge($fields, [

                'gemstone_description_visible' => 0

            ]);

        }

        $options = [

            
            'gemstone_required_fields' => $this->gemstoneRequiredFields(),
            'gemstone_prompts' => $this->gemstonePrompts(),
            'gemstone_default_hidden_fields' => $this->gemstoneDefaultHiddenFields(),
            'gemstone_options' => $this->gemstoneOptions(),
            'color_options' => $this->colorOptions(),
            'cut_options' => $this->cutOptions(),
            'clarity_options' => $this->clarityOptions(),
            'grade_options' => $this->gradeOptions(),
            'gemstone_grade_options' => $this->gradeOptions(),
            'gemstone_treatment_options' => $this->gemstoneTreatmentOptions(),
            'gemstone_dependent_fields' => $this->gemstoneDependentFields(),

        ];

        $fields = array_merge($fields, $options);

        return $fields;

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

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 52)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function gemstoneRequiredFields()
    {

        return [

            'gemstone',
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

            'grade',
            'grade_2',
            'clarity',
            'clarity_2'

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

}