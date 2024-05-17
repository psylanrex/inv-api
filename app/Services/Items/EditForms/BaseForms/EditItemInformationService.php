<?php

namespace App\Services\Items\EditForms\BaseForms;

use App\Models\Category;
use App\Models\ItemCondition;
use App\Models\ProductDescriptionProductTag;
use App\Models\ProductTag;
use App\Models\Brand;
use App\Models\ProductDescription;

class EditItemInformationService
{

    public function editItemInformation($product)
    {

        $category_id = $product->category_id;
            
        // item-information

        // get old values for display

        $fields = [

            'item_code' => $product->vendorItemCode->item_code,
            'price' => $product->current_unit_cost,
            'category' => $category_id,
            'category_name' => Category::find($category_id)->name,
            'condition' => $product->item_condition_id,
            'condition_name' => ItemCondition::find($product->item_condition_id)->item_condition,
            'tags' => ProductDescriptionProductTag::where('product_description_id', $product->id)->pluck('product_tag_id'),
            'tags_selected' => $this->selectedTags($product),
            'brand' => $product->brand_id,
            'brand_name' => $this->formatBrandName($product, $category_id),
            'reorderable' => $product->reorderable,
            'returnable' => $product->returnable,
            

        ];

        // gemstones category (58) has additional field

        if ( $category_id == 53 ) {

            // if we have a gemstone, it's not a lot

            if ( (new ProductDescription)->hasGemstone($product->id) ) {

                $fields = array_merge($fields, [

                    'lot' => 0,
                    'single' => 1,
                    'gemstone_radio_button_fields' => 'single, lot',
                    'gemstone_radio_button_default_value' => 'single'
                    
                ]);

            } else {

                // absence of gemstone, it's a lot

                $fields = array_merge($fields, [
                    
                    'lot' => 1,
                    'single' => 0,
                    'gemstone_radio_button_fields' => 'single, lot',
                      
                ]);

            }

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

    public function selectedTags($product)
    {

        $tags = ProductDescriptionProductTag::where('product_description_id', $product->id)
        
            ->pluck('product_tag_id');

        $selected = [];

        foreach ( $tags as $tag ) {

            $result = ProductTag::where('id', $tag)->first();

            $selected[$result->id] = $result->tag;

        }

        return $selected;

    }

    public function formatBrandName($product, $category_id)
    {

        if ( $product->brand_id != 0 ) {

            return Brand::find($product->brand_id)->name;

        } 

        return 'Select Brand';

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