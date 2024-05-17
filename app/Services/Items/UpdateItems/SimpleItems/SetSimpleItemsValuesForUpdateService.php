<?php

namespace App\Services\Items\UpdateItems\SimpleItems;   

use App\Models\ProductStatus;
use App\Models\ImageStatus;

class SetSimpleItemsValuesForUpdateService
{

    public function setValues($request)
    {
        
        return [

            'product_id' => $request->product_id,
            'category_id' => $request->category,
            'item_code' => $request->item_code,
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'short_name' => $request->short_name,
            'description' => $request->filled('description') ? $request->description : 0,
            'tags' => $request->tags ? $request->tags : null,
            'current_unit_cost' => $request->price,
            'price' => '0.00',
            'condition' => $request->condition,
            'brand' => $request->brand,
            'reorderable' => $request->reorderable,
            'returnable' => $request->returnable,
            'tags' => $this->tags($request),
            'product_gender_id' => 0,
            'description_status_id' => ProductStatus::NOT_REVIEWED,
            'product_status_id' => ProductStatus::NOT_REVIEWED,
            'image_status_id' => ImageStatus::REIMAGE,
            'voided' => 0,
            'discontinued' => 0,
            'schedulable' => 0,
            'vendor_returnable' => 1

        ];

    }

    public function tags($request)
    {

        $tags = $request->tags;


        if ( ! $tags[0] == null || ! $tags[0] == 0 ) {

            // format tags to integers

            $tags = explode(',', $tags[0]);

            $tags = array_map('intval', $tags);

        } else {

            $tags = 0;

        }

        return $tags;


    }

}