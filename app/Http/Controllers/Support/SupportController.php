<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportReceiptRequest;
use App\Services\Support\SupportService;

class SupportController extends Controller
{

    public function postSupport(SupportReceiptRequest $request, SupportService $supportService )
    {

        $supportService->sendSupportEmail($request->all());

        return response()->json(['message' => 'Support request sent successfully'], 200);
        
    }

}
