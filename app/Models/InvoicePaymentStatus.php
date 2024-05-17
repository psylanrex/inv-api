<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicePaymentStatus extends Model
{
    use HasFactory;

    const PENDING   = 1;
    const UNPAID    = 2;
    const PAID      = 3;
    const DUMP      = 4;

    public $table = 'inventory.InvoicePaymentStatus';
    
}
