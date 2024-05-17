<?php

namespace App\Services\Dashboard;

use App\Models\StagedPurchaseOrder;
use App\Models\PurchaseOrder;
use App\Models\InvoicePayment;
use App\Models\CategoryVendorRating;
use App\Models\PurchaseOrderStatus;
use App\Models\InvoicePaymentStatus;
use App\Queries\HdImages\HdImageStatsQuery;
use App\Queries\VendorStats\VendorStatsQuery;
use App\Queries\ProductRatings\ProductRatingsQuery;
use Illuminate\Support\Facades\Auth;

class DashboardService
{

    public function handleDashboard($request)
    {

        $vendor_id = Auth::user()->vendor_id;


       $request->filled('is_employee') ? $is_employee = 1 : $is_employee = 0;

        
        $stock_check_orders = number_format(

            StagedPurchaseOrder::where('purchase_order_status_id',

            PurchaseOrderStatus::STOCK_CHECK_PENDING)
            
                ->where('vendor_id', $vendor_id)
                
                ->count()
            
            );

        $pending_orders = number_format(
            
            StagedPurchaseOrder::where('purchase_order_status_id', 
            
            PurchaseOrderStatus::PENDING_VENDOR)
            
                ->where('vendor_id', $vendor_id)
                
                ->count()
            
            );

        $open_orders = number_format(
            
            PurchaseOrder::where('purchase_order_status_id', 
            
            PurchaseOrderStatus::OPEN)
            
                ->where('vendor_id', $vendor_id)
                
                ->count()
            
            );

        $closed_orders = number_format(
            
            PurchaseOrder::where('purchase_order_status_id', 
            
            PurchaseOrderStatus::VENDOR_CLOSED)
            
                ->where('vendor_id', $vendor_id)
            
                ->count()
            
            );

        $pending_payments = number_format(
            
            InvoicePayment::inStatus(InvoicePaymentStatus::PENDING)
            
                ->byVendor($vendor_id)
                
                ->count()
            
            );

        // Get the ratings per category for vendor

        $cat_ratings = CategoryVendorRating::with('category')
            
            ->where('vendor_id', $vendor_id)
           
            ->get();

        // Get the product stats i.e. items on current open PO's 
        // and the required HD images amongst those products
        
        $product_stats = (new HdImageStatsQuery)->getData($vendor_id);

        // Get the damaged and returned percentage 
        // for the products sold for the vendor

        $vendor_stats = (new VendorStatsQuery)->getData($vendor_id);

        // Get the items that have a rating of less than 4 stars for "bad rating" 
        // and greater than or equal to 4 stars as "good rating"
        
        $product_ratings = (new ProductRatingsQuery)->getData($vendor_id);

        return [

            'stock_check_orders' => $stock_check_orders,
            'pending_orders' => $pending_orders,
            'open_orders' => $open_orders,
            'closed_orders' => $closed_orders,
            'pending_payments' => $pending_payments,
            'cat_ratings' => $cat_ratings,
            'product_stats' => $product_stats,
            'vendor_stats' => $vendor_stats,
            'product_ratings' => $product_ratings,
            'is_employee' => $is_employee

        ];

    }

}