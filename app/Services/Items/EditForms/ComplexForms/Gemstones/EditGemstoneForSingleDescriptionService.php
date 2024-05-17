<?php

namespace App\Services\Items\EditForms\ComplexForms\Gemstones;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductFeatureAttributeOption;
use App\Services\Items\EditForms\ComplexForms\Gemstones\PopulateValuesForSingleGemstoneEditService;


class EditGemstoneForSingleDescriptionService
{

    public function editGemstone($product)
    { 
        // get product description product feature numbers for gemstone.
        // set as array so we can identify the array key as stone number

        $product_description_product_features = $this->getProductDescriptionProductFeatures($product->id);

        // we only have one stone for this form, no need to set a stone number    

        $fields = array_merge(

            // to keep the code consistent, 
            //we use the same service to populate the fields as we do for multiple gemstone descriptions
            // stone count will always be 1 for this form
            
            (new PopulateValuesForSingleGemstoneEditService)->populateValues($product_description_product_features),
            
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

    public function getProductDescriptionProductFeatures($product_id)
    {

            return ProductDescriptionProductFeature::where('product_description_id', $product_id)

            ->where('product_feature_id', 1)
        
            ->get()
            
            ->toArray();     

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
    
}