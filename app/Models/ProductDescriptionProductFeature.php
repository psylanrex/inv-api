<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescriptionProductFeature extends Model
{
    use HasFactory;

    protected $table = 'inventory.ProductDescriptionProductFeature';

    protected $guarded = [];

    public $timestamps = false;
    
}
