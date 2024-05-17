<?php

namespace App\Services\Items\EditForms\ComplexForms\Watches;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;
use App\Models\ProductFeatureAttributeOption;


class EditWatchInformationService
{

    public function editWatchInformation($product)
    {


        // watch information

        // get old values and store in values array

        $values = $this->getOldValues($product);

        // base fields

        $fields = [

            'gender' => $values['gender']->product_feature_attribute_option_id,
            'gender_name' => $values['gender_name'],
            'movement' => $values['movement']->product_feature_attribute_option_id,
            'movement_name' => $values['movement_name'],
            'glass_type' => $values['glass_type']->product_feature_attribute_option_id,
            'glass_type_name' => $values['glass_type_name'],
            'clasp_type' => $values['clasp_type']->product_feature_attribute_option_id,
            'clasp_type_name' => $values['clasp_type_name'],
            'band_material' => $values['band_material']->product_feature_attribute_option_id,
            'band_material_name' => $values['band_material_name'],
            'functions' => $values['functions'] ? $values['functions'] : [],
            'functions_selected' => $values['functions_selected'],
            'timezones' => $values['timezones'],
            'diameter' => $values['diameter'],
            'height' => $values['height'],
            'length' => $values['length'],
            'weight' => $values['weight'],
            'warranty_included' => $values['warranty_included'],
            'instructions_included' => $values['instructions_included']
     
        ];

        //options and other form metadata

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

        // mrege and return

        $fields = array_merge($fields, $options);

        return $fields;

    }

    public function getOldValues($product)
    {

        // get the old values from the database
        // we need to get the product feature id so we can get the child attributes of that feature

        $productFeature = ProductDescriptionProductFeature::where('product_description_id', $product->id)->where('product_feature_id', 9)
        
            ->first();

        $gender = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 49)
            
            ->first();

        $gender_name = ProductFeatureAttributeOption::where('id', $gender->product_feature_attribute_option_id)
        
            ->first()->value; 

        $movement = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 26)
            
            ->first();

        $movement_name = ProductFeatureAttributeOption::where('id', $movement->product_feature_attribute_option_id)
        
            ->first()->value;  

        $glass_type = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 27)
            
            ->first();

        $glass_type_name = ProductFeatureAttributeOption::where('id', $glass_type->product_feature_attribute_option_id)
        
            ->first()->value;  

        $clasp_type = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 28)
                
            ->first();

        $clasp_type_name = ProductFeatureAttributeOption::where('id', $clasp_type->product_feature_attribute_option_id)
        
            ->first()->value; 
            
        $band_material = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 29)
                
            ->first();

        $band_material_name = ProductFeatureAttributeOption::where('id', $band_material->product_feature_attribute_option_id)
        
            ->first()->value; 
                  

        $functions = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 79)
                
            ->first()->value;

        // provide ids and names of selected functions

        $functions_selected = [];

        if ($functions != null) {

            $functions = explode(',', $functions);

            $functions_selected = ProductFeatureAttributeOption::whereIn('id', $functions)
            
                ->orderBy('value', 'asc')
                
                ->pluck('value', 'id');

        } 


        $timezones = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
            
            ->where('product_feature_attribute_id', 25)
                    
            ->first()->value;
  

        $diameter = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 32)
            
            ->first()->value;

        $height = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)

            ->where('product_feature_attribute_id', 45)
            
            ->first()->value;

        $length = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)

            ->where('product_feature_attribute_id', 43)
            
            ->first()->value;

        $weight = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 30)
            
            ->first()->value;

        $warranty_included = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 81)
            
            ->first()->value;

        $instructions_included = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
            
                ->where('product_feature_attribute_id', 82)
                
                ->first()->value;


        return compact(

            'gender',
            'gender_name',
            'movement',
            'movement_name',
            'glass_type',
            'glass_type_name',
            'clasp_type',
            'clasp_type_name',
            'band_material',
            'band_material_name',
            'functions',
            'functions_selected',
            'timezones',
            'diameter',
            'height',
            'length',
            'weight',
            'warranty_included',
            'instructions_included'      

        );

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