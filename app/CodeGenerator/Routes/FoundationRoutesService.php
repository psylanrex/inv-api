<?php

namespace App\CodeGenerator\Routes;

use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Tokens\FoundationTokens;
use App\CodeGenerator\Assemblers\AssembleTemplateService;


class FoundationRoutesService
{

    public $tokenFormatter;

    public function __construct()
    {

        $this->tokenFormatter = new FoundationTokens;

    }

    public function makeRoutes($request)
    {

        // Format model name

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        // base path

        $base_path = base_path();

        $template_file = $base_path . '/app/CodeGenerator/Templates/Foundations/' . 'foundation-routes.txt';

        $file_path = base_path('/routes/api.php');

        $tokens = $this->tokenFormatter->formatTokens($request);

        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);

        // define tokens

        $tokens = $this->tokenFormatter->formatTokens($request);

        // Define the string to remove

        $controller_type = $tokens['CONTROLLERTYPE'];

        $controller_folder = $tokens['CONTROLLERFOLDER'];

        $controller_name = $tokens['CONTROLLERNAME'];

        // Add the use statement to the file

        $string_to_add = "use App\Http\Controllers\\{$controller_type}\\{$controller_folder}\\{$controller_name };";

        // Find the last occurrence of the string "use" in the file

        $last_use_position = strrpos($file_contents, 'use App\Http\Controllers');

        // Find the end of the line after the last "use" statement
    
        $end_of_line_position = strpos($file_contents, PHP_EOL, $last_use_position);
    
        // Insert the new string after the end of the line

        $file_contents = substr_replace($file_contents, PHP_EOL . $string_to_add, $end_of_line_position, 0);
        
        // Write the modified contents back to the file
    
        file_put_contents($file_path, $file_contents);


        // use assemble template service to read and format routes content

        $content = AssembleTemplateService::assembleTemplate($template_file, $tokens);

        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);

        // Find the last "use" statement again
    
        $last_use_position = strrpos($file_contents, 'use App\Http\Controllers');
    
        // Find the end of the line after the last "use" statement
    
        $end_of_line_position = strpos($file_contents, PHP_EOL, $last_use_position);
    
        // Add two blank lines and additional content after the end of the line
    
        $file_contents = substr_replace($file_contents, PHP_EOL . PHP_EOL . $content, $end_of_line_position, 0);

        // Write the modified contents back to the file
    
        file_put_contents($file_path, $file_contents);

        return $content;


    }



}