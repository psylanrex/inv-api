<?php

namespace App\Queries\HdImages;

use App\Models\Image;
use App\Models\ImageStatus;
use App\Models\ProductDescription;

class ListRejectedImagesQuery
{
    public function getData()
    {

        $product_ids = Image::where('Image.image_status_id', ImageStatus::REJECTED)

            ->join('inventory.ProductDescription', 'Image.product_description_id', '=', 'ProductDescription.id')

            ->join('inventory.VendorItemCode', function($join) {

                $join->on('ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')
                    ->where('VendorItemCode.vendor_id', '=', auth()->user()->vendor_id);

            })
            
            ->pluck('Image.product_description_id')->toArray();

        $products = ProductDescription::selectRaw('ProductDescription.*, VendorItemCode.item_code')

            ->with(['hdImages', 'rejectedImages'])

            ->join('inventory.VendorItemCode', 'ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')

            ->whereIn('ProductDescription.id', $product_ids)
            
            ->get();

        return $products;

    }


}