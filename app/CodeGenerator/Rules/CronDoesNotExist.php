<?php

namespace App\CodeGenerator\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CronDoesNotExist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // path to file

        $file = base_path() . "/app/Console/Commands/{$value}.php";


        if ( file_exists($file) ) {

            $fail('Command already exists.');

        }
        
    }
}
