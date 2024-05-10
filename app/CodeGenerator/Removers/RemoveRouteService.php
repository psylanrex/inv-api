<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Formatters\TableNameFormatter;
use App\CodeGenerator\Tokens\FoundationTokens;
use Illuminate\Support\Str;

class RemoveRouteService
{

    public $tokenFormatter;

    public function __construct()
    {

        $this->tokenFormatter = new FoundationTokens;

    }

    public function removeRoute($request)
    {

        $file_path = base_path('/routes/api.php');


        $tokens = $this->tokenFormatter->formatTokens($request);

        // Read the entire file into a string

        $file_contents = file_get_contents($file_path);

        // Define the string to remove

        $controller_type = $request->get('controller_type');

        $controller_type = ucwords($controller_type);

        $controller_folder = Str::plural($tokens['MODEL']);

        $controller_name = $tokens['CONTROLLERNAME'];

        // format the string

        $remove_use_statement = "use App\Http\Controllers\\{$controller_type}\\{$controller_folder}\\{$controller_name };";  

        // Remove the specified string from the file contents

        $file_contents = str_replace($remove_use_statement, '', $file_contents);

        // save changes

        file_put_contents($file_path, $file_contents);

        // get modified file

        $file_contents = file_get_contents($file_path);

        // Define the start and end strings

        $start_string = "// {$tokens['ROUTENAME']} routes begin";

        $end_string = "// {$tokens['ROUTENAME']} routes end";


        // Create a pattern to match the entire block of code (including start and end strings)

        $pattern = "#$start_string.*?$end_string#s";

        // Remove the matched block from the file contents

        $file_contents = preg_replace($pattern, '', $file_contents);

        // Write the modified contents back to the file

        file_put_contents($file_path, $file_contents);

    }

}