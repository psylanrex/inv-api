<?php

namespace App\Services\HdImages;

use App\Models\Image;
use App\Models\ImageType;

class GetImagesService
{
    public function getImages($product_id)
    {

        $image_types = [
            ImageType::HD_PRIMARY,
            ImageType::HD_SECONDARY,
            ImageType::HD_IMAGE_THREE,
            ImageType::HD_IMAGE_FOUR,
            ImageType::HD_SCALE
        ];

        $images = Image::where('product_description_id', $product_id)

            ->with(['imageComment'])
            ->whereIn('image_type_id', $image_types)
            ->get();


        $files = [

            'urls' => [],
            'comments' => []
            
        ];

        foreach ($images as $image) {

            $files['urls'][$image->image_type_id] = $image->imageUrl() . $image->filename();
            $files['comments'][$image->image_type_id] = ($image->imageComment) ? $image->imageComment->comment : '';

        }

        return $files;

    }

}
