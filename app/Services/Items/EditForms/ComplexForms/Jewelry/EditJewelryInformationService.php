<?php

namespace App\Services\Items\EditForms\ComplexForms\Jewelry;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;
use App\Models\ProductFeatureAttributeOption;

class EditJewelryInformationService
{

    public function editJewelryInformation($product)
    {

        // jwelery information

        // get old values and store in values array

        $values = $this->getOldValues($product);

        // base fields

        $fields = [
     
            'mount_type' => $values['mountType']->product_feature_attribute_option_id,
            'mount_type_name' => $values['mount_type_name'], 
            'gender' => $values['gender']->product_feature_attribute_option_id,
            'gender_name' => $values['gender_name'],
            'size' => optional($values['size'])->value,
            'length' => optional($values['length'])->value,
            'overall_weight' => $values['overallWeight'],

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

    public function getOldValues($product)
    {

        // get the old values from the database
        // we need to get the product feature id so we can get the child attributes of that feature

        $productFeature = ProductDescriptionProductFeature::where('product_description_id', $product->id)->where('product_feature_id', 17)
        
            ->first();

        $mountType = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 48)
            
            ->first();

        $mount_type_name = ProductFeatureAttributeOption::where('id', $mountType->product_feature_attribute_option_id)
        
            ->first()->value; 

        $gender = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 49)
            
            ->first();

        $gender_name = ProductFeatureAttributeOption::where('id', $gender->product_feature_attribute_option_id)
        
            ->first()->value;  

        $size = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 8)
            
            ->first();

        $length = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 31)
                
            ->first();
                

        $overallWeight = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 50)
            
            ->first()->value;


        return compact(

            'mountType',
            'mount_type_name',
            'gender',
            'gender_name',
            'size',
            'length',
            'overallWeight'

        );

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