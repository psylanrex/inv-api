<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductFeatureAttribute;

class ProductFeature extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeature';

    public $timestamps = false;

    public $guarded = [];

    public function attributes()
    {
        return $this->hasMany(ProductFeatureAttribute::class, 'product_feature_id')

            ->where('active', TRUE)

            ->orderBy('weight', 'ASC');       

    }

}
