<?php

namespace App\CodeGenerator\Controllers;

use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Tokens\FoundationTokens;
use App\CodeGenerator\Assemblers\AssembleTemplateService;
use Illuminate\Support\Facades\File;



class ControllerService
{

    public $tokenFormatter;

    public function __construct()
    {

        $this->tokenFormatter = new FoundationTokens;

    }

    public function makeController($request)
    {


         // Format model name

         $model_name = $request->get('model');

         $model_name = ModelNameFormatter::formatModelName($model_name);
 
        // base path

        $base_path = base_path();

        $template_file = $base_path . '/app/CodeGenerator/Templates/Foundations/' . 'controller.txt';

        $tokens = $this->tokenFormatter->formatTokens($request);

        // use assemble template service to read and format content

        $content = AssembleTemplateService::assembleTemplate($template_file, $tokens);

        $controller_type = $tokens['CONTROLLERTYPE'];
        $controller_folder = $tokens['CONTROLLERFOLDER'];
        $controller_name = $tokens['CONTROLLERNAME'];

        // set path

        $filePath = base_path() . "/app/Http/Controllers/{$controller_type}/{$controller_folder}/{$controller_name}.php";

        // Create the directory if it doesn't exist
        
        File::makeDirectory(dirname($filePath), 0755, true, true);

        // Write the content to the file

        file_put_contents($filePath, $content);

        return $content;

    }


}