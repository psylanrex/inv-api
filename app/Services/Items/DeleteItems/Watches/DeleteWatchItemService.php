<?php

namespace App\Services\Items\DeleteItems\Watches;

use App\Services\Items\DeleteItems\Basic\DeleteBasicItemService;

class DeleteWatchItemService
{
    public function deleteWatchItem($product_id)
    {

        // delete the watch item

        (new DeleteOldWatchRecordsService)->deleteOldWatchRecords($product_id);

        return (new DeleteBasicItemService)->deleteBasicItem($product_id);

    }

}