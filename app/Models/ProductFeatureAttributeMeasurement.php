<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureAttributeMeasurement extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeatureAttributeMeasurement';

    public $timestamps = false;

    public $guarded = [];

}
