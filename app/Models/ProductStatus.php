<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductStatus extends BaseModel
{
    use HasFactory;

    const NOT_REVIEWED      = 1;
    const REVIEWED          = 2;
    const REJECTED          = 3;
    const NEW_ITEM          = 4;
    const APPROVED          = 5;
    const DO_NOT_REORDER    = 6;
    
    public $table = 'inventory.ProductStatus';
    
}
