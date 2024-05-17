<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrder extends BaseModel
{
    use HasFactory;

    protected $table = 'inventory.PurchaseOrder';

    protected $guarded = [];

    public function scopePurchaseOrderByStatus($query, $status)
    {

        return $query->where('purchase_order_status_id', $status);

    }

    public function category()
    {

        return $this->belongsTo(Category::class);

    }

    public function purchaseOrderStatus()
    {

        return $this->belongsTo(PurchaseOrderStatus::class);

    }

    public function purchaseOrderSummaries()
    {

        return $this->hasMany(PurchaseOrderSummary::class, 'purchase_order_id');

    }    

}
