<?php

namespace App\CodeGenerator\Formatters;

class RemoveBlankLines
{

    public static function removeLines(Array $lines, $file_path)
    {

        // $linesToRemove = [2, 4]; // Line numbers to remove

        // Read the file into an array

        $fileLines = file($file_path, FILE_IGNORE_NEW_LINES);
    
        // Remove specific lines from the array
    
        foreach ($lines as $line) {
            
            if (isset($fileLines[$line - 1])) {

            unset($fileLines[$line - 1]);

            }

        }

        // Write the modified array back to the file
    
        file_put_contents($file_path, implode(PHP_EOL, $fileLines));

    }

   
   
   




}