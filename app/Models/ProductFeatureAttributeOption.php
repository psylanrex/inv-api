<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureAttributeOption extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeatureAttributeOption';

    public $timestamps = false;

    public $guarded = [];
    
}
