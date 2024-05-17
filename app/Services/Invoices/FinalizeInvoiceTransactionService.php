<?php

namespace App\Services\Invoices;

use App\Models\InvoiceStatus;
use Illuminate\Support\Facades\DB;

class FinalizeInvoiceTransactionService
{

    public function transaction($request, $invoice)
    {

        DB::beginTransaction();

        try{

            // Update the invoice instance with the post data

            $invoice->fill($request->except('_token'));

            // Update the invoice status to be Invoiced

            $invoice->invoice_status_id = InvoiceStatus::INVOICED;

            // Save the invoice

            $invoice->save();


        } catch (\Exception $e) {

            DB::rollBack();

            return $e->getMessage();

        }

        return [
            
            'status' => 'success', 
            'code' => 200, 
            'message' => 'You have successfully marked the invoice as shipped. The invoice is now available to print.'
        
        ];  

    }

}