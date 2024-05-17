<?php

namespace App\Services\Items\UpdateItems\SimpleItems;

use App\Models\DescriptionDetail;
use App\Models\ProductDescription;
use App\Models\ProductDescriptionProductTag;
use App\Models\VendorItemCode;
use Illuminate\Support\Facades\DB;

class SimpleItemUpdateTransactionService
{

    public function simpleItemUpdateTransaction($values)
    { 

        DB::beginTransaction();

        try {

            // get the current vendor item code id for description_id

            $product = ProductDescription::find($values['product_id']);

            $vendorItemCode = VendorItemCode::where('id', $product->vendor_item_code_id)

                ->first();

            if ( ! $values['item_code'] == $vendorItemCode->item_code ) {

                // update vendor item code

                $vendorItemCode->item_code = $values['item_code'];

                $vendorItemCode->save();

            }

            // update description details

            if ( ! $values['description'] == 0 ) {

                $descriptionDetail = DescriptionDetail::where('id', $product->description_details_id)

                    ->first();

                $descriptionDetail->description = $values['description'];

                $descriptionDetail->save();

            }

            // update product description

            $product->name = $values['name'];
            $product->short_name = $values['short_name'];
            $product->item_condition_id = $values['condition'];
            $product->brand_id = $values['brand'];
            $product->current_unit_cost = $values['current_unit_cost'];
            $product->price = $values['price'];
            $product->reorderable = $values['reorderable'];
            $product->returnable = $values['returnable'];
            $product->product_gender_id = $values['product_gender_id'];
            $product->description_status_id = $values['description_status_id'];
            $product->product_status_id = $values['product_status_id'];
            $product->image_status_id = $values['image_status_id'];
            $product->voided = $values['voided'];
            $product->discontinued = $values['discontinued'];
            $product->schedulable = $values['schedulable'];
            $product->vendor_returnable = $values['vendor_returnable'];

            $product->save(); 
            
            
            // delete old tags

            ProductDescriptionProductTag::where('product_description_id', $values['product_id'])->delete();
            
            if ( ! empty($values['tags']) ) { 
                
                // create new tags
      
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