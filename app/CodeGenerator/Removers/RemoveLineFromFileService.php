<?php

namespace App\CodeGenerator\Removers;

class RemoveLineFromFileService
{

    public function removeLine($file, $line_to_remove)
    {

        // Read the entire file into an array
    
        $lines = file($file, FILE_IGNORE_NEW_LINES);

        // Filter out the lines containing the string to remove
    
        $filtered_lines = array_filter($lines, function ($line) use ($line_to_remove) {

        return strpos($line, $line_to_remove) === false;

        });

    
        // If any lines were removed, update the file content

    
        if (count($lines) !== count($filtered_lines)) {

        file_put_contents($file, implode(PHP_EOL, $filtered_lines));

        } 
    




        // // Search for the line to remove
    
        // $key = array_search($line_to_remove, $lines);

        // // if the line is found, remove it

        // if ( $key !== false)  {

        //     unset($lines[$key]);

        // }

        // // Write the modified content back to the file
    
        // file_put_contents($file, implode(PHP_EOL, $lines));


    }


}