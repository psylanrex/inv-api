<?php

namespace App\Http\Controllers\Items;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Items\DeleteItems\Routers\DeleteItemRouterService;

class ItemDeleteController extends Controller
{
    public function deleteItem(Request $request)
    {

        $request->validate([


            'product_id' => 'required|integer',
            
        ]);
        
        return (new DeleteItemRouterService)->routeItem($request);
       
    }
    
}
