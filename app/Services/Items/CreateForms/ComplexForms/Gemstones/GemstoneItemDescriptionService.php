<?php

namespace App\Services\Items\CreateForms\ComplexForms\Gemstones;

class GemstoneItemDescriptionService
{

    public function itemDescription()
    {


        $fields = [

            'name' => '',
            'short_name' => '',
            'description' => '',
            'item_description_required_fields' => $this->itemDescriptionRequiredFields(),
            'single_stone_disabled_fields' => $this->singleStoneDisabledFields()

        ];

        return $fields;

    }

    public function itemDescriptionRequiredFields()
    {

        return [

            'name',
            'short_name',
            'description'

        ];

    } 
    
    public function singleStoneDisabledFields()
    {

        return [

            'description'

        ];

    }

}