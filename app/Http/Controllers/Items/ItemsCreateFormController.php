<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Items\CreateForms\FormRouting\FormRouteService;
use App\Services\Items\CreateForms\ComplexForms\Gemstones\GemstoneDependencyService;

class ItemsCreateFormController extends Controller
{

    public function getCategories()
    {

        // get categories

        return Category::orderBy('name', 'asc')
        
            ->pluck('name', 'id');

    }

    public function getFormByCategory($id)
    {

        // get form by category

        return (new FormRouteService)->getForm($id);

    }

    public function getGemstoneDependentFields($id)
    {

        // get gemstone dependent fields, clarity and grade
        // depending on gemstone type

        return (new GemstoneDependencyService)->getGemstoneDependentFields($id);

    }

}
