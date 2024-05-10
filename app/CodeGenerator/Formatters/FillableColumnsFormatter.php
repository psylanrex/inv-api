<?php

namespace App\CodeGenerator\Formatters;

class FillableColumnsFormatter
{

    public static function formatFillableColumns($request)
    {

        // get rid of the values we don't need

        $newRequest = $request->except([
            '_token',
            'model',
            'controller_folder', 
            'controller_type', 
            'has_seeds',
            'column_1_type',
            'column_2_type',
            'column_3_type',
            'column_4_type',
            'column_5_type',
            'column_6_type',
            'column_7_type',
            'column_8_type',
            'column_9_type',
            'column_10_type',
            'column_11_type',
            'column_12_type'
        ]);

        // filter out null values

        $filteredRequest = array_filter($newRequest, function ($value) {
            return $value !== null;
        });

        $fillable_columns = [];

        // Add to fillable columns array

        foreach ( $filteredRequest as $column => $value ) {

            $value = strtolower($value);

            $fillable_columns[] = "'$value'";

        }

        // format as string so we can tokenize

        $fillable_columns = implode(', ', $fillable_columns);

        return $fillable_columns;


    }


}