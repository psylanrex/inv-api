<?php

namespace App\Services\Items\DeleteItems\Jewelry;

use App\Services\Items\DeleteItems\RemoveAttributes\RemoveGemstoneAttributesService;
use App\Services\Items\DeleteItems\RemoveAttributes\RemoveJewelryAttributesService;
use App\Services\Items\DeleteItems\RemoveAttributes\RemoveMaterialAttributesService;
use App\Services\Items\DeleteItems\RemoveProductFeatures\RemoveProductFeaturesService;

class DeleteOldJewelryRecordsService
{

    public function deleteOldJewelryRecords($product_id)
    {

        // delete attributes for gemstones

        (new RemoveGemstoneAttributesService)->removeGemstoneAttributes($product_id);

        // delete attributes for jewelry

        (new RemoveJewelryAttributesService)->removeJewelryAttributes($product_id);

        // delete attributes for material

        (new RemoveMaterialAttributesService)->removeMaterialAttributes($product_id);

        // delete product features

        (new RemoveProductFeaturesService)->removeProductFeatures($product_id);
        
    }


}