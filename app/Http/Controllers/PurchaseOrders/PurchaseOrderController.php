<?php

namespace App\Http\Controllers\PurchaseOrders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PurchaseOrders\StockCheckService;
use App\Services\PurchaseOrders\PendingService;
use App\Services\PurchaseOrders\OpenService;
use App\Services\PurchaseOrders\ClosedService;
use App\Services\PurchaseOrders\StockCheckDetailService;
use App\Services\PurchaseOrders\PostStockCheckService;
use App\Services\PurchaseOrders\StagedDetailsService;
use App\Services\PurchaseOrders\DetailsService;
use App\Services\PurchaseOrders\CreateInvoiceService;
use App\Services\PurchaseOrders\ApproveService;
use App\Services\PurchaseOrders\CloseService;
use App\Services\PurchaseOrders\RejectService;
use App\Services\PurchaseOrders\GetTotalsService;

class PurchaseOrderController extends Controller
{

    // Show all the staged purchase orders waiting on stock check

    public function stockCheck(StockCheckService $service)
    {

        return $service->stockCheck();
        
    }

    // Show all the staged purchase orders

    public function pending(PendingService $service)
    {
            
        return $service->pending();
        
    }

    // Show all the open purchase orders

    public function open(OpenService $service)
    {

        return $service->open();
        
    }

    // Show all the closed purchase orders

    public function closed(ClosedService $service)
    {

        return $service->closed();
        
    }
    
    // Detailed view of a staged purchase order in stock check status
    // breaking down the items that are attached on the order.

    public function stockCheckDetails($purchase_order_id, StockCheckDetailService $service)
    {

        return $service->stockCheckDetails($purchase_order_id);
        
    }
    
    // Handle the POST request for updating the quantities on the stock check
    // purchase orders.

    public function postStockCheck(Request $request, $purchase_order_id, PostStockCheckService $service)
    {

        return $service->postStockCheck($request, $purchase_order_id);
        
    }
    
    // Detailed view of a staged purchase order breaking down the items that are
    // attached on the order.

    public function stagedDetails($purchase_order_id, StagedDetailsService $service)
    {

        return $service->stagedDetails($purchase_order_id);
        
    }   

    // Detailed view of a purchase order breaking down the items that are
    // attached on the order.

    public function details($purchase_order_id, DetailsService $service)
    {

        return $service->details($purchase_order_id);
        
    }

    // Handle the post request for creating an invoice on the open purchase order details form.

    public function createInvoice(Request $request, $purchase_order_id, CreateInvoiceService $service)
    {

        return $service->createInvoice($request, $purchase_order_id);
    
    }

    // Approve the staged purchase order and create the purchase order, detail and
    // summary. Updated the product descriptions current unit cost and delete
    // the staged purchase order.

    public function approve($staged_purchase_order_id, ApproveService $service)
    {

        return $service->approve($staged_purchase_order_id);
      
    }
    
    // Update the status of the purchase order to vendor closed status and redirect
    // back to the open page with the success message.

    public function close($purchase_order_id, CloseService $service)
    {

        return $service->close($purchase_order_id);
        
    }

    // Update the status of the staged purchase order to rejected status and redirect
    // back to the pending page with the success message.

    public function reject($purchase_order_id, RejectService $service)
    {

        return $service->reject($purchase_order_id);
        
    }
    
    //  Method to calculate the totals of the quantity of items 
    // in the order and the grand total cost of the orders.

    public function getTotals($purchase_order_summaries, GetTotalsService $service)
    {

        return $service->getTotals($purchase_order_summaries);
        
    }

    public function noPurchaseOrderFound()
    {

        return ['message' => 'No purchase order found'];
        
    }

}
