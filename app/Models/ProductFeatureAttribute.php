<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureAttribute extends Model
{
    use HasFactory;

    protected $table = 'inventory.ProductFeatureAttribute';

    protected $guarded = [];

    public $timestamps = false;

    public function type()
    {

        return $this->belongsTo(ProductFeatureAttributeType::class, 'product_feature_attribute_type_id');

    }

    public function options()
    {

        return $this->hasMany(ProductFeatureAttributeOption::class, 'product_feature_attribute_id')
        
            ->where('active', 1)
            
            ->orderBy('weight', 'ASC')
            ->orderBy('value', 'ASC');

    }

    public function measurement()
    {

        return $this->belongsTo(ProductFeatureAttributeMeasurement::class, 'product_feature_attribute_measurement_id');

    }

    public function rules()
    {

        return $this->hasMany(ProductFeatureValidationRule::class, 'product_feature_attribute_id');

    }

    public function childAttribute()
    {

        return $this->hasOne(self::class, 'parent_product_feature_attribute_id');

    }
    
}
