<?php

namespace App\Services\PurchaseOrders;

use App\Models\Invoice;
use App\Models\InvoiceStatus;
use Illuminate\Support\Facades\DB;
use App\Models\PurchaseOrderLineItem;
use App\Models\ShipMethod;
use App\Models\ItemStatus;
use App\Models\Control;

class CreateInvoiceTransactionService
{

    private $insert_bdp = '';
    private $bdp_count = 0;

    public function createInvoiceTransaction($purchase_order_id, $quantities, $vendor, $products, $summary_ids)
    {

        // start transaction

        DB::beginTransaction();

        try {

            // Create the new invoice

            $invoice = Invoice::create([

                'purchase_order_id' => $purchase_order_id,
                'invoice_status_id' => InvoiceStatus::PENDING

            ]);

            // process each product

            foreach ( $products AS $product ) {

                // Get the quantity to be invoiced for this product
        
                $quantity = $quantities[$product->id];

                // Create the line item(s) for the invoice
        
                for($count = 0; $count < $quantity; $count++) {
            
                    $line_item_id = PurchaseOrderLineItem::insertGetId([
                
                        'purchase_order_summary_id' => $summary_ids[$product->id],
                        'invoice_id' => $invoice->id,
                        'ship_method_id' => ShipMethod::PENDING,
                        'item_condition_id' => $product->item_condition_id,
                        'unit_cost' => $product->current_unit_cost,
                        'received_date' => '0000-00-00',
                        'employee_id' => 1

                    ]);

                    // Create the control record for each line item

                    Control::create([
                
                        'item_status_id' => ItemStatus::INVOICED,
                        'purchase_order_line_item_id' => $line_item_id,
                        'inventory_location_id' => 0,
                        'product_description_id' => $product->id,
                        'item_condition_id' => $product->item_condition_id
            
                    ]);
        
                }

                // Append a string for the product and bdp price to be inserted or ignored
        
                if ( $vendor->bdp_flag ) {
            
                    // check if the bdp price calculated is greater than or equal to the unit code 
                    // and it is greater than the bdp minimum
            
                    $bdp_price = round($product->current_unit_cost * $vendor->bdp_modifier, 2);
            
                    if ($bdp_price >= $product->current_unit_cost && 
                    
                            $bdp_price >= $vendor->bdp_minimum_value && 
                    
                                ! $product->priceTypeBdp) {
                
                                    $this->insert_bdp .= " ({$product->id}, 11, $bdp_price), ";
                
                                    $this->bdp_count++;

                    } 

                }

                // insert BDP prices if there are any

                if ( $this->bdp_count > 0 ) {

                    $this->insert_bdp = rtrim($this->insert_bdp, ', ');

                    DB::select("
                    
                        INSERT INTO inventory.ProductDescriptionPriceType (product_description_id, price_type_id, price) 
                        
                        VALUES {$this->insert_bdp}");
                
                }

            }

            DB::commit();

        } catch (\Exception $e) {

            DB::rollback();

            throw $e->getMessage();

        }  
    
        return [
            
            'status' => 'success', 
            'code' => 200, 
            'message' => 'Successfully created an invoice with the items selected. Finish the Invoice you just created by going to Invoices -> Pending and clicking the "View / Finish" button for the invoice.'
        
        ];

    }

}