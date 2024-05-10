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
            
                'name' => ['required','alpha_dash', 'unique:users,name', new ProfanityNotAllowed],
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
            
        ];
    }
}