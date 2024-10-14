<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Services\Barcodes\BarcodeGeneratorService;

class InvoiceBarcodeController extends Controller
{

    public function barcode($code)
    {

        $bc = new BarcodeGeneratorService();
        $bc->init('png');
        $bc->build($code);
        
    }
    
}
