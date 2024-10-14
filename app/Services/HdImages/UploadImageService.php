<?php

namespace App\Services\HdImages;

use App\Models\Image;
use App\Services\HdImages\ProcessUploadedImageService;
use App\Models\ProductDescription;
use Illuminate\Http\UploadedFile;

class UploadImageService
{

    public function uploadImage($request)
    {

        $product = ProductDescription::find($request->get('product_id'));

        foreach ($request->all() AS $key => $input) {

            // If the input is NOT an image, keep moving...

            if ( ! $input instanceof UploadedFile) {

                continue;

            }

            $image = new ProcessUploadedImageService($request->{$key}, $product, true, $request->has('rejected'), "/pending");

            $image->process(Image::getImageType($key));

        }

        return [

            'success' => true, 
            'code' => 200
        
        ];


    }


}