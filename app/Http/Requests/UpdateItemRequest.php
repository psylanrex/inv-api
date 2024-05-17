<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\Items\SaveItems\Validation\BaseRules;
use App\Services\Items\SaveItems\Validation\JewelryValidationRules;
use App\Services\Items\SaveItems\Validation\GemstoneValidationRules;
use App\Services\Items\SaveItems\Validation\WatchValidationRules;

class UpdateItemRequest extends FormRequest
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

        // rules common to all categories

        $base_rules = (new BaseRules)->baseRules();

        // add product_description_id as product_id

        $base_rules = array_merge($base_rules, ['product_id' => 'required|integer']);

        // corresponding complex categories are jewelry - 21, gemstones - 53, watches - 38

        $complex_form_categories = [21, 53, 38];

        // validate according to category_id
        // if the category is not in the complex_forms array
        // then it is a simple form

        if ( ! in_array($this->category, $complex_form_categories)  ) {

            // rules for simple form

            $name_and_description = [

                'description' => 'required|string',

            ];

            return array_merge($base_rules, $name_and_description);

        }

        // Jewelry

        if ($this->category == 21) {
 

            // rules for jewelry

            $additional_fields = (new JewelryValidationRules)->jewelryValidationRules();

            return array_merge($base_rules, $additional_fields);


        }

        // Gemstones

        if ($this->category == 53) {

            $additional_fields = (new GemstoneValidationRules)->gemstoneValidationRules();

            return array_merge($base_rules, $additional_fields);

        }

        // Watches

        if ($this->category == 38) {

            // rules for watches

            $additional_fields = (new WatchValidationRules)->watchValidationRules();

            return array_merge($base_rules, $additional_fields);

        }
        
    }

}
