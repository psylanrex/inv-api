<?php

namespace App\Services\Items\SaveItems\Images;

class SaveImagesService
{

    public function saveImages($request, $product)
    {
        $image_types = [
            
            'hd_primary_image', 'hd_secondary_image', 'hd_image_3', 'hd_image_4', 'hd_image_5', 'hd_image_6'
        
        ];

        foreach ( $image_types as $type ) {

            if ($request->hasFile($type)) {


                $type_id = $this->convertToImageTypeId($type);

                // need category and type for correct folder path
                // /{categoryId}/{imageTypeId}/{productDescriptionId}.jpg

                $category_and_type_id = $product->category_id . '/' . $type_id;

                $file = $request->file($type);

                // we need to get the product id to use as the filename
                // this should replace type with the product id
                
                $filename =  $product->id . '.' . $file->getClientOriginalExtension();
        
                // Store the file in the storage/app/public directory

                // we need to store to Amazon

                // $request->file($type)->storeAs($category_and_type_id, $filename);
            }

        }
        
    }

    public function convertToImageTypeId($type)
    {
        switch ($type) {

            case 'hd_primary_image':

                return 24;
                break;

            case 'hd_secondary_image':

                return 25;
                break;

            case 'hd_image_3':

                return 26;
                break;

            case 'hd_image_4':

                return 27;
                break;

            case 'hd_image_5':

                return 29;
                break;

            case 'hd_image_6':

                return 30;
                break;

            default:

                return 24;

        }
    }

}