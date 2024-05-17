<?php

namespace App\Services\PurchaseOrders;

use App\Models\StagedPurchaseOrderItem;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseOrderDetail;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderStatus;
use App\Models\ProductDescription;
use App\Models\PurchaseOrderSummary;

class ApproveTransactionService
{

    public function approveTransaction($stagedPo, $stagedPoItems, $staged_purchase_order_id)
    {

        DB::beginTransaction();

        try {
            
            // Create a base PO detail record for use

            $puchaseOrderDetail = new PurchaseOrderDetail();

            $puchaseOrderDetail->save();

            // Create the Purchase Order record

            $purchaseOrder = $this->createPurchaseOrder($stagedPo, $puchaseOrderDetail);

            // Create the Purchase Order Summary records

            $this->createPurchaseOrderSummary($stagedPoItems, $purchaseOrder);

            // Delete the staged purchase order items and the staged purchase order

            StagedPurchaseOrderItem::where('staged_purchase_order_id', $staged_purchase_order_id)
            
                ->delete();
        
            $stagedPo->delete();

            DB::commit();

        } catch (\Exception $e) {

            DB::rollBack();

            return $e->getMessage();

        }  
        
        return $purchaseOrder;

    }

    private function createPurchaseOrder($stagedPo, $puchaseOrderDetail)
    {

        return PurchaseOrder::create(array_merge(
                
            $stagedPo->toArray(), [

                'purchase_order_status_id' => PurchaseOrderStatus::OPEN,
                'purchase_order_detail_id' => $puchaseOrderDetail->id

            ])
        
        );

    }

    private function createPurchaseOrderSummary($stagedPoItems, $purchaseOrder)
    {

        // Create PurchaseOrderSummary record for the product and 
        // update the current unit cost based on the staged items
        
        foreach ( $stagedPoItems AS $stagedPoItem) {

            // Update the products unit cost

            ProductDescription::where('id', $stagedPoItem->product_description_id)

                ->update(['current_unit_cost' => $stagedPoItem->price]);

            // Create the Purchase Order Summary

            PurchaseOrderSummary::create([

                'purchase_order_id' => $purchaseOrder->id,
                'product_description_id' => $stagedPoItem->product_description_id,
                'quantity' => $stagedPoItem->quantity,
                'customer_cancelled' => 0,
                'vendor_cancelled' => 0,
                'unit_cost' => $stagedPoItem->price

            ]);

        }

    }

}