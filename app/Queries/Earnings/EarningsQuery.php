<?php

namespace App\Queries\Earnings;

use Illuminate\Support\Facades\DB;

class EarningsQuery
{

    public $date_range = false;
    public $status = false;

    public function getData($request, $vendor_id)
    {

        $is_paid = $request->get('is_paid');

        // set post data

        if ( ! empty($request->get('from')) && ! empty($request->get('to'))) {

            $this->date_range = ['start' => $request->get('from'), 'end' => $request->get('to')];
        }
        if ( ! empty($request->get('status'))) {

            $this->status = $request->get('status');

        }

        $columns = [

            'po.id',
            'po.purchase_order_number',
            'po.purchase_order_date',
            'ip.payment_date',
            DB::raw('GROUP_CONCAT(i.id) AS invoice_ids'),
            DB::raw('GROUP_CONCAT(i.invoice_number) AS invoice_numbers'),
            'pos.purchase_order_status',
            DB::raw('(SELECT COUNT(*) FROM inventory.PurchaseOrderLineItem AS poli JOIN inventory.Invoice AS i2 ON (poli.invoice_id = i2.id) WHERE i2.id = i.id) AS ordered'),
            DB::raw('(SELECT COUNT(*) FROM inventory.PurchaseOrderLineItem AS poli JOIN inventory.Control AS c ON (poli.id = c.purchase_order_line_item_id AND c.item_status_id NOT IN (30, 31)) JOIN inventory.Invoice AS i2 ON (poli.invoice_id = i2.id) WHERE i2.id = i.id) AS received'),
            DB::raw('IFNULL(ip.amount, (SELECT SUM(unit_cost) FROM inventory.PurchaseOrderLineItem AS poli JOIN inventory.Invoice AS i2 ON (poli.invoice_id = i2.id) WHERE i2.id = i.id)) AS total'),
    
        ];

        $query = DB::table('inventory.PurchaseOrder AS po')
        
            ->select($columns)

            ->leftJoin('inventory.Invoice AS i', 'po.id', '=', 'i.purchase_order_id')
            ->leftJoin('inventory.InvoicePayment AS ip', 'i.id', '=', 'ip.invoice_id')
            ->leftJoin('inventory.PurchaseOrderStatus AS pos', 'po.purchase_order_status_id', '=', 'pos.id')
        
            ->where('po.vendor_id', $vendor_id)
        
            ->when($this->date_range, function ($query) {

                return $query->whereBetween('po.purchase_order_date', [$this->date_range['start'], $this->date_range['end']]);

            })

            ->when( ! $is_paid, function ($query) {

                return $query->whereNotIn('ip.invoice_payment_status_id', [3, 4]);

            })

            ->when($is_paid, function ($query) {

                return $query->where('ip.invoice_payment_status_id', 3);

            })
        
            ->when($this->status && ! $is_paid, function ($query) {

                return $query->where('po.purchase_order_status_id', $this->status);

            })
       
            ->groupBy('i.id', 'ip.payment_date', 'ip.amount')
        
            ->orderBy('po.purchase_order_date', 'DESC');

        return $query->get();   

    }

}
