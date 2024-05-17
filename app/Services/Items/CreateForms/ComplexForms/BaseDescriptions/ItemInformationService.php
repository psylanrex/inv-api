<?php

namespace App\Services\Items\CreateForms\ComplexForms\BaseDescriptions;

use App\Models\Category;
use App\Models\ItemCondition;
use App\Models\Brand;
use App\Models\ProductTag;

class ItemInformationService
{

    public function itemInformation($category_id)
    {
            
        // item-information

        $fields = [

            'item_code' => '',
            'price' => '',
            'category' => $category_id,
            'category_name' => Category::find($category_id)->name,
            'condition' => 0,
            'tags' => [], 
            'brand' => 0,
            'reorderable' => 1,
            'returnable' => 1,
            

        ];

        // gemstones category (58) has additional field

        if ( $category_id == 53 ) {

            $fields = array_merge($fields, [
                
                'lot' => 1,
                'single' => 0,
                'gemstone_radio_button_fields' => 'single, lot',
                'gemstone_radio_button_default_value' => 'lot'
                  
            ]);

        }

        // options and metadata

        $options = [


            'item_information_required_fields' => $this->itemInformationRequiredFields(),
            'tag_select_options' => $this->tagSelectOptions(),
            'condition_select_options' => $this->conditionSelectOptions(),
            'brand_select_options' => $this->brandSelectOptions()


        ];

        // merge and return

        $fields = array_merge($fields, $options);

        return $fields;

    }


    public function itemInformationRequiredFields()
    {

        return [

            'item_code',
            'price',
            'category',
            'condition',
            'reorderable',
            'returnable'

        ];

    }

    public function tagSelectOptions()
    {

        return ProductTag::orderBy('tag', 'asc')
    
            ->pluck('tag', 'id');

    }

    public function conditionSelectOptions()
    {

        return ItemCondition::orderBy('item_condition', 'asc')
        
            ->pluck('item_condition', 'id');

    }

    public function brandSelectOptions()
    {

        return Brand::orderBy('name', 'asc')
        
            ->pluck('name', 'id');

    }

}