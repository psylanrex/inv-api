<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescriptionProductFeatureAttribute extends Model
{
    use HasFactory;

    protected $table = 'inventory.ProductDescriptionProductFeatureAttribute';

    protected $guarded = [];

    public $timestamps = false;

    /**
     * Relation to the product feature attribute for this type of values for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function productFeatureAttribute()
    {

        return $this->hasOne(ProductFeatureAttribute::class, 'id', 'product_feature_attribute_id');

    }
    
}
