<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Services\Auth\ProfanityFilterService;

class ProfanityNotAllowed implements ValidationRule
{
  
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( (new ProfanityFilterService)->matches($value) ) {

            $fail("Name has been taken. Please try another.");

        }

    }
    
}
