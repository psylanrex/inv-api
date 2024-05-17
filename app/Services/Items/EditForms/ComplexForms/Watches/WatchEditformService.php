<?php

namespace App\Services\Items\EditForms\ComplexForms\Watches;

use App\Services\Items\EditForms\BaseForms\EditItemInformationService;
use App\Services\Items\EditForms\BaseForms\EditItemImagesService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditSimpleItemDescriptionService;
use App\Services\Items\EditForms\ComplexForms\Watches\EditWatchInformationService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditMaterialInformationService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditGemstoneForMultipleDescriptionService;
use App\Services\Items\CreateForms\ComplexForms\Watches\GemstoneForWatchDescriptionService;


class WatchEditFormService
{

    public function getEditForm($product)
    {

        if ( $product->hasGemstone($product->id) ) {

            return [

                'vendor_id' => auth()->user()->vendor_id,
                'product_id' => $product->id,
                'item_information' => (new EditItemInformationService)->editItemInformation($product),
                'item_images' => (new EditItemImagesService)->editItemImages($product),
                'item_description' => (new EditSimpleItemDescriptionService)->editSimpleItemDescription($product),
                'watch_information' => (new EditWatchInformationService)->editWatchInformation($product),
                'material_information' => (new EditMaterialInformationService)->editMaterialInformation($product),
                'gemstone_description' => (new EditGemstoneForMultipleDescriptionService)->editGemstones($product)

            ];

        }

        // individual form components are assembled here

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'product_id' => $product->id,
            'item_information' => (new EditItemInformationService)->editItemInformation($product),
            'item_images' => (new EditItemImagesService)->editItemImages($product),
            'item_description' => (new EditSimpleItemDescriptionService)->editSimpleItemDescription($product),
            'watch_information' => (new EditWatchInformationService)->editWatchInformation($product),
            'material_information' => (new EditMaterialInformationService)->editMaterialInformation($product),
            'gemstone_description' => (new GemstoneForWatchDescriptionService)->gemstoneFields($product)

        ];

    }

}