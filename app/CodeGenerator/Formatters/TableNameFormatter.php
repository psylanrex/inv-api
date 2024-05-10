<?php

namespace App\CodeGenerator\Formatters;

use Illuminate\Support\Str;

class TableNameFormatter
{

    public static function formatTableName($model_name)
    {


        $table_name = Str::lower(Str::of($model_name)->snake());

        return Str::plural($table_name);

        


    }



}