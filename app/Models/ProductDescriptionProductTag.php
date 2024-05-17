<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDescriptionProductTag extends Model
{
    use HasFactory;

    public $table = 'inventory.ProductDescriptionProductTag';

    public $guarded = [];

    public $timestamps = false;

    public static function createMany($product_key, Array $tags)
    {
        foreach ($tags AS $tag) {

            self::create(['product_description_id' => $product_key, 'product_tag_id' => $tag]);

        }

    }
    
}
