<?php

namespace App\CodeGenerator\Writers;

class Writer
{

    public function writeFromTemplate($template_file, $file_path)
    {

        // get the template

        $content = file_get_contents($template_file);

        // Write the content to the file
        // make sure directories exist before attempting to write the file

        file_put_contents($file_path, $content);

    }


}