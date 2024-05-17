<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StagedPurchaseOrder extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.StagedPurchaseOrder';

    protected $hidden = ['last_items_used', 'ship_method_id'];


    public function category()
    {

        return $this->belongsTo(Category::class);

    }

    public function purchaseOrderStatus()
    {

        return $this->belongsTo(PurchaseOrderStatus::class);

    }

    public function stagedPurchaseOrderItems()
    {

        return $this->hasMany(StagedPurchaseOrderItem::class);

    }

}
