<?php

namespace App\Services\Items\SaveItems\ComplexItems\Jewelry;

use Illuminate\Support\Facades\DB;
use App\Models\ProductDescriptionProductFeature;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordAttributesForGemstonesService;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordProductFeaturesService;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordAttributesForMaterial;
use App\Services\Items\SaveItems\ComplexItems\Jewelry\TransactionServices\RecordAttributesForJewelryService;

class SaveJewelryTransactionService
{

    public $material_information_id;
    public $jewelry_information_id;

    public function saveJewelryTransaction($request, $product_id)
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

            (new RecordAttributesForJewelryService)->makeAttributeRecordsForJewelry($request, $this->jewelry_information_id);

            // create records for gemstone attributes

            (new RecordAttributesForGemstonesService)->makeAttributeRecordsForGemstones($request, $product_id);

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            return $e->getMessage();
        }

        return [
            
            'message' => 'Jewelry item saved.', 
            
            'product_id' => $product_id
        
        ];

    }

    public function setInformationValues($product_id)
    {

        // 15 is material information

        // 17 is jewerly information

        $this->material_information_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 15)

            ->value('id');

        $this->jewelry_information_id = ProductDescriptionProductFeature::where('product_description_id', $product_id)
            
            ->where('product_feature_id', 17)

            ->value('id');      

    }

}

        