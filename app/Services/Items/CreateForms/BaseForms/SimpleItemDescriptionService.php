<?php

namespace App\Services\Items\CreateForms\BaseForms;

class SimpleItemDescriptionService
{

    public function simpleItemDescription()
    {

        // item-description

        $fields = [

            'name' => '',
            'short_name' => '',
            'description' =>  ''

        ];

        // metadata

        $metadata = [
            
            'item_description_required_fields' => $this->itemDescriptionRequiredFields()

        ];

        return array_merge($fields, $metadata);

    }

    public function itemDescriptionRequiredFields()
    {

        return [

            'name',
            'short_name',
            'description'

        ];

    }

}