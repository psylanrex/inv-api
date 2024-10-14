<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;

class HdImagePostRequest extends FormRequest
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

        $category_jewelry = Category::JEWELRY;
        $filetype = 'sometimes|file|mimes:jpeg,jpg,png';
        $dimension = 'dimensions:min_width=1080,min_height=1080';

        return [

            // Should never be missing
            
            'product_id' => 'required',
            'category_id' => 'required',

            // Optional and can fail validation

            'hd_primary_image' => "required_unless:rejected,true|{$filetype}|{$dimension}",
            'hd_secondary_image' => "required_unless:rejected,true|{$filetype}|{$dimension}",
            'hd_image_3' => "{$filetype}|{$dimension}",
            'hd_image_4' => "{$filetype}|{$dimension}",

            // Only to required if jewelry if this isn't the rejected upload form.

            'hd_scale_image' => ($this->request->get('rejected')) ? "{$filetype}|{$dimension}" : "required_if:category_id,{$category_jewelry}|{$filetype}|{$dimension}"
        
        ];
        
    }

    public function messages(): Array
    {
        return [

            // Generic message since these should never be missing

            'product_id.required' => 'Product seems to be missing from product. Please refresh the page and try again.',
            'category_id.required' => 'Category seems to be missing from product. Please refresh the page and try again.',

            // Custom message to make it more readable to the user

            'hd_scale_image.required_if' => 'The hd scale image field is required when the product category is "Jewelry".',
            'dimensions' => 'The :attribute doesn\'t meet the dimensions requirement :min_width x :min_height px'

        ];
    }

}
