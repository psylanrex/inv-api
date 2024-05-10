<?php

namespace App\CodeGenerator\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFoundationRequest extends FormRequest
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

         'model' => 'string|required',
         'controller_type' => 'string|required'
            
        ];
    }
}
