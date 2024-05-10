<?php

namespace App\CodeGenerator\Routes;
use App\CodeGenerator\Formatters\FormatControllerNameFromFolderName;

class AddRoutesService
{

    public function addRoutes($folder_name, $template_file)
    {

        $file_path = base_path('/routes/api.php');

        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);

        // Add the use statement to the file

        $controller_name = FormatControllerNameFromFolderName::formatControllerName($folder_name);

        $string_to_add = "use App\Http\Controllers\\{$folder_name}\\{$controller_name};";

        // Find the last occurrence of the string "use" in the file

        $last_use_position = strrpos($file_contents, 'use App\Http\Controllers');

        // Find the end of the line after the last "use" statement
    
        $end_of_line_position = strpos($file_contents, PHP_EOL, $last_use_position);
    
        // Insert the new string after the end of the line

        $file_contents = substr_replace($file_contents, PHP_EOL . $string_to_add, $end_of_line_position, 0);
        
        // Write the modified contents back to the file
    
        file_put_contents($file_path, $file_contents);


        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);

        // Find the last "use" statement again
    
        $last_use_position = strrpos($file_contents, 'use App\Http\Controllers');
    
        // Find the end of the line after the last "use" statement
    
        $end_of_line_position = strpos($file_contents, PHP_EOL, $last_use_position);

        // get template

        $content = file_get_contents($template_file);
    
        // Add two blank lines and additional content after the end of the line
    
        $file_contents = substr_replace($file_contents, PHP_EOL . PHP_EOL . $content, $end_of_line_position, 0);

        // Write the modified contents back to the file
    
        file_put_contents($file_path, $file_contents);

        return $content;




    }


}