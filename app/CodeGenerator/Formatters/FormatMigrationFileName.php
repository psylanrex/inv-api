<?php

namespace App\CodeGenerator\Formatters;
use Carbon\Carbon;

class FormatMigrationFileName
{

    public static function formatMigrationFileName($table_name)
    {

        $date_time = Carbon::now()->format('Y_m_d_His');

        $date_time = strtolower(str_replace(' ', '_', $date_time));

        return $date_time . '_create_' . $table_name . '_table.php';

    }



}