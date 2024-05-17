<?php

namespace App\Services\Invoices;

use App\Models\Invoice;
use App\Models\InvoiceStatus;
use App\Models\PurchaseOrderLineItem;
use App\Models\Control;
use Illuminate\Support\Facades\DB;

class CancelInvoiceTransactionService
{
    public function transaction($invoice_id)
    {
        
            $invoice = Invoice::find($invoice_id);
            
            DB::beginTransaction();

            try {

                // Update the invoice status to be Cancelled

                $invoice->invoice_status_id = InvoiceStatus::CANCELLED;

                $invoice->save();

                // Get the PurchaseOrderLineItems and Controls to be removed

                $items = PurchaseOrderLineItem::select(
                    
                    'PurchaseOrderLineItem.id AS poli_id',
                    'Control.id AS control_id'

                )

                ->join('inventory.Control', 'Control.purchase_order_line_item_id', '=', 'PurchaseOrderLineItem.id')

                ->where('PurchaseOrderLineItem.invoice_id', $invoice_id)

                ->where('Control.item_status_id', 30)

                ->get();

                // Get the ids of the PurchaseOrderLineItems and Controls to be removed
            
                $purchase_order_line_item_ids = $items->pluck('poli_id')->toArray();
            
                $control_ids = $items->pluck('control_id')->toArray();            
            
                // Remove PurchaseOrderLineItems
            
                PurchaseOrderLineItem::destroy($purchase_order_line_item_ids);
            
                // Remove Controls
            
                Control::destroy($control_ids);

            } catch (\Exception $e) {

                DB::rollBack();

                return $e->getMessage();

            }

            return [
                
                'code' => 200, 
                'status' => 'success', 
                'message' => 'Successfully cancelled selected invoice.'
            
            ];

    }
        
}