<?php

namespace App\CodeGenerator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsValidColumnType implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Acceptable types. May refactor to pull this from data

        $types = ['string', 'string-unique', 'integer', 'unsigned-integer', 'boolean', 'boolean-default', 'null', 'text', 'date-time'];


        if ( ! in_array($value, $types) ) {

            $fail('Not a valid column type.');

        }
        
    }
}
