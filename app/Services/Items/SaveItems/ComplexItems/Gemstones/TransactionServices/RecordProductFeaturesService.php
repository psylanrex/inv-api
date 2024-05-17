<?php

namespace App\Services\Items\SaveItems\ComplexItems\Gemstones\TransactionServices;


use App\Models\ProductDescriptionProductFeature;

class RecordProductFeaturesService
{

    public function makeProductFeatureRecords($product_id)
    {

        // 1 is gemstone

        ProductDescriptionProductFeature::create([

            'product_feature_id' => 1,
            'product_description_id' => $product_id,

        ]);

    }

}