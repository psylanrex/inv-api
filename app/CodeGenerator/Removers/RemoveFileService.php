<?php

namespace App\CodeGenerator\Removers;

class RemoveFileService
{

    public function removeFile($file)
    {

        if ( file_exists($file) ) {

            unlink($file);

        }  

    }




}