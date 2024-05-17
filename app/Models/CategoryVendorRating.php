<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryVendorRating extends Model
{
    use HasFactory;

    protected $table = 'reporting.CategoryVendorRatings';

    
    public function category()
    {

        return $this->belongsTo(Category::class);

    }
    
}
