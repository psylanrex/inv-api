<?php

namespace App\CodeGenerator\Tokens;

use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Formatters\TableNameFormatter;
use Illuminate\Support\Str;

class FoundationTokens
{

    public function formatTokens($request)
    {

        // get values from request

        $model_name = $request->get('model');
        $controller_type = $request->get('controller_type');
        $controller_folder = $request->get('controller_folder');
        $column_1 = $request->get('column_1_name');

        // format values

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $all_models = $this->formatAllModels($model_name);

        $single_model = $this->formatSingleModel($model_name);

        $table_name = TableNameFormatter::formatTableName($model_name);

        $controller_name = $this->formatControllerName($model_name);

        $route_singular = $this->formatSingularRoute($model_name);

        $route_plural = $this->formatPluralRoute($model_name);

        $route_name = $this->formatRouteName($model_name);




        return [

            'ALLMODELS' => $all_models,
            'CONTROLLERTYPE' => $controller_type,   
            'CONTROLLERFOLDER' => $controller_folder,
            'CONTROLLERNAME' => $controller_name,
            'COLULMN1' => $column_1,
            'MODEL' => $model_name,
            'SINGLEMODEL' => $single_model,
            'TABLENAME' => $table_name,
            'ROUTENAME' => $route_name,
            'ROUTEPLURAL' => $route_plural,
            'ROUTESINGULAR' => $route_singular

        ];

        
    }



    private function formatSingleModel($model)
    {

        return Str::camel($model);

    }

    private function formatAllModels($model)
    {

        $all_models = Str::camel($model);

        return Str::plural($all_models);

    }

    private function formatControllerName($model)
    {  

        return Str::plural($model) . 'Controller';

    }

    private function formatSingularRoute($model_name)
    {

        return Str::kebab($model_name);


    }

    private function formatPluralRoute($model_name)
    {

        $model = Str::plural($model_name);

        return Str::kebab($model);


    }

    private function formatRouteName($model_name)
    {

        $route_name = preg_replace_callback('/([A-Z])/', function($match) {

            return ' ' . $match[1];

        }, $model_name);
        
        // Trim leading space, if any

        return ltrim($route_name);



    }




}