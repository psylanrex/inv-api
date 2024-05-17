<?php

namespace App\Services\Items\SaveItems\ComplexItems\Watches;

use Illuminate\Support\Facades\DB;
use App\Models\ProductDescriptionProductFeature;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordAttributesForGemstonesService;
use App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices\RecordProductFeaturesService;
use App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices\RecordAttributesForMaterial;
use App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices\RecordAttributesForWatchService;

class SaveWatchTransactionService
{

    public $material_information_id;
    public $watch_information_id;

    public function saveWatchTransaction($request, $product_id)
    {

        DB::beginTransaction();

        try{

            // associate product features with product_description_id

            (new RecordProductFeaturesService)->makeProductFeatureRecords($request, $product_id);

            // set information values once you have product feature records

            $this->setInformationValues($product_id);

            // create records for material attributes

            (new RecordAttributesForMaterial)->makeAttributeRecordsForMaterial($request, $this->material_information_id);

            // create records for jewelry attributes

            (new RecordAttributesForWatchService)->makeAttributeRecordsForWatch($request, $this->watch_information_id);

            // create records for gemstone attributes - common for all jewelry and watches

            (new RecordAttributesForGemstonesService)->makeAttributeRecordsForGemstones($request, $product_id);

            

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }

        return [
            
            'message' => 'Watch item saved.', 
            
            'product_id' => $product_id
        
        ];

    }

    public function setInformationValues($product_id)
    {

        // 15 is material information

        // 9 is watch information

        $this->material_information_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 15)

            ->value('id');

        $this->watch_information_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 9)

            ->value('id');      

    }

    


}