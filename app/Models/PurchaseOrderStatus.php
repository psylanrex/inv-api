<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseOrderStatus extends BaseModel
{
    use HasFactory;

    const PENDING                   = 1;
    const PENDING_VENDOR            = 2;
    const RECEIVED                  = 3;
    const OPEN                      = 4;
    const COMPLETE                  = 5;
    const REJECTED                  = 6;
    const DUMP                      = 7;
    const VENDOR_CLOSED             = 8;
    const PENDING_APPROVAL          = 9;
    const PENDING_INVOICE_CREATION  = 10;
    const STOCK_CHECK_PENDING       = 11;
    const STOCK_CHECK_COMPLETE      = 12;

    public $table = 'inventory.PurchaseOrderStatus';

}
