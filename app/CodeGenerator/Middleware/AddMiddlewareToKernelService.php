<?php

namespace App\CodeGenerator\Middleware;

class AddMiddlewareToKernelService
{

    public function addToKernel($middleware)
    {

        // path to Kernel

        $kernel_file_path = base_path() . '/app/Http/Kernel.php';

        // Read the content from the file

        $originalKernel = file_get_contents($kernel_file_path);

        // The anchor line is the line we are writing below

        $anchorLine = "'verified' => \\Illuminate\\Auth\\Middleware\\EnsureEmailIsVerified::class,";

        // tab in twice:

        $middleware = "\t\t{$middleware}";

        // Find the position of the anchor line

        $position = strpos($originalKernel, $anchorLine);

        // Insert the new line below the anchor line in the kernel
    
        $newKernel = substr_replace($originalKernel, PHP_EOL . $middleware, $position + strlen($anchorLine), 0);
    
        // Save the updated content back to the file
    
        file_put_contents($kernel_file_path, $newKernel);


    }

}