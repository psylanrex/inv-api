<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureValidationRule extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductFeatureValidationRule';

    public function validationRule()
    {

        return $this->belongsTo(ValidationRule::class, 'validation_rule_id');

    }

    public function conditionalAttribute()
    {

        return $this->belongsTo(ProductFeatureAttribute::class, 'conditional_attribute_id');
        
    }

}
