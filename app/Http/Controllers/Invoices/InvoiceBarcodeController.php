<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceBarcodeController extends Controller
{
    public function barcode(Request $request)
    {

        return 'here is the barcode';
        
    }
}
