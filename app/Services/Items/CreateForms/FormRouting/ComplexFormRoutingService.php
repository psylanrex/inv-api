<?php

namespace App\Services\Items\CreateForms\FormRouting;

use App\Services\Items\CreateForms\ComplexForms\Jewelry\JewelryFormService;
use App\Services\Items\CreateForms\ComplexForms\Watches\WatchFormService;
use App\Services\Items\CreateForms\ComplexForms\Gemstones\GemstoneFormService;

class ComplexFormRoutingService
{

    public function getComplexFormStructure($category_id)
    {

        // get complex form structure by category

        switch ($category_id) {

            case 21:

                return (new JewelryFormService)->getForm($category_id);
                break;

            case 38:

                return (new WatchFormService)->getForm($category_id);
                break;

            case 53:

                return (new GemstoneFormService)->getForm($category_id);
                break;

            default:

                return ['error' => 'Category not found.'];

        }     

    }


}