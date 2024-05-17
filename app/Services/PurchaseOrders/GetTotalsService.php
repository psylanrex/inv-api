<?php

namespace App\Services\PurchaseOrders;

class GetTotalsService
{
    
    public function getTotals($poDetails)
    {
        
        $totals = (object) ['quantity' => 0, 'grand_total' => 0.00];

        foreach ($poDetails AS $poDetail) {

            $totals->quantity += $poDetail->quantity;
            $totals->grand_total += ($poDetail->quantity * $poDetail->unit_cost);

        }

        return $totals;
        
    }

}