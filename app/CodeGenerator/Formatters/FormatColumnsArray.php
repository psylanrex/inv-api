<?php

namespace App\CodeGenerator\Formatters;

class FormatColumnsArray
{

    public static function buildColumnsArray($request)
    {

        $columns = [];

        // Assuming a maximum of 12 columns
    
        for ($i = 1; $i <= 12; $i++) {

        $column_name_key = "column_{$i}_name";
        $column_type_key = "column_{$i}_type";

        if ( $request->filled($column_name_key) ) {

            $column_name = $request->get($column_name_key);
            $column_type = $request->get($column_type_key);

            // make sure we are lowercase

            $column_name = strtolower($column_name);

            $column_type = strtolower($column_type);

            $columns[] = [$column_name => $column_type];

        }
    }

    return $columns;


    }

}