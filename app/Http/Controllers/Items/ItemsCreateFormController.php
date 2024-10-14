<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ItemCondition;
use App\Models\ProductTag;
use App\Services\Items\CreateForms\FormRouting\FormRouteService;
use App\Services\Items\CreateForms\ComplexForms\Gemstones\GemstoneDependencyService;

class ItemsCreateFormController extends Controller
{

    /**
     * Returns fields needed for create form
     *
     * @return array
     */
    public function getFormFields()
    {
        return [
            'categories' => Category::orderBy('name', 'asc')->pluck('name', 'id'),
            'brands' => Brand::orderBy('name', 'asc')->pluck('name', 'id'),
            'conditions' => ItemCondition::all()->pluck('name', 'id'),
            'tags' => ProductTag::orderBy('tag', 'asc')->pluck('tag', 'id')
        ];
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
