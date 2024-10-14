<?php

namespace App\Services\PurchaseOrders;

use App\Models\PurchaseOrder;
use App\Queries\PurchaseOrders\PoDetailsQuery;
use App\Services\PurchaseOrders\GetTotalsService;

class DetailsService
{
    
    public function details($purchase_order_id)
    {      
        
        $purchase_order = PurchaseOrder::find($purchase_order_id);

        $poDetails = (new PoDetailsQuery)->getData($purchase_order_id);

        $purchase_order_totals = (new GetTotalsService)->getTotals($poDetails);

        return (object) [

            'items' => $poDetails,
            'purchase_order' => $purchase_order,
            'item_count' => $purchase_order_totals->quantity,
            'grand_total' => $purchase_order_totals->grand_total,
            'is_staged' => false,
            'category_name' => $purchase_order->category->name,
            'purchase_order_status_name' => $purchase_order->purchaseOrderStatus->name

        ];

    }

}