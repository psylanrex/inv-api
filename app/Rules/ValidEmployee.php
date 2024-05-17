<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Employee;
use App\Models\EmployeeStatus;
use Illuminate\Support\Facades\Hash;

class ValidEmployee implements ValidationRule
{

    private $password;

    public function __construct( $password=Null )
    {

        $this->password = $password;

    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check that the user trying to sign in is a valid employee and the password matched

        $employee = Employee::where('username', $value)->first();

        if ( ! $employee || $employee->employee_status_id != EmployeeStatus::ACTIVE 
        
            || ! Hash::check($this->password, $employee->password) ) {

            $fail('Invalid employee');

        }

    }
}
