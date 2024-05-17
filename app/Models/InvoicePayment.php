<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory;

    public $table = 'inventory.InvoicePayment';

    /**
     * Scope a query to only include show invoice payments by vendor.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByVendor($query, $vendor_id)
    {
        return $query->join('inventory.Invoice AS invoice', 'InvoicePayment.invoice_id', '=', 'invoice.id')

            ->join('inventory.PurchaseOrder AS purchaseOrder', 'invoice.purchase_order_id', '=', 'purchaseOrder.id')

            ->where('purchaseOrder.vendor_id', $vendor_id);
            
    }

    /**
     * Scope a query to only show pending invoices.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeInStatus($query, $status)
    {

        return $query->where('invoice_payment_status_id', $status);

    }

}
