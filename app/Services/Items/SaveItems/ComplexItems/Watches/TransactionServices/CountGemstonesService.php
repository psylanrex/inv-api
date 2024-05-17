<?php


namespace App\Services\Items\SaveItems\ComplexItems\Watches\TransactionServices;

class CountGemstonesService
{

    public function countGemstones($request)
    {

        $count = 0;
        
        if ($request->has_gemstone == 0 ) {

            return 0;

        } 

        $request->has_gemstone_one ? $count++ : null;
        $request->has_gemstone_two ? $count++ : null;   
        $request->has_gemstone_three ? $count++ : null;
        $request->has_gemstone_four ? $count++ : null;
        $request->has_gemstone_five ? $count++ : null;

        return $count;
        
    }

}