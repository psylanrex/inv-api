<?php

namespace App\Services\Items\SaveItems\SimpleItems;


use App\Models\VendorItemCode;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDescription;
use App\Models\DescriptionDetail;
use App\Models\ProductDescriptionProductTag;
use App\Models\ProductStatus;
use App\Models\ImageStatus;

class SimpleItemTransactionService
{

    public function simpleItemTransaction($values)
    { 

        DB::beginTransaction();

        try {

            $vendorItemCode = VendorItemCode::create([

                'vendor_id' => $values['vendor_id'],
                'item_code' => $values['item_code']

            ]);

            if ( ! $values['description'] == 0 ) {

                $descriptionDetail = DescriptionDetail::create([

                    'description' => $values['description']
    
                ]);

                $description_detail_id = $descriptionDetail->id;

            }  else {

                $description_detail_id = 0;

            }

            $product = ProductDescription::create([

                'category_id' => $values['category_id'],
                'vendor_item_code_id' => $vendorItemCode->id,
                'name' => $values['name'],
                'short_name' => $values['short_name'],
                'description_details_id' => $description_detail_id,
                'item_condition_id' => $values['condition'],
                'brand_id' => $values['brand'],
                'current_unit_cost' => $values['current_unit_cost'],
                'price' => $values['price'],
                'reorderable' => $values['reorderable'],
                'returnable' => $values['returnable'],
                'product_gender_id' => $values['product_gender_id'],
                'description_status_id' => $values['description_status_id'],
                'product_status_id' => $values['product_status_id'],
                'image_status_id' => $values['image_status_id'],
                'voided' => $values['voided'],
                'discontinued' => $values['discontinued'],
                'schedulable' => $values['schedulable'],
                'vendor_returnable' => $values['vendor_returnable']

            ]);   
            
            if ( ! empty($values['tags']) ) {

               
                ProductDescriptionProductTag::createMany($product->id, $values['tags']);

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return [

                'message' => $e->getMessage()  

            ];

        }

        return $product;

    }

}