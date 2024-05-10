<?php

namespace App\CodeGenerator\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\CodeGenerator\Rules\CronDoesNotExist;


class MakeCronRequest extends FormRequest
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
            
            'command_name' => ['string', 'required', new CronDoesNotExist],
            'signature' => 'string|required',
            'description' => 'string|required',
            'handler_name' => 'string|required',
            'handler_method_name' => 'string|required',
            'interval' => 'string|required'

        ];
    }
}
