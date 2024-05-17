<?php

namespace App\Services\Items\CreateForms\ComplexForms\Gemstones;

use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ItemInformationService;
use App\Services\Items\CreateForms\BaseForms\ItemImagesService;


class GemstoneFormService
{

    public function getForm($category_id)
    {

        // get item description

        $item_description = (new GemstoneItemDescriptionService)->itemDescription();

        

        // individual form pages

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'item_information' => (new ItemInformationService)->itemInformation($category_id),
            'item_images' => (new ItemImagesService)->itemImages(),
            'item_description' => $item_description,
            'gemstone_description' => (new GemstoneDescriptionService)->gemstoneFields($category_id)

        ];

    }

}