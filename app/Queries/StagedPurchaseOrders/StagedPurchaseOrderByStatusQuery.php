<?php

namespace App\Queries\StagedPurchaseOrders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StagedPurchaseOrder;

class StagedPurchaseOrderByStatusQuery
{

    public function getData($status)
    {

        $select = [

            'StagedPurchaseOrder.id',
            'purchase_order_date',
            'purchase_order_number',
            DB::raw('SUM(StagedPurchaseOrderItem.quantity) AS quantity'),
            'term_period',
            'term_percent_due',
            'approval_deadline',
            DB::raw('SUM(StagedPurchaseOrderItem.price * StagedPurchaseOrderItem.quantity) AS total')

        ];

        return StagedPurchaseOrder::select($select)    
        
        ->join('inventory.StagedPurchaseOrderItem', 'StagedPurchaseOrder.id', '=', 'StagedPurchaseOrderItem.staged_purchase_order_id')
        
        ->where('StagedPurchaseOrder.vendor_id', Auth::user()->vendor_id)
        ->where('StagedPurchaseOrder.purchase_order_status_id', $status)
        
        ->whereNotNull('StagedPurchaseOrder.id')
        
        ->groupBy('StagedPurchaseOrder.id')

        ->get();

    }

}