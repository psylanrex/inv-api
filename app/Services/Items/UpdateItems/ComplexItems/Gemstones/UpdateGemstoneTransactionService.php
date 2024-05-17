<?php

namespace App\Services\Items\UpdateItems\ComplexItems\Gemstones;

use App\Models\ProductDescriptionProductFeature;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordAttributesForGemstonesService;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordProductFeaturesService;
use App\Services\Items\DeleteItems\Gemstones\DeleteOldGemstoneRecordsService;
use Illuminate\Support\Facades\DB;

class UpdateGemstoneTransactionService
{

    public $gemstone_information_id;

    public function updateItemTransaction($request)
    {

        $product_id = $request->product_id;

        DB::beginTransaction();

        try{

            // delete all product all records before recording new

           (new DeleteOldGemstoneRecordsService)->deleteOldGemstoneRecords($product_id);

            // associate product features with product_description_id

            (new RecordProductFeaturesService)->makeProductFeatureRecords($request, $product_id);

            // set information values once you have product feature records

            $this->setInformationValues($product_id);

            // create records for gemstone attributes

            (new RecordAttributesForGemstonesService)->makeAttributeRecordsForGemstones($request, $product_id);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }

        return [
            
            'message' => 'Jewelry item updated.', 
            
            'product_id' => $product_id
        
        ];

        
    }

    public function setInformationValues($product_id)
    {

        // 15 is material information

        // 17 is jewerly information

        $this->gemstone_information_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 1)

            ->value('id');

   

    }




}