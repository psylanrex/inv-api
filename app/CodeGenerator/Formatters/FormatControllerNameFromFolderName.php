<?php

namespace App\CodeGenerator\Formatters;

class FormatControllerNameFromFolderName
{

    public static function formatControllerName($folder_name)
    {

        // Find the position of the first backslash

        $first_backslash_position = strpos($folder_name, '\\');

        // Extract the substring starting from the position after the first backslash
    
        $controller_name = substr($folder_name, $first_backslash_position + 1);

        $controller_name = strtok($controller_name, '\\') . 'Controller';
    
        // Extract the first word after the first backslash
    
        return $controller_name;


    }


}