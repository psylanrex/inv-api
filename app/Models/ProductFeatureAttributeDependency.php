<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureAttributeDependency extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeatureAttributeDependency';

    public $timestamps = false;

    public $guarded = [];
    
}
