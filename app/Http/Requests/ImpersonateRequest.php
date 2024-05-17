<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidEmployee;
use App\Rules\EmployeeCanImpersonate;
use App\Rules\VendorExists;
use App\Rules\EmployeeExists;

class ImpersonateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            'vendor_id' => ['required', 'integer', new VendorExists],
            'user_name' => [

                'required', 
                'string', 
                new EmployeeExists,

            
            ],
            'password' => 'required|string'
            
        ];

    }

}
