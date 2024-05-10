<?php

namespace App\CodeGenerator\Removers;

class RemoveDirectoryService
{

    public function removeDirectory($directory)
    {

        if ( is_dir($directory) ) {

            $files = glob($directory . '/*');

            foreach ($files as $file) {

                is_dir($file) ? $this->removeDirectory($file) : unlink($file);

            }

            rmdir($directory);

            return true;

        }

        return false;
        

    }




}