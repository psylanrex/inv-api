<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Formatters\FormatModelLabel;

class RemoveFormConfigSeedService
{

    public function removeFormConfigSeed($model)
    {

        // Format initial values

        $model_name = ModelNameFormatter::formatModelName($model);

        $model_label = FormatModelLabel::formatModelLabel($model_name);


        $file_path = base_path('/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php');


        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);
 

        // Define the start and end strings

        $start_string = "// {$model_label} begin";

        $end_string = "// {$model_label} end";


        // Create a pattern to match the entire block of code (including start and end strings)

        $pattern = "#$start_string.*?$end_string#s";

        // Remove the matched block from the file contents

        $file_contents = preg_replace($pattern, '', $file_contents);

        // Write the modified contents back to the file

        file_put_contents($file_path, $file_contents);

    }

}