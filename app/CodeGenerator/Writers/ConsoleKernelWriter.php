<?php

namespace App\CodeGenerator\Writers;

class ConsoleKernelWriter
{

    public function addLineToKernel($line)
    {

        // Get the content of the Kernel.php file

        $file_path = app_path('Console/Kernel.php');
        
        $content = file_get_contents($file_path);

         // Find the position of the second opening bracket

         $pos = strpos($content, '{', strpos($content, '{') + 1);

            if ($pos !== false) {

                // Move the position to after the second opening bracket

                $pos = $pos + 1;
    
                // Insert a new line and the $schedule line

                $new_content = substr_replace($content, "\n\n \t    " . $line, $pos, 0);
    
                // Save the modified content back to the file
                
                file_put_contents($file_path, $new_content);

        } else {

            return false;

        }

    }



}