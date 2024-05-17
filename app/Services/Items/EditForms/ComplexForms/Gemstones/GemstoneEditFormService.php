<?php

namespace App\Services\Items\EditForms\ComplexForms\Gemstones;

use App\Services\Items\EditForms\ComplexForms\Gemstones\EditGemstoneForSingleDescriptionService;
use App\Services\Items\EditForms\BaseForms\EditItemImagesService;
use App\Services\Items\EditForms\BaseForms\EditItemInformationService;


class GemstoneEditFormService
{

    public function getEditForm($product)
    {

        if( $product->hasGemstone($product->id) ) {

            return [

                'vendor_id' => auth()->user()->vendor_id,
                'product_id' => $product->id,
                'item_information' => (new EditItemInformationService)->editItemInformation($product),
                'item_images' => (new EditItemImagesService)->editItemImages($product),
                'item_description' => (new EditGemstoneItemDescriptionService)->editGemstoneItemDescription($product),
                'gemstone_description' => (new EditGemstoneForSingleDescriptionService)->editGemstone($product)
    
            ];

        }

        // if no gemstone, it's a lot, no need for gemstone description

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'product_id' => $product->id,
            'item_information' => (new EditItemInformationService)->editItemInformation($product),
            'item_images' => (new EditItemImagesService)->editItemImages($product),
            'item_description' => (new EditGemstoneItemDescriptionService)->editGemstoneItemDescription($product),

        ];

    }

}