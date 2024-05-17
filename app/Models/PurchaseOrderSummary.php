<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderSummary extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.PurchaseOrderSummary';

    protected $guarded = [];

    public function productDescription()
    {

        return $this->belongsTo(ProductDescription::class);
        
    }

}
