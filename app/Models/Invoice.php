<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.Invoice';

    protected $guarded = [];

    public function shipMethod()
    {

        return $this->belongsTo(ShipMethod::class);

    }

    public function invoiceNote()
    {

        return $this->belongsTo(InvoiceNote::class);

    }

    public function invoiceStatus()
    {

        return $this->belongsTo(InvoiceStatus::class);

    }

    public function purchaseOrder()
    {

        return $this->belongsTo(PurchaseOrder::class);

    }

    /**
     * Generate the invoice label code for packaging
     *
     * @return string
     */
    public function getInvoiceLabelCode()
    {

        return '05' . str_pad((string) $this->id, 8, "0", STR_PAD_LEFT);

    }


}
