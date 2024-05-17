<?php

namespace App\Services\Items\SaveItems\Validation;


class BaseRules
{

    public function baseRules()
    {

        return [

            'vendor_id' => 'required|integer',
            'category' => 'required|integer',
            'item_code' => 'required|string',
            'price' => 'required|numeric',
            'brand' => 'required|integer',
            'condition' => 'required|integer',
            'hd_primary_image' => 'required|file|mimes:jpeg,jpg,png,gif|max:1080',
            'hd_secondary_image' => 'required|file|mimes:jpeg,jpg,png,gif|max:1080',
            'hd_image_3' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:1080',
            'hd_image_4' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:1080',
            'hd_image_5' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:1080',
            'hd_image_6' => 'nullable|file|mimes:jpeg,jpg,png,gif|max:1080',
            'short_name' => 'required|string|max:16',
            'name' => 'required|string|max:150',
            'tags' => 'nullable|array',
            'returnable' => 'required|boolean',
            'reorderable' => 'required|boolean',
            'gender' => 'required|integer',

        ];

    }

}