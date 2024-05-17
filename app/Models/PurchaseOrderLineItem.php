<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderLineItem extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.PurchaseOrderLineItem';

    protected $guarded = [];

    public function purchaseOrderSummary()
    {
        return $this->belongsTo(PurchaseOrderSummary::class);
    }
    
}
