<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Support\Str;

class RemoveModelFromRunSeedsService
{

    public function removeModelFromRunSeedsController($model)
    {


        $model_to_remove = Str::plural($model);

        $model_to_remove = "'" . $model_to_remove . "',";

        $run_seeds_controller_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/RunSeedsController.php';

        if ( ! file_exists($run_seeds_controller_file) ) {

            return FALSE;
        }

        // get the file

        $file_content = file_get_contents($run_seeds_controller_file);

        // Remove the specified model from the content
    
        $file_content = str_replace($model_to_remove, '', $file_content);

        // Write the content to the file

        file_put_contents($run_seeds_controller_file, $file_content);


    }


}