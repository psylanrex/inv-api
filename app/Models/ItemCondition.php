<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCondition extends Model
{
    use HasFactory;

    const NEW_ITEM              = 1;
    const USED_ITEM             = 2;
    const LIGHT_DAMAGE          = 3;
    const HEAVY_DAMAGE          = 4;
    const REFURBISHED           = 5;
    const OPEN_BOX              = 6;
    const MISSING_PARTS         = 7;
    const MISSING_DOCUMENTATION = 8;
    const MECHANICAL_CONDITION  = 9;
    const UNTESTED              = 10;
    const N_A                   = 11;

    public $table = 'inventory.ItemCondition';
    
}
