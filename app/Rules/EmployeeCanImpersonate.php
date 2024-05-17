<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Employee;
use App\Models\EmployeeRole;

class EmployeeCanImpersonate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $employee = Employee::where('username', $value)->first();

        // Check if the employee has the proper permissions to impersonate the Vendor

        if ( ! $employee->hasRoles([EmployeeRole::ADMIN, EmployeeRole::PURCHASING]) ) {
                
            $fail('Employee does not have permission to impersonate');
                  
        }

    }
    
}
