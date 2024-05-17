<?php

namespace App\Services\Items\CreateForms\ComplexForms\BaseDescriptions;

use App\Models\ProductFeatureAttributeOption;

class MaterialInformationService
{

    public function materialInformation()
    {

        // material-information

        $fields = [

            'primary_material' => 0,
            'primary_material_karat' => 0,
            'secondary_material' => 0,
            'plating_material' => 0,
            'plating_material_karat' => 0,
            'secondary_material_karat' => 0

        ];

        // options and other form metadata
        
        $options = [
        
            'material_information_required_fields' => $this->materialInformationRequiredFields(),
            'material_information_prompts' => $this->materialInformationPrompts(),
            'default_hidden_fields' => $this->defaultHiddenFields(),
            'primary_material_options' => $this->primaryMaterialOptions(),
            'secondary_material_options' => $this->secondaryMaterialOptions(),
            'plating_material_options' => $this->platingMaterialOptions(),
            'plating_karat_options' => $this->platingKaratOptions(),
            'primary_material_karat_options' => $this->primaryMaterialKaratOptions(),
            'primary_material_karat_dependencies' => $this->primaryMaterialKaratDepencies()

        ];

        $fields = array_merge($fields, $options);

        return $fields;

    }

    public function primaryMaterialKaratDepencies()
    {

        return [

            954, 955, 956, 957

        ];

    }

    public function materialInformationRequiredFields()
    {

        return [

            'primary_material'

        ];

    }

    public function materialInformationPrompts()
    {

        return [

            'plating_material_karat' => 'K',
            'primary_material_karat' => 'K'

        ];

    }

    public function primaryMaterialOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 20)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function primaryMaterialKaratOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 57)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function secondaryMaterialOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 54)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function platingMaterialOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 22)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function platingKaratOptions()
    {

        return ProductFeatureAttributeOption::where('product_feature_attribute_id', 57)
        
            ->orderBy('value', 'asc')
        
            ->pluck('value', 'id');

    }

    public function defaultHiddenFields()
    {

        return [

            'primary_material_karat',
            'secondary_plating_material',
            'secondary_material_karat'

        ];

    }

}