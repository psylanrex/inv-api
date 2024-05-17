<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseOrder;
use App\Models\StagedPurchaseOrder;

class HasPurchaseOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $purchase_order = $request->route('purchase_order_id');

        $vendor_id = Auth::user()->vendor_id;

        $has_po = PurchaseOrder::where('vendor_id', $vendor_id)->where('id', $purchase_order)->exists();

        // Make sure the PO isn't a staged PO just in case.

        if ( ! $has_po ) {

            $has_po = StagedPurchaseOrder::where('vendor_id', $vendor_id)->where('id', $purchase_order)->exists();

        }
        if ( ! $has_po ) {

            return redirect('/api/no-purchase-order-found');

        }

        return $next($request);

    }
}
