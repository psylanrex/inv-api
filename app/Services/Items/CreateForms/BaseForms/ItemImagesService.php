<?php

namespace App\Services\Items\CreateForms\BaseForms;


class ItemImagesService
{

    public function itemImages()
    {

        // item-images

        $fields = [

            'hd_primary_image' => 0,
            'hd_scondary_image' => 0,
            'hd_image_3' => 0,
            'hd_image_4' => 0,
            'hd_image_5' => 0,
            'hd_image_6' => 0,

        ];

    
        // options and other metadata

        $options = [

            
            'item_images_required_fields' => $this->itemImagesRequiredFields(),
            'item_images_note' => $this->itemImagesNote()

        ];

        return array_merge($fields, $options);


    }

    public function itemImagesRequiredFields()
    {

        return [

            'hd_primary_image',
            'hd_scondary_image',

        ];

    }

    public function itemImagesNote()
    {

        return 'Note: Image Dimensions are restricted to min. 1080 x1080 pixels.';

    }



}