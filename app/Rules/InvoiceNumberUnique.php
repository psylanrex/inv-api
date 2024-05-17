<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class InvoiceNumberUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if this vendor has an Invoice # already for what the Vendor input

        $invoice_number_exists = Invoice::join('inventory.PurchaseOrder', function($join) {

            $join->on('PurchaseOrder.id', '=', 'Invoice.purchase_order_id')
            
                ->where('PurchaseOrder.vendor_id', '=', Auth::user()->vendor_id);
                
            })
            
            ->where('invoice_number', $value)
            
            ->exists();

        if ( $invoice_number_exists ) {

            $fail('Invoice number already exists for this vendor');

        }

    }

}
