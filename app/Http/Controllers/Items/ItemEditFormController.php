<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Items\EditForms\Routers\EditFormRouterService;
use App\Http\Requests\EditItemFormRequest;
use App\Models\ProductDescription;
use App\Rules\UserOwnsItem;


class ItemEditFormController extends Controller
{

    public function getEditForm($product_id)
    {  
        return (new EditFormRouterService())->getEditFormByCategory($product_id);

    }

}
