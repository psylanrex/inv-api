<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrudStoreRequest extends FormRequest
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
                'crud_name' => 'string|max:140|required|unique:cruds,crud_name',
                'table_name' => 'string|required' 
        ];
    }
}
