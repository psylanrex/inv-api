<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\InvoiceNumberUnique;

class FinalizeInvoicePostRequest extends FormRequest
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
            
            
            'ship_date' => 'required',
            'invoice_number' => ['required', new InvoiceNumberUnique()],
            'tracking_number' => 'required',
            'ship_method_id' => 'required',
            'freight_cost_in' => 'required',
            'import_fee' => 'required',
            'sales_tax' => 'required',
            'expected_landing_date' => 'required',

        ];

    }

}
