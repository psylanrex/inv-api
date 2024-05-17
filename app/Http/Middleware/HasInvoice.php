<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class HasInvoice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $invoice_id = $request->route('invoice_id');

        $vendor_id = Auth::user()->vendor_id;

        $own_invoice = Invoice::join('inventory.PurchaseOrder', 'Invoice.purchase_order_id', '=', 'PurchaseOrder.id')
           
            ->where('PurchaseOrder.vendor_id', $vendor_id)
            ->where('Invoice.id', $invoice_id)
            
            ->exists();

        if ( ! $own_invoice) {

            return redirect('/invoices/no-invoice-found');

        }

        return $next($request);
    }
}
