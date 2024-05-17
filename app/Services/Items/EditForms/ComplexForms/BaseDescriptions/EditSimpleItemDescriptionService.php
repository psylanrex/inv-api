<?php

namespace App\Services\Items\EditForms\ComplexForms\BaseDescriptions;

use App\Models\DescriptionDetail;

class EditSimpleItemDescriptionService
{

    public function editSimpleItemDescription($product)
    {

        $complex_categories = [ 21, 38, 53 ];

        // item-description

        if ( ! in_array($product->category_id, $complex_categories) ) {

            $fields = [

                'name' => $product->name,
                'short_name' => $product->short_name,
                'description' =>  DescriptionDetail::where('id', $product->description_details_id)->first()->description
    
            ];

        } else {

            $fields = [

                'name' => $product->name,
                'short_name' => $product->short_name,
    
            ];

        }

        // metadata

        $metadata = [
            
            'item_description_required_fields' => $this->itemDescriptionRequiredFields($product, $complex_categories)

        ];

        return array_merge($fields, $metadata);

    }

    public function itemDescriptionRequiredFields($product, $complex_categories)
    {

        if ( ! in_array($product->category_id, $complex_categories) ) {

            return [

                'name',
                'short_name',
                'description'
    
            ];

        }

        return [

            'name',
            'short_name',

        ];

    }

}