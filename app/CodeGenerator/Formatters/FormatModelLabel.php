<?php

namespace App\CodeGenerator\Formatters;

use Illuminate\Support\Str;

class FormatModelLabel
{

    public static function formatModelLabel($model_name)
    {

        // make plural

        $model_name = Str::plural($model_name);

        // Convert to title case and insert space between words

        $model_name = preg_replace('/(?<!\s)([A-Z])/', ' $1', $model_name);

        return $model_name;

    }



}