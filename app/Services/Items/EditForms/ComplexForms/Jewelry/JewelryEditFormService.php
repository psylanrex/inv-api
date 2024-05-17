<?php

namespace App\Services\Items\EditForms\ComplexForms\Jewelry;

use App\Services\Items\EditForms\BaseForms\EditItemInformationService;
use App\Services\Items\EditForms\BaseForms\EditItemImagesService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditSimpleItemDescriptionService;
use App\Services\Items\EditForms\ComplexForms\Jewelry\EditJewelryInformationService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditMaterialInformationService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditGemstoneForMultipleDescriptionService;
use App\Services\Items\CreateForms\ComplexForms\Jewelry\GemstoneForJewelryDescriptionService;

class JewelryEditFormService
{

    public function getEditForm($product)
    {

        // individual form components are assembled here

        if ( $product->hasGemstone($product->id) ) {

            return [

                'vendor_id' => auth()->user()->vendor_id,
                'product_id' => $product->id,
                'item_information' => (new EditItemInformationService)->editItemInformation($product),
                'item_images' => (new EditItemImagesService)->editItemImages($product),
                'item_description' => (new EditSimpleItemDescriptionService)->editSimpleItemDescription($product),
                'jewelry_information' => (new EditJewelryInformationService)->editJewelryInformation($product),
                'material_information' => (new EditMaterialInformationService)->editMaterialInformation($product),
                'gemstone_description' => (new EditGemstoneForMultipleDescriptionService)->editGemstones($product)

            ];

        }

        return [

            'vendor_id' => auth()->user()->vendor_id,
            'product_id' => $product->id,
            'item_information' => (new EditItemInformationService)->editItemInformation($product),
            'item_images' => (new EditItemImagesService)->editItemImages($product),
            'item_description' => (new EditSimpleItemDescriptionService)->editSimpleItemDescription($product),
            'jewelry_information' => (new EditJewelryInformationService)->editJewelryInformation($product),
            'material_information' => (new EditMaterialInformationService)->editMaterialInformation($product),
            'gemstone_description' => (new GemstoneForJewelryDescriptionService)->gemstoneFields($product)

        ];

    }

}