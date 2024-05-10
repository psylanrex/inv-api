<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Formatters\ModelNameFormatter;

class RemoveModelService
{

    public static function removeModel($request)
    {

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $file_path = base_path() . "/app/Models/{$model_name}.php";

        if ( file_exists($file_path) ) {

            unlink($file_path);

        }

        return ['message' => "{$model_name} model has been deleted"];


    }




}