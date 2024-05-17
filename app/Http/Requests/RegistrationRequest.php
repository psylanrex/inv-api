<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ProfanityNotAllowed;

class RegistrationRequest extends FormRequest
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
            
            'username' => ['required','alpha_dash', 'max:255', 'unique:App\Models\User,username', new ProfanityNotAllowed],
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|max:70',
            'billing_company' => 'required|max:255',
            'category' => 'required',
            'website' => 'required|max:255',
            'terms' => 'required',
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'phone' => 'required|max:20',
            'ext' => 'nullable|max:4',
            'fax' => 'max:20',
            'billing_address' => 'required|max:255',
            'billing_city' => 'required|max:255',
            'billing_state' => 'required',
            'billing_country' => 'required',
            'billing_zip' => 'required|max:10',
            'shipping_address' => 'required_unless:same,1|max:255',
            'shipping_city' => 'required_unless:same,1|max:255',
            'shipping_state' => 'required_unless:same,1',
            'shipping_country' => 'required_unless:same,1',
            'shipping_zip' => 'required_unless:same,1|max:10',          
        
        ];

    }

}
