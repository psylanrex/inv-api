<?php

namespace App\Services\Items\CreateForms\ComplexForms\Jewelry;

use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ItemInformationService;
use App\Services\Items\CreateForms\ComplexForms\Jewelry\GemstoneForJewelryDescriptionService;
use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ComplexDescriptionService;
use App\Services\Items\CreateForms\BaseForms\ItemImagesService;
use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\MaterialInformationService;

class JewelryFormService
{

    public function getForm($category_id)
    {

        // individual form pages

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'item_information' => (new ItemInformationService)->itemInformation($category_id),
            'item_images' => (new ItemImagesService)->itemImages(),
            'item_description' => (new ComplexDescriptionService)->itemDescription(),
            'jewelry_information' => (new JewelryInformationService)->jewelryInformation(),
            'material_information' => (new MaterialInformationService)->materialInformation(),
            'gemstone_description' => (new GemstoneForJewelryDescriptionService)->gemstoneFields($category_id)

        ];

    }

    

    

    

   
}