<?php

namespace App\Queries\Products;

use Illuminate\Support\Facades\DB;
use App\Models\ProductDescription;

class GetProductsFromIdsQuery
{

    /**
     * Static method to return the products and the required data for the data tables for the dashboard stats.
     *
     * @param array $product_ids
     * @return Collection
     */
    public static function getProductsFromIds($product_ids)
    {

        return ProductDescription::select(DB::raw('
            
            ProductDescription.id,
            CONCAT(ProductDescription.category_id, "/", 9, "/", ProductDescription.id, ".jpg") AS image_url, ### Build the image URI
            VendorItemCode.item_code,
            ProductDescription.short_name,
            PurchaseOrderLineItem.unit_cost,
            ProductStats.avg_rating
        
        '))
        
            ->join('inventory.VendorItemCode', 'ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')
            ->join('inventory.Control', 'ProductDescription.id', '=', 'Control.product_description_id')
            ->join('reporting.ProductStats', 'ProductDescription.id', '=', 'ProductStats.product_id')
            ->join('inventory.PurchaseOrderLineItem', 'Control.purchase_order_line_item_id', '=', 'PurchaseOrderLineItem.id')

            ->whereIn('ProductDescription.id', $product_ids)

            ->groupBy('ProductDescription.id', 'PurchaseOrderLineItem.unit_cost')

            ->get();

    }

}