<?php

namespace App\Services\Items\EditForms\ComplexForms\Gemstones;

use App\Models\ProductDescription;
use App\Models\DescriptionDetail;

class EditGemstoneItemDescriptionService
{

    public function editGemstoneItemDescription($product)
    {

        if ( (new ProductDescription)->hasGemstone($product->id) ){

            $is_lot = 0;

        } else {

            $is_lot = 1;

        }

        if ( $is_lot == 0 ) {

            // if not a lot, we don't use the description field

            $fields = [

                'name' => $product->name,
                'short_name' => $product->short_name,

            ];

        } else {

            $fields = [

                'name' => $product->name,
                'short_name' => $product->short_name,
                'description' => DescriptionDetail::where('id', $product->description_details_id)->first()->description

            ];

        }

        // metadata

        $metadata = [

            'item_description_required_fields' => $this->itemDescriptionRequiredFields($is_lot)

        ];

        return array_merge($fields, $metadata);

    }

    public function itemDescriptionRequiredFields($is_lot)
    {

        if ( $is_lot == 1 ) {

            return [

                'name',
                'short_name',
                'description'

            ];

        }

        return [

            'name',
            'short_name'

        ];

    }

}