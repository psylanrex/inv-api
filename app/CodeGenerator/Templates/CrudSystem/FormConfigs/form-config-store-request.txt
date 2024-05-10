<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormConfigStoreRequest extends FormRequest
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
            
            'name' => 'string|max:140|unique:form_configs,name',
            'crud_id' => 'integer|required',
            'type' => 'string|required',
            'label' => 'string|required',
            'required' => 'boolean|required',
            'max_length' => 'integer|required',
            'default' => 'nullable|string',
            'instructions' => 'nullable|string'

        ];
    }
}
