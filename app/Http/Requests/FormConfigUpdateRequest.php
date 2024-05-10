<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormConfigUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [

            'name' => 'string|required|max:140',
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
