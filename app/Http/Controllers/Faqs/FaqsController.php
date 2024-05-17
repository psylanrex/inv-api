<?php

namespace App\Http\Controllers\Faqs;

use App\Http\Controllers\Controller;
use App\Models\FaqCategory;

class FaqsController extends Controller
{
    public function index()
    {

        return FaqCategory::with('faqs')->get();

    }

}
