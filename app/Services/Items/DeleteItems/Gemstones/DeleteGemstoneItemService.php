<?php

namespace App\Services\Items\DeleteItems\Gemstones;

use App\Services\Items\DeleteItems\Basic\DeleteBasicItemService;
use App\Services\Items\DeleteItems\Gemstones\DeleteOldGemstoneRecordsService;

class DeleteGemstoneItemService
{
    public function deleteGemstoneItem($product_id)
    {

        // delete the gemstone item

        (new DeleteOldGemstoneRecordsService)->deleteOldGemstoneRecords($product_id);

        return (new DeleteBasicItemService)->deleteBasicItem($product_id);

    }

}