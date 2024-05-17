<?php

namespace App\Services\Items\EditForms\ComplexForms\BaseDescriptions;

use App\Models\ProductDescriptionProductFeature;
use App\Models\ProductDescriptionProductFeatureAttribute;
use App\Models\ProductFeatureAttributeOption;


class EditMaterialInformationService
{

    public function editMaterialInformation($product)
    {

        // material-information

        // get old values and store in values array

        $values = $this->getOldValues($product);

        $fields = [

            'primary_material' => $values['primaryMaterial']->product_feature_attribute_option_id,
            'primary_material_name' => $values['primary_material_name'], 
            'primary_material_karat' => optional($values['primaryMaterialKarat'])->product_feature_attribute_option_id,
            'primary_material_karat_name' => $values['primary_material_karat_name'],
            'secondary_material' => optional($values['secondaryMaterial'])->product_feature_attribute_option_id,
            'secondary_material_name' => $values['secondary_material_name'],
            'plating_material_karat' => optional($values['platingMaterialKarat'])->product_feature_attribute_option_id,
            'plating_material_karat_name' => $values['plating_material_karat_name'],
            'secondary_material_karat' => optional($values['secondaryMaterialKarat'])->product_feature_attribute_option_id,
            'secondary_material_karat_name' => $values['secondary_material_karat_name']
            
        ];

        // options and other form metadata
        
        $options = [
        
            'material_information_required_fields' => $this->materialInformationRequiredFields(),
            'material_information_prompts' => $this->materialInformationPrompts(),
            'default_hidden_fields' => $this->defaultHiddenFields($values),
            'primary_material_options' => $this->primaryMaterialOptions(),
            'secondary_material_options' => $this->secondaryMaterialOptions(),
            'plating_material_options' => $this->platingMaterialOptions(),
            'plating_karat_options' => $this->platingKaratOptions()

        ];

        $fields = array_merge($fields, $options);

        return $fields;

    }

    public function getOldValues($product)
    {

        // get the old values from the database
        // we need to get the product feature id so we can get the child attributes of that feature

        $productFeature = ProductDescriptionProductFeature::where('product_description_id', $product->id)->where('product_feature_id', 15)
        
            ->first();

        $primaryMaterial = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 20)
            
            ->first();

        $primary_material_name = ProductFeatureAttributeOption::where('id', $primaryMaterial->product_feature_attribute_option_id)
        
            ->first()->value; 

        if ( $secondaryMaterial = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
            ->where('product_feature_attribute_id', 54)
        
            ->exists() ) {

                $secondaryMaterial = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
                    ->where('product_feature_attribute_id', 54)
            
                    ->first();

                $secondary_material_name = ProductFeatureAttributeOption::where('id', $secondaryMaterial->product_feature_attribute_option_id)
        
                    ->first()->value; 

        } else {

            $secondaryMaterial = 0;
            $secondary_material_name = NULL;
        }
        
        if ( ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
                ->where('product_feature_attribute_id', 22)
        
                ->exists() ) {

                $platingMaterial = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
        
                    ->where('product_feature_attribute_id', 22)
            
                    ->first();

                $plating_material_name = ProductFeatureAttributeOption::where('id', $platingMaterial->product_feature_attribute_option_id)
        
                    ->first()->value;
            
                $platingMaterialKarat = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
            
                    ->where('product_feature_attribute_id', 59)
                
                    ->first();

                $plating_material_karat_name = ProductFeatureAttributeOption::where('id', $platingMaterialKarat->product_feature_attribute_option_id)
            
                    ->first()->value;

        } else {

            $platingMaterial = 0;
            $plating_material_name = NULL;
            $platingMaterialKarat = 0;
            $plating_material_karat_name = NULL;

        }

        if ( ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
            
                ->where('product_feature_attribute_id', 57)
        
                ->exists()) {

                    $primaryMaterialKarat = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)
            
                        ->where('product_feature_attribute_id', 57)
                    
                        ->first();
        
                        $primary_material_karat_name = ProductFeatureAttributeOption::where('id', $primaryMaterialKarat->product_feature_attribute_option_id)
                
                        ->first()->value; 

        } else {

            $primaryMaterialKarat = 0;
            $primary_material_karat_name = NULL;    

        }

        if ( ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)

                ->where('product_feature_attribute_id', 58)

                ->exists() ) {

                    $secondaryMaterialKarat = ProductDescriptionProductFeatureAttribute::where('product_description_product_feature_id', $productFeature->id)

                        ->where('product_feature_attribute_id', 58)

                        ->first();

                    $secondary_material_karat_name = ProductFeatureAttributeOption::where('id', $secondaryMaterialKarat->product_feature_attribute_option_id)

                        ->first()->value;

        } else {

            $secondaryMaterialKarat = 0;
            $secondary_material_karat_name = NULL;

        }


        return compact(

            'primaryMaterial',
            'primary_material_name',
            'secondaryMaterial',
            'secondary_material_name',
            'platingMaterial',
            'plating_material_name',
            'platingMaterialKarat',
            'plating_material_karat_name',
            'primaryMaterialKarat',
            'primary_material_karat_name',
            'secondaryMaterialKarat',
            'secondary_material_karat_name'

        );



    }

    public function materialInformationRequiredFields()
    {

        return [

            'primary_material',

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

    public function defaultHiddenFields($values)
    {
       

        $hidden_fields = [];

        optional($values['primaryMaterialKarat'])->product_feature_attribute_option_id ?
            
            NULL : $hidden_fields[] = 'primary_material_karat';

        optional($values['platingMaterial'])->product_feature_attribute_option_id ?
                
            NUll : $hidden_fields[] = 'plating_material';

        return $hidden_fields;

    }

    




}