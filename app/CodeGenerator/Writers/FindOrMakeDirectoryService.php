<?php

namespace App\CodeGenerator\Writers;


class FindOrMakeDirectoryService
{

    public function findOrMakeDirectory($file_path)
    {

        // Check if the directory exists

        if ( ! is_dir($file_path) ) {
    
            // Create the directory
      
            mkdir($file_path, 0755, true);

        } 


    }



}