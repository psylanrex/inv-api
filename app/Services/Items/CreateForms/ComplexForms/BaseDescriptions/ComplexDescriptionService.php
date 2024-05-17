<?php

namespace App\Services\Items\CreateForms\ComplexForms\BaseDescriptions;

class ComplexDescriptionService
{

    public function itemDescription()
    {

        // item-description

        $fields = [

            'name' => '',
            'short_name' => '',
            'description' =>  ''

        ];

        $metadata = [

            'item_description_required_fields' => $this->itemDescriptionRequiredFields(),
            'item_description_prompts' => $this->itemDescriptionPrompts(),
            'item_description_disabled_fields' => $this->itemDescriptionDisabledFields()

        ];

        // merge and return

        return array_merge($fields, $metadata);

    }

    public function itemDescriptionRequiredFields()
    {

        return [

            'long_name',
            'short_name'

        ];

    }

    public function itemDescriptionPrompts()
    {

        return [

            'name' => '9150 characters max',
        
            'short_name' => '(16 chars max)',

            'description' => 'This item type does not require a description.'
            
        ];

    }

    public function itemDescriptionDisabledFields()
    {

        return [

            'description'

        ];

    }

}