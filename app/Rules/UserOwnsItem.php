<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\ProductDescription;

class UserOwnsItem implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $product = ProductDescription::with(['vendorItemCode'])->where('id', $value)->first();

        if ( $product->vendorItemCode->vendor_id != auth()->user()->vendor_id ) {

            $fail('You do not have permission to edit this item');

        }
        
    }

}
