<?php

namespace App\CodeGenerator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotNullIfRelatedValueFilled implements ValidationRule
{

    public $associated_column_name;

    public function __construct($associated_column_name)
    {

        $this->associated_column_name = $associated_column_name;


    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (  is_null($this->associated_column_name) ) {

            $attribute = str_replace('_', ' ', $attribute);

            $attribute = ucwords($attribute);

            $fail("The associated column name or type for {$attribute} is not filled.'");

        }
    }
}
