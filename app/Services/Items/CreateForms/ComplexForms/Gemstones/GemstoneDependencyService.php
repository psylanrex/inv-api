<?php

namespace App\Services\Items\CreateForms\ComplexForms\Gemstones;

class GemstoneDependencyService
{

    public function getGemstoneDependentFields($gemstone_id)
    {

        // if the gemstone is a diamond (70), return the diamond dependent fields

        if ( $gemstone_id == 70 ) {

            return ['clarity', 'clarity_2'];

        }

        return ['grade', 'grade_2'];    

    }     

}