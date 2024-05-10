<?php

namespace App\CodeGenerator\Formatters;

class ModelNameFormatter
{


    public static function formatModelName($model_name)
    {

        $model_name = ucwords($model_name);

        return str_replace(' ', '', $model_name);;

    }

}