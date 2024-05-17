<?php

namespace App\Services\Items\DeleteItems\Gemstones;

use App\Services\Items\DeleteItems\RemoveProductFeatures\RemoveProductFeaturesService;
use App\Services\Items\DeleteItems\RemoveAttributes\RemoveGemstoneAttributesService;

class DeleteOldGemstoneRecordsService
{

    public function deleteOldGemstoneRecords($product_id)
    {

        // delete attributes for gemstones

        (new RemoveGemstoneAttributesService)->removeGemstoneAttributes($product_id);
 
        // delete product features

        (new RemoveProductFeaturesService)->removeProductFeatures($product_id);
        
    }

}