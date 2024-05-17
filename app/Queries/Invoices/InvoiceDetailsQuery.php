<?php

namespace App\Queries\Invoices;

use App\Models\Invoice;
use App\Models\PurchaseOrderLineItem;
use App\Models\VendorReturnControl;

class InvoiceDetailsQuery
{

    public function getData($invoice_id)
    {

        $results = (object) [];

        $invoice_summary = Invoice::selectRaw('

                COUNT(*) AS item_count,
                SUM(PurchaseOrderLineItem.unit_cost) AS grand_total,
                COUNT(if(Control.item_status_id NOT IN (30, 1), 1, NULL)) AS landed_count,
                SUM(if(Control.item_status_id NOT IN (30, 1), PurchaseOrderLineItem.unit_cost,0)) AS landed_grand_total
            ')
        
            ->join('inventory.PurchaseOrderLineItem', 'Invoice.id', '=', 'PurchaseOrderLineItem.invoice_id')


            ->leftJoin('inventory.Control', 'PurchaseOrderLineItem.id', '=', 'Control.purchase_order_line_item_id')

            ->where('Invoice.id', $invoice_id)
            
            ->first();

        $results->invoice = Invoice::with(['purchaseOrder', 'shipMethod'])->where('Invoice.id', $invoice_id)->first();


        $results->items = PurchaseOrderLineItem::selectRaw('
        
                *, COUNT(*) AS quantity, COUNT(if(Control.item_status_id NOT IN (30, 1), 1, NULL)) AS landed
            
            ')
           
            ->with([

                'purchaseOrderSummary.productDescription',
                'purchaseOrderSummary.productDescription.vendorItemCode',
                'purchaseOrderSummary.productDescription.stdImages',
                'purchaseOrderSummary.productDescription.hdImages'
            ])
            
            ->join('inventory.PurchaseOrderSummary', 'PurchaseOrderLineItem.purchase_order_summary_id', '=', 'PurchaseOrderSummary.id')
            
            ->leftJoin('inventory.Control', 'PurchaseOrderLineItem.id', '=', 'Control.purchase_order_line_item_id')
            
            ->where('PurchaseOrderLineItem.invoice_id', $invoice_id)
            
            ->groupBy('PurchaseOrderSummary.product_description_id')
            
            ->get();

        $results->item_count = $invoice_summary->item_count;

        $results->landed_count = $invoice_summary->landed_count;

        $results->grand_total = $invoice_summary->grand_total;

        $results->landed_grand_total = $invoice_summary->landed_grand_total;

        $results->returned = VendorReturnControl::selectRaw('

              VendorReturn.id,
              VendorReturn.tracking,
              COUNT(*) AS item_count,
              SUM(PurchaseOrderLineItem.unit_cost) AS item_value,
              ProductDescription.id AS product_id,
              ProductDescription.category_id,
              VendorItemCode.item_code,
              VendorReturn.create_time

            ')
        
            ->join('inventory.VendorReturn', function($join) use ($invoice_id) {

                $join->on('VendorReturn.id', '=', 'VendorReturnControl.vendor_return_id')->where('invoice_id', '=', $invoice_id);

            })
            
            ->join('inventory.Control', 'Control.id', '=', 'VendorReturnControl.control_id')
            ->join('inventory.PurchaseOrderLineItem', 'PurchaseOrderLineItem.id', '=', 'Control.purchase_order_line_item_id')
            ->join('inventory.ProductDescription', 'ProductDescription.id', '=', 'Control.product_description_id')
            ->join('inventory.VendorItemCode', 'VendorItemCode.id', '=', 'ProductDescription.vendor_item_code_id')
            ->join('inventory.NotReceived', 'NotReceived.control_id', '=', 'Control.id')
            ->join('inventory.NotReceivedReason', 'NotReceivedReason.id', '=', 'NotReceived.not_received_reason_id')

            ->groupBy('VendorReturn.invoice_id')

            ->get();
            
        return $results;

    }


}