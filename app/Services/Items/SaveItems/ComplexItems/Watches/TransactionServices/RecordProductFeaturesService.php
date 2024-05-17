<?php

namespace App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices;

use App\Models\ProductDescriptionProductFeature;
use App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices\CountGemstonesService;

class RecordProductFeaturesService
{

    public function makeProductFeatureRecords($request, $product_id)
    {

        // 15 is materiall information, 9 is watch information
        // leaving out 1 which is gemstone because there can be mutliple gemstones

        $product_features = [15, 9];

        foreach ($product_features as $product_feature) {

            ProductDescriptionProductFeature::create([

                'product_feature_id' => $product_feature,
                'product_description_id' => $product_id,

            ]);

        }

        $count = (new CountGemstonesService)->countGemstones($request);

        for ($i = 0; $i < $count; $i++) {

            ProductDescriptionProductFeature::create([

                'product_feature_id' => 1,
                'product_description_id' => $product_id,

            ]);

        }    

    }

}