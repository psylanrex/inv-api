<?php

namespace App\Rules;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmployeeExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( Employee::where('username', $value)->doesntExist() ) {

            $fail('Employee does not exist');

        }

    }
}
