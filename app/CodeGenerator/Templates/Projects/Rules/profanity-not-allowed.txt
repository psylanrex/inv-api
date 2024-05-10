<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Services\Auth\ProfanityFilterService;

class ProfanityNotAllowed implements ValidationRule
{

    private $profantiy;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->profanity = new ProfanityFilterService;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( $this->profanity->matches($value) ) {

            $fail('The name is already in use.');

        }
    }
}