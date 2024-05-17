<?php

namespace App\Services\Items\CreateForms\ComplexForms\Watches;

use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ItemInformationService;
use App\Services\Items\CreateForms\BaseForms\ItemImagesService;
use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\ComplexDescriptionService;
use App\Services\Items\CreateForms\ComplexForms\Watches\WatchInformationService;
use App\Services\Items\CreateForms\ComplexForms\BaseDescriptions\MaterialInformationService;
use App\Services\Items\CreateForms\ComplexForms\Watches\GemstoneForWatchDescriptionService;


class WatchFormService
{

    public function getForm($category_id)
    {

        // individual form pages

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'item_information' => (new ItemInformationService)->itemInformation($category_id),
            'item_images' => (new ItemImagesService)->itemImages(),
            'item_description' => (new ComplexDescriptionService)->itemDescription(),
            'watch_information' => (new WatchInformationService)->watchInformation(),
            'material_information' => (new MaterialInformationService)->materialInformation(),
            'gemstone_description' => (new GemstoneForWatchDescriptionService)->gemstoneFields($category_id)

        ];

    }

}