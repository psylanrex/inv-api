<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureAttributeType extends Model
{
    use HasFactory;

    const TEXT          = 1;
    const SELECT        = 2;
    const CHECK         = 3;
    const RADIO         = 4;
    const TEXTAREA      = 5;
    const MULTI_SELECT  = 6;
    const RANGE         = 7;

    public $table = 'inventory.ProductFeatureAttributeType';

    public $timestamps = false;

    public $guarded = [];
    
}
