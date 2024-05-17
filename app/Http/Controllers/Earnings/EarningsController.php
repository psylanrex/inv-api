<?php

namespace App\Http\Controllers\Earnings;

use App\Http\Controllers\Controller;
use App\Queries\Earnings\EarningsQuery;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EarningsRequest;


class EarningsController extends Controller
{
    public function owed(EarningsRequest $request, EarningsQuery $earnings)
    {

        // add is_paid to the request

        $request->merge(['is_paid' => FALSE]);

       // $vendor_id = Auth::user()->vendor_id;

        // test with a hard coded vendor_id

        $vendor_id = 7;

        return $earnings->getData($request, $vendor_id);
       
    }

    public function paid(EarningsRequest $request, EarningsQuery $earnings)
    {

        // $vendor_id = Auth::user()->vendor_id;

        // test with a hard coded vendor_id

        $vendor_id = 7;

        // add is_paid to the request

        $request->merge(['is_paid' => TRUE]);

        return $earnings->getData($request, $vendor_id);

    }

}
