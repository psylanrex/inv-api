<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StagedInvoiceItem extends Model
{
    use HasFactory;

    protected $table = 'inventory.StagedInvoiceItem';

    public function stagedPurchaseOrderItem()
    {

        return $this->belongsTo(StagedPurchaseOrderItem::class, 'staged_po_item_id');
        
    }

}
