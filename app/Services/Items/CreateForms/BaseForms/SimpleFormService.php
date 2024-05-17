<?php

namespace App\Services\Items\CreateForms\BaseForms;

use App\Services\Items\CreateForms\BaseForms\ItemImagesService;
use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ItemInformationService;
use App\Services\Items\CreateForms\BaseForms\SimpleItemDescriptionService;

class SimpleFormService
{

    public function getSimpleFormStructure($category_id)
    {

        $vendor_id = auth()->user()->vendor_id;

        return [

            'vendor_id' => $vendor_id,
            'item_information' => (new ItemInformationService)->itemInformation($category_id),
            'item_images' => (new ItemImagesService)->itemImages(),
            'item_description' => (new SimpleItemDescriptionService)->simpleItemDescription()

        ];

    }

}