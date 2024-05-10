<?php

namespace App\CodeGenerator\Models;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Assemblers\AssembleTemplateService;
use App\CodeGenerator\Formatters\FillableColumnsFormatter;

class ModelService
{

    public function makeModel($request)
    {


        // Format model name

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        // base path

        $base_path = base_path();

        $template_file = $base_path . '/app/CodeGenerator/Templates/Foundations/' . 'model.txt';

        // get fillable columns

        $fillable_columns = FillableColumnsFormatter::formatFillableColumns($request);

        // define tokens

        $tokens = ['MODEL' => $model_name, 'FILLABLE' => $fillable_columns];

        // use assemble template service to read and format content

        $content = AssembleTemplateService::assembleTemplate($template_file, $tokens);

        // set path

        $filePath = base_path() . "/app/Models/{$model_name}.php";

        // Write the content to the file

        file_put_contents($filePath, $content);

        return $content;

       

    }


}