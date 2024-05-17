<?php

namespace App\Services\Items\SaveItems\SimpleItems;

use App\Models\ProductStatus;
use App\Models\ImageStatus;

class SetSimpleItemValuesService
{
    public function setSimpleItemValues($request)
    {
        $category_id = $request->category;
        $item_code = $request->item_code;
        $vendor_id = $request->vendor_id;
        $name = $request->name ? $request->name : 'placeholder';
        $short_name = $request->short_name;
        $description = $request->filled('description') ? $request->description : 0;
        $tags = $request->tags;
        $current_unit_cost = $request->price;
        $price = '0.00';
        $condition = $request->condition;
        $brand = $request->brand;
        $reorderable = $request->reorderable;
        $returnable = $request->returnable;  

        // default product gender id

        $product_gender_id = 0;

        if ( ! $tags[0] == null || ! $tags[0] == 0 ) {

            // format tags to integers

            $tags = explode(',', $tags[0]);

            $tags = array_map('intval', $tags);

        } else {

            $tags = 0;

        }

        // default values

        $description_status_id = ProductStatus::NOT_REVIEWED;
        $product_status_id = ProductStatus::NOT_REVIEWED;
        $image_status_id = ImageStatus::REIMAGE;
        $voided = 0;
        $discontinued = 0;
        $schedulable = 0;
        $vendor_returnable = 1;

        return [

            'category_id' => $category_id,
            'item_code' => $item_code,
            'vendor_id' => $vendor_id,
            'name' => $name,
            'short_name' => $short_name,
            'description' => $description,
            'tags' => $tags,
            'current_unit_cost' => $current_unit_cost,
            'price' => $price,
            'condition' => $condition,
            'brand' => $brand,
            'reorderable' => $reorderable,
            'returnable' => $returnable,
            'tags' => $tags,
            'product_gender_id' => $product_gender_id,
            'description_status_id' => $description_status_id,
            'product_status_id' => $product_status_id,
            'image_status_id' => $image_status_id,
            'voided' => $voided,
            'discontinued' => $discontinued,
            'schedulable' => $schedulable,
            'vendor_returnable' => $vendor_returnable

        ];

    }

}