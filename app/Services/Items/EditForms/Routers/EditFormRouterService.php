<?php

namespace App\Services\Items\EditForms\Routers;

use App\Models\ProductDescription;
use App\Models\ProductStatus;
use App\Services\Items\EditForms\Routers\RouteEditFormByCategoryService;

Class EditFormRouterService
{

    public function getEditFormByCategory($product_id)
    {

        // validating here because a stand alone rule with request object didn't work.
        // possible refactor to use a request and custom rule in controller

        $product = ProductDescription::with(['vendorItemCode'])->where('id', $product_id)->first();

        if ($product->vendorItemCode->vendor_id != auth()->user()->vendor_id ) {


            return response()->json([

                'status' => 'error',
                'message' => 'You do not have permission to edit this item'

            ], 403);

        }

         // Check if the item is available for editing or not and redirect if not

        if ( $product->product_status_id != ProductStatus::NOT_REVIEWED  ) {

                    return [

                        'status' => 'error',
                        'message' => 'This item is not available for editing'

                    ];

        }

        return (new RouteEditFormByCategoryService)->routeEditFormByCategory($product);
        
    }

}