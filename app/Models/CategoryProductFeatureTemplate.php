<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductFeatureTemplate extends Model
{
    use HasFactory;

    public $table = 'inventory.CategoryProductFeatureTemplate';

    public $timestamps = false;

    public $guarded = [];

    public function feature()
    {

        return $this->belongsTo(ProductFeature::class, 'product_feature_id');
        
    }


}
