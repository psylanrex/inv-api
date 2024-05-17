<?php

namespace App\Services\PurchaseOrders;

class SummaryFormatService
{

    public function formatSummaries($purchaseOrderSummaries, $invoiced, $products)
    {

        // Iterate through the summaries and order them in array structure where product id is the key to the summary id

        $summary_ids = [];

        foreach ($purchaseOrderSummaries AS $summary) {

            if ( ($summary->quantity - $invoiced[$summary->product_description_id] 
            
                    - $products[$summary->product_description_id]) < 0) {

                throw new \Exception('You have tried to invoice a product with more qty than ordered, please check your order!');

            }

            $summary_ids[$summary->product_description_id] = $summary->id;

        }

        return $summary_ids;

    }

}