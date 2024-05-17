<?php

namespace App\Queries\PurchaseOrders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseOrderQuery
{
    
    public function getData($status)
    {

        $vendor_id = Auth::user()->vendor_id;

        $query = "
    
            SELECT

                derived.id,
                derived.purchase_order_date,
                derived.purchase_order_number,
                SUM(derived.quantity) AS quantity,
                SUM(derived.received) AS received,
                SUM(derived.quantity) - SUM(derived.invoiced) AS missing,
                SUM(derived.total) AS total,
                ps.purchase_order_status,
                derived.invoice_window_end

            FROM (

            SELECT

                po.id,
                po.purchase_order_status_id,
                po.purchase_order_date,
                po.purchase_order_number,
                pos.quantity AS quantity,
                COUNT(c.id) AS received,
                COUNT(li.id) AS invoiced,
                GROUP_CONCAT(pos.id) AS pos_ids,
                (pos.unit_cost * pos.quantity) AS total,
                po.invoice_window_end

            FROM

                inventory.PurchaseOrder AS po
                
            LEFT JOIN

                inventory.PurchaseOrderSummary AS pos ON (po.id = pos.purchase_order_id)

            LEFT JOIN
            
                inventory.PurchaseOrderLineItem AS li ON (li.purchase_order_summary_id = pos.id)
                
            LEFT JOIN

                inventory.Control AS c ON (c.purchase_order_line_item_id = li.id AND c.item_status_id NOT IN (30, 1))
        
            WHERE

                po.vendor_id = {$vendor_id}

            AND

                po.purchase_order_status_id = {$status}

            GROUP BY

                po.id, 
                po.purchase_order_status_id, 
                po.purchase_order_date, 
                po.purchase_order_number, 
                po.invoice_window_end, 
                pos.quantity, 
                pos.unit_cost
                ) as derived

            LEFT JOIN

                inventory.PurchaseOrderStatus AS ps ON (derived.purchase_order_status_id = ps.id)
    
            GROUP BY
        
                derived.id, 
                derived.purchase_order_date, 
                derived.purchase_order_number, 
                ps.purchase_order_status, 
                derived.invoice_window_end
    
            ORDER BY 

                derived.purchase_order_date DESC                           
        ";

        return DB::select($query);

    }    
    
}