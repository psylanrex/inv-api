<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountInfoPostRequest;
use App\Http\Requests\AccountAddressPostRequest;
use Illuminate\Http\Request;
use App\Services\Account\GetProfileService;
use App\Services\Account\AccountInfoUpdateService;
use App\Services\Account\UpdateAddressService;
use App\Http\Requests\AccountContactPostRequest;
use App\Services\Account\UpdateContactsService;

class AccountController extends Controller
{
    public function profile(GetProfileService $profileService)
    {

        return response()->json($profileService->getProfile());

    }
    
    public function postInfo(AccountInfoPostRequest $request, AccountInfoUpdateService $service)
    {

        $result = $service->updateInfo($request);

        [$user, $vendor] = $result;

        return response()->json([
            
            'message' => 'Account information updated successfully',
            'user' => $user,
            'vendor' => $vendor   
        
        ], 200);
        
    }

    public function postAddress(AccountAddressPostRequest $request, UpdateAddressService $service)
    {

        $addresses = $service->updateAddress($request);

        return response()->json([
            
            'message' => 'Address information updated successfully',
            'addresses' => $addresses  
        
        ], 200);
        
    }

    public function postContacts(AccountContactPostRequest $request, UpdateContactsService $service)
    {

        $contacts = $service->updateContacts($request);

        return response()->json([
            
            'message' => 'Address information updated successfully',
            'contacts' => $contacts 
        
        ], 200);
       
    }
    
}
