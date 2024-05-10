<?php

namespace App\Utilities;

class SortBy
{

    public static function setSortBy($request, $column_map)
    {

        if ($request->has('sortBy')) {

            $sortBy = $request->get('sortBy');

            $sortOrder = $request->get('sortOrder');

            $sortBy = $column_map[$sortBy - 1];

            return [$sortBy, $sortOrder];
           
        }

        $sortBy = $column_map[0];

        $sortOrder = 'asc';


        return [$sortBy, $sortOrder];


    }


}