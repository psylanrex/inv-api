<?php

namespace App\Services\Items\CreateForms\ComplexForms\Jewelry;

use App\Models\ProductFeatureAttributeOption;

class JewelryInformationService
{

    public function jewelryInformation()
    {

        // base fields

        $fields = [
     
            'mount_type' => 0,
            'gender' => 0,
            'size' => '',
            'length' => '',
            'overall_weight' => '',

        ];

        //options and other form metadata

        $options = [

            'jewerly_information_required_fields' => $this->jewelryInformationRequiredFields(),
            'jewerly_information_prompts' => $this->jewleryInformationPrompts(),
            'mount_options' => $this->mountTypeOptions(),
            'gender_options' => $this->genderOptions(),
            'option_fields_dependencies' => $this->mountTypeFieldsDependencies(),
            'default_hidden_fields' => $this->defaultHiddenFields(),
            'gemstone_max_count' => 5,

        ];

        // mrege and return

        $fields = array_merge($fields, $options);

        return $fields;

    }

    public function mountTypeOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 48)
        
        ->orderBy('value', 'asc')   
    
        ->pluck('value', 'id');

    }

    public function genderOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 49)
        
        ->orderBy('value', 'asc')
    
        ->pluck('value', 'id');

    }

    public function mountTypeFieldsDependencies()
    {

        return [

            889 => 'size',
            890 => 'length',
            891 => 'length',

        ];

    }

    public function defaultHiddenFields()
    {

        return [

            'size',
            'length',

        ];

    }

    public function jewelryInformationRequiredFields()
    {

        return [

            'mount_type',
            'gender',
            'overall_weight'

        ];
            
    }

    public function jewleryInformationPrompts()
    {

        return [

            'size' => 'mm',
            'length' => 'inches',
            'overall_weight' => '(g)'

        ];
    }

}