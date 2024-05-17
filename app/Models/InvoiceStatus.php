<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
    use HasFactory;

    const PENDING                   = 1;
    const LANDED                    = 2;
    const RECEIVED                  = 3;
    const INVOICED                  = 4;
    const CANCELLED                 = 5;
    const FREIGHT_OVERAGE           = 6;
    const PENDING_VENDOR_FREIGHT    = 7;

    public $table = 'inventory.InvoiceStatus';
    
}
