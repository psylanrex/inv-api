<?php

namespace App\Services\Items\DeleteItems\Watches;

use App\Services\Items\DeleteItems\RemoveAttributes\RemoveGemstoneAttributesService;
use App\Services\Items\DeleteItems\RemoveAttributes\RemoveWatchAttributesService;
use App\Services\Items\DeleteItems\RemoveAttributes\RemoveMaterialAttributesService;
use App\Services\Items\DeleteItems\RemoveProductFeatures\RemoveProductFeaturesService;

class DeleteOldWatchRecordsService
{

    public function deleteOldWatchRecords($product_id)
    {

        // delete attributes for gemstones

        (new RemoveGemstoneAttributesService)->removeGemstoneAttributes($product_id);

        // delete attributes for watch

        (new RemoveWatchAttributesService)->removeWatchAttributes($product_id);

        // delete attributes for material

        (new RemoveMaterialAttributesService)->removeMaterialAttributes($product_id);

        // delete product features

        (new RemoveProductFeaturesService)->removeProductFeatures($product_id);
        
    }

}