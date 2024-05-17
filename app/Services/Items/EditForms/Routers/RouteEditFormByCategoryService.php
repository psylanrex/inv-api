<?php

namespace App\Services\Items\EditForms\Routers;

use App\Services\Items\EditForms\BasicEditFormService;
use App\Services\Items\EditForms\ComplexForms\Jewelry\JewelryEditFormService;
use App\Services\Items\EditForms\ComplexForms\Watches\WatchEditFormService;
use App\Services\Items\EditForms\ComplexForms\Gemstones\GemstoneEditFormService;
use App\Services\Items\EditForms\BaseForms\SimpleFormService;


class RouteEditFormByCategoryService
{

    public function routeEditFormByCategory($product)
    {

        $category_id = $product->category_id;


        // get complex form structure by category

        switch ($category_id) {

            case 21:

                return (new JewelryEditFormService)->getEditForm($product);
                break;

            case 38:

                return (new WatchEditFormService)->getEditForm($product);
                break;

            case 53:

                return (new GemstoneEditFormService)->getEditForm($product);
                break;

            default:

                return (new SimpleFormService)->getEditForm($product);

        }

    }

}