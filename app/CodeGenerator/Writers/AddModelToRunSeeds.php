<?php

namespace App\CodeGenerator\Writers;

use Illuminate\Support\Str;

class AddModelToRunSeeds
{

    public function addModelToRunSeeds($model)
    {

        $model_to_add = Str::plural($model);

        $model_to_add = ltrim($model_to_add);

        $run_seeds_controller_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/RunSeedsController.php';

        // get the file

        $file_content = file_get_contents($run_seeds_controller_file);

        // Find the position of the models array

        $models_array_pos = strpos($file_content, '$models = [');

        // Find the position of the closing bracket of the models array
    
        $closing_bracket_pos = strpos($file_content, '];', $models_array_pos);

        // Extract the content of the models array
        
        $models_content = substr($file_content, $models_array_pos, $closing_bracket_pos - $models_array_pos + 2);

        // Add the new model to the array
        
        $models_content = str_replace('];', "\t'$model_to_add',\n\t\t];", $models_content);

        // Remove blank lines from $models_content

        $models_content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $models_content);

        // Replace the models array in the file content
        
        $file_content = substr_replace($file_content, $models_content, $models_array_pos, $closing_bracket_pos - $models_array_pos + 2);

        // Write the content to the file

        file_put_contents($run_seeds_controller_file, $file_content);


    }


}