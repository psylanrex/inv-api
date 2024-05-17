<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountAddressPostRequest extends FormRequest
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

        foreach($this->type as $index => $value) {

            $rules["type.{$index}"] = 'required';
            $rules["address.{$index}"] = 'required';
            $rules["city.{$index}"] = 'required';
            $rules["state.{$index}"] = 'required';
            $rules["zip.{$index}"] = 'required';

        }

        return $rules;

    }
}
