<?php

namespace App\Utilities;

class IncludeRoutes
{

    public static function file($path)
    {

        include base_path($path);

    }

}