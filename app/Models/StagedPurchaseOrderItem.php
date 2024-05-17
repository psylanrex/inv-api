<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class StagedPurchaseOrderItem extends BaseModel
{
    use HasFactory;

    public $table = 'inventory.StagedPurchaseOrderItem';

    public function productDescription()
    {

        return $this->belongsTo('App\Models\ProductDescription');

    }
    
}
