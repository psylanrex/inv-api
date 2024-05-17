<?php

namespace App\Services\Items\CreateForms\ComplexForms\Watches;

use App\Models\ProductFeatureAttributeOption;


class WatchInformationService
{

    public function watchInformation()
    {

        // watch-information

        $fields = [

            'gender' => 0,
            'movement' => 0,
            'glass_type' => 0,
            'clasp_type' => 0,
            'band_material' => 0,
            'functions' => [],
            'timezones' => 0,
            'diameter' => '',
            'height' => '',
            'length' => '',
            'weight' => '',
            'warranty_included' => 0,
            'instructions_included' => 0,

        ];

        // options and other form metadata

        $options = [

            'watch_information_required_fields' => $this->watchInformationRequiredFields(),
            'watch_information_prompts' => $this->watchInformationPrompts(),
            'watch_radio_button_fields' => $this->watchRadioButtonFields(),
            'gender_options' => $this->genderOptions(),
            'movement_options' => $this->movementOptions(),
            'glass_type_options' => $this->glassTypeOptions(),
            'clasp_type_options' => $this->claspTypeOptions(),
            'band_material_options' => $this->bandMaterialOptions(),
            'functions_options' => $this->functionsOptions(),
            'timezones_options' => $this->timezoneOptions()

        ];

        $fields = array_merge($fields, $options);

        return $fields;

    }

    public function genderOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 49)
        
            ->orderBy('value', 'asc')
    
            ->pluck('value', 'id');

    }

    public function movementOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 26)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function glassTypeOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 27)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function claspTypeOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 28)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function bandMaterialOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 29)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function functionsOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 79)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function timezoneOptions()
    {

        return [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

    }

    public function watchInformationRequiredFields()
    {

        return [

            'gender',
            'movement',
            'glass_type',
            'clasp_type',
            'band_material',
            'timezones',
            'diameter',
            'height',
            'length',
            'weight'

        ];

    }

    public function watchInformationPrompts()
    {

        return [

            'diameter' => 'mm',
            'height' => 'mm',
            'length' => 'mm',
            'overall_weight' => '(g)'

        ];

    }

    public function watchRadioButtonFields()
    {

        return [

            'warranty_included',
            'instructions_included'

        ];

    }

}