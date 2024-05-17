<?php

namespace App\Services\Items\DeleteItems\Jewelry;

use App\Services\Items\DeleteItems\Basic\DeleteBasicItemService;
use App\Services\Items\DeleteItems\Jewelry\DeleteOldJewelryRecordsService;

class DeleteJewelryItemService
{

    public function deleteJewelryItem($product_id)
    {

        // delete the jewelry item

        (new DeleteOldJewelryRecordsService)->deleteOldJewelryRecords($product_id);

        return (new DeleteBasicItemService)->deleteBasicItem($product_id);

    }

}