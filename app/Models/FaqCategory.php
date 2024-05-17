<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    public $table = 'vendorinv.FaqCategory';

    public function faqs()
    {

        return $this->hasMany(Faq::class, 'faq_category_id');

    }
    
}
