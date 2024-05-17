<?php

namespace App\Services\Items\EditForms\ComplexForms\BaseDescriptions;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductFeatureAttributeOption;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\PopulateEditGemstoneFieldsService;

class EditGemstoneForMultipleDescriptionService
{

    public $hasGemstone;

    public function editGemstones($product)
    { 

        // check if the product has a gemstone

        $this->hasGemstone = $product->hasGemstone($product->id);

        $base = ['has_gemstone' => $this->hasGemstone];

        // get product description product feature numbers for gemstone.
        // set as array so we can identify the array key as stone number

        $product_description_product_features = $this->getProductDescriptionProductFeatures($base, $product->id);

        // count the stones that have values
        // default values are used for stones that do not have values

        $stone_count = $this->stoneCount($product_description_product_features);

        // assemble all fields necessary for the gemstone description

        $fields = array_merge(
            
            $base, 
            (new PopulateEditGemstoneFieldsService)->stoneOne($stone_count, $product_description_product_features),
            (new PopulateEditGemstoneFieldsService)->stoneTwo($stone_count, $product_description_product_features),
            (new PopulateEditGemstoneFieldsService)->stoneThree($stone_count, $product_description_product_features),
            (new PopulateEditGemstoneFieldsService)->stoneFour($stone_count, $product_description_product_features),
            (new PopulateEditGemstoneFieldsService)->stoneFive($stone_count, $product_description_product_features),
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

    public function stoneCount($product_description_product_features)
    {

        if ($this->hasGemstone == 1) {

            return count($product_description_product_features);

        } else {

            return 0;

        }

    }

    public function getProductDescriptionProductFeatures($base, $product_id)
    {

        if ($base['has_gemstone'] == 1) {

            $product_description_product_features = ProductDescriptionProductFeature::where('product_description_id', $product_id)

            ->where('product_feature_id', 1)
        
            ->get()
            
            ->toArray();     

        } else {

            $product_description_product_features = 0;

        }

        return $product_description_product_features;

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

}