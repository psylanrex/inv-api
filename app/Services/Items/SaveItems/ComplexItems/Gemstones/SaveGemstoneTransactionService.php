<?php

namespace App\Services\Items\SaveItems\ComplexItems\Gemstones;

use App\Services\Items\SaveItems\ComplexItems\Gemstones\TransactionServices\RecordAttributesForSingleGemstoneService;
use App\Services\Items\SaveItems\ComplexItems\Gemstones\TransactionServices\RecordProductFeaturesService;
use Illuminate\Support\Facades\DB;


class SaveGemstoneTransactionService
{

    public function saveGemstoneTransaction($request, $product_id)
    {


        DB::beginTransaction();

        try{

            // associate product features with product_description_id

            (new RecordProductFeaturesService)->makeProductFeatureRecords($product_id);

            // create records for gemstone attributes

            (new RecordAttributesForSingleGemstoneService)->makeAttributeRecordsForGemstones($request, $product_id);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }

        return [
            
            'message' => 'Gemstone item saved.', 
            
            'product_id' => $product_id
        
        ];




    }



}