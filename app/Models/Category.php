<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const US_COINS  = 63;
    const JEWELRY   = 21;
    const WATCHES   = 38;
    const GEMSTONES = 53;

    public $table = 'inventory.Category';

    public static function specialCategories()
    {
        return [
            self::US_COINS,
            self::JEWELRY,
            self::WATCHES,
            self::GEMSTONES
        ];
    }

    public function features()
    {

        return $this->belongsToMany(ProductFeature::class, 'inventory.CategoryProductFeatureTemplate');

    }
}
