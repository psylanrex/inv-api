<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageType extends Model
{
    use HasFactory;

    const INVOICE_AGREEMENT = 11;

    protected $table = 'websites.PageType'; 

}
