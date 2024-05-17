<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountContactPostRequest extends FormRequest
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

        // Build the validation rule for all the address fields added

        $rules = [];

        foreach($this->first_name as $index => $value) {

            $rules["first_name.{$index}"] = 'required';
            $rules["last_name.{$index}"] = 'required';
            $rules["phone.{$index}"] = 'required_without:mobile.' . $index;
            $rules["mobile.{$index}"] = 'required_without:phone.' . $index;
            $rules["email.{$index}"] = 'required';
        }

        return $rules;

    }

}
