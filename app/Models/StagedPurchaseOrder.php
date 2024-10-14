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

    public function scopePurchaseOrderByStatus($query, $status)
    {

        return $query->selectRaw('

                StagedPurchaseOrder.id
                purchase_order_date,
                purchase_order_number,
                SUM(StagedPurchaseOrderItem.quantity) AS quantity,
                term_period,
                term_percent_due,
                approval_deadline,
                SUM(StagedPurchaseOrderItem.price * StagedPurchaseOrderItem.quantity) AS total

            ')->join('inventory.StagedPurchaseOrderItem', 'StagedPurchaseOrder.id', '=', 'StagedPurchaseOrderItem.staged_purchase_order_id')
            
                ->where('StagedPurchaseOrder.vendor_id', Auth::user()->vendor_id)
                ->where('StagedPurchaseOrder.purchase_order_status_id', $status)
            
                ->whereNotNull('StagedPurchaseOrder.id')
            
                ->groupBy('StagedPurchaseOrder.id');

    }

}
