<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureTemplate extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeatureTemplate';

    public $timestamps = false;

    public $guarded = [];
    
}
