<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Support\Str;

class RemoveSeedFileService
{

    public function removeSeedFile($model)
    {

        $model_name_plural = Str::plural($model);

        // path for the seeder file

        $file_name = $model_name_plural . 'SeederController.php';

        $file_path = base_path() . "/app/Http/Controllers/Admin/Dev/Seeders//{$file_name}";

        // delete file

        if ( file_exists($file_path) ) {

            unlink($file_path);

        }
    
    }

}