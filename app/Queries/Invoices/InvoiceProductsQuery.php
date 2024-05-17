<?php

namespace App\Queries\Invoices;

use App\Models\ProductDescription;

Class InvoiceProductsQuery
{
    
    public function getData($product_ids)
    {
        
        return ProductDescription::select('ProductDescription.*')

            ->with('priceTypeBdp')

            ->join('inventory.VendorItemCode', 'ProductDescription.vendor_item_code_id', '=', 'VendorItemCode.id')

            ->whereIn('ProductDescription.id', $product_ids)

            ->orderBy('VendorItemCode.item_code', 'ASC')

            ->get();
        
    }

}
