<?php

namespace App\CodeGenerator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\CodeGenerator\Rules\IsValidColumnType;
use App\CodeGenerator\Rules\NotNullIfRelatedValueFilled;

class MakeFoundationRequest extends FormRequest
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
            
            $rules = [
                'model' => 'string|required',
                'controller_folder' => 'string|required',
                'controller_type' => 'string|required',
                'column_1_name' => 'string|required',
                'column_1_type' => ['nullable', 'string', new IsValidColumnType],
            ];
        
            // validation for columns 2 - 12 are the same, so we use a for loop

            for ($i = 2; $i <= 12; $i++) {

                $column_name_key = "column_{$i}_name";
                $column_type_key = "column_{$i}_type";
        
                $rules[$column_name_key] = ['nullable', 'string', new NotNullIfRelatedValueFilled($this->$column_type_key)];
                $rules[$column_type_key] = ['nullable', 'string', new IsValidColumnType, new NotNullIfRelatedValueFilled($this->$column_name_key)];

            }
        
            return $rules;

    }
}
