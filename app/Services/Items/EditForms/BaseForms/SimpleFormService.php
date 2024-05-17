<?php

namespace App\Services\Items\EditForms\BaseForms;

use App\Services\Items\EditForms\BaseForms\EditItemInformationService;
use App\Services\Items\EditForms\BaseForms\EditItemImagesService;
use App\Services\Items\EditForms\ComplexForms\BaseDescriptions\EditSimpleItemDescriptionService;

class SimpleFormService
{

    public function getEditForm($product)
    {

        $vendor_id = auth()->user()->vendor_id;

        return [

            'vendor_id' => $vendor_id,
            'product_id' => $product->id,
            'item_information' => (new EditItemInformationService)->editItemInformation($product),
            'item_images' => (new EditItemImagesService)->editItemImages($product),
            'item_description' => (new EditSimpleItemDescriptionService)->editSimpleItemDescription($product)

        ];

    }

}