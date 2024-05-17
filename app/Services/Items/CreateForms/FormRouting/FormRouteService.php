<?php

namespace App\Services\Items\CreateForms\FormRouting;

use App\Services\Items\CreateForms\BaseForms\SimpleFormService;
use App\Services\Items\CreateForms\FormRouting\ComplexFormRoutingService;

class FormRouteService
{

    public function getForm($category_id)
    {

        // if the category requires a complex form 
        // return the complex form structure

        $complex_forms = [21, 53, 38];

        if ( in_array($category_id, $complex_forms) ) {

            return (new ComplexFormRoutingService)->getComplexFormStructure($category_id);

        }

        // otherwise, return the simple form structure

        return (new SimpleFormService)->getSimpleFormStructure($category_id);

    }

}