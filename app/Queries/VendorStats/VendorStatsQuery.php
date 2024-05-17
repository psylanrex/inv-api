<?php

namespace App\Queries\VendorStats;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class VendorStatsQuery
{
    public function getData($vendor_id)
    {

        $start = Carbon::now()->subDays(180);
        
        $query = "

            SELECT

                FORMAT(SUM(derived_refunds.refund_count) / SUM(derived_sales.number_sold) * 100, 2) AS returned_percentage,
                FORMAT(SUM(derived_refunds.number_rmas) / SUM(derived_sales.number_sold) * 100, 2) AS damaged_percentage

            FROM

            websites.Schedule s

            JOIN

            inventory.Control c ON (c.id = s.control_id)

            JOIN

            inventory.ProductDescription pd ON (pd.id = c.product_description_id)

            JOIN

            inventory.Category AS cat ON (cat.id = pd.category_id)

            JOIN

            inventory.VendorItemCode vic ON (vic.id = pd.vendor_item_code_id)

            JOIN

            inventory.Vendor v ON (v.id = vic.vendor_id)

                JOIN (

                        SELECT pdd.id, COUNT(*) as number_sold, SUM(sd.sale_price) AS amount_sold
                        FROM inventory.Control cd
                        JOIN websites.Schedule sd ON sd.control_id = cd.id
                        JOIN inventory.ProductDescription pdd ON cd.product_description_id = pdd.id
                        WHERE cd.item_status_id IN(5, 6, 9)
                        AND sd.item_status_id = cd.item_status_id
                        AND sd.event_end BETWEEN '$start' and NOW()
                        GROUP BY pdd.id

                ) AS derived_sales ON derived_sales.id = pd.id

                JOIN (

                    SELECT pdr.id,

                            COUNT(DISTINCT(IF(rmar.rma_reason_id = 2, rmar.id, NULL))) as number_rmas,
                            COUNT(DISTINCT(prr.original_transaction_id)) AS refund_count,
                            SUM(prr.amount) AS amount_refunded

                    FROM inventory.Rma rmar

                    JOIN inventory.Control cr ON rmar.control_id = cr.id

                    JOIN websites.Schedule sdr ON sdr.control_id = cr.id

                    JOIN inventory.ProductDescription pdr ON cr.product_description_id = pdr.id

                    LEFT JOIN inventory.RmaPendingRefund rprr ON rprr.rma_id = rmar.id

                    LEFT JOIN inventory.PendingRefund prr ON prr.id = rprr.pending_refund_id AND prr.pending_refund_status_id = 2

                    WHERE rmar.rma_reason_id NOT IN (6, 7)

                    AND sdr.event_end BETWEEN '$start' and NOW()

                    GROUP BY pdr.id

                ) AS derived_refunds ON derived_refunds.id = pd.id

            WHERE

                pd.discontinued = 0

                AND

                pd.reorderable = 1

                AND

                v.id = {$vendor_id}
                
        ";

        return DB::select($query);

    
    }
}